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
    <div class="row gy-5">

      <!-- Post Item 1 -->
      <div class="col-xl-4 col-md-6">
        <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">

          <div class="post-img position-relative overflow-hidden">
            <img src="assets-user/img/blog/blog-1.jpg" class="img-fluid" alt="">
            <span class="post-date">December 12</span>
          </div>

          <div class="post-content d-flex flex-column">
            <h3 class="post-title">Eum ad dolor et. Autem aut fugiat debitis</h3>

            <div class="meta d-flex align-items-center">
              <div class="d-flex align-items-center">
                <i class="bi bi-calendar-event"></i>
                <span class="ps-2">12 Dec 2025</span>
              </div>
              <span class="px-3 text-black-50">/</span>
              <div class="d-flex align-items-center">
                <i class="bi bi-folder2"></i>
                <span class="ps-2">Politics</span>
              </div>
            </div>

            <hr>

            <a href="/news_detail" class="readmore stretched-link">
              <span>Read More</span><i class="bi bi-arrow-right"></i>
            </a>
          </div>

        </div>
      </div><!-- End post item -->

      <!-- Post Item 2 -->
      <div class="col-xl-4 col-md-6">
        <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="200">

          <div class="post-img position-relative overflow-hidden">
            <img src="assets-user/img/blog/blog-2.jpg" class="img-fluid" alt="">
            <span class="post-date">July 5</span>
          </div>

          <div class="post-content d-flex flex-column">
            <h3 class="post-title">Et repellendus molestiae qui est sed omnis</h3>

            <div class="meta d-flex align-items-center">
              <div class="d-flex align-items-center">
                <i class="bi bi-calendar-event"></i>
                <span class="ps-2">5 Jul 2025</span>
              </div>
              <span class="px-3 text-black-50">/</span>
              <div class="d-flex align-items-center">
                <i class="bi bi-folder2"></i>
                <span class="ps-2">Sports</span>
              </div>
            </div>

            <hr>

            <a href="/news_detail" class="readmore stretched-link">
              <span>Read More</span><i class="bi bi-arrow-right"></i>
            </a>
          </div>

        </div>
      </div><!-- End post item -->

      <!-- Post Item 3 -->
      <div class="col-xl-4 col-md-6">
        <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="300">

          <div class="post-img position-relative overflow-hidden">
            <img src="assets-user/img/blog/blog-3.jpg" class="img-fluid" alt="">
            <span class="post-date">September 22</span>
          </div>

          <div class="post-content d-flex flex-column">
            <h3 class="post-title">Quia assumenda est et veritatis aut quae</h3>

            <div class="meta d-flex align-items-center">
              <div class="d-flex align-items-center">
                <i class="bi bi-calendar-event"></i>
                <span class="ps-2">22 Sept 2025</span>
              </div>
              <span class="px-3 text-black-50">/</span>
              <div class="d-flex align-items-center">
                <i class="bi bi-folder2"></i>
                <span class="ps-2">Entertainment</span>
              </div>
            </div>

            <hr>

            <a href="/news_detail" class="readmore stretched-link">
              <span>Read More</span><i class="bi bi-arrow-right"></i>
            </a>
          </div>

        </div>
      </div><!-- End post item -->

    </div><!-- End row -->

  </div><!-- End container -->

</section><!-- End Recent Posts Section -->




@endsection

@extends('user-temp.footer')