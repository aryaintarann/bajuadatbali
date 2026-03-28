<?php

use Illuminate\Support\Facades\DB;

$konf = DB::table('setting')->first();
?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Register | {{$konf->instansi_setting}}</title>
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
                    <img src="{{asset ('logo/'.$konf->logo_setting)}}" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start-->


    <!-- Register -->

    <main class="login-body" data-vide-bg="web/assets/img/login-bg.mp4">
        <!-- Login Admin -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="login-form">
                <!-- logo-login -->
                <div class="logo-login">
                    <a href="index.html">
                        @if ($konf->logo_login_setting)
                            <img src="{{asset ('logo/'.$konf->logo_login_setting)}}" alt="Logo Login">
                        @else
                            <img src="{{asset ('logo/'.$konf->logo_setting)}}" alt="Logo">
                        @endif
                    </a>
                </div>
                <h2>Registration Here</h2>

                <div class="form-input">
                    <!-- <label for="name">Full name</label> -->
                    <input type="text" name="name" placeholder="Full name">
                </div>
                <div class="form-input">
                    <!-- <label for="name">Email Address</label> -->
                    <input type="email" name="email" placeholder="Email Address">
                </div>
                <div class="form-input">
                    <!-- <label for="name">Password</label> -->
                    <input type="password" name="password" placeholder="Password">
                </div>
                <div class="form-input">
                    <!-- <label for="name">Confirm Password</label> -->
                    <input type="password" name="password_confirmation" placeholder="Confirm Password">
                </div>
                <div class="form-input pt-30">
                    <input type="submit" name="submit" value="Registration">
                </div>
                <!-- Forget Password -->
                <a href="{{url ('login')}}" class="registration">login</a>
            </div>
        </form>
        <!-- /end login form -->
    </main>


    <script src="./web/assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./web/assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./web/assets/js/popper.min.js"></script>
    <script src="./web/assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./web/assets/js/jquery.slicknav.min.js"></script>

    <!-- Video bg -->
    <script src="./web/assets/js/jquery.vide.js"></script>

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