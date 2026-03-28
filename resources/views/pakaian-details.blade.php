@extends('layouts.web')
@section('isi')

    <!-- Page Header -->
    <div class="page-header">
        <h1>Detail Produk</h1>
        <div class="breadcrumb-nav">
            <a href="{{ url('/') }}">Beranda</a>
            <span>/</span>
            <span>{{ $tshirt->nama_pakaian }}</span>
        </div>
    </div>

    <!-- Product Detail -->
    <div class="container-fluid px-xl-5 pb-5">
        <div class="row">

            <!-- Product Image -->
            <div class="col-lg-5 mb-4">
                <div class="card border-0 shadow-sm" style="border-radius:16px; overflow:hidden;">
                    <img class="w-100" style="object-fit:contain; max-height:500px; background-color:#f8f9fa;"
                        src="{{ asset('file/pakaian/' . $tshirt->gambar_pakaian) }}"
                        alt="{{ $tshirt->nama_pakaian }}">
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-lg-7 mb-4">
                <div class="card border-0 shadow-sm p-4" style="border-radius:16px;">

                    <!-- Category Badge -->
                    @if($tshirt->nama_kategori)
                    <span class="badge mb-3" style="background:#fff0ec; color:#E8500A; font-size:0.8rem; padding:6px 14px; border-radius:50px; font-weight:500;">
                        {{ $tshirt->nama_kategori }}
                    </span>
                    @endif

                    <h2 style="font-family:'Playfair Display',serif; font-weight:700; color:#1a1a1a; margin-bottom:12px;">
                        {{ $tshirt->nama_pakaian }}
                    </h2>

                    <!-- Rating -->
                    <div class="d-flex align-items-center mb-3">
                        <div style="color:#f4b942;">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span style="color:#999; font-size:0.85rem; margin-left:8px;">(5.0)</span>
                    </div>

                    <!-- Price -->
                    <div class="mb-4" style="background:#fdf8f4; border-radius:12px; padding:16px 20px;">
                        <p style="color:#999; font-size:0.85rem; margin-bottom:4px;">Harga</p>
                        <h3 style="color:#E8500A; font-weight:700; font-size:1.8rem; margin:0;">
                            Rp {{ number_format($tshirt->harga_pakaian) }}
                        </h3>
                    </div>

                    <!-- Stock -->
                    @if ($tshirt->stok_pakaian > 0)
                        <div class="mb-3">
                            <span style="background:#d4edda; color:#155724; padding:6px 16px; border-radius:50px; font-size:0.85rem; font-weight:500;">
                                <i class="fas fa-check-circle mr-1"></i> Stok Tersedia: {{ $tshirt->stok_pakaian }} pcs
                            </span>
                        </div>
                    @else
                        <div class="mb-3">
                            <span style="background:#f8d7da; color:#721c24; padding:6px 16px; border-radius:50px; font-size:0.85rem; font-weight:500;">
                                <i class="fas fa-times-circle mr-1"></i> Stok Habis
                            </span>
                        </div>
                    @endif

                    <!-- Description -->
                    <div class="mb-4" style="color:#555; line-height:1.8; font-size:0.95rem;">
                        {!! $tshirt->pratinjau_pakaian !!}
                    </div>

                    <hr style="border-color:#f0f0f0;">

                    <!-- Add to Cart Form -->
                    <div class="mb-4">
                        @if ($tshirt->stok_pakaian > 0)
                            <form action="{{ route('cart.store', $tshirt->id_pakaian) }}" method="POST">
                                @csrf

                                <!-- Pilihan Ukuran (Jika Ada) -->
                                @php
                                    $availableSizes = DB::table('pakaian_sizes')->where('pakaian_id', $tshirt->id_pakaian)->where('stok', '>', 0)->get();
                                @endphp
                                @if($availableSizes->count() > 0)
                                    <div class="form-group mb-3">
                                        <label style="font-weight:600; color:#444; font-size:0.9rem;">Pilih Ukuran <span style="color:#E8500A;">*</span></label>
                                        <select name="ukuran" class="form-control" required
                                            style="border-radius:10px; border:2px solid #eee; height: 50px; padding: 0 16px; font-size:0.9rem;">
                                            <option value="" disabled selected>-- Pilih Ukuran --</option>
                                            @foreach($availableSizes as $size)
                                                <option value="{{ $size->ukuran }}">{{ $size->ukuran }} (Sisa: {{ $size->stok }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                <div class="d-flex align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary btn-block py-3" style="font-size:1rem; font-weight:600;">
                                        <i class="fas fa-shopping-cart mr-2"></i>Tambahkan ke Keranjang
                                    </button>
                                </div>
                            </form>
                        @else
                            <button class="btn btn-block py-3" disabled
                                style="background:#eee; color:#999; border-radius:50px; font-weight:600; cursor:not-allowed;">
                                <i class="fas fa-ban mr-2"></i>Stok Habis
                            </button>
                        @endif
                    </div>

                    <!-- Share -->
                    <div class="d-flex align-items-center">
                        <span style="color:#666; font-size:0.9rem; margin-right:12px; font-weight:500;">Bagikan:</span>
                        <a href="#" style="width:34px; height:34px; border-radius:50%; background:#3b5998; color:#fff; display:inline-flex; align-items:center; justify-content:center; margin-right:8px; font-size:0.85rem; text-decoration:none;">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" style="width:34px; height:34px; border-radius:50%; background:#1da1f2; color:#fff; display:inline-flex; align-items:center; justify-content:center; margin-right:8px; font-size:0.85rem; text-decoration:none;">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" style="width:34px; height:34px; border-radius:50%; background:#25d366; color:#fff; display:inline-flex; align-items:center; justify-content:center; font-size:0.85rem; text-decoration:none;">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
