@extends('layouts.web')

@section('isi')

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-check-circle mr-3"></i>Pembayaran Berhasil!</h1>
        <div class="breadcrumb-nav">
            <a href="{{ url('/') }}">Beranda</a>
            <span>/</span> Konfirmasi Pesanan
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            <!-- Success Card -->
            <div class="card border-0 shadow-sm text-center mb-4" style="border-radius:20px; overflow:hidden;">
                <div class="card-body py-5">
                    <!-- Animated checkmark -->
                    <div class="mb-4" style="width:90px; height:90px; background:linear-gradient(135deg,#28a745,#20c997); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto; box-shadow:0 10px 30px rgba(40,167,69,0.3);">
                        <i class="fas fa-check" style="font-size:2.5rem; color:#fff;"></i>
                    </div>
                    <h3 style="font-family:'Playfair Display',serif; font-weight:700; color:#1a1a1a;">Terima Kasih!</h3>
                    <p class="text-muted mb-0">Pesanan Anda telah berhasil dibayar dan sedang diproses.</p>
                </div>
            </div>

            @if($order)
            <!-- Order Detail Card -->
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

                    <!-- Order ID -->
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3" style="border-bottom:1px solid #f0f0f0;">
                        <span class="text-muted" style="font-size:0.9rem;">Nomor Pesanan</span>
                        <strong style="font-size:0.9rem; color:#E8500A;">{{ $order->order_id_midtrans }}</strong>
                    </div>

                    <!-- Customer Info -->
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3" style="border-bottom:1px solid #f0f0f0;">
                        <span class="text-muted" style="font-size:0.9rem;">Penerima</span>
                        <strong style="font-size:0.9rem;">{{ $order->nama }}</strong>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3" style="border-bottom:1px solid #f0f0f0;">
                        <span class="text-muted" style="font-size:0.9rem;">Alamat Pengiriman</span>
                        <span style="font-size:0.85rem; text-align:right; max-width:60%;">{{ $order->alamat }}, {{ $order->kota }}, {{ $order->provinsi }} {{ $order->kode_pos }}</span>
                    </div>

                    <!-- Items -->
                    @if($order->items && $order->items->count() > 0)
                    <div class="mb-3 pb-3" style="border-bottom:1px solid #f0f0f0;">
                        <span class="text-muted d-block mb-2" style="font-size:0.9rem;">Item Pesanan</span>
                        @foreach($order->items as $item)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span style="font-size:0.88rem;">
                                {{ $item->nama_pakaian }} 
                                @if($item->ukuran) <span class="badge bg-secondary ml-1 px-2" style="font-size:0.75rem;">{{ $item->ukuran }}</span> @endif
                                <span class="text-muted ml-1">x{{ $item->quantity }}</span>
                            </span>
                            <span style="font-size:0.88rem; font-weight:600;">Rp {{ number_format($item->harga_pakaian * $item->quantity, 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- Subtotal & Ongkir -->
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted" style="font-size:0.9rem;">Subtotal</span>
                        <span style="font-size:0.9rem;">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 pb-3" style="border-bottom:1px solid #f0f0f0;">
                        <span class="text-muted" style="font-size:0.9rem;">Ongkos Kirim</span>
                        <span style="font-size:0.9rem;">Rp {{ number_format($order->ongkir, 0, ',', '.') }}</span>
                    </div>

                    <!-- Total -->
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="font-weight:700; font-size:1rem;">Total Pembayaran</span>
                        <span style="font-weight:700; font-size:1.2rem; color:#E8500A;">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Shipping Estimate -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius:16px; border-left:4px solid #E8500A !important;">
                <div class="card-body d-flex align-items-center gap-3 py-3 px-4">
                    <div style="width:45px; height:45px; background:#fff0ec; border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                        <i class="fas fa-truck" style="color:#E8500A; font-size:1.1rem;"></i>
                    </div>
                    <div>
                        <div style="font-weight:600; font-size:0.9rem; color:#1a1a1a;">Estimasi Pengiriman</div>
                        <div class="text-muted" style="font-size:0.85rem;">Pesanan akan dikirim dalam <strong>2-7 hari kerja</strong> setelah konfirmasi.</div>
                    </div>
                </div>
            </div>

            <!-- Email Notice -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius:16px; background:#f0fdf4;">
                <div class="card-body d-flex align-items-center gap-3 py-3 px-4">
                    <div style="width:45px; height:45px; background:#d1fae5; border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                        <i class="fas fa-envelope" style="color:#059669; font-size:1.1rem;"></i>
                    </div>
                    <div>
                        <div style="font-weight:600; font-size:0.9rem; color:#1a1a1a;">Konfirmasi Email</div>
                        <div class="text-muted" style="font-size:0.85rem;">Detail pesanan telah dikirim ke <strong>{{ $order->email }}</strong></div>
                    </div>
                </div>
            </div>

            @else
            <!-- No order found -->
            <div class="alert alert-info text-center" style="border-radius:16px;">
                <i class="fas fa-info-circle mr-2"></i>
                Pembayaran berhasil diproses. Cek email Anda untuk detail pesanan.
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="text-center mt-4">
                <a href="{{ url('/') }}" class="btn btn-primary mr-3">
                    <i class="fas fa-home mr-2"></i>Kembali ke Beranda
                </a>
                <a href="{{ url('/') }}#produk" class="btn btn-outline-primary mr-3">
                    <i class="fas fa-shopping-bag mr-2"></i>Belanja Lagi
                </a>
                <a href="{{ route('order.tracking') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-search mr-2"></i>Cek Status Pesanan
                </a>
            </div>

        </div>
    </div>
</div>

@endsection
