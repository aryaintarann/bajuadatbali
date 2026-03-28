<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function store(Request $request, $id)
    {
        $product = DB::table('pakaian')->where('id_pakaian', $id)->first();

        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        $request->validate([
            'ukuran' => 'nullable|string'
        ]);

        $ukuran = $request->ukuran;

        // Jika butuh ukuran, validasi stok spesifik ukurannya (HANYA JIKA UKURAN DIKIRIM)
        $stokTersedia = $product->stok_pakaian;
        if ($ukuran) {
            $ukuranStok = DB::table('pakaian_sizes')
                ->where('pakaian_id', $id)
                ->where('ukuran', $ukuran)
                ->first();
            
            if (!$ukuranStok || $ukuranStok->stok <= 0) {
                return redirect()->back()->with('error', 'Maaf, stok untuk ukuran ' . $ukuran . ' sudah habis.');
            }
            $stokTersedia = $ukuranStok->stok;
        }

        $cartKey = $ukuran ? $id . '_' . $ukuran : $id;
        $cart = session()->get('cart', []);
        $currentQty = isset($cart[$cartKey]) ? $cart[$cartKey]['quantity'] : 0;

        if ($currentQty + 1 > $stokTersedia) {
            return redirect()->back()->with('error', 'Maaf, stok tidak mencukupi. Stok tersedia: ' . $stokTersedia);
        }

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity']++;
        } else {
            $cart[$cartKey] = [
                'id_pakaian' => $product->id_pakaian,
                'nama'       => $product->nama_pakaian,
                'harga'      => $product->harga_pakaian,
                'gambar'     => $product->gambar_pakaian,
                'butuh_ukuran' => $product->butuh_ukuran,
                'ukuran'     => $ukuran, // Menyimpan ukuran
                'quantity'   => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Produk ditambahkan ke keranjang!');
    }


    public function index()
    {
        $konf = DB::table('setting')->first();
        $cart = session()->get('cart', []);

        return view('cart', compact('cart', 'konf'));
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);
        
        if (!isset($cart[$id])) {
            return redirect()->route('cart.index')->with('error', 'Produk tidak ditemukan di keranjang.');
        }

        $itemCart = $cart[$id];
        $idPakaian = $itemCart['id_pakaian'];
        $ukuran = $itemCart['ukuran'] ?? null;

        $product = DB::table('pakaian')->where('id_pakaian', $idPakaian)->first();
        
        $stokTersedia = $product->stok_pakaian;
        if ($ukuran) {
             $ukuranStok = DB::table('pakaian_sizes')
                ->where('pakaian_id', $idPakaian)
                ->where('ukuran', $ukuran)
                ->first();
             $stokTersedia = $ukuranStok ? $ukuranStok->stok : 0;
        }

        if ($product && $request->quantity > $stokTersedia) {
            return redirect()->route('cart.index')
                ->with('error', 'Stok tidak mencukupi. Stok tersedia: ' . $stokTersedia);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Jumlah produk diperbarui.');
        }

        return redirect()->route('cart.index')->with('error', 'Produk tidak ditemukan di keranjang.');
    }

    public function updateSize(Request $request, $id)
    {
        $request->validate([
            'ukuran' => 'required|string'
        ]);

        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return redirect()->route('cart.index')->with('error', 'Produk tidak ditemukan di keranjang.');
        }

        $itemCart = $cart[$id];
        $idPakaian = $itemCart['id_pakaian'];
        $newUkuran = $request->ukuran;
        $quantity = $itemCart['quantity'];

        // Cek apakah stok ukuran baru cukup
        $ukuranStok = DB::table('pakaian_sizes')
            ->where('pakaian_id', $idPakaian)
            ->where('ukuran', $newUkuran)
            ->first();

        if (!$ukuranStok || $ukuranStok->stok < $quantity) {
            return redirect()->back()->with('error', 'Maaf, stok untuk ukuran ' . $newUkuran . ' tidak mencukupi.');
        }

        // Buat key baru
        $newCartKey = $idPakaian . '_' . $newUkuran;

        // Jika key baru sudah ada (misal ganti dari S ke M, tapi M sudah ada di cart)
        if (isset($cart[$newCartKey]) && $newCartKey !== $id) {
            if ($ukuranStok->stok < ($cart[$newCartKey]['quantity'] + $quantity)) {
                return redirect()->back()->with('error', 'Maaf, gabungan stok untuk ukuran ' . $newUkuran . ' tidak mencukupi.');
            }
            $cart[$newCartKey]['quantity'] += $quantity;
            unset($cart[$id]);
        } else {
            // Ubah atribut ukuran dan key
            $cart[$newCartKey] = $cart[$id];
            $cart[$newCartKey]['ukuran'] = $newUkuran;
            if ($newCartKey !== $id) {
                unset($cart[$id]);
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Ukuran produk diperbarui.');
    }
}
