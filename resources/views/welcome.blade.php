@extends('layouts.web')
@section('isi')
    <style>
        .grayscale {
            filter: grayscale(100%);
        }
    </style>
    @if ($message = Session::get('success'))
        <div class="container mt-4">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}

            </div>
        </div>
    @endif

    {{-- ERROR MESSAGE --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <!-- Banner Carousel (data dari Admin > Master Umum > Galeri) -->
    <div class="container-fluid px-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @forelse ($galeri as $key => $item)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" style="height: 500px; overflow:hidden;">
                        <img class="w-100 h-100" src="{{ asset('file/galeri/' . $item->gambar_galeri) }}"
                            alt="{{ $item->nama_galeri }}" style="object-fit: cover; object-position: center 20%;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width:700px; text-shadow:0 2px 10px rgba(0,0,0,0.6);">
                                <h4 class="text-white text-uppercase font-weight-medium mb-3"
                                    style="letter-spacing:2px; font-size:1rem;">
                                    {{ $item->nama_galeri }}
                                </h4>
                                <h3 class="text-white font-weight-bold mb-0"
                                    style="font-family:'Playfair Display',serif; font-size:2.5rem; line-height:1.3;">
                                    {{ $item->keterangan_galeri }}
                                </h3>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Fallback jika belum ada gambar di galeri --}}
                    <div class="carousel-item active"
                        style="height:450px; background:linear-gradient(135deg,#E8500A 0%,#8B1A00 100%);
                               display:flex; align-items:center; justify-content:center;">
                        <div class="text-center text-white p-4">
                            <h4 class="text-uppercase mb-3"
                                style="letter-spacing:2px; font-size:1rem; opacity:0.85;">
                                Platform Penjualan Busana Adat Bali Terpercaya
                            </h4>
                            <h2 style="font-family:'Playfair Display',serif; font-size:2.8rem; font-weight:700;">
                                Uang Kembali Jika Tidak Sesuai
                            </h2>
                        </div>
                    </div>
                @endforelse
            </div>

            @if($galeri->count() > 1)
            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                <div class="btn btn-dark"
                    style="width:45px; height:45px; border-radius:50%;
                           display:flex; align-items:center; justify-content:center;">
                    <span class="carousel-control-prev-icon"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                <div class="btn btn-dark"
                    style="width:45px; height:45px; border-radius:50%;
                           display:flex; align-items:center; justify-content:center;">
                    <span class="carousel-control-next-icon"></span>
                </div>
            </a>
            @endif
        </div>
    </div>

    <!-- Featured Start -->

    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">

            @foreach ($layanans as $row)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-4">

                    <div class="card h-100 border-0 shadow-sm">
                        <!-- Gambar -->
                        <div class="d-flex align-items-center p-3">
                            <div style="width: 60px; height: 60px; overflow: hidden; flex-shrink: 0;">
                                <img src="{{ asset('file/layanan/' . $row->gambar_layanan) }}"
                                    alt="{{ $row->nama_layanan }}" class="img-fluid rounded"
                                    style="object-fit: cover; width: 100%; height: 100%;">
                            </div>

                            <h5 class="font-weight-semi-bold mb-0 ml-3">
                                {{ $row->nama_layanan }}
                            </h5>
                        </div>

                        <!-- Footer -->
                        <div class="card-body pt-0 d-flex justify-content-between align-items-center">


                            <a href="{{ url('layanan-details/' . $row->slug_layanan) }}"
                                class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye mr-1"></i> Detail
                            </a>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>
    </div>

    <!-- Featured End -->







    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Produk Busana Adat Bali</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            @foreach ($pakaian as $row)
                @php
                    $stokHabis = $row->stok_pakaian <= 0;
                @endphp

                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4 {{ $stokHabis ? 'opacity-75' : '' }}">

                        <!-- GAMBAR -->
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0"
                            style="height: 250px;">

                            <img class="img-fluid w-100 h-100 {{ $stokHabis ? 'grayscale' : '' }}"
                                src="{{ asset('file/pakaian/' . $row->gambar_pakaian) }}"
                                alt="{{ $row->nama_pakaian }}" style="object-fit: contain;">

                            {{-- BADGE STOK HABIS --}}
                            @if ($stokHabis)
                                <span class="badge badge-danger position-absolute" style="top:10px; left:10px;">
                                    Stok Habis
                                </span>
                            @endif
                        </div>

                        <!-- BODY -->
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">
                                {{ $row->nama_pakaian }}
                            </h6>

                            <div class="d-flex justify-content-center">
                                <h6>Rp {{ number_format($row->harga_pakaian) }}</h6>
                            </div>

                            {{-- INFO STOK --}}
                            <small class="{{ $stokHabis ? 'text-danger' : 'text-success' }}">
                                {{ $stokHabis ? 'Produk habis' : 'Stok: ' . $row->stok_pakaian }}
                            </small>
                        </div>

                        <!-- FOOTER -->
                        <div class="card-footer d-flex justify-content-between bg-light border">

                            {{-- DETAIL --}}
                            <a href="{{ url('pakaian-details', $row->slug_pakaian) }}"
                                class="btn btn-sm text-dark p-0 {{ $stokHabis ? 'disabled' : '' }}">
                                <i class="fas fa-eye text-primary mr-1"></i>Detail
                            </a>

                            {{-- ADD TO CART --}}
                            @if ($stokHabis)
                                <button class="btn btn-sm text-muted p-0" disabled>
                                    <i class="fas fa-ban mr-1"></i>Habis
                                </button>
                            @else
                                <form action="{{ route('cart.store', $row->id_pakaian) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm text-dark p-0">
                                        <i class="fas fa-shopping-cart text-primary mr-1"></i>Keranjang
                                    </button>
                                </form>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    <!-- Products End -->

    <!-- Berita Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5">
                <span class="px-2">Berita Terbaru</span>
            </h2>
        </div>

        <div class="row px-xl-5 pb-3">
            @foreach ($beritas as $row)
                <div class="col-lg-4 col-md-6 col-sm-12 pb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('file/berita/' . $row->gambar_berita) }}" class="card-img-top"
                            style="height: 220px; object-fit: contain; width: 100%;">

                        <div class="card-body">
                            <h5 class="card-title text-truncate">
                                {{ $row->judul_berita }}
                            </h5>
                            <p class="card-text text-muted">
                                {!! Str::limit(strip_tags($row->isi_berita), 100) !!}
                            </p>
                        </div>

                        <div class="card-footer bg-white border-0">
                            <a href="{{ route('berita.detail', $row->slug_berita) }}" class="btn btn-sm btn-primary">
                                Baca Selengkapnya
                            </a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Berita End -->










@endsection
