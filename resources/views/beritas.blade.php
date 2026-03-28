@extends('layouts.web')
@section('isi')

    <!-- Page Header -->
    <div class="page-header">
        <h1>{{ $berita->judul_berita }}</h1>
        <div class="breadcrumb-nav">
            <a href="{{ url('/') }}">Beranda</a>
            <span>/</span>
            <span>Berita</span>
        </div>
    </div>

    <div class="container-fluid px-xl-5 pb-5">
        <div class="row">

            <!-- Article Content -->
            <div class="col-lg-8 mb-5">
                <div class="card border-0 shadow-sm p-4" style="border-radius:16px;">

                    <!-- Meta -->
                    <div class="d-flex align-items-center mb-4" style="gap:16px;">
                        <span style="background:#fff0ec; color:#E8500A; padding:5px 14px; border-radius:50px; font-size:0.8rem; font-weight:500;">
                            <i class="fas fa-calendar-alt mr-1"></i>
                            {{ $berita->created_at->format('d M Y') }}
                        </span>
                    </div>

                    <!-- Featured Image -->
                    <img src="{{ asset('file/berita/' . $berita->gambar_berita) }}"
                        class="img-fluid mb-4"
                        style="width:100%; max-height:420px; object-fit:contain; border-radius:12px; background-color:#f8f9fa;">

                    <!-- Content -->
                    <div style="color:#444; line-height:1.9; font-size:0.95rem;">
                        {!! $berita->isi_berita !!}
                    </div>

                    <hr style="border-color:#f0f0f0; margin-top:30px;">

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

            <!-- Sidebar -->
            <div class="col-lg-4 mb-5">
                <div class="card border-0 shadow-sm" style="border-radius:16px; overflow:hidden; position:sticky; top:90px;">
                    <div class="card-header" style="background:linear-gradient(135deg,#E8500A,#c43d00); color:#fff; padding:18px 24px; border:none;">
                        <h6 class="mb-0"><i class="fas fa-newspaper mr-2"></i>Berita Terbaru</h6>
                    </div>
                    <div class="card-body p-0">
                        @foreach ($beritaTerbaru as $row)
                            <a href="{{ route('berita.detail', $row->slug_berita) }}"
                                class="d-flex align-items-center p-3 text-decoration-none"
                                style="border-bottom:1px solid #f0f0f0; transition:background 0.2s;"
                                onmouseover="this.style.background='#fdf8f4'"
                                onmouseout="this.style.background='#fff'">
                                @if($row->gambar_berita)
                                    <img src="{{ asset('file/berita/' . $row->gambar_berita) }}"
                                        style="width:55px; height:55px; object-fit:cover; border-radius:8px; margin-right:12px; flex-shrink:0;">
                                @endif
                                <div>
                                    <p style="color:#333; font-size:0.85rem; font-weight:500; margin:0; line-height:1.4;">{{ $row->judul_berita }}</p>
                                    <small style="color:#999;">{{ $row->created_at->format('d M Y') }}</small>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
