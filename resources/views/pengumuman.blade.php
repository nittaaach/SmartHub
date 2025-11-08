@extends('user-temp.head')
@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Pengumuman</h1>
                        <p class="mb-0">Informasi Terkini</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="/landing">Home</a></li>
                    <li class="current">Berita</li>
                    <li class="current">Pengumuman</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- ======= Section PKK ======= -->
    <section id="pkk-section" class="recent-posts section">
        <div class="container" data-aos="fade-up">
            <h2 class="mb-4 fw-bold border-bottom pb-2">Pengumuman PKK</h2>
            <div class="row gy-4">
                @foreach ($jadwal_pkk as $jadwal)
                    <div class="col-12">
                        <div class="post-item d-flex flex-column flex-md-row align-items-start p-4 border rounded-3 shadow-sm w-100"
                            data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="post-content grow w-100">
                                <h3 class="post-title mb-2">{{ $jadwal->nama_kegiatan }}</h3>
                                <div class="meta d-flex align-items-center mb-2 text-muted small flex-wrap">
                                    <div class="d-flex align-items-center me-3 mb-1">
                                        <i class="bi bi-calendar-event"></i>
                                        <span class="ps-2">
                                            {{ $jadwal->tanggal_mulai->format('d M Y') }}
                                            -
                                            {{ $jadwal->tanggal_selesai ? $jadwal->tanggal_selesai->format('d M Y') : '-' }}
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="bi bi-folder2"></i>
                                        <span class="ps-2">PKK</span>
                                    </div>
                                </div>
                                <p class="mb-2 text-secondary" style="text-align: justify;">
                                    {{ Str::limit($jadwal->deskripsi, 200) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $jadwal_pkk->links() }}
            </div>
        </div>
    </section>
    <!-- End Section PKK -->

    <!-- ======= Section KATAR ======= -->
    <section id="katar-section" class="recent-posts section">
        <div class="container" data-aos="fade-up">
            <h2 class="mb-4 fw-bold border-bottom pb-2">Pengumuman KATAR</h2>
            <div class="row gy-4">
                @foreach ($jadwal_katar as $jadwal)
                    <div class="col-12">
                        <div class="post-item d-flex flex-column flex-md-row align-items-start p-4 border rounded-3 shadow-sm w-100"
                            data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="post-content grow w-100">
                                <h3 class="post-title mb-2">{{ $jadwal->nama_kegiatan }}</h3>
                                <div class="meta d-flex align-items-center mb-2 text-muted small flex-wrap">
                                    <div class="d-flex align-items-center me-3 mb-1">
                                        <i class="bi bi-calendar-event"></i>
                                        <span class="ps-2">
                                            {{ $jadwal->tanggal_mulai->format('d M Y') }}
                                            -
                                            {{ $jadwal->tanggal_selesai ? $jadwal->tanggal_selesai->format('d M Y') : '-' }}
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="bi bi-folder2"></i>
                                        <span class="ps-2">KATAR</span>
                                    </div>
                                </div>
                                <p class="mb-2 text-secondary" style="text-align: justify;">
                                    {{ Str::limit($jadwal->deskripsi, 350) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $jadwal_katar->links() }}
            </div>
        </div>
    </section>
    <!-- End Section KATAR -->
@endsection


@extends('user-temp.footer')
