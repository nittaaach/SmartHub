@extends('user-temp.head')
@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Struktural</h1>
                        <p class="mb-0">Susunan kepengurusan RW 12 Jatiwaringin</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="/landing">Home</a></li>
                    <li class="current">Struktural</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- ================= RW ================= -->
    <section id="team" class="team section">
        <a href="/rw">
            <div class="container section-title" data-aos="fade-up">
                <p>Struktur RW 12</p>
                <h2>Susunan kepengurusan RW 12 Jatiwaringin</h2>
            </div>


            <div class="container">
                <div class="row gy-4">
                    @forelse ($rw as $item)
                        <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                            <div class="team-member">
                                <div class="member-img">
                                    <img src="{{ asset('assets-user/img/team/team-1.jpg') }}" class="img-fluid"
                                        alt="">
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
                        <p class="text-center">Belum ada data RW.</p>
                    @endforelse
                </div>
            </div>
        </a>
    </section>

    <!-- ================= PKK ================= -->
    <section id="team" class="team section">
        <a href="/pkk">
            <div class="container section-title" data-aos="fade-up">
                <p>Struktur PKK</p>
                <h2>Susunan kepengurusan PKK Jatiwaringin</h2>
            </div>
            <div class="container">
                <div class="row gy-4">
                    @forelse ($pkk as $item)
                        <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                            <div class="team-member">
                                <div class="member-img">
                                    <img src="{{ asset('assets-user/img/team/team-2.jpg') }}" class="img-fluid"
                                        alt="">
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
                        <p class="text-center">Belum ada data PKK.</p>
                    @endforelse
                </div>
            </div>
        </a>
    </section>

    <!-- ================= KATAR ================= -->
    <section id="team" class="team section">
        <a href="/katar">
            <div class="container section-title" data-aos="fade-up">
                <p>Struktur Karang Taruna</p>
                <h2>Susunan kepengurusan Karang Taruna Jatiwaringin</h2>
            </div>
            <div class="container">
                <div class="row gy-4">
                    @forelse ($katar as $item)
                        <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                            <div class="team-member">
                                <div class="member-img">
                                    <img src="{{ asset('assets-user/img/team/team-3.jpg') }}" class="img-fluid"
                                        alt="">
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
                        <p class="text-center">Belum ada data Karang Taruna.</p>
                    @endforelse
                </div>
            </div>
        </a>
    </section><!-- /Team Section -->
@endsection

@extends('user-temp.footer')
