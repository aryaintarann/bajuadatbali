@extends('layouts.web')

@section('isi')

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-search mr-3"></i>Cek Status Pesanan</h1>
        <div class="breadcrumb-nav">
            <a href="{{ url('/') }}">Beranda</a>
            <span>/</span> Cek Status Pesanan
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            <!-- Info Box -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius:16px; border-left:4px solid #E8500A !important; background:#fff8f3;">
                <div class="card-body d-flex align-items-center gap-3 py-3 px-4">
                    <i class="fas fa-info-circle" style="color:#E8500A; font-size:1.4rem; flex-shrink:0;"></i>
                    <div style="font-size:0.9rem; color:#555;">
                        Masukkan <strong>Nomor Pesanan</strong> (dikirim ke email Anda setelah pembayaran) dan <strong>Email</strong> yang digunakan saat checkout.
                    </div>
                </div>
            </div>

            <!-- Search Form -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius:20px;">
                <div class="card-body p-4">
                    <h5 style="font-weight:700; color:#1a1a1a; margin-bottom:1.5rem;">
                        <i class="fas fa-search mr-2" style="color:#E8500A;"></i>Lacak Pesanan Anda
                    </h5>

                    @if ($errors->has('not_found'))
                        <div class="alert alert-danger" style="border-radius:12px; border:none; background:#fff5f5;">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $errors->first('not_found') }}
                        </div>
                    @endif

                    <form action="{{ route('order.tracking.search') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label class="form-label" style="font-weight:600; font-size:0.9rem;">Nomor Pesanan</label>
                            <input type="text" name="order_id" class="form-control @error('order_id') is-invalid @enderror"
                                placeholder="Contoh: ORDER-ABC123-..." value="{{ old('order_id') }}"
                                style="border-radius:10px; padding:10px 14px;">
                            @error('order_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label" style="font-weight:600; font-size:0.9rem;">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Email yang digunakan saat checkout" value="{{ old('email') }}"
                                style="border-radius:10px; padding:10px 14px;">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block" style="border-radius:10px; padding:10px; font-weight:600;">
                            <i class="fas fa-search mr-2"></i>Cek Pesanan
                        </button>
                    </form>
                </div>
            </div>

            {{-- HASIL --}}
            @isset($order)
            <div class="card border-0 shadow-sm mb-4" style="border-radius:20px;">
                <div class="card-header border-0 py-4 px-4" style="background:linear-gradient(135deg,#E8500A,#c43d00); border-radius:20px 20px 0 0;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-white" style="font-weight:600;">Detail Pesanan</h5>
                        <span class="badge" style="background:rgba(255,255,255,0.2); color:#fff; padding:6px 14px; border-radius:50px; font-size:0.8rem;">
                            {{ strtoupper($order->status) }}
                        </span>
                    </div>
                </div>
                <div class="card-body px-4 py-4">

                    <!-- Order ID & Tanggal -->
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3" style="border-bottom:1px solid #f0f0f0;">
                        <span class="text-muted" style="font-size:0.9rem;">Nomor Pesanan</span>
                        <strong style="font-size:0.85rem; color:#E8500A;">{{ $order->order_id_midtrans }}</strong>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3" style="border-bottom:1px solid #f0f0f0;">
                        <span class="text-muted" style="font-size:0.9rem;">Tanggal Pesan</span>
                        <span style="font-size:0.9rem;">{{ $order->created_at->format('d M Y, H:i') }} WIB</span>
                    </div>

                    <!-- Penerima -->
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3" style="border-bottom:1px solid #f0f0f0;">
                        <span class="text-muted" style="font-size:0.9rem;">Penerima</span>
                        <strong style="font-size:0.9rem;">{{ $order->nama }}</strong>
                    </div>

                    <!-- Alamat -->
                    <div class="d-flex justify-content-between mb-3 pb-3" style="border-bottom:1px solid #f0f0f0;">
                        <span class="text-muted" style="font-size:0.9rem; flex-shrink:0;">Alamat</span>
                        <span style="font-size:0.85rem; text-align:right; max-width:65%;">
                            {{ $order->alamat }}, {{ $order->kota }}, {{ $order->provinsi }} {{ $order->kode_pos }}
                        </span>
                    </div>

                    <!-- Status Pengiriman -->
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3" style="border-bottom:1px solid #f0f0f0;">
                        <span class="text-muted" style="font-size:0.9rem;">Status Pengiriman</span>
                        @php
                            $badgeColor = match($order->shipping_status) {
                                'diproses'      => '#ffc107',
                                'dikirim'       => '#0d6efd',
                                'sampai tujuan' => '#17a2b8',
                                'diterima'      => '#28a745',
                                default         => '#999',
                            };
                        @endphp
                        <span class="badge" style="background:{{ $badgeColor }}; color:#fff; padding:5px 12px; border-radius:50px; font-size:0.8rem;">
                            {{ $order->shipping_status ? strtoupper($order->shipping_status) : 'MENUNGGU PROSES' }}
                        </span>
                    </div>

                    <!-- Kurir -->
                    @if($order->kurir)
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3" style="border-bottom:1px solid #f0f0f0;">
                        <span class="text-muted" style="font-size:0.9rem;">Kurir</span>
                        <strong style="font-size:0.9rem;">🚚 {{ $order->kurir }}</strong>
                    </div>
                    @endif

                    <!-- Nomor Resi -->
                    @if($order->nomor_resi)
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3" style="border-bottom:1px solid #f0f0f0;">
                        <span class="text-muted" style="font-size:0.9rem;">Nomor Resi</span>
                        <strong style="font-size:0.9rem; color:#0d6efd;">📋 {{ $order->nomor_resi }}</strong>
                    </div>
                    @endif

                    <!-- Items -->
                    @if($order->items && $order->items->count() > 0)
                    <div class="mb-3 pb-3" style="border-bottom:1px solid #f0f0f0;">
                        <span class="text-muted d-block mb-2" style="font-size:0.9rem;">Item Pesanan</span>
                        @foreach($order->items as $item)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span style="font-size:0.88rem;">
                                {{ $item->nama_pakaian }} 
                                @if($item->ukuran) <span class="badge bg-secondary ms-1 px-2" style="font-size:0.75rem;">{{ $item->ukuran }}</span> @endif
                                <span class="text-muted ms-1">x{{ $item->quantity }}</span>
                            </span>
                            <span style="font-size:0.88rem; font-weight:600;">Rp {{ number_format($item->harga_pakaian * $item->quantity, 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- Total -->
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="font-weight:700; font-size:1rem;">Total Pembayaran</span>
                        <span style="font-weight:700; font-size:1.2rem; color:#E8500A;">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            @if(is_null($order->refund_status) || $order->refund_status === 'rejected')
            <!-- Tombol Request Refund -->
            <div class="text-center mb-4">
                <a href="{{ url('/refund') }}" class="btn btn-outline-danger" style="border-radius:10px;">
                    <i class="fas fa-undo mr-2"></i>Ajukan Refund
                </a>
            </div>
            @elseif($order->refund_status === 'requested')
            <div class="alert alert-warning text-center" style="border-radius:12px;">
                <i class="fas fa-clock mr-2"></i><strong>Refund sedang diproses</strong> oleh admin.
            </div>
            @elseif($order->refund_status === 'refunded')
            <div class="alert alert-success text-center" style="border-radius:12px;">
                <i class="fas fa-check-circle mr-2"></i><strong>Refund telah disetujui</strong> dan sudah diproses.
            </div>
            @endif

            @endisset

        </div>
    </div>
</div>

@endsection
