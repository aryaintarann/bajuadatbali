@extends('layouts.web')
@section('isi')

    <!-- Page Header -->
    <div class="page-header">
        <h1>Hubungi Kami</h1>
        <div class="breadcrumb-nav">
            <a href="{{ url('/') }}">Beranda</a>
            <span>/</span>
            <span>Kontak</span>
        </div>
    </div>

    <div class="container-fluid px-xl-5 pb-5">

        <div class="section-heading mb-5">
            <h2>Hubungi Untuk Pertanyaan Apa Pun</h2>
            <p class="text-muted mt-3">Kami siap membantu Anda. Jangan ragu untuk menghubungi kami.</p>
        </div>

        <div class="row">

            <!-- Map -->
            <div class="col-lg-7 mb-5">
                <div class="card border-0 shadow-sm" style="border-radius:16px; overflow:hidden; height:100%; min-height:400px;">
                    @if(isset($konf->maps_setting) && $konf->maps_setting)
                        <iframe src="{{ $konf->maps_setting }}"
                            width="100%" height="100%" style="border:0; min-height:400px;"
                            allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100" style="background:#f8f8f8; min-height:400px;">
                            <div class="text-center text-muted">
                                <i class="fas fa-map-marker-alt" style="font-size:3rem; color:#ddd;"></i>
                                <p class="mt-3">Peta belum dikonfigurasi</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-5 mb-5">
                <div class="card border-0 shadow-sm p-4" style="border-radius:16px;">

                    <h5 style="font-family:'Playfair Display',serif; font-weight:700; color:#1a1a1a; margin-bottom:20px;">
                        Informasi Kontak
                    </h5>

                    <p style="color:#666; line-height:1.8; margin-bottom:24px;">
                        {!! $konf->tentang_setting !!}
                    </p>

                    <div class="d-flex align-items-start mb-4">
                        <div style="width:44px; height:44px; border-radius:12px; background:#fff0ec; display:flex; align-items:center; justify-content:center; margin-right:16px; flex-shrink:0;">
                            <i class="fa fa-map-marker-alt" style="color:#E8500A;"></i>
                        </div>
                        <div>
                            <p style="font-weight:600; color:#333; margin-bottom:4px;">Alamat</p>
                            <p style="color:#666; font-size:0.9rem; margin:0;">{{ $konf->alamat_setting }}</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-4">
                        <div style="width:44px; height:44px; border-radius:12px; background:#fff0ec; display:flex; align-items:center; justify-content:center; margin-right:16px; flex-shrink:0;">
                            <i class="fa fa-envelope" style="color:#E8500A;"></i>
                        </div>
                        <div>
                            <p style="font-weight:600; color:#333; margin-bottom:4px;">Email</p>
                            <p style="color:#666; font-size:0.9rem; margin:0;">{{ $konf->email_setting }}</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-4">
                        <div style="width:44px; height:44px; border-radius:12px; background:#fff0ec; display:flex; align-items:center; justify-content:center; margin-right:16px; flex-shrink:0;">
                            <i class="fa fa-phone-alt" style="color:#E8500A;"></i>
                        </div>
                        <div>
                            <p style="font-weight:600; color:#333; margin-bottom:4px;">Telepon / WhatsApp</p>
                            <p style="color:#666; font-size:0.9rem; margin:0;">{{ $konf->no_hp_setting }}</p>
                        </div>
                    </div>

                    <hr style="border-color:#f0f0f0;">

                    <div class="d-flex" style="gap:10px;">
                        <a href="#" style="width:40px; height:40px; border-radius:10px; background:#3b5998; color:#fff; display:flex; align-items:center; justify-content:center; text-decoration:none;">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" style="width:40px; height:40px; border-radius:10px; background:#e1306c; color:#fff; display:flex; align-items:center; justify-content:center; text-decoration:none;">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" style="width:40px; height:40px; border-radius:10px; background:#25d366; color:#fff; display:flex; align-items:center; justify-content:center; text-decoration:none;">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection