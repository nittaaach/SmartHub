@extends('user-temp.head')

@section('content')

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1>Galeri</h1>
              <p class="mb-0">Memori RW 12</p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="/landing">Home</a></li>
            <li class="current">Informasi</li>
            <li class="current">Galeri</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

<!-- Features Section -->
<section id="features" class="features section">
  <div class="container">
    <div class="row gy-4">

      <!-- Card 1 -->
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
        <a href="/detailgaleri" class="readmore stretched-link"><span></span></a>
        <div class="card border-0 shadow-sm position-relative overflow-hidden rounded-4">
          <img src="assets-user/img/about.jpg" class="img-fluid" alt="LDKS Hari-1">
          <div class="card-img-overlay d-flex flex-column justify-content-end p-3" style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
            <h5 class="text-white fw-bold mb-1">LDKS Hari-1</h5>
            <div class="text-white-50 small d-flex align-items-center">
              <i class="bi bi-calendar me-1"></i> 2021-12-23 23:40:00
              <span class="mx-2">•</span>
              <i class="bi bi-folder me-1"></i> General
            </div>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
        <a href="/detailgaleri" class="readmore stretched-link"><span></span></a>
        <div class="card border-0 shadow-sm position-relative overflow-hidden rounded-4">
          <img src="assets-user/img/about.jpg" class="img-fluid" alt="Pengumuman Kelulusan 2022">
          <div class="card-img-overlay d-flex flex-column justify-content-end p-3" style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
            <h5 class="text-white fw-bold mb-1">Pengumuman Kelulusan 2022</h5>
            <div class="text-white-50 small d-flex align-items-center">
              <i class="bi bi-calendar me-1"></i> 2022-06-03 09:08:53
              <span class="mx-2">•</span>
              <i class="bi bi-folder me-1"></i> General
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

@endsection

@extends('user-temp.footer')





