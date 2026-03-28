<h2 style="color:#dc3545; margin-bottom:15px;">
    ❌ Refund Ditolak
</h2>

<p>Halo {{ $order->nama ?? 'Customer' }},</p>

<p>
    Pengajuan refund untuk pesanan berikut telah
    <strong>ditolak oleh admin</strong>.
</p>

<hr>

<p><strong>Detail Pesanan:</strong></p>

<ul>
    <li><strong>Order ID:</strong> {{ $order->order_id_midtrans }}</li>
    <li><strong>Total:</strong> Rp {{ number_format($order->total ?? 0) }}</li>
    <li><strong>Email:</strong> {{ $order->email ?? '-' }}</li>
</ul>

@if (!empty($order->refund_reject_reason))
    <p>
        <strong>Alasan Penolakan:</strong><br>
        {{ $order->refund_reject_reason }}
    </p>
@endif

<hr>

<p>
    Jika memiliki pertanyaan lebih lanjut, silakan hubungi tim support kami melalui email ini
    atau melalui WhatsApp di nomor <a href="https://wa.me/6282147384256" style="color:#25d366; font-weight:bold;">082147384256</a>.
</p>

<p>Terima kasih.</p>
