<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Layanan | {{$konf->instansi_setting}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset ('logo/'.$konf->logo_setting)}}">

    <!-- CSS here -->
    <link rel="stylesheet" href="web/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="web/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="web/assets/css/slicknav.css">
    <link rel="stylesheet" href="web/assets/css/flaticon.css">
    <link rel="stylesheet" href="web/assets/css/progressbar_barfiller.css">
    <link rel="stylesheet" href="web/assets/css/gijgo.css">
    <link rel="stylesheet" href="web/assets/css/animate.min.css">
    <link rel="stylesheet" href="web/assets/css/animated-headline.css">
    <link rel="stylesheet" href="web/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="web/assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="web/assets/css/themify-icons.css">
    <link rel="stylesheet" href="web/assets/css/slick.css">
    <link rel="stylesheet" href="web/assets/css/nice-select.css">
    <link rel="stylesheet" href="web/assets/css/style.css">
</head>

<body>
    <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="web/assets/img/logo/loder.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <!-- Header Start -->
    <div class="header-area header-transparent">
        <div class="main-header ">
            <div class="header-bottom  header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo">
                                <a href="{{url ('/')}}"><img src="{{asset ('logo/'.$konf->logo_setting)}}" style="width: 30%;" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10">
                            <div class="menu-wrapper d-flex align-items-center justify-content-end">
                                <!-- Main-menu -->
                                <div class="main-menu d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="{{url ('/')}}">Home</a></li>
                                            <li><a href="{{url ('tentang')}}">Tentang Kami</a></li>
                                            <li><a href="{{url ('layananx')}}">Layanan</a></li>
                                            <li><a href="{{url ('beritas')}}">Blog</a></li>
                                            <li><a href="{{url ('kontak')}}">Kontak</a></li>
                                            <!-- Button -->
                                            <li class="button-header margin-left "><a href="{{url ('register')}}" class="btn">Join</a></li>
                                            <li class="button-header"><a href="{{url ('login')}}" class="btn btn3">Log in</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
    <main>
        <!--? slider Area Start-->
        <section class="slider-area slider-area2">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height2">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8 col-lg-11 col-md-12">
                                <div class="hero__caption hero__caption2">
                                    <h1 data-animation="bounceIn" data-delay="0.2s">Layanan Kami</h1>
                                    <!-- breadcrumb Start-->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{url ('/')}}">Home</a></li>
                                            <li class="breadcrumb-item"><a href="#">Layanan</a></li>
                                        </ol>
                                    </nav>
                                    <!-- breadcrumb End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Courses area start -->
        <div class="courses-area section-padding40 fix">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mb-55">
                            <h2>Layanan Kami</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($layanan as $row)
                    <div class="col-lg-4">
                        <div class="properties properties2 mb-30">
                            <div class="properties__card">
                                <div class="properties__img overlay1">
                                    <a href="#"><img src="{{asset ('file/layanan/'.$row->gambar_layanan)}}" alt=""></a>
                                </div>
                                <div class="properties__caption">
                                    <!-- <p>Layanan Kami</p> -->
                                    <h3><a href="#">{{$row->nama_layanan}}</a></h3>
                                    <p>{!!$row->keterangan_layanan!!}
                                    </p>


                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
                <!-- <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mt-40">
                            <a href="#" class="border-btn">Load More</a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        <!-- Courses area End -->
        <!--? top subjects Area Start -->

        <!-- top subjects End -->
        <!-- ? services-area -->

    </main>
    <footer>
        <div class="footer-wrappper footer-bg">
            <!-- Footer Start-->
            <div class="footer-area footer-padding">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-xl-4 col-lg-5 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="single-footer-caption mb-30">
                                    <!-- logo -->
                                    <div class="footer-logo mb-25">
                                        <a href="index.html"><img src="{{asset ('logo/'.$konf->logo_setting)}}" style="width: 35%;" alt=""></a>
                                    </div>
                                    <div class="footer-tittle">
                                        <div class="footer-pera">
                                            <p>{!!$konf->tentang_setting!!}</p>
                                        </div>
                                    </div>
                                    <!-- social -->
                                    <div class="footer-social">
                                        <a href="{{$konf->youtube_setting}}"><i class="fab fa-youtube"></i></a>
                                        <a href="https://instagram.com/{{$konf->instagram_setting}}"><i class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-6 col-md-6 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <iframe class="w-100 rounded" src="{{ $konf->maps_setting }}" frameborder="0" style="min-height: 300px; border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Support</h4>
                                    <ul>
                                        <li><a href="#">Design & creatives</a></li>
                                        <li><a href="#">Telecommunication</a></li>
                                        <li><a href="#">Restaurant</a></li>
                                        <li><a href="#">Programing</a></li>
                                        <li><a href="#">Architecture</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Company</h4>
                                    <ul>
                                        <li><a href="#">Design & creatives</a></li>
                                        <li><a href="#">Telecommunication</a></li>
                                        <li><a href="#">Restaurant</a></li>
                                        <li><a href="#">Programing</a></li>
                                        <li><a href="#">Architecture</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- footer-bottom area -->
            <div class="footer-bottom-area">
                <div class="container">
                    <div class="footer-border">
                        <div class="row d-flex align-items-center">
                            <div class="col-xl-12 ">
                                <div class="footer-copy-right text-center">
                                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                        Copyright &copy;<script>
                                            document.write(new Date().getFullYear());
                                        </script> All rights reserved | {{$konf->instansi_setting}} by <a href="https://instagram.com/roberth_colln" target="_blank"><small><i>roberth_colln</i></small></a>
                                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End-->
        </div>
    </footer>
    <!-- Scroll Up -->
    <div id="back-top">
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>

    <!-- JS here -->
    <script src="./web/assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./web/assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./web/assets/js/popper.min.js"></script>
    <script src="./web/assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./web/assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./web/assets/js/owl.carousel.min.js"></script>
    <script src="./web/assets/js/slick.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="./web/assets/js/wow.min.js"></script>
    <script src="./web/assets/js/animated.headline.js"></script>
    <script src="./web/assets/js/jquery.magnific-popup.js"></script>

    <!-- Date Picker -->
    <script src="./web/assets/js/gijgo.min.js"></script>
    <!-- Nice-select, sticky -->
    <script src="./web/assets/js/jquery.nice-select.min.js"></script>
    <script src="./web/assets/js/jquery.sticky.js"></script>
    <!-- Progress -->
    <script src="./web/assets/js/jquery.barfiller.js"></script>

    <!-- counter , waypoint,Hover Direction -->
    <script src="./web/assets/js/jquery.counterup.min.js"></script>
    <script src="./web/assets/js/waypoints.min.js"></script>
    <script src="./web/assets/js/jquery.countdown.min.js"></script>
    <script src="./web/assets/js/hover-direction-snake.min.js"></script>

    <!-- contact js -->
    <script src="./web/assets/js/contact.js"></script>
    <script src="./web/assets/js/jquery.form.js"></script>
    <script src="./web/assets/js/jquery.validate.min.js"></script>
    <script src="./web/assets/js/mail-script.js"></script>
    <script src="./web/assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="./web/assets/js/plugins.js"></script>
    <script src="./web/assets/js/main.js"></script>

</body>

</html>