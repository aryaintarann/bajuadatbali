<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
    /**
     * Tampilkan form cek status pesanan
     */
    public function index()
    {
        return view('order-tracking');
    }

    /**
     * Proses pencarian pesanan berdasarkan Order ID Midtrans + email
     */
    public function search(Request $request)
    {
        $request->validate([
            'order_id'  => 'required|string',
            'email'     => 'required|email',
        ], [
            'order_id.required' => 'Nomor pesanan wajib diisi.',
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
        ]);

        $order = Order::with('items')
            ->where('order_id_midtrans', $request->order_id)
            ->where('email', $request->email)
            ->first();

        if (!$order) {
            return back()
                ->withInput()
                ->withErrors(['not_found' => 'Pesanan tidak ditemukan. Pastikan Nomor Pesanan dan Email sudah benar.']);
        }

        return view('order-tracking', compact('order'));
    }
}
