@yield('header')
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
                    <a href="/landing#news"><span>Berita</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
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
