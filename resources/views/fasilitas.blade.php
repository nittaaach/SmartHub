@extends('user-temp.head')
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

          <div class="col-lg-3 col-md-6">
            <div class="stats-item w-100 h-100 p-4 shadow-sm rounded bg-light text-dark">
                <h5 class="fw-bold mb-3">Kantor Pos</h5>
                <p class="fw-semibold mb-2">Jam Operasional</p>
                <div class="d-flex align-items-center mb-4">
                <i class="bi bi-clock text-success me-2 fs-5"></i>
                <small>08:00 WIB – 20:00 WIB</small>
                </div>
                <div class="d-flex justify-content-start gap-3">
                <a href="tel:+628123456789" class="text-muted fs-4">
                    <i class="bi bi-telephone"></i>
                </a>
                <a href="https://kantorpos.co.id" target="_blank" class="text-muted fs-4">
                    <i class="bi bi-link-45deg"></i>
                </a>
                </div>
            </div>
            </div>

        </div>
      </div>
    </section><!-- /Stats Section -->
@endsection

@extends('user-temp.footer')
