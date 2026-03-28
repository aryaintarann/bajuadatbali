<h2>Terima kasih telah berbelanja di toko kami 🙏</h2>

<p>Halo <strong>{{ $order->nama }}</strong>,</p>

<p>
    Pesanan Anda telah <strong>berhasil dibayar</strong> dan saat ini sedang kami siapkan
    untuk proses pengiriman.
</p>

<hr>

<h4>📦 Detail Pesanan</h4>
<p><strong>Order ID:</strong> {{ $order->order_id_midtrans }}</p>
<p><strong>Total Pembayaran:</strong> Rp {{ number_format($order->total) }}</p>
<p><strong>Ongkir:</strong> Rp {{ number_format($order->ongkir) }}</p>

<h4>🛒 Daftar Produk</h4>
<table width="100%" cellpadding="6" cellspacing="0" border="1" style="border-collapse: collapse;">
    <thead style="background:#f5f5f5;">
        <tr>
            <th align="left">Produk</th>
            <th align="center">Jumlah</th>
            <th align="right">Harga</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->items as $item)
            <tr>
                <td>{{ $item->nama_pakaian }}</td>
                <td align="center">{{ $item->quantity }}</td>
                <td align="right">
                    Rp {{ number_format($item->harga_pakaian * $item->quantity) }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<h4>📍 Alamat Pengiriman</h4>
<p>
    {{ $order->alamat }} <br>
    {{ $order->kota }}, {{ $order->provinsi }} {{ $order->kode_pos }}
</p>

<h4>🚚 Estimasi Pengiriman</h4>
<p>
    Pesanan Anda diperkirakan tiba dalam waktu:
    <strong>{{ $estimasi }}</strong>
</p>

<hr>

<p>
    Jika Anda memiliki pertanyaan, silakan balas email ini atau hubungi layanan pelanggan kami
    melalui WhatsApp di nomor <a href="https://wa.me/6282147384256" style="color:#25d366; font-weight:bold;">082147384256</a>.
</p>

<p>
    Terima kasih telah mempercayakan belanja Anda kepada kami 😊
</p>

<p>
    <strong>Salam,</strong><br>
    Tim Toko Online
</p>
