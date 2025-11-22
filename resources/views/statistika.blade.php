@extends('user-temp.layout')
@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Statistik</h1>
                        <p class="mb-0">Statistik penduduk dan bangunan di RW 12 Jatiwaringin</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="/landing">Home</a></li>
                    <li class="current">Informasi</li>
                    <li class="current">Statistik</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->


    <section id="stats" class="stats section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="text-center mb-4">
                <h3>Data Penduduk Berdasarkan KTP</h3>
            </div>
            <div class="table-responsive mb-5">
                <table class="table table-striped table-hover table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th>RT</th>
                            <th>Laki-laki</th>
                            <th>Perempuan</th>
                            <th>Jumlah KK</th>
                            <th>Total Penduduk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_ktp as $item)
                            <tr>
                                <td>{{ $item->rt }}</td>
                                <td>{{ $item->laki_laki }}</td>
                                <td>{{ $item->perempuan }}</td>
                                <td>{{ $item->jumlah_kk }}</td>
                                <td>{{ $item->laki_laki + $item->perempuan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            <div class="text-center mb-4">
                <h3>Data Penduduk Non-KTP</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th>RT</th>
                            <th>Laki-laki</th>
                            <th>Perempuan</th>
                            <th>Jumlah KK</th>
                            <th>Total Penduduk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_nonktp as $item)
                            <tr>
                                <td>{{ $item->rt }}</td>
                                <td>{{ $item->laki_laki }}</td>
                                <td>{{ $item->perempuan }}</td>
                                <td>{{ $item->jumlah_kk }}</td>
                                <td>{{ $item->laki_laki + $item->perempuan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
