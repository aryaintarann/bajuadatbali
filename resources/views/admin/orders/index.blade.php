@extends('layouts.index')

@section('content')
    <div class="container py-4">

        {{-- HEADER --}}
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-2">
            <h2 class="text-primary fw-bold mb-0">📦 Daftar Pesanan</h2>
            <span class="text-muted">Total Pesanan: {{ $orders->count() }}</span>
        </div>

        {{-- ALERT --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif


        @forelse($orders as $order)
            <div class="card shadow-sm mb-4 border-0">

                {{-- CARD HEADER --}}
                <div class="card-header bg-light d-flex flex-column flex-sm-row justify-content-between gap-2">
                    <strong>🧾 Order ID: {{ $order->order_id_midtrans }}</strong>

                    {{-- STATUS PEMBAYARAN --}}
                    <div>
                        <strong>Status Pembayaran:</strong>
                        <span class="badge bg-success mt-1">
                            {{ strtoupper($order->status) }}
                        </span> {{ $order->created_at->format('d M Y, H:i') }}
                    </div>
                </div>

                {{-- CARD BODY --}}
                <div class="card-body">

                    {{-- CUSTOMER INFO --}}
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>👤 Nama:</strong> {{ $order->nama }}</p>
                            <p class="mb-1"><strong>📞 Telepon:</strong> {{ $order->no_tlpn }}</p>
                            <p class="mb-0"><strong>📧 Email:</strong> {{ $order->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>📍 Alamat Pengiriman:</strong>
                            <p class="text-muted mb-0">
                                {{ $order->alamat }}<br>
                                {{ $order->kota }}, {{ $order->provinsi }} {{ $order->kode_pos }}
                            </p>
                        </div>
                    </div>


                    {{-- ITEM TABLE --}}
                    <h6 class="fw-bold mb-2">🛒 Detail Produk</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Produk</th>
                                    <th class="text-end">Harga</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                        <td>
                                            {{ $item->nama_pakaian }}
                                            @if($item->ukuran)
                                                <small class="text-muted d-block">Ukuran: <strong>{{ $item->ukuran }}</strong></small>
                                            @endif
                                        </td>
                                        <td class="text-end">Rp {{ number_format($item->harga_pakaian) }}</td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end">
                                            Rp {{ number_format($item->harga_pakaian * $item->quantity) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- TOTAL --}}
                    <div class="row justify-content-end mt-3">
                        <div class="col-md-5">
                            <table class="table table-borderless table-sm mb-0">
                                <tr>
                                    <th>Subtotal</th>
                                    <td class="text-end">Rp {{ number_format($order->subtotal) }}</td>
                                </tr>
                                <tr>
                                    <th>Ongkir</th>
                                    <td class="text-end">Rp {{ number_format($order->ongkir) }}</td>
                                </tr>
                                <tr class="border-top">
                                    <th class="fw-bold">Total</th>
                                    <td class="text-end fw-bold text-success">
                                        Rp {{ number_format($order->total) }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    {{-- STATUS --}}
                    <div class="mt-3 d-flex flex-column flex-sm-row gap-3">


                        {{-- STATUS PENGIRIMAN --}}
                        <div>
                            <strong>Status Pengiriman:</strong>

                            {{-- Tampilkan info resi jika sudah ada --}}
                            @if($order->nomor_resi)
                            <div class="alert alert-info py-2 px-3 mt-2 mb-2" style="border-radius:8px; font-size:0.85rem;">
                                🚚 <strong>{{ $order->kurir ?? '-' }}</strong> &mdash;
                                📋 Resi: <strong>{{ $order->nomor_resi }}</strong>
                            </div>
                            @endif

                            <form action="{{ route('orders.shipping-status', $order->id) }}" method="POST" class="mt-2">
                                @csrf

                                <div class="row g-2 mb-2">
                                    <div class="col-sm-4">
                                        <select name="shipping_status" class="form-select form-select-sm">
                                            <option value="diproses"
                                                {{ $order->shipping_status == 'diproses' ? 'selected' : '' }}>
                                                Diproses
                                            </option>
                                            <option value="dikirim"
                                                {{ $order->shipping_status == 'dikirim' ? 'selected' : '' }}>
                                                Dikirim
                                            </option>
                                            <option value="sampai tujuan"
                                                {{ $order->shipping_status == 'sampai tujuan' ? 'selected' : '' }}>
                                                Sampai Tujuan
                                            </option>
                                            <option value="diterima"
                                                {{ $order->shipping_status == 'diterima' ? 'selected' : '' }}>
                                                Diterima
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <select name="kurir" class="form-select form-select-sm">
                                            <option value="">-- Kurir --</option>
                                            @foreach(['JNE', 'J&T', 'TIKI', 'POS Indonesia', 'SiCepat', 'AnterAja', 'GoSend', 'GrabExpress'] as $k)
                                                <option value="{{ $k }}" {{ $order->kurir == $k ? 'selected' : '' }}>{{ $k }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" name="nomor_resi" class="form-control form-control-sm"
                                            placeholder="No. Resi" value="{{ $order->nomor_resi }}">
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-sm btn-primary w-100">
                                            <i class="fas fa-save"></i> Update
                                        </button>
                                    </div>
                                </div>
                            </form>

                            {{-- Tombol Kirim WhatsApp (muncul setelah update berhasil) --}}
                            @if(session('wa_link') && session('wa_order_id') == $order->id)
                            <a href="{{ session('wa_link') }}" target="_blank" class="btn btn-sm btn-success mt-1">
                                <i class="fab fa-whatsapp"></i> Kirim Notifikasi WhatsApp ke Customer
                            </a>
                            @endif
                        </div>

                    </div>

                </div>
            </div>
        @empty
            <div class="alert alert-info text-center">
                📭 Belum ada pesanan
            </div>
        @endforelse

        {{-- PAGINATION --}}
        <div class="d-flex justify-content-center mt-2 mb-4">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>

        {{-- ========================= --}}
        {{-- TABLE REFUND REQUEST --}}
        {{-- ========================= --}}

        <div class="card shadow-sm mb-4 border-0">

            <div class="card-header bg-warning">
                <strong>💰 Pengajuan Refund</strong>
            </div>

            <div class="card-body">

                @php
                    $refundOrders = \App\Models\Order::where('refund_status', 'requested')->get();
                @endphp

                @if ($refundOrders->count())
                    <div class="table-responsive">

                        <table class="table table-bordered align-middle">

                            <thead class="table-light">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>Alasan</th>
                                    <th>Data Rekening</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($refundOrders as $refund)
                                    <tr>

                                        <td>{{ $refund->order_id_midtrans }}</td>

                                        <td>
                                            <strong>{{ $refund->nama }}</strong><br>
                                            <small class="text-muted">{{ $refund->email }}</small>
                                        </td>

                                        <td>Rp {{ number_format($refund->total) }}</td>

                                        <td>{{ $refund->refund_reason }}</td>

                                        {{-- DATA BANK --}}
                                        <td>
                                            <div>
                                                <strong>{{ $refund->refund_bank_name }}</strong>
                                            </div>
                                            <small>
                                                {{ $refund->refund_account_name }} <br>
                                                {{ $refund->refund_account_number }}
                                            </small>
                                        </td>

                                        <td class="d-flex gap-2">

                                            {{-- APPROVE (dengan konfirmasi modal) --}}
                                            <button type="button" class="btn btn-sm btn-success"
                                                data-bs-toggle="modal"
                                                data-bs-target="#approveModal{{ $refund->id }}">
                                                Approve
                                            </button>

                                            {{-- MODAL APPROVE KONFIRMASI --}}
                                            <div class="modal fade" id="approveModal{{ $refund->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-success text-white">
                                                            <h5 class="modal-title">✅ Konfirmasi Approve Refund</h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Anda yakin ingin <strong>menyetujui</strong> refund untuk pesanan:</p>
                                                            <ul>
                                                                <li><strong>Order ID:</strong> {{ $refund->order_id_midtrans }}</li>
                                                                <li><strong>Customer:</strong> {{ $refund->nama }}</li>
                                                                <li><strong>Total:</strong> Rp {{ number_format($refund->total) }}</li>
                                                            </ul>
                                                            <p class="text-danger mb-0"><small>⚠️ Stok produk akan dikembalikan setelah approve.</small></p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <form action="{{ route('refund.approve', $refund->id) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success">
                                                                    Ya, Approve Refund
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- REJECT --}}
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#rejectModal{{ $refund->id }}">
                                                Reject
                                            </button>


                                        </td>

                                    </tr>
                                    {{-- MODAL REJECT --}}
                                    <div class="modal fade" id="rejectModal{{ $refund->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <form action="{{ route('refund.reject', $refund->id) }}" method="POST">
                                                    @csrf

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Alasan Penolakan Refund</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body">

                                                        <label class="form-label">Masukkan alasan reject</label>

                                                        <textarea name="refund_reject_reason" class="form-control" rows="4" placeholder="Tuliskan alasan penolakan..."
                                                            required></textarea>

                                                    </div>

                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                            Batal
                                                        </button>

                                                        <button class="btn btn-danger">
                                                            Reject Refund
                                                        </button>

                                                    </div>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </tbody>


                        </table>

                    </div>
                @else
                    <div class="alert alert-info mb-0">
                        Tidak ada pengajuan refund
                    </div>
                @endif

            </div>

        </div>


    </div>
@endsection
