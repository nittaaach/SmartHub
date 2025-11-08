@yield('head')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>SmartHub - RW 12 (PKK Anyelir & Karang Taruna)</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets-user/img/Logov1.png" rel="icon">
    <link href="assets-user/img/Logov1.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@300;400;500;600&family=Nunito:wght@300;400;600;700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets-user/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-user/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-user/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-user/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-user/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets-user/css/main.css') }}" rel="stylesheet">

</head>

<body class="index-page">

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">
            <a href="/landing" class="logo d-flex align-items-center me-auto">
                <img src="{{ asset('assets-user/img/clients/kemdi.png') }}" alt="">
                <img src="{{ asset('assets-user/img/clients/UNM.png') }}" alt="">
                <img src="{{ asset('assets-user/img/Logov1.png') }}" alt="">
                <h1 class="sitename">SmartHub</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="/landing" class="{{ Request::is('landing') ? 'active' : '' }}">Beranda</a></li>


                    <!-- Tentang Kami -->
                    <li class="dropdown">
                        <a href="/landing#about"><span>Tentang Kami</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li class="dropdown">
                                <a href="/struktural"><span>Struktural</span> <i
                                        class="bi bi-chevron-down toggle-dropdown"></i></a>
                                <ul>
                                    <li><a href="/rw">RW</a></li>
                                    <li><a href="/pkk">PKK</a></li>
                                    <li><a href="/katar">Katar</a></li>
                                </ul>
                            </li>
                            <li><a href="/profil">Profil</a></li>
                        </ul>
                    </li>


                    <!-- Layanan -->
                    <li class="dropdown">
                        <a href="/landing#values"><span>Layanan</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="/administrasi">Administrasi Kependudukan</a></li>
                        </ul>
                    </li>


                    <!-- Informasi -->
                    <li class="dropdown">
                        <a href="/landing#stats"><span>Informasi</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="/katalog">Katalog PKK</a></li>
                            <li><a href="/galeri">Galeri</a></li>
                            <li><a href="/statistika">Statistik</a></li>
                            <li><a href="/fasilitas">Fasilitas</a></li>
                        </ul>
                    </li>


                    <!-- Berita -->
                    <li class="dropdown">
                        <a href="/landing#news"><span>Berita</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="/pengumuman">Pengumuman</a></li>
                            <li><a href="/aktivitas">Aktivitas</a></li>
                        </ul>
                    </li>


                    <li><a href="/landing#contact" class="{{ Request::is('contact') ? 'active' : '' }}">Hubungi
                            Kami</a>
                    </li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted flex-md-shrink-0" href="/login">Sign In</a>
        </div>
    </header>

    <!-- ======= Main Content ======= -->
    @yield('content')

    <!-- ======= Footer ======= -->
    @include('user-temp.footer')

    <!-- Scroll Top -->
    <a href="#" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets-user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets-user/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets-user/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets-user/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets-user/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets-user/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets-user/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets-user/js/main.js') }}"></script>

</body>

</html>
