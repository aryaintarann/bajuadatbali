<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ShippingStatusUpdated;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        $title = 'Pesanan';
        $orders = Order::with('items')->latest()->paginate(10);

        return view('admin.orders.index', compact('orders', 'title'));
    }

    public function updateShippingStatus(Request $request, Order $order)
    {
        $request->validate([
            'shipping_status' => 'required|string',
            'kurir'           => 'nullable|string|max:50',
            'nomor_resi'      => 'nullable|string|max:100',
        ]);

        $order->update([
            'shipping_status' => $request->shipping_status,
            'kurir'           => $request->kurir,
            'nomor_resi'      => $request->nomor_resi,
        ]);

        // kirim email ke customer
        Mail::to($order->email)->send(new ShippingStatusUpdated($order));

        // generate link WhatsApp untuk notifikasi manual
        $waMessage = "Halo {$order->nama},\n\n"
            . "Pesanan Anda *{$order->order_id_midtrans}* telah diperbarui:\n"
            . "📦 Status: *" . strtoupper($request->shipping_status) . "*\n";

        if ($request->kurir) {
            $waMessage .= "🚚 Kurir: *{$request->kurir}*\n";
        }
        if ($request->nomor_resi) {
            $waMessage .= "📋 No. Resi: *{$request->nomor_resi}*\n";
        }

        $waMessage .= "\nTerima kasih telah berbelanja di Baju Adat Bali! 🙏";

        // Bersihkan no telepon (hapus +, spasi, dash) dan buat link wa.me
        $phone = preg_replace('/[^0-9]/', '', $order->no_tlpn);
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }
        $waLink = 'https://wa.me/' . $phone . '?text=' . urlencode($waMessage);

        return back()->with([
            'success' => 'Status pengiriman berhasil diperbarui & email terkirim!',
            'wa_link' => $waLink,
            'wa_order_id' => $order->id,
        ]);
    }
}
