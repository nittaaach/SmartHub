@extends('user-temp.head')
@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Administrasi Penduduk</h1>
                        <p class="mb-0">Jenis peAdministrasi Penduduk yang tersedia di RW 12</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="/landing">Home</a></li>
                    <li class="current">Layanan</li>
                    <li class="current">Administrasi Penduduk</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Stats Section -->
    <section id="stats" class="stats section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="row">
                    @foreach ($layanan as $item)
                        <div class="col-lg-3 col-md-6">
                            <div class="stats-item d-flex flex-column w-100 h-100 p-3">
                                <h6 class="fw-bold mb-2">{{ $item->nama_layanan }}</h6>
                                <p class="fw-semibold mb-2 fs-6">Persyaratan Dokumen</p>

                                <ul class="list-unstyled mb-0 fs-6">
                                    @foreach ($item->syaratLayanans as $syarat)
                                        <li class="d-flex flex-column mb-2">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-file-earmark-text text-success me-2 fs-5"></i>
                                                <small>{{ $syarat->nama_dokumen }}</small>
                                            </div>
                                            @php
                                                $template = $syarat->template_surat->first();
                                            @endphp

                                            @if ($template && $template->file)
                                                <a href="{{ asset('storage/' . $template->file) }}" target="_blank"
                                                    class="text-primary small" style="margin-left: 28px;">
                                                    Download Template
                                                </a>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section><!-- /Stats Section -->
@endsection

@extends('user-temp.footer')
