@extends('user-temp.layout')
@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Karang Taruna</h1>
                        <p class="mb-0">Susunan kepengurusan Karang Taruna 12 Jatiwaringin</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="/landing">Home</a></li>
                    <li class="current">Struktural</li>
                    <li class="current">Karang Taruna</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Team Section -->
    <section id="team" class="team section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <p>Struktur Karang Taruna 12</p>
            <h2>Susunan kepengurusan Karang Taruna 12 Jatiwaringin</h2>
        </div><!-- End Section Title -->
        <div class="container">
            <div class="row gy-4">
                <div class="container">
                    <div class="row gy-4">
                        @forelse ($strukturalkatar as $item)
                            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                                <div class="team-member">
                                    <div class="member-img">
                                        <img src="{{ asset('storage/' . $item->gambar) }}" class="img-fluid"
                                            alt="{{ $item->datadiri->name ?? 'Tidak ada nama' }}" width="300">
                                        <div class="social">
                                            @if ($item->datadiri && $item->datadiri->notelp)
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->datadiri->notelp) }}"
                                                    target="_blank">
                                                    <i class="bi bi-whatsapp"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="member-info">
                                        <h4>{{ $item->datadiri->name ?? 'Tidak ada nama' }}</h4>
                                        <span>{{ $item->jabatan ?? 'Jabatan belum diatur' }}</span>
                                        <p>{{ $item->datadiri->alamat ?? 'Alamat tidak tersedia' }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">Belum ada data RT untuk jabatan BPH.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Team Section -->

    <section id="stat" class="stats section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="row gy-3">
                    @forelse ($anggotaLain as $item)
                        <div class="col-lg-3 col-md-6">
                            <div class="stats-item d-flex justify-content-start align-items-center w-100 h-100">
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="foto"
                                    class="me-2 rounded-circle" style="width:50px; height:50px; object-fit:cover;">
                                <div>
                                    <p style="margin: 0; font-weight: bold;">{{ $item->jabatan ?? 'Jabatan belum diatur' }}
                                    </p>
                                    <p style="margin: 0;">{{ $item->datadiri->name ?? 'Tidak ada nama' }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">Belum ada data anggota RW lainnya.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section><!-- /Stats Section -->

    <!-- Bagan Struktur Section -->
    <section id="bagan" class="section bg-light">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <p>Bagan Karang Taruna</p>
                <h2>Struktur visual kepengurusan Karang Taruna</h2>
            </div>
            <div class="row justify-content-center">
                @forelse ($bagan as $item)
                    <div class="col-lg-8 col-md-10 text-center mb-4">
                        <img src="{{ asset('storage/' . $item->fotobagan) }}" alt="Bagan Struktur RW"
                            class="img-fluid rounded"
                            style="object-fit: cover; object-position: center; width: 100%; height: auto;">

                        @if ($item->deskripsi)
                            <p class="text-muted mt-2">{{ $item->deskripsi }}</p>
                        @endif
                    </div>
                @empty
                    <p class="text-center">Belum ada bagan struktur RW yang diunggah.</p>
                @endforelse
            </div>
        </div>
    </section>
    <!-- /Bagan Struktur Section -->
@endsection
