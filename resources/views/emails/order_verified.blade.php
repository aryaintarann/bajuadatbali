<?php

use Illuminate\Support\Facades\DB;

$konf = DB::table('setting')->first();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Terverifikasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        p {
            color: #555;
            line-height: 1.6;
            margin: 10px 0;
        }
        strong {
            color: #000;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="header">
            <img src="{{ asset('logo/'.$konf->logo_setting) }}" alt="Logo">
            <h1>Pemesanan Anda Telah Diverifikasi!</h1>
        </div>
        

        @if($order->buku->id_type == 1)
            <p>Halo Kak {{ $order->nama }},</p>
            <p>Pemesanan Anda untuk buku <strong>{{ $order->buku->nama_buku }}</strong> telah berhasil diverifikasi.</p>
            <p>Buku sudah dapat diakses sekarang.</p>
        @elseif($order->buku->id_type == 2)
            <p>Halo Kak {{ $order->nama }},</p>
            <p>Pemesanan Anda untuk buku <strong>{{ $order->buku->nama_buku }}</strong> telah berhasil diverifikasi dengan nomor order: <strong>{{ $order->kode_pemesanan }}</strong>.</p>
            <p>Pengiriman buku akan kami lakukan bertahap setelah tanggal <strong>{{ \Carbon\Carbon::parse($order->created_at)->isoFormat('dddd, D MMMM YYYY H:mm:ss') }}</strong>, untuk biaya ongkos kirim akan dihitung setelah buku siap untuk dikirim.</p>
        @endif

        <p>Terima kasih atas pesanan Anda!</p>

        <p>
            Jika memiliki pertanyaan, silakan hubungi tim kami melalui email ini
            atau melalui WhatsApp di nomor <a href="https://wa.me/6282147384256" style="color:#25d366; font-weight:bold;">082147384256</a>.
        </p>

        <div class="footer">
            &copy; {{ date('Y') }} {{$konf->instansi_setting}}. All rights reserved.
        </div>
    </div>
</body>
</html>
