<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>@yield('title')</title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    {{-- <link rel="manifest" href="{{ asset('mahasiswa/manifest.json') }}" /> --}}

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('mahasiswa/img/favicon180.png') }}" sizes="180x180">
    <link rel="icon" href="{{ asset('mahasiswa/img/favicon32.png') }}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{ asset('mahasiswa/img/favicon16.png') }}" sizes="16x16" type="image/png">

    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- swiper carousel css -->
    <link rel="stylesheet" href="{{ asset('mahasiswa/vendor/swiperjs-6.6.2/swiper-bundle.min.css') }}">

    <!-- style css for this template -->
    <link href="{{ asset('mahasiswa/css/style.css') }}" rel="stylesheet" id="style">
</head>

<body class="body-scroll" data-page="index">
    @include('sweetalert::alert')
    <!-- loader section -->
    <div class="container-fluid loader-wrap">
        <div class="row h-100">
            <div class="mx-auto text-center col-10 col-md-6 col-lg-5 col-xl-3 align-self-center">
                <div class="mx-auto loader-cube-wrap loader-cube-animate">
                    <img src="{{ asset('mahasiswa/img/logo.png') }}" alt="Logo">
                </div>
                <p class="mt-4">It's time for track budget<br><strong>Please wait...</strong></p>
            </div>
        </div>
    </div>
    <!-- loader section ends -->
    {{-- @include('layouts.mahasiswa.sidebar') --}}

    <!-- Begin page -->
    <main class="h-100">

        <!-- Header -->
        <header class="header position-fixed">
            <div class="row">
                <div class="col-auto">
                    <a href="javascript:void(0)" target="_self" class="btn btn-light btn-44 menu-btn">
                        <i class="bi bi-list"></i>
                    </a>
                </div>
                <div class="text-center col align-self-center">
                    <div class="logo-small">
                        <img src="{{ asset('mahasiswa/img/logo.png') }}" alt="">
                        <h5>FiMobile</h5>
                    </div>
                </div>
                <div class="col-auto">
                    <a href="notifications.html" target="_self" class="btn btn-light btn-44">
                        <i class="bi bi-bell"></i>
                        <span class="count-indicator"></span>
                    </a>
                </div>
            </div>
        </header>
        <!-- Header ends -->

        <!-- main page content -->
        <div class="container main-container">

            @yield('container')

        </div>
        <!-- main page content ends -->


    </main>
    <!-- Page ends-->

    @include('layouts.mahasiswa.footer')
    <!-- Required jquery and libraries -->
    <script src="{{ asset('mahasiswa/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('mahasiswa/js/popper.min.js') }}"></script>
    <script src="{{ asset('mahasiswa/vendor/bootstrap-5/js/bootstrap.bundle.min.js') }}"></script>

    <!-- cookie js -->
    <script src="{{ asset('mahasiswa/js/jquery.cookie.js') }}"></script>

    <!-- Customized jquery file  -->
    <script src="{{ asset('mahasiswa/js/main.js') }}"></script>
    <script src="{{ asset('mahasiswa/js/color-scheme.js') }}"></script>

    <!-- PWA app service registration and works -->
    {{-- <script src="{{ asset('mahasiswa/js/pwa-services.js') }}"></script> --}}

    <!-- Chart js script -->
    <script src="{{ asset('mahasiswa/vendor/chart-js-3.3.1/chart.min.js') }}"></script>

    <!-- Progress circle js script -->
    <script src="{{ asset('mahasiswa/vendor/progressbar-js/progressbar.min.js') }}"></script>

    <!-- swiper js script -->
    <script src="{{ asset('mahasiswa/vendor/swiperjs-6.6.2/swiper-bundle.min.js') }}"></script>

    <!-- page level custom script -->
    <script src="{{ asset('mahasiswa/js/app.js') }}"></script>


    @yield('page-script')
</body>

</html>
