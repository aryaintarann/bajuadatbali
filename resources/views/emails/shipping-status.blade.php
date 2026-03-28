<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pengiriman Pesanan</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f6f8fb;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 650px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .08);
        }

        .header {
            background: #0d6efd;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .content {
            padding: 24px;
            color: #333333;
            font-size: 14px;
            line-height: 1.6;
        }

        .section-title {
            margin-top: 24px;
            margin-bottom: 10px;
            font-size: 15px;
            font-weight: bold;
            color: #0d6efd;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        table th,
        table td {
            padding: 8px;
            border-bottom: 1px solid #eaeaea;
        }

        table th {
            background: #f8f9fa;
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-success {
            background: #d1e7dd;
            color: #0f5132;
        }

        .badge-warning {
            background: #fff3cd;
            color: #664d03;
        }

        .badge-info {
            background: #cff4fc;
            color: #055160;
        }

        .footer {
            background: #f8f9fa;
            padding: 16px;
            font-size: 12px;
            text-align: center;
            color: #777;
        }
    </style>
</head>

<body>

    <div class="container">

        {{-- HEADER --}}
        <div class="header">
            <h2>Status Pengiriman Pesanan</h2>
            <p>Terima kasih telah berbelanja bersama kami</p>
        </div>

        {{-- CONTENT --}}
        <div class="content">

            <p>Halo <strong>{{ $order->nama }}</strong>,</p>

            <p>
                Kami ingin menginformasikan bahwa <strong>status pengiriman pesanan Anda telah diperbarui</strong>.
                Berikut adalah detail lengkap pesanan Anda:
            </p>

            {{-- STATUS --}}
            <div class="section-title">📦 Informasi Status</div>
            <table>
                <tr>
                    <th>Order ID</th>
                    <td>{{ $order->order_id_midtrans }}</td>
                </tr>
                <tr>
                    <th>Status Pembayaran</th>
                    <td>
                        <span class="badge badge-success">
                            {{ strtoupper($order->status) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Status Pengiriman</th>
                    <td>
                        @php
                            $shippingClass = match ($order->shipping_status) {
                                'diproses' => 'badge-warning',
                                'dikirim' => 'badge-info',
                                'diterima' => 'badge-success',
                                default => 'badge-info',
                            };
                        @endphp
                        <span class="badge {{ $shippingClass }}">
                            {{ strtoupper($order->shipping_status) }}
                        </span>
                    </td>
                </tr>
                @if($order->kurir)
                <tr>
                    <th>Kurir</th>
                    <td><strong>{{ $order->kurir }}</strong></td>
                </tr>
                @endif
                @if($order->nomor_resi)
                <tr>
                    <th>No. Resi</th>
                    <td><strong style="color:#0d6efd;">{{ $order->nomor_resi }}</strong></td>
                </tr>
                @endif
            </table>

            {{-- CUSTOMER --}}
            <div class="section-title">👤 Informasi Customer</div>
            <table>
                <tr>
                    <th>Nama</th>
                    <td>{{ $order->nama }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $order->email }}</td>
                </tr>
                <tr>
                    <th>No. Telepon</th>
                    <td>{{ $order->no_tlpn }}</td>
                </tr>
            </table>

            {{-- ADDRESS --}}
            <div class="section-title">📍 Alamat Pengiriman</div>
            <table>
                <tr>
                    <td>
                        {{ $order->alamat }}<br>
                        {{ $order->kota }}, {{ $order->provinsi }} {{ $order->kode_pos }}
                    </td>
                </tr>
            </table>

            {{-- ITEMS --}}
            <div class="section-title">🛒 Detail Produk</div>
            <table>
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th class="text-right">Harga</th>
                        <th class="text-right">Qty</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td>{{ $item->nama_pakaian }}</td>
                            <td class="text-right">Rp {{ number_format($item->harga_pakaian) }}</td>
                            <td class="text-right">{{ $item->quantity }}</td>
                            <td class="text-right">
                                Rp {{ number_format($item->harga_pakaian * $item->quantity) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- TOTAL --}}
            <div class="section-title">💰 Ringkasan Pembayaran</div>
            <table>
                <tr>
                    <th>Subtotal</th>
                    <td class="text-right">Rp {{ number_format($order->subtotal) }}</td>
                </tr>
                <tr>
                    <th>Ongkir</th>
                    <td class="text-right">Rp {{ number_format($order->ongkir) }}</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td class="text-right"><strong>Rp {{ number_format($order->total) }}</strong></td>
                </tr>
                <tr>
                    <th>Metode Pembayaran</th>
                    <td>{{ strtoupper($order->metode_pembayaran) }}</td>
                </tr>
            </table>

            <p style="margin-top: 24px;">
                Jika Anda memiliki pertanyaan terkait pesanan ini, silakan hubungi tim kami melalui email ini
                atau melalui WhatsApp di nomor <a href="https://wa.me/6282147384256" style="color:#25d366; font-weight:bold;">082147384256</a>.
            </p>

            <p>
                Salam hangat,<br>
                <strong>Tim Customer Service</strong>
            </p>

        </div>

        {{-- FOOTER --}}
        <div class="footer">
            Email ini dikirim secara otomatis. Mohon tidak membalas email ini.
        </div>

    </div>

</body>

</html>
