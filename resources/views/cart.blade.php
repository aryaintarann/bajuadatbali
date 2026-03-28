@extends('layouts.web')
@section('isi')

    <!-- Page Header -->
    <div class="page-header">
        <h1>Keranjang Belanja</h1>
        <div class="breadcrumb-nav">
            <a href="{{ url('/') }}">Beranda</a>
            <span>/</span>
            <span>Keranjang</span>
        </div>
    </div>

    <div class="container-fluid px-xl-5 pb-5">

        @if (session('success'))
            <div class="alert alert-success text-center mb-4">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger text-center mb-4">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            </div>
        @endif

        @if(empty($cart))
            <div class="text-center py-5">
                <i class="fas fa-shopping-cart" style="font-size:5rem; color:#ddd;"></i>
                <h4 class="mt-4 text-muted">Keranjang Anda Masih Kosong</h4>
                <p class="text-muted">Yuk, mulai belanja busana adat Bali pilihan Anda!</p>
                <a href="{{ url('/') }}" class="btn btn-primary mt-2">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali Belanja
                </a>
            </div>
        @else
        <div class="row">
            <!-- Cart Table -->
            <div class="col-lg-8 mb-5">
                <div class="card border-0 shadow-sm" style="border-radius:16px; overflow:hidden;">
                    <div class="card-header" style="background:linear-gradient(135deg,#E8500A,#c43d00); color:#fff; padding:18px 24px; border:none;">
                        <h5 class="mb-0"><i class="fas fa-shopping-cart mr-2"></i>Item Keranjang</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead style="background:#fdf8f4;">
                                    <tr>
                                        <th class="px-4 py-3" style="font-weight:600; color:#555; border:none;">Produk</th>
                                        <th class="py-3 text-center" style="font-weight:600; color:#555; border:none;">Harga</th>
                                        <th class="py-3 text-center" style="font-weight:600; color:#555; border:none;">Jumlah</th>
                                        <th class="py-3 text-center" style="font-weight:600; color:#555; border:none;">Total</th>
                                        <th class="py-3 text-center" style="font-weight:600; color:#555; border:none;">Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $subtotal = 0; @endphp
                                    @foreach ($cart as $id => $item)
                                        @php
                                            $total = $item['harga'] * $item['quantity'];
                                            $subtotal += $total;
                                        @endphp
                                        <tr>
                                            <td class="px-4 py-3 align-middle">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('file/pakaian/' . $item['gambar']) }}"
                                                        alt="{{ $item['nama'] }}"
                                                        style="width:65px; height:65px; object-fit:cover; border-radius:10px; margin-right:15px;">
                                                    <div>
                                                        <span style="font-weight:500; color:#333; display:block;">{{ $item['nama'] }}</span>
                                                        @if(isset($item['butuh_ukuran']) && $item['butuh_ukuran'] == 1)
                                                            @php
                                                                $availableSizes = \Illuminate\Support\Facades\DB::table('pakaian_sizes')
                                                                    ->where('pakaian_id', $item['id_pakaian'])
                                                                    ->where('stok', '>', 0)
                                                                    ->get();
                                                            @endphp
                                                            @if($availableSizes->count() > 0)
                                                                <form action="{{ route('cart.update_size', $id) }}" method="POST" class="mt-2" style="display:inline-block;">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <select name="ukuran" class="form-control form-control-sm" style="border-radius:6px; min-width:100px; background:#f9f9f9; padding: 4px 8px; font-size: 0.8rem;" onchange="this.form.submit()">
                                                                        <option value="" disabled {{ !isset($item['ukuran']) ? 'selected' : '' }}>-- Pilih Ukuran --</option>
                                                                        @foreach($availableSizes as $size)
                                                                            <option value="{{ $size->ukuran }}" {{ (isset($item['ukuran']) && $item['ukuran'] == $size->ukuran) ? 'selected' : '' }}>
                                                                                Ukuran: {{ $size->ukuran }} (Sisa: {{ $size->stok }})
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </form>
                                                            @else
                                                                <small class="badge bg-danger px-2 mt-1" style="font-size:0.75rem;">Stok ukuran habis</small>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3 text-center align-middle" style="color:#E8500A; font-weight:600;">
                                                Rp {{ number_format($item['harga']) }}
                                            </td>
                                            <td class="py-3 text-center align-middle">
                                                <form action="{{ route('cart.update', $id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                                        class="form-control text-center mx-auto"
                                                        style="width:70px; border-radius:8px; border:2px solid #eee;"
                                                        onchange="this.form.submit()">
                                                </form>
                                            </td>
                                            <td class="py-3 text-center align-middle" style="font-weight:700; color:#333;">
                                                Rp {{ number_format($total) }}
                                            </td>
                                            <td class="py-3 text-center align-middle">
                                                <a href="{{ route('cart.remove', $id) }}"
                                                    class="btn btn-sm"
                                                    style="background:#fff0ec; color:#E8500A; border:1px solid #ffd0c0; border-radius:8px; padding:6px 12px;"
                                                    onclick="return confirm('Hapus item ini?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <a href="{{ url('/') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left mr-2"></i>Lanjutkan Belanja
                    </a>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4 mb-5">
                <div class="card border-0 shadow-sm" style="border-radius:16px; overflow:hidden; position:sticky; top:90px;">
                    <div class="card-header" style="background:linear-gradient(135deg,#E8500A,#c43d00); color:#fff; padding:18px 24px; border:none;">
                        <h5 class="mb-0"><i class="fas fa-receipt mr-2"></i>Ringkasan Pesanan</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-3">
                            <span style="color:#666;">Subtotal ({{ array_sum(array_column($cart, 'quantity')) }} item)</span>
                            <span style="font-weight:600;">Rp {{ number_format($subtotal) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span style="color:#666;">Ongkos Kirim</span>
                            <span style="color:#28a745; font-weight:500;">Dihitung saat checkout</span>
                        </div>
                        <hr style="border-color:#f0f0f0;">
                        <div class="d-flex justify-content-between mb-4">
                            <span style="font-weight:700; font-size:1.05rem;">Total</span>
                            <span style="font-weight:700; font-size:1.15rem; color:#E8500A;">Rp {{ number_format($subtotal) }}</span>
                        </div>

                        @php
                            $missingSize = false;
                            foreach($cart as $item) {
                                if(isset($item['butuh_ukuran']) && $item['butuh_ukuran'] == 1 && empty($item['ukuran'])) {
                                    $missingSize = true;
                                    break;
                                }
                            }
                        @endphp

                        <form action="{{ route('checkout') }}" method="GET">
                            @if($missingSize)
                                <div class="alert alert-warning p-2 text-center" style="font-size:0.85rem;">
                                    ⚠️ Silakan pilih ukuran untuk semua produk terlebih dahulu.
                                </div>
                                <button type="button" class="btn btn-secondary btn-block py-3" style="font-size:1rem; font-weight:600; cursor:not-allowed;" disabled>
                                    <i class="fas fa-lock mr-2"></i>Lengkapi Ukuran Produk
                                </button>
                            @else
                                <button type="submit" class="btn btn-primary btn-block py-3" style="font-size:1rem; font-weight:600;">
                                    <i class="fas fa-lock mr-2"></i>Lanjutkan Pembayaran
                                </button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection
