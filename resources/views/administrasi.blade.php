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

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex flex-column w-100 h-100 p-3">
                <a href="/detaillayanan" class="text-decoration-none text-dark">
              <h6 class="fw-bold mb-2">Ahli Waris</h6>
              <p class="fw-semibold mb-2 fs-6">Persyaratan Dokumen</p>
              <ul class="list-unstyled mb-0 fs-6">
                <li class="d-flex align-items-center mb-2">
                  <i class="bi bi-file-earmark-text text-success me-2 fs-5"></i>
                  <small>Surat Pengantar RT</small>
                </li>
                <li class="d-flex align-items-center mb-2">
                  <i class="bi bi-file-earmark-text text-success me-2 fs-5"></i>
                  <small>Fotokopi KTP Anggota Ahli Waris</small>
                </li>
                <li class="d-flex align-items-center mb-2">
                  <i class="bi bi-file-earmark-text text-success me-2 fs-5"></i>
                  <small>Fotokopi Kartu Keluarga</small>
                </li>
                <li class="d-flex align-items-center mb-2">
                  <i class="bi bi-file-earmark-text text-success me-2 fs-5"></i>
                  <small>Fotokopi Akta Kematian</small>
                </li>
                <li class="d-flex align-items-center">
                  <i class="bi bi-file-earmark-text text-success me-2 fs-5"></i>
                  <small>Fotokopi Akta Kelahiran Anggota Ahli Waris</small>
                </li>
              </ul>
            </div>
            </a>
          </div>


        </div>

      </div>

    </section><!-- /Stats Section -->


@endsection

@extends('user-temp.footer')
