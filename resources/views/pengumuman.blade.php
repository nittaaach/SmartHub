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


    <!-- ======= Recent Posts Section ======= -->
    <section id="recent-posts" class="recent-posts section">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">

                @foreach ($jadwals as $jadwal)
                    <div class="col-12">
                        <div class="post-item d-flex flex-column flex-md-row align-items-start p-3 border rounded-3 shadow-sm"
                            data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="post-content grow">
                                <h3 class="post-title mb-2">{{ $jadwal->nama_kegiatan }}</h3>
                                <div class="meta d-flex align-items-center mb-2 text-muted small">
                                    <div class="d-flex align-items-center me-3">
                                        <i class="bi bi-calendar-event"></i>
                                        <span class="ps-2">
                                            {{ $jadwal->tanggal_mulai->format('d M Y') }}
                                            -
                                            {{ $jadwal->tanggal_selesai ? $jadwal->tanggal_selesai->format('d M Y') : '-' }}
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-folder2"></i>
                                        <span class="ps-2">{{ $jadwal->kategori }}</span>
                                    </div>
                                </div>
                                <p class="mb-0 text-secondary">
                                    {{ Str::limit($jadwal->deskripsi, 200) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div><!-- End row -->

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $jadwals->links() }}
            </div>

        </div><!-- End container -->
    </section><!-- End Recent Posts Section -->
@endsection


@extends('user-temp.footer')
