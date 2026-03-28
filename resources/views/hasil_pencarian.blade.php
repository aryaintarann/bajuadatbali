@extends('layouts.web')

@section('isi')

    <!-- Page Header -->
    <div class="page-header">
        <h1>Hasil Pencarian</h1>
        <div class="breadcrumb-nav">
            <a href="{{ url('/') }}">Beranda</a>
            <span>/</span>
            <span>Pencarian: "{{ $query }}"</span>
        </div>
    </div>

    <div class="container-fluid px-xl-5 pb-5">

        <div class="mb-4">
            <h5 style="color:#555;">
                Menampilkan hasil untuk: <span style="color:#E8500A; font-weight:600;">"{{ $query }}"</span>
                @if($pakaian->count())
                    <span style="color:#999; font-size:0.9rem;">({{ $pakaian->count() }} produk ditemukan)</span>
                @endif
            </h5>
        </div>

        @if($pakaian->count())
            <div class="row">
                @foreach($pakaian as $item)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="product-card card h-100">
                            <div class="card-img-wrapper">
                                <img src="{{ asset('file/pakaian/' . $item->gambar_pakaian) }}"
                                    alt="{{ $item->nama_pakaian }}">
                            </div>
                            <div class="card-body">
                                <h6 class="product-name">{{ $item->nama_pakaian }}</h6>
                                <p class="product-price">Rp {{ number_format($item->harga_pakaian, 0, ',', '.') }}</p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ url('pakaian-details', $item->slug_pakaian) }}" class="btn btn-primary btn-block">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-search" style="font-size:5rem; color:#ddd;"></i>
                <h4 class="mt-4 text-muted">Produk Tidak Ditemukan</h4>
                <p class="text-muted">Tidak ada produk yang cocok dengan kata kunci "<strong>{{ $query }}</strong>".</p>
                <a href="{{ url('/') }}" class="btn btn-primary mt-2">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Beranda
                </a>
            </div>
        @endif
    </div>

@endsection
