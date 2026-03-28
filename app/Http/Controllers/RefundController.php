<?php

namespace App\Http\Controllers;

use App\Mail\RefundApprovedMail;
use App\Mail\RefundNotification;
use App\Mail\RefundRejectedMail;
use App\Mail\RefundRequestMail;
use App\Models\Order;
use App\Models\Pakaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RefundController extends Controller
{
    // tampilkan halaman form refund
    public function showForm()
    {
        return view('refund');
    }

    // user ajukan refund
    public function requestRefund(Request $request)
    {
        // VALIDASI UTAMA
        $validator = Validator::make($request->all(), [
            'order_id'       => 'required|string|max:100',
            'email'          => 'required|email',
            'alasan'         => 'required|string|min:10|max:500',
            'nama_bank'      => 'required|in:BCA,Mandiri,BRI,BNI',
            'nama_rekening'  => 'required|string|min:3|max:100',
            'nomor_rekening' => 'required|string|min:10|max:20',
        ], [
            'order_id.required'       => 'Order ID wajib diisi.',
            'order_id.max'            => 'Order ID terlalu panjang.',
            'email.required'          => 'Email wajib diisi.',
            'email.email'             => 'Format email tidak valid.',
            'alasan.required'         => 'Alasan refund wajib diisi.',
            'alasan.min'              => 'Alasan refund minimal 10 karakter.',
            'alasan.max'              => 'Alasan refund maksimal 500 karakter.',
            'nama_bank.required'      => 'Nama bank wajib dipilih.',
            'nama_bank.in'            => 'Bank yang dipilih tidak valid.',
            'nama_rekening.required'  => 'Nama pemilik rekening wajib diisi.',
            'nama_rekening.min'       => 'Nama rekening minimal 3 karakter.',
            'nomor_rekening.required' => 'Nomor rekening wajib diisi.',
            'nomor_rekening.min'      => 'Nomor rekening minimal 10 digit.',
            'nomor_rekening.max'      => 'Nomor rekening maksimal 20 digit.',
        ]);

        // VALIDASI TAMBAHAN (CUSTOM SECURITY CHECK)
        $validator->after(function ($validator) use ($request) {

            $order = Order::where('order_id_midtrans', trim($request->order_id))
                ->where('email', trim($request->email))
                ->first();

            // ORDER TIDAK DITEMUKAN
            if (!$order) {
                $validator->errors()->add('order_id', 'Order ID tidak ditemukan atau email tidak sesuai dengan pesanan.');
                return;
            }

            // BELUM DIBAYAR
            if ($order->status !== 'paid') {
                $validator->errors()->add('order_id', 'Pesanan belum lunas, refund tidak dapat diajukan.');
            }

            // SUDAH REFUND
            if ($order->refund_status) {
                $validator->errors()->add('order_id', 'Refund sudah pernah diajukan untuk pesanan ini.');
            }
        });

        // JALANKAN VALIDASI
        $validator->validate();


        // AMBIL ORDER (PASTI VALID)
        $order = Order::where('order_id_midtrans', $request->order_id)
            ->where('email', $request->email)
            ->first();


        // UPDATE DATA REFUND
        $order->update([
            'refund_status' => 'requested',
            'refund_reason' => $request->alasan,
            'refund_requested_at' => now(),

            'refund_bank_name' => $request->nama_bank,
            'refund_account_name' => $request->nama_rekening,
            'refund_account_number' => $request->nomor_rekening
        ]);


        // EMAIL ADMIN
        Mail::to('merthadewatadestar@gmail.com')
            ->send(new RefundNotification($order));

        return back()->with('success', 'Pengajuan refund berhasil dikirim');
    }

    public function approveRefund($id)
    {
        DB::transaction(function () use ($id) {

            $order = Order::findOrFail($id);

            if ($order->refund_status != 'requested') {
                throw new \Exception('Invalid refund status');
            }

            // kembalikan stok
            foreach ($order->items as $item) {

                $pakaian = Pakaian::where('id_pakaian', $item->pakaian_id)
                    ->lockForUpdate()
                    ->first();

                if (!$pakaian) {
                    \Log::warning('Refund approve: Pakaian tidak ditemukan untuk pakaian_id=' . $item->pakaian_id);
                    continue; // skip, jangan crash
                }

                $pakaian->stok_pakaian += $item->quantity;
                $pakaian->save();
            }

            $order->update([
                'refund_status' => 'refunded',
                'status' => 'refunded',
                'refund_processed_at' => now()
            ]);

            // email customer
            Mail::to($order->email)
                ->send(new RefundApprovedMail($order));
        });

        return back()->with('success', 'Refund disetujui');
    }

    public function rejectRefund(Request $request, $id)
    {
        $request->validate([
            'refund_reject_reason' => 'required|string|min:5|max:300'
        ]);

        $order = Order::findOrFail($id);

        if ($order->refund_status != 'requested') {
            return back()->withErrors('Status refund tidak valid');
        }

        $order->update([
            'refund_status' => 'rejected',
            'refund_processed_at' => now(),
            'refund_reject_reason' => $request->refund_reject_reason
        ]);

        Mail::to($order->email)
            ->send(new RefundRejectedMail($order));

        return back()->with('success', 'Refund ditolak');
    }
}
