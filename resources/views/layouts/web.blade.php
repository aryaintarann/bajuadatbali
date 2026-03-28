<?php

use App\Models\Galeri;
use Illuminate\Support\Facades\DB;

$konf = DB::table('setting')->first() ?? (object)[
    'instansi_setting'   => 'Baju Adat Bali',
    'logo_setting'       => null,
    'logo_login_setting' => null,
    'favicon_setting'    => null,
    'tentang_setting'    => '',
    'keyword_setting'    => '',
    'alamat_setting'     => '-',
    'email_setting'      => '-',
    'no_hp_setting'      => '-',
];
$galeri = Galeri::where('jenis_galeri', 'Banner')->get();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>{{ $konf->instansi_setting }} - E-commerce</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Busana Adat Bali, Baju Adat Bali, Kebaya Bali" name="keywords">
    <meta content="Platform penjualan busana adat Bali terpercaya" name="description">

    @if($konf->favicon_setting)
    <link href="{{ asset('favicon/' . $konf->favicon_setting) }}" rel="icon">
    @endif

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap 4 -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Owl Carousel -->
    <link href="{{ asset('web/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('web/css/style.css') }}" rel="stylesheet">

    <style>
        :root {
            --primary: #E8500A;
            --primary-dark: #c43d00;
            --primary-light: #ff6b2b;
            --gold: #c9a84c;
            --dark: #1a1a1a;
            --light-bg: #fdf8f4;
        }

        * { font-family: 'Poppins', sans-serif; }
        h1, h2, h3, .brand-font { font-family: 'Playfair Display', serif; }

        body { background: #fff; color: #333; }

        /* ===== NAVBAR ===== */
        .top-navbar {
            background: #fff;
            border-bottom: 1px solid #eee;
            padding: 12px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        }

        .navbar-brand-logo img { max-height: 60px; }
        .navbar-brand-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary);
            line-height: 1.2;
        }
        .navbar-brand-text small { font-size: 0.65rem; color: #666; font-family: 'Poppins', sans-serif; font-weight: 400; display: block; letter-spacing: 2px; text-transform: uppercase; }

        .search-form .input-group { border: 2px solid #eee; border-radius: 50px; overflow: hidden; transition: border-color 0.3s; }
        .search-form .input-group:focus-within { border-color: var(--primary); }
        .search-form .form-control { border: none; padding: 10px 20px; font-size: 0.9rem; background: #f8f8f8; }
        .search-form .form-control:focus { box-shadow: none; background: #fff; }
        .search-form .btn-search { background: var(--primary); color: #fff; border: none; padding: 10px 20px; border-radius: 0; }
        .search-form .btn-search:hover { background: var(--primary-dark); }

        .nav-actions { display: flex; align-items: center; gap: 15px; }
        .btn-cart {
            position: relative;
            background: var(--light-bg);
            border: 2px solid #eee;
            border-radius: 50px;
            padding: 8px 18px;
            color: #333;
            font-size: 0.9rem;
            transition: all 0.3s;
            text-decoration: none;
        }
        .btn-cart:hover { background: var(--primary); border-color: var(--primary); color: #fff; text-decoration: none; }
        .cart-badge {
            position: absolute;
            top: -6px;
            right: -6px;
            background: var(--primary);
            color: #fff;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.65rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }
        .btn-cart:hover .cart-badge { background: #fff; color: var(--primary); }

        .btn-login-nav {
            background: var(--primary);
            color: #fff !important;
            border-radius: 50px;
            padding: 8px 22px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s;
            text-decoration: none;
        }
        .btn-login-nav:hover { background: var(--primary-dark); color: #fff !important; text-decoration: none; }

        .btn-user-nav {
            background: var(--light-bg);
            color: #333 !important;
            border: 2px solid #eee;
            border-radius: 50px;
            padding: 8px 22px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s;
            text-decoration: none;
        }
        .btn-user-nav:hover { border-color: var(--primary); color: var(--primary) !important; text-decoration: none; }

        .nav-link-kontak {
            color: #555 !important;
            font-size: 0.9rem;
            font-weight: 500;
            padding: 8px 5px;
            transition: color 0.3s;
        }
        .nav-link-kontak:hover { color: var(--primary) !important; text-decoration: none; }

        /* ===== SECTION TITLE ===== */
        .section-heading {
            text-align: center;
            margin-bottom: 40px;
        }
        .section-heading h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }
        .section-heading h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--gold));
            border-radius: 2px;
        }

        /* ===== PAGE HEADER ===== */
        .page-header {
            background: linear-gradient(135deg, var(--primary) 0%, #8B1A00 100%);
            padding: 60px 0;
            text-align: center;
            margin-bottom: 50px;
            position: relative;
            overflow: hidden;
        }
        .page-header::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .page-header h1 {
            color: #fff;
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
        }
        .page-header .breadcrumb-nav {
            color: rgba(255,255,255,0.8);
            font-size: 0.9rem;
            position: relative;
        }
        .page-header .breadcrumb-nav a { color: rgba(255,255,255,0.9); text-decoration: none; }
        .page-header .breadcrumb-nav a:hover { color: #fff; }
        .page-header .breadcrumb-nav span { margin: 0 8px; }

        /* ===== BUTTONS ===== */
        .btn-primary {
            background: var(--primary) !important;
            border-color: var(--primary) !important;
            border-radius: 50px;
            padding: 10px 28px;
            font-weight: 500;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            background: var(--primary-dark) !important;
            border-color: var(--primary-dark) !important;
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(232,80,10,0.3);
        }
        .btn-outline-primary {
            border-color: var(--primary) !important;
            color: var(--primary) !important;
            border-radius: 50px;
            padding: 8px 22px;
            font-weight: 500;
            transition: all 0.3s;
        }
        .btn-outline-primary:hover {
            background: var(--primary) !important;
            color: #fff !important;
        }

        /* ===== PRODUCT CARD ===== */
        .product-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            background: #fff;
        }
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        .product-card .card-img-wrapper {
            overflow: hidden;
            height: 260px;
        }
        .product-card .card-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .product-card:hover .card-img-wrapper img { transform: scale(1.05); }
        .product-card .card-body { padding: 18px; }
        .product-card .product-name { font-weight: 600; font-size: 0.95rem; color: var(--dark); margin-bottom: 6px; }
        .product-card .product-price { font-weight: 700; color: var(--primary); font-size: 1.05rem; }
        .product-card .card-footer { background: #fff; border-top: 1px solid #f0f0f0; padding: 12px 18px; }

        /* ===== FOOTER ===== */
        .site-footer {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d1a0e 100%);
            color: #ccc;
            padding: 60px 0 0;
            margin-top: 60px;
        }
        .site-footer h5 {
            color: #fff;
            font-weight: 600;
            margin-bottom: 20px;
            font-size: 1rem;
            position: relative;
            padding-bottom: 12px;
        }
        .site-footer h5::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0;
            width: 30px; height: 2px;
            background: var(--primary);
        }
        .site-footer a { color: #aaa; text-decoration: none; transition: color 0.3s; font-size: 0.9rem; }
        .site-footer a:hover { color: var(--primary); }
        .site-footer p { font-size: 0.9rem; line-height: 1.8; }
        .footer-contact-item { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 12px; font-size: 0.9rem; }
        .footer-contact-item i { color: var(--primary); margin-top: 3px; min-width: 16px; }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding: 20px 0;
            margin-top: 40px;
            font-size: 0.85rem;
            color: #888;
        }

        /* ===== BACK TO TOP ===== */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--primary);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(232,80,10,0.4);
            transition: all 0.3s;
            z-index: 999;
            text-decoration: none;
        }
        .back-to-top:hover { background: var(--primary-dark); color: #fff; transform: translateY(-3px); }

        /* ===== ALERTS ===== */
        .alert { border-radius: 12px; border: none; }
        .alert-success { background: #d4edda; color: #155724; }
        .alert-danger { background: #f8d7da; color: #721c24; }

        /* ===== MISC ===== */
        .text-primary { color: var(--primary) !important; }
        .bg-primary { background: var(--primary) !important; }
        .badge-primary { background: var(--primary); }
        .section-title { font-family: 'Playfair Display', serif; }
    </style>
</head>

<body>

    <!-- ===== NAVBAR ===== -->
    <nav class="top-navbar">
        <div class="container-fluid px-xl-5">
            <div class="row align-items-center">

                <!-- Logo -->
                <div class="col-lg-2 col-md-3 col-4">
                    <a href="{{ url('/') }}" class="text-decoration-none d-flex align-items-center">
                        @if($konf->logo_setting)
                            <img src="{{ asset('logo/' . $konf->logo_setting) }}" alt="Logo" class="navbar-brand-logo">
                        @else
                            <div class="navbar-brand-text">
                                {{ $konf->instansi_setting }}
                                <small>Busana Adat Bali</small>
                            </div>
                        @endif
                    </a>
                </div>

                <!-- Search Bar -->
                <div class="col-lg-5 col-md-5 col-8">
                    <form action="{{ route('pencarian') }}" method="GET" class="search-form">
                        <div class="input-group">
                            <input type="text" class="form-control" name="q" placeholder="Cari Produk...">
                            <div class="input-group-append">
                                <button type="submit" class="btn-search">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Nav Actions -->
                <div class="col-lg-5 col-md-4 d-none d-md-flex justify-content-end" style="padding-left: 10px;">
                    <div class="nav-actions">
                        <a href="{{ url('kontak') }}" class="nav-link-kontak">Kontak</a>
                        <a href="{{ route('order.tracking') }}" class="nav-link-kontak" style="white-space:nowrap;">
                            <i class="fas fa-search mr-1"></i>Cek Pesanan
                        </a>
                        <a href="{{ route('refund.form') }}" class="nav-link-kontak" style="white-space:nowrap; color:#dc3545 !important;">
                            <i class="fas fa-undo mr-1"></i>Refund
                        </a>

                        @php
                            $cart = session('cart', []);
                            $cartCount = array_sum(array_column($cart, 'quantity'));
                        @endphp

                        <a href="{{ route('cart.index') }}" class="btn-cart">
                            <i class="fas fa-shopping-cart mr-1"></i>
                            <span class="cart-badge">{{ $cartCount }}</span>
                        </a>

                        @guest
                            <a href="{{ url('login') }}" class="btn-login-nav">
                                <i class="fas fa-sign-in-alt mr-1"></i> Login
                            </a>
                        @else
                            <a href="{{ url('dashboard') }}" class="btn-user-nav">
                                <i class="fas fa-user mr-1"></i> {{ Auth::user()->name }}
                            </a>
                        @endguest
                    </div>
                </div>

            </div>
        </div>
    </nav>
    <!-- ===== END NAVBAR ===== -->

    @yield('isi')

    <!-- ===== FOOTER ===== -->
    <footer class="site-footer">
        <div class="container-fluid px-xl-5">
            <div class="row">

                <!-- Brand Info -->
                <div class="col-lg-4 col-md-6 mb-5">
                    @if($konf->logo_setting)
                        <img src="{{ asset('logo/' . $konf->logo_setting) }}" alt="Logo" style="max-height:50px; margin-bottom:15px;">
                    @else
                        <h4 style="color:#fff; font-family:'Playfair Display',serif; margin-bottom:15px;">{{ $konf->instansi_setting }}</h4>
                    @endif
                    <p>{!! $konf->tentang_setting !!}</p>
                    <div class="footer-contact-item">
                        <i class="fa fa-map-marker-alt"></i>
                        <span>{{ $konf->alamat_setting }}</span>
                    </div>
                    <div class="footer-contact-item">
                        <i class="fa fa-envelope"></i>
                        <span>{{ $konf->email_setting }}</span>
                    </div>
                    <div class="footer-contact-item">
                        <i class="fa fa-phone-alt"></i>
                        <span>{{ $konf->no_hp_setting }}</span>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-3 col-6 mb-5">
                    <h5>Menu</h5>
                    <div class="d-flex flex-column" style="gap:8px;">
                        <a href="{{ url('/') }}"><i class="fa fa-angle-right mr-2"></i>Beranda</a>
                        <a href="{{ route('cart.index') }}"><i class="fa fa-angle-right mr-2"></i>Keranjang</a>
                        <a href="{{ route('checkout') }}"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                        <a href="{{ route('order.tracking') }}"><i class="fa fa-angle-right mr-2"></i>Cek Pesanan</a>
                        <a href="{{ route('refund.form') }}"><i class="fa fa-angle-right mr-2"></i>Ajukan Refund</a>
                        <a href="{{ url('kontak') }}"><i class="fa fa-angle-right mr-2"></i>Kontak</a>
                    </div>
                </div>

                <!-- Info -->
                <div class="col-lg-2 col-md-3 col-6 mb-5">
                    <h5>Informasi</h5>
                    <div class="d-flex flex-column" style="gap:8px;">
                        <a href="#"><i class="fa fa-angle-right mr-2"></i>Tentang Kami</a>
                        <a href="#"><i class="fa fa-angle-right mr-2"></i>Kebijakan Privasi</a>
                        <a href="#"><i class="fa fa-angle-right mr-2"></i>Syarat & Ketentuan</a>
                        <a href="#"><i class="fa fa-angle-right mr-2"></i>Cara Pemesanan</a>
                    </div>
                </div>

                <!-- Payment -->
                <div class="col-lg-4 col-md-6 mb-5">
                    <h5>Metode Pembayaran</h5>
                    <p>Kami menerima berbagai metode pembayaran yang aman dan terpercaya melalui Midtrans.</p>
                    <div class="d-flex flex-wrap gap-2" style="gap:6px;">
                        @foreach(['Visa','Mastercard','BCA','Mandiri','BRI','BNI','GoPay','OVO','DANA'] as $pm)
                        <span style="
                            background:rgba(255,255,255,0.12);
                            color:#fff;
                            border:1px solid rgba(255,255,255,0.2);
                            border-radius:6px;
                            padding:3px 10px;
                            font-size:0.78rem;
                            font-weight:600;
                            letter-spacing:0.5px;
                            margin-bottom:4px;
                        ">{{ $pm }}</span>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

        <div class="footer-bottom">
            <div class="container-fluid px-xl-5">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-left">
                        &copy; {{ date('Y') }} <a href="#" style="color:var(--primary);">{{ $konf->instansi_setting }}</a>. All Rights Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-right mt-2 mt-md-0">
                        <span style="font-size:0.8rem;">Dibuat dengan <i class="fas fa-heart" style="color:var(--primary);"></i> untuk budaya Bali</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ===== END FOOTER ===== -->

    <!-- Back to Top -->
    <a href="#" class="back-to-top" id="backToTop" style="display:none;">
        <i class="fa fa-angle-up"></i>
    </a>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap Bundle -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <!-- Owl Carousel -->
    <script src="{{ asset('web/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <!-- Easing -->
    <script src="{{ asset('web/lib/easing/easing.min.js') }}"></script>
    <!-- Template JS -->
    <script src="{{ asset('web/js/main.js') }}"></script>

    <script>
        // Back to top
        window.addEventListener('scroll', function() {
            var btn = document.getElementById('backToTop');
            if (window.scrollY > 300) {
                btn.style.display = 'flex';
            } else {
                btn.style.display = 'none';
            }
        });
        document.getElementById('backToTop').addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>

    @stack('scripts')

</body>

</html>
