@extends('user-temp.head')
@section('content')

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1>Layanan</h1>
              <p class="mb-0">Jenis pelayanan yang tersedia di RW 12</p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="/landing">Home</a></li>
            <li class="current">Layanan</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->
 <section id="values" class="values section">
  <div class="container">
    <div class="row gy-4">

      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card">
          <img src="assets-user/img/values-1.png" class="img-fluid" alt="">
          <h3>Ad cupiditate sed est odio</h3>
          <p>Eum ad dolor et. Autem aut fugiat debitis voluptatem consequuntur sit. Et veritatis id.</p>
          <a href="/administrasi" class="readmore stretched-link">
            <span>Read More</span><i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div><!-- End Card Item -->

      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
        <div class="card">
          <img src="assets-user/img/values-2.png" class="img-fluid" alt="">
          <h3>Voluptatem voluptatum alias</h3>
          <p>Repudiandae amet nihil natus in distinctio suscipit id. Doloremque ducimus ea sit non.</p>
          <a href="/detaillayanan" class="readmore stretched-link">
            <span>Read More</span><i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div><!-- End Card Item -->

      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
        <div class="card">
          <img src="assets-user/img/values-3.png" class="img-fluid" alt="">
          <h3>Fugit cupiditate alias nobis.</h3>
          <p>Quam rem vitae est autem molestias explicabo debitis sint. Vero aliquid quidem commodi.</p>
          <a href="/detaillayanan" class="readmore stretched-link">
            <span>Read More</span><i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div><!-- End Card Item -->

    </div>
  </div>

</section><!-- /Values Section -->

@endsection

@extends('user-temp.footer')
