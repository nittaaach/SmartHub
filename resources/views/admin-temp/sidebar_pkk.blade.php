<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    @yield('sidebar_pkk')
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Sidebar Menu ] start -->
    @php
        $role = auth()->user()->role;
        $routePrefix = "{$role}.";
        $dashboardRoute = $routePrefix . 'dashboard';
    @endphp

    <nav class="pc-sidebar">
        <div class="navbar-wrapper">
            <div class="m-header">
                {{-- Use the named route for the logo link as well --}}
                <a href="{{ route($dashboardRoute) }}" class="b-brand text-primary">
                    {{-- <img src="../assets_admin/images/logo-dark.svg" class="img-fluid logo-lg" alt="logo"> --}}
                    <h2>SmartHub</h2>
                </a>
            </div>
            <div class="navbar-content">
                <ul class="pc-navbar">

                    {{-- 1. DASHBOARD: The FIX --}}
                    {{-- Use the correct route name and check if the current route is the dashboard route --}}
                    <li class="pc-item {{ request()->routeIs($dashboardRoute) ? 'pc-active' : '' }}">
                        <a href="{{ route($dashboardRoute) }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>
                    {{-- END OF FIX --}}
                    <li class="pc-item pc-caption">
                        <label>Produksi</label>
                        <i class="ti ti-news"></i>
                    </li>

                    {{-- Consistent use of $routePrefix --}}
                    <li class="pc-item {{ request()->routeIs($routePrefix . 'jadwalpkk') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'jadwalpkk') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-clipboard-list"></i></span>
                            <span class="pc-mtext">Penjadwalan Kegiatan</span>
                        </a>
                    </li>
                    <li class="pc-item {{ request()->routeIs($routePrefix . 'dokumentasipkk') ? 'pc-active' : '' }}">
                        <a class="pc-link" href="{{ route($routePrefix . 'dokumentasipkk') }}">
                            <span class="pc-micon"><i class="ti ti-camera"></i></span>
                            <span class="pc-mtext">Dokumentasi Kegiatan</span></a>
                        </a>
                    </li>
                    <li class="pc-item {{ request()->routeIs($routePrefix . 'activitypkk') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'activitypkk') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-cloud-upload"></i></span>
                            <span class="pc-mtext">Publikasi Kegiatan</span>
                        </a>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>Management</label>
                        <i class="ti ti-news"></i>
                    </li>

                    <li class="pc-item {{ request()->routeIs($routePrefix . 'struktural') ? 'pc-active' : '' }}">
                        <a class="pc-link" href="{{ route($routePrefix . 'struktural') }}">
                            <span class="pc-micon"><i class="ti ti-sitemap"></i></span>
                            <span class="pc-mtext">Struktural PKK</span></a>
                        </a>
                    </li>

                    {{-- <li class="pc-item {{ request()->routeIs($routePrefix . 'rekapitulasipkk') ? 'pc-active' : '' }}">
                        <a class="pc-link" href="{{ route($routePrefix . 'rekapitulasipkk') }}">
                            <span class="pc-micon"><i class="ti ti-report-money"></i></span>
                            <span class="pc-mtext">Rekapitulasi Keuangan</span></a>
                        </a>
                    </li> --}}

                    <li class="pc-item pc-caption">
                        <label>Pemasaran</label>
                        <i class="ti ti-news"></i>
                    </li>

                    <li class="pc-item {{ request()->routeIs($routePrefix . 'katalog') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'katalog') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-shopping-cart"></i></span>
                            <span class="pc-mtext">Katalog Produk</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ Sidebar Menu ] end -->

    <!-- [ Header Topbar ] start -->
    <header class="pc-header">
        <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">
                    <!-- ======= Menu collapse Icon ===== -->
                    <li class="pc-h-item pc-sidebar-collapse">
                        <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="pc-h-item pc-sidebar-popup">
                        <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="dropdown pc-h-item d-inline-flex d-md-none">
                        <a class="pc-head-link dropdown-toggle arrow-none m-0" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ti ti-search"></i>
                        </a>
                        <div class="dropdown-menu pc-h-dropdown drp-search">
                            <form class="px-3">
                                <div class="form-group mb-0 d-flex align-items-center">
                                    <i data-feather="search"></i>
                                    <input type="search" class="form-control border-0 shadow-none"
                                        placeholder="Search here. . .">
                                </div>
                            </form>
                        </div>
                    </li>
                    <li class="pc-h-item d-none d-md-inline-flex">
                        <form class="header-search">
                            <i data-feather="search" class="icon-search"></i>
                            <input type="search" class="form-control" placeholder="Search here. . .">
                        </form>
                    </li>
                </ul>
            </div>
            <!-- [Mobile Media Block end] -->
            <div class="ms-auto">
                <ul class="list-unstyled">
                    <li class="dropdown pc-h-item header-user-profile">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false">
                            @if ($user && $user->gambar)
                                <img src="{{ asset('storage/' . $user->gambar) }}" alt="user-image"
                                    class="user-avtar">
                            @else
                                <img src="{{ asset('assets_admin/images/user/avatar-2.jpg') }}" alt="user-image"
                                    class="user-avtar">
                            @endif
                            <span>{{ $user->name ?? 'Guest' }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header">
                                <div class="d-flex mb-1">
                                    <div class="shrink-0">
                                        @if ($user && $user->gambar)
                                            <img src="{{ asset('storage/' . $user->gambar) }}" alt="user-image"
                                                class="user-avtar wid-35">
                                        @else
                                            <img src="{{ asset('assets_admin/images/user/avatar-2.jpg') }}"
                                                alt="user-image" class="user-avtar wid-35">
                                        @endif
                                    </div>
                                    <div class="grow ms-3">
                                        <h6 class="mb-1">{{ $user->name ?? 'Guest' }}</h6>
                                        <span>{{ $user->role ?? 'Tidak Ada Role' }}</span>
                                    </div>
                                    <a href="{{ route('logout') }}" class="pc-head-link bg-transparent">
                                        <i class="ti ti-power text-danger"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                                <div class="dropdown-header">
                                    <div class="d-flex mb-1 align-items-center">
                                        <div class="shrink-0">
                                            @if ($user && $user->gambar)
                                                <img src="{{ asset('storage/' . $user->gambar) }}" alt="user-image"
                                                    class="user-avtar wid-35">
                                            @else
                                                <img src="{{ asset('assets_admin/images/user/avatar-2.jpg') }}"
                                                    alt="user-image" class="user-avtar wid-35">
                                            @endif
                                        </div>

                                        <div class="grow ms-3">
                                            <h6 class="mb-1">{{ $user->name ?? 'Guest' }}</h6>
                                            <span>{{ $user->role ?? 'Tidak Ada Role' }}</span>
                                        </div>

                                        <a href="{{ route('logout') }}" class="pc-head-link bg-transparent"
                                            title="Logout">
                                            <i class="ti ti-power text-danger fs-5"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="dropdown-item">
                                    <a href="{{ route('logout') }}" class="d-flex align-items-center text-danger">
                                        <i class="ti ti-power me-2"></i> Logout
                                    </a>
                                </div>
                            </div>
                            <div class="tab-content" id="mysrpTabContent">
                                <div class="tab-pane fade show active" id="drp-tab-1" role="tabpanel"
                                    aria-labelledby="drp-t1" tabindex="0">
                                    <a href="/" class="dropdown-item">
                                        <i class="ti ti-power"></i>
                                        <span>Logout</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- [ Header ] end -->
</body>
