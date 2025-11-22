@extends('user-temp.layout')
@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Fasilitas</h1>
                        <p class="mb-0">Lihat fasilitas penunjang yang ada di RW 12 Jatiwaringin</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="/landing">Home</a></li>
                    <li class="current">Informasi</li>
                    <li class="current">Fasilitas</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->




    <!-- Stats Section -->
    <section id="stats" class="stats section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">


                @foreach ($fasilitas as $item)
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item w-100 h-100 p-4 shadow-sm rounded bg-light text-dark">


                            {{-- Tambahan gambar --}}
                            @if ($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->name }}"
                                    class="img-fluid rounded mb-3" style="width: 100%; height: 180px; object-fit: cover;">
                            @else
                                <img src="{{ asset('assets-user/img/default.jpg') }}" alt="Default Image"
                                    class="img-fluid rounded mb-3" style="width: 100%; height: 180px; object-fit: cover;">
                            @endif


                            <h5 class="fw-bold mb-3">{{ $item->name }}</h5>
                            <p class="fw-semibold mb-2">{{ $item->kategori }}</p>


                            <div class="d-flex align-items-center mb-4">
                                <i class="bi bi-geo-alt text-success me-2 fs-5"></i>
                                <small>{{ $item->alamat }} (RT {{ $item->lokasi_rt }})</small>
                            </div>


                            <div class="d-flex justify-content-start gap-3">
                                <i class="bi bi-houses text-muted fs-4"></i>
                                <small>Kondisi: {{ $item->condition }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach


                {{-- Jika tidak ada data --}}
                @if ($fasilitas->isEmpty())
                    <div class="col-12 text-center text-muted">
                        <p>Belum ada data fasilitas yang tersedia.</p>
                    </div>
                @endif


            </div>
        </div>
    </section><!-- /Stats Section -->
@endsection
