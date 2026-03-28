<h2 style="color:#ffc107; margin-bottom:15px;">
    💰 Pengajuan Refund Baru
</h2>

<p>Admin, terdapat pengajuan refund baru dengan detail berikut:</p>

<hr>

<p><strong>Detail Pesanan:</strong></p>

<ul>
    <li><strong>Order ID:</strong> {{ $order->order_id_midtrans }}</li>
    <li><strong>Nama:</strong> {{ $order->nama ?? '-' }}</li>
    <li><strong>Email:</strong> {{ $order->email ?? '-' }}</li>
</ul>

<p><strong>Alasan Refund:</strong></p>

<p>
    {{ $order->refund_reason ?? '-' }}
</p>

<hr>

<p><strong>Data Rekening Customer:</strong></p>

<ul>
    <li><strong>Bank:</strong> {{ $order->refund_bank_name ?? '-' }}</li>
    <li><strong>Nama Rekening:</strong> {{ $order->refund_account_name ?? '-' }}</li>
    <li><strong>Nomor Rekening:</strong> {{ $order->refund_account_number ?? '-' }}</li>
</ul>

<hr>

<p>
    Silakan login ke dashboard admin untuk melakukan approve atau reject.
</p>
