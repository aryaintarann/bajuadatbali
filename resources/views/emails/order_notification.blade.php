<?php

use Illuminate\Support\Facades\DB;

$konf = DB::table('setting')->first();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Baru</title>
    <style>
        body {
            background-color: #f4f6f8;
            margin: 0;
            padding: 30px 10px;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
        }

        .container {
            max-width: 650px;
            margin: auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e0e0e0;
        }

        .logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo img {
            max-width: 160px;
            height: auto;
        }

        h2 {
            color: #2d3436;
            font-size: 24px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        h2::before {
            content: "📦";
            margin-right: 10px;
            font-size: 28px;
        }

        p {
            font-size: 15px;
            line-height: 1.6;
            margin: 8px 0;
        }

        .highlight {
            font-weight: 600;
            color: #0984e3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        table th {
            background-color: #f1f2f6;
            text-align: left;
        }

        table td.center {
            text-align: center;
        }

        table td.right {
            text-align: right;
        }

        .total-box {
            background-color: #f9f9f9;
            border: 1px dashed #ccc;
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 16px;
            margin-top: 20px;
        }

        .total-box span {
            font-size: 18px;
            font-weight: bold;
            color: #27ae60;
        }

        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #e0e0e0;
            font-size: 13px;
            color: #7f8c8d;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="logo">
            @if($konf && $konf->logo_setting)
                <img src="{{ asset('logo/' . $konf->logo_setting) }}" alt="Logo Toko">
            @else
                <h3 style="color:#E8500A; margin:0;">Baju Adat Bali</h3>
            @endif
        </div>

        <h2>Pesanan Baru Diterima</h2>

        <p><span class="highlight">Nama Customer:</span> {{ $order->nama }}</p>
        <p><span class="highlight">No Telp:</span> {{ $order->no_tlpn }}</p>

        <p><span class="highlight">Alamat Pengiriman:</span><br>
            {{ $order->alamat }}<br>
            {{ $order->kota }}, {{ $order->provinsi }} - {{ $order->kode_pos }}
        </p>

        <hr>

        <h4>🛒 Detail Produk</h4>
        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th class="center">Qty</th>
                    <th class="right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->nama_pakaian }}</td>
                        <td class="center">{{ $item->quantity }}</td>
                        <td class="right">
                            Rp {{ number_format($item->harga_pakaian * $item->quantity) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-box">
            <p>Ongkir: <strong>Rp {{ number_format($order->ongkir) }}</strong></p>
            <p>Total Pembayaran: <span>Rp {{ number_format($order->total) }}</span></p>
        </div>

        <div class="footer">
            <p>Segera proses pesanan ini melalui dashboard admin.</p>
            <p>Email ini dikirim otomatis oleh sistem.</p>
        </div>

    </div>
</body>

</html>
