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
    <link href="assets-user/img/favicon.png" rel="icon">
    <link href="assets-user/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets-user/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets-user/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets-user/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets-user/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets-user/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets-user/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: FlexStart
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Updated: Nov 01 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="/landing" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="assets-user/img/logo.svg" alt="">
                <h1 class="sitename">SmartHub</h1>
            </a>

            <nav id="navmenu" class="navmenu">
<<<<<<< HEAD
                <ul>
                    <li><a href="landing" class="{{ Request::is('landing') ? 'active' : '' }}">Beranda</a></li>
                    <li><a href="#about" class="{{ Request::is('about') ? 'active' : '' }}">Tentang Kami</a></li>
                    <li><a href="#values" class="{{ Request::is('values') ? 'active' : '' }}">Layanan</a></li>
                    <li><a href="#stats" class="{{ Request::is('stats') ? 'active' : '' }}">Informasi</a></li>
                    {{-- <li><a href="#team" class="{{ Request::is('team') ? 'active' : '' }}">Team</a></li> --}}
                    <li><a href="#recent-posts" class="{{ Request::is('recent-posts') ? 'active' : '' }}">Berita</a></li>
                    {{-- <li class="dropdown"><a href="#"><span>Dropdown</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="#">Dropdown 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                                        class="bi bi-chevron-down toggle-dropdown"></i></a>
                                <ul>
                                    <li><a href="#">Deep Dropdown 1</a></li>
                                    <li><a href="#">Deep Dropdown 2</a></li>
                                    <li><a href="#">Deep Dropdown 3</a></li>
                                    <li><a href="#">Deep Dropdown 4</a></li>
                                    <li><a href="#">Deep Dropdown 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Dropdown 2</a></li>
                            <li><a href="#">Dropdown 3</a></li>
                            <li><a href="#">Dropdown 4</a></li>
                        </ul>
                    </li> --}}
                    {{-- <li class="listing-dropdown"><a href="#"><span>Listing Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li>
                <a href="#">Column 1 link 1</a>
                <a href="#">Column 1 link 2</a>
                <a href="#">Column 1 link 3</a>
              </li>
              <li>
                <a href="#">Column 2 link 1</a>
                <a href="#">Column 2 link 2</a>
                <a href="#">Column 3 link 3</a>
              </li>
              <li>
                <a href="#">Column 3 link 1</a>
                <a href="#">Column 3 link 2</a>
                <a href="#">Column 3 link 3</a>
              </li>
              <li>
                <a href="#">Column 4 link 1</a>
                <a href="#">Column 4 link 2</a>
                <a href="#">Column 4 link 3</a>
              </li>
              <li>
                <a href="#">Column 5 link 1</a>
                <a href="#">Column 5 link 2</a>
                <a href="#">Column 5 link 3</a>
              </li>
            </ul>
          </li> --}}
                    <li><a href="#contact" class="{{ Request::is('contact') ? 'active' : '' }}">Hubungi Kami</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
=======
  <ul>
    <li><a href="/landing" class="{{ Request::is('landing') ? 'active' : '' }}">Beranda</a></li>

    <!-- Tentang Kami -->
    <li class="dropdown">
      <a href="/landing#about"><span>Tentang Kami</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
      <ul>
        <li class="dropdown">
          <a href="/struktural"><span>Struktural</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
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
      <a href="/landing#values"><span>Layanan</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
      <ul>
        <li><a href="/administrasi">Administrasi Kependudukan</a></li>
      </ul>
    </li>

    <!-- Informasi -->
    <li class="dropdown">
      <a href="/landing#stats"><span>Informasi</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
      <ul>
        <li><a href="/katalog">Katalog PKK</a></li>
        <li><a href="/galeri">Galeri</a></li>
        <li><a href="/statistika">Statistik</a></li>
        <li><a href="/fasilitas">Fasilitas</a></li>
      </ul>
    </li>

    <!-- Berita -->
    <li class="dropdown">
      <a href="/landing#news"><span>Berita</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
      <ul>
        <li><a href="/pengumuman">Pengumuman</a></li>
        <li><a href="/aktivitas">Aktivitas</a></li>
      </ul>
    </li>

    <li><a href="/landing#contact" class="{{ Request::is('contact') ? 'active' : '' }}">Hubungi Kami</a></li>
  </ul>

  <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>

>>>>>>> bada

            <a class="btn-getstarted flex-md-shrink-0" href="/login">Sign In</a>

        </div>
    </header>

</body>

</html>
