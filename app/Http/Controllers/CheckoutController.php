<?php

namespace App\Http\Controllers;

use App\Mail\OrderNotification;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Pakaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    /**
     * Halaman checkout
     */
    public function index()
    {
        $cart = session('cart', []);

        $subtotal = collect($cart)
            ->sum(fn($item) => $item['harga'] * $item['quantity']);

        return view('checkout', compact('cart', 'subtotal'));
    }

    /**
     * Halaman sukses setelah pembayaran
     */
    public function success()
    {
        // Ambil order terakhir dari session atau dari database
        $orderIdMidtrans = session('last_order_id');
        $order = null;

        if ($orderIdMidtrans) {
            $order = Order::with('items')
                ->where('order_id_midtrans', $orderIdMidtrans)
                ->first();
        }

        // Jika tidak ada di session, ambil order terbaru milik user ini
        if (!$order && auth()->check()) {
            $order = Order::with('items')
                ->where('user_id', auth()->id())
                ->latest()
                ->first();
        }

        return view('checkout.success', compact('order'));
    }

    /**
     * Proses checkout → Midtrans
     */
    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_tlpn' => 'required|string|max:20',
            'email' => 'required|email',
            'alamat' => 'required|string',
            'kota' => 'required|string',
            'provinsi' => 'required|string',
            'kode_pos' => 'required|string|max:10',
            'metode_pembayaran' => 'required|in:midtrans',
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->withErrors('Keranjang belanja kosong');
        }

        // Hitung subtotal
        $subtotal = collect($cart)
            ->sum(fn($item) => $item['harga'] * $item['quantity']);

        // ✅ ONGKIR BERDASARKAN PROVINSI
        $ongkir = $this->hitungOngkirProvinsi($validated['provinsi']);

        $total = $subtotal + $ongkir;

        session([
            'midtrans_order' => [
                ...$validated,
                'subtotal' => $subtotal,
                'ongkir' => $ongkir,
                'total' => $total,
                'cart' => $cart, // Langsung gunakan keranjang karena id_pakaian dan ukuran sudah ada
                'user_id' => auth()->id(), // ✅ Simpan user_id agar tetap ada saat callback
            ]
        ]);

        return $this->prosesMidtrans(
            $total,
            $validated['nama'],
            $validated['no_tlpn']
        );
    }

    /**
     * Proses pembayaran Midtrans
     */
    public function prosesMidtrans($total, $nama, $telp)
    {
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = true;
        Config::$is3ds = true;
        
        // Tambahan untuk mengatasi error SSL di local/windows
        if (config('app.env') !== 'production') {
            Config::$curlOptions[CURLOPT_SSL_VERIFYPEER] = false;
            // Pencegahan error undefined array key 10023 (CURLOPT_HTTPHEADER) di library Midtrans
            if (!isset(Config::$curlOptions[CURLOPT_HTTPHEADER])) {
                Config::$curlOptions[CURLOPT_HTTPHEADER] = [];
            }
        }

        $orderId = uniqid('ORDER-');

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => $nama,
                'phone' => $telp,
            ],
        ];

        session(['midtrans_order_id' => $orderId]);

        return view('payment.midtrans', [
            'snapToken' => Snap::getSnapToken($params)
        ]);
    }

    /**
     * Simpan order setelah pembayaran sukses
     */
    public function simpanSetelahBayar()
    {
        try {
            DB::transaction(function () {

                $data = session('midtrans_order');
                $orderIdMidtrans = session('midtrans_order_id');

                if (!$data || !$orderIdMidtrans) {
                    throw new \Exception('Data order tidak ditemukan di session. Silakan ulangi checkout.');
                }

                if (Order::where('order_id_midtrans', $orderIdMidtrans)->exists()) {
                    // Order sudah ada - ini bukan error, kembalikan sukses saja
                    return;
                }

                $order = Order::create([
                    'user_id' => $data['user_id'] ?? auth()->id(), // ✅ Ambil dari session jika auth sudah expired
                    'nama' => $data['nama'],
                    'no_tlpn' => $data['no_tlpn'],
                    'email' => $data['email'],
                    'alamat' => $data['alamat'],
                    'kota' => $data['kota'],
                    'provinsi' => $data['provinsi'],
                    'kode_pos' => $data['kode_pos'],
                    'subtotal' => $data['subtotal'],
                    'ongkir' => $data['ongkir'],
                    'total' => $data['total'],
                    'order_id_midtrans' => $orderIdMidtrans,
                    'metode_pembayaran' => 'midtrans',
                    'status' => 'paid',
                ]);

                foreach ($data['cart'] as $item) {

                    $pakaian = Pakaian::where('id_pakaian', $item['id_pakaian'])
                        ->lockForUpdate()
                        ->first();

                    if (!$pakaian) {
                        throw new \Exception('Produk tidak ditemukan: ' . ($item['nama'] ?? $item['id_pakaian']));
                    }

                    if ($pakaian->stok_pakaian < $item['quantity']) {
                        throw new \Exception('Stok tidak mencukupi: ' . $item['nama']);
                    }

                    $pakaian->stok_pakaian -= $item['quantity'];
                    $pakaian->save();
                    
                    // ✅ Kurangi stok spesifik berdasarkan ukuran jika ada
                    if (isset($item['ukuran'])) {
                        $pakaianSize = \App\Models\PakaianSize::where('pakaian_id', $pakaian->id_pakaian)
                            ->where('ukuran', $item['ukuran'])
                            ->lockForUpdate()
                            ->first();
                            
                        if ($pakaianSize && $pakaianSize->stok >= $item['quantity']) {
                            $pakaianSize->stok -= $item['quantity'];
                            $pakaianSize->save();
                        } else {
                            throw new \Exception('Stok ukuran ' . $item['ukuran'] . ' tidak mencukupi untuk: ' . $item['nama']);
                        }
                    }

                    OrderItem::create([
                        'order_id' => $order->id,
                        'pakaian_id' => $pakaian->id_pakaian,
                        'nama_pakaian' => $item['nama'],
                        'harga_pakaian' => $item['harga'],
                        'quantity' => $item['quantity'],
                        'ukuran' => $item['ukuran'] ?? null, // ✅ Simpan ukuran
                    ]);
                }

                $estimasi = $this->estimasiPengiriman($order->provinsi);

                // Email Owner
                try {
                    Mail::to('merthadewatadestar@gmail.com')
                        ->send(new OrderNotification($order, $estimasi, 'owner'));
                } catch (\Exception $e) {
                    \Log::error('Gagal kirim email owner: ' . $e->getMessage());
                }

                // Email Customer
                try {
                    Mail::to($order->email)
                        ->send(new OrderNotification($order, $estimasi, 'customer'));
                } catch (\Exception $e) {
                    \Log::error('Gagal kirim email customer: ' . $e->getMessage());
                }

                session()->put('last_order_id', $order->order_id_midtrans);

                session()->forget([
                    'cart',
                    'midtrans_order',
                    'midtrans_order_id'
                ]);
            });

            return response()->json([
                'message' => 'Order berhasil disimpan'
            ]);

        } catch (\Exception $e) {
            \Log::error('simpanSetelahBayar error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Gagal menyimpan order: ' . $e->getMessage()
            ], 500);
        }
    }



    /**
     * ONGKIR FLAT PER PROVINSI (SIMULASI)
     */
    private function hitungOngkirProvinsi($provinsi)
    {
        $ongkir = [
            // SUMATERA
            'Aceh' => 30000,
            'Sumatera Utara' => 28000,
            'Sumatera Barat' => 28000,
            'Riau' => 27000,
            'Kepulauan Riau' => 30000,
            'Jambi' => 27000,
            'Sumatera Selatan' => 26000,
            'Bengkulu' => 28000,
            'Lampung' => 25000,
            'Bangka Belitung' => 30000,

            // JAWA
            'DKI Jakarta' => 10000,
            'Jawa Barat' => 12000,
            'Banten' => 12000,
            'Jawa Tengah' => 15000,
            'DI Yogyakarta' => 15000,
            'Jawa Timur' => 18000,

            // BALI & NUSA TENGGARA
            'Bali' => 20000,
            'Nusa Tenggara Barat' => 30000,
            'Nusa Tenggara Timur' => 40000,

            // KALIMANTAN
            'Kalimantan Barat' => 35000,
            'Kalimantan Tengah' => 35000,
            'Kalimantan Selatan' => 35000,
            'Kalimantan Timur' => 38000,
            'Kalimantan Utara' => 40000,

            // SULAWESI
            'Sulawesi Utara' => 40000,
            'Sulawesi Tengah' => 40000,
            'Sulawesi Selatan' => 38000,
            'Sulawesi Tenggara' => 40000,
            'Gorontalo' => 40000,
            'Sulawesi Barat' => 40000,

            // MALUKU & PAPUA
            'Maluku' => 45000,
            'Maluku Utara' => 45000,
            'Papua' => 60000,
            'Papua Barat' => 55000,
        ];

        return $ongkir[$provinsi] ?? 30000;
    }


    private function estimasiPengiriman($provinsi)
    {
        $estimasi = [
            // JAWA
            'DKI Jakarta' => '1 - 2 hari kerja',
            'Jawa Barat' => '2 - 3 hari kerja',
            'Banten' => '2 - 3 hari kerja',
            'Jawa Tengah' => '3 - 4 hari kerja',
            'DI Yogyakarta' => '3 - 4 hari kerja',
            'Jawa Timur' => '3 - 5 hari kerja',

            // SUMATERA
            'Aceh' => '4 - 6 hari kerja',
            'Sumatera Utara' => '4 - 6 hari kerja',
            'Sumatera Barat' => '4 - 6 hari kerja',
            'Riau' => '4 - 6 hari kerja',
            'Kepulauan Riau' => '5 - 7 hari kerja',
            'Jambi' => '4 - 6 hari kerja',
            'Sumatera Selatan' => '4 - 6 hari kerja',
            'Bengkulu' => '4 - 6 hari kerja',
            'Lampung' => '4 - 6 hari kerja',
            'Bangka Belitung' => '5 - 7 hari kerja',

            // BALI & NUSA TENGGARA
            'Bali' => '4 - 6 hari kerja',
            'Nusa Tenggara Barat' => '5 - 7 hari kerja',
            'Nusa Tenggara Timur' => '6 - 8 hari kerja',

            // KALIMANTAN
            'Kalimantan Barat' => '5 - 7 hari kerja',
            'Kalimantan Tengah' => '5 - 7 hari kerja',
            'Kalimantan Selatan' => '5 - 7 hari kerja',
            'Kalimantan Timur' => '6 - 8 hari kerja',
            'Kalimantan Utara' => '6 - 8 hari kerja',

            // SULAWESI
            'Sulawesi Utara' => '6 - 8 hari kerja',
            'Sulawesi Tengah' => '6 - 8 hari kerja',
            'Sulawesi Selatan' => '5 - 7 hari kerja',
            'Sulawesi Tenggara' => '6 - 8 hari kerja',
            'Gorontalo' => '6 - 8 hari kerja',
            'Sulawesi Barat' => '6 - 8 hari kerja',

            // MALUKU & PAPUA
            'Maluku' => '7 - 10 hari kerja',
            'Maluku Utara' => '7 - 10 hari kerja',
            'Papua' => '8 - 12 hari kerja',
            'Papua Barat' => '8 - 12 hari kerja',
        ];

        return $estimasi[$provinsi] ?? '4 - 7 hari kerja';
    }
}
