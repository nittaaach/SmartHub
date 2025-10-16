@extends('user-temp.head')
@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section">

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">Rukun Warga 12</h1>
                    <p data-aos="fade-up" data-aos-delay="100">Situs Resmi Sekretariat RW 12 Jatiwaringin, Jakarta Timur
                    </p>
                    <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
                        <a href="#about" class="btn-get-started">Get Started <i class="bi bi-arrow-right"></i></a>
                        <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                            class="glightbox btn-watch-video d-flex align-items-center justify-content-center ms-0 ms-md-4 mt-4 mt-md-0"><i
                                class="bi bi-play-circle"></i><span>Watch Now</span></a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                    <img src="assets-user/img/hero-img.png" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

        <div class="container" data-aos="fade-up">
            <div class="row gx-0">

                <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="content">
                        <h3>TENTANG KAMI</h3>
                        <h2>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eveniet nulla quam iusto deserunt
                            optio ad minus ullam numquam atque. Distinctio autem eos perferendis ipsam id voluptates ullam
                            praesentium nulla dicta!</h2>
                        <p>
                            Quisquam vel ut sint cum eos hic dolores aperiam. Sed deserunt et. Inventore et et dolor
                            consequatur itaque ut voluptate sed et. Magnam nam ipsum tenetur suscipit voluptatum nam et
                            est corrupti.
                        </p>
                        <div class="text-center text-lg-start">
                            <a href="/profil"
                                class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>Read More</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                    <img src="assets-user/img/about.jpg" class="img-fluid" alt="">
                </div>

            </div>
        </div>

    </section><!-- /About Section -->

 <section id="values" class="values section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <p>LAYANAN<br></p>
    <h2>Yang Kami Sediakan</h2>
    <a href="/layanan" class="readmore stretched-link"><span></span></a>
  </div><!-- End Section Title -->

  <div class="container">
    <div class="row gy-4">

      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card">
          <img src="assets-user/img/values-1.png" class="img-fluid" alt="">
          <h3>Ad cupiditate sed est odio</h3>
          <p>Eum ad dolor et. Autem aut fugiat debitis voluptatem consequuntur sit. Et veritatis id.</p>
          <a href="/layanan" class="readmore stretched-link">
            <span>Read More</span><i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div><!-- End Card Item -->

      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
        <div class="card">
          <img src="assets-user/img/values-2.png" class="img-fluid" alt="">
          <h3>Voluptatem voluptatum alias</h3>
          <p>Repudiandae amet nihil natus in distinctio suscipit id. Doloremque ducimus ea sit non.</p>
          <a href="/layanan" class="readmore stretched-link">
            <span>Read More</span><i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div><!-- End Card Item -->

      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
        <div class="card">
          <img src="assets-user/img/values-3.png" class="img-fluid" alt="">
          <h3>Fugit cupiditate alias nobis.</h3>
          <p>Quam rem vitae est autem molestias explicabo debitis sint. Vero aliquid quidem commodi.</p>
          <a href="/layanan" class="readmore stretched-link">
            <span>Read More</span><i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div><!-- End Card Item -->

    </div>
  </div>

</section><!-- /Values Section -->

<!-- Stats Section -->
<section id="stats" class="stats section">
    <div class="container section-title" data-aos="fade-up">
        <p>INFORMASI<br></p>
        <h2>Yang Kami Sediakan</h2>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">

            <div class="col-lg-3 col-md-6">
                <a href="/statistika" class="text-decoration-none text-dark">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <div>
                            <h3>Statistik</h3>
                            <p>Statistik penduduk & bangunan</p>
                        </div>
                    </div>
                </a>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-md-6">
                <a href="" class="text-decoration-none text-dark">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <div>
                            <h3>Fasilitas</h3>
                            <p>Fasilitas penunjang di sekitar</p>
                        </div>
                    </div>
                </a>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-md-6">
                <a href="" class="text-decoration-none text-dark">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <div>
                            <h3>Siaga Banjir</h3>
                            <p>Status ketinggian air & pompa</p>
                        </div>
                    </div>
                </a>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-md-6">
                <a href="" class="text-decoration-none text-dark">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <div>
                            <h3>Galeri</h3>
                            <p>Dokumentasi kegiatan kemasyarakatan</p>
                        </div>
                    </div>
                </a>
            </div><!-- End Stats Item -->

        </div>
    </div>
</section><!-- /Stats Section -->


    <!-- Recent Posts Section -->
    <section id="recent-posts" class="recent-posts section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <p>BERITA</p>
            <h2>Informasi Terkini</h2>
        <a href="/news" class="readmore stretched-link"><span></span></a>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-5">

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
                                    <i class="bi bi-person"></i> <span class="ps-2">Julia Parker</span>
                                </div>
                                <span class="px-3 text-black-50">/</span>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-folder2"></i> <span class="ps-2">Politics</span>
                                </div>
                            </div>

                            <hr>

                            <a href="/news" class="readmore stretched-link"><span>Read More</span><i
                                    class="bi bi-arrow-right"></i></a>

                        </div>

                    </div>
                </div><!-- End post item -->

                <div class="col-xl-4 col-md-6">
                    <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="200">

                        <div class="post-img position-relative overflow-hidden">
                            <img src="assets-user/img/blog/blog-2.jpg" class="img-fluid" alt="">
                            <span class="post-date">July 17</span>
                        </div>

                        <div class="post-content d-flex flex-column">

                            <h3 class="post-title">Et repellendus molestiae qui est sed omnis</h3>

                            <div class="meta d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person"></i> <span class="ps-2">Mario Douglas</span>
                                </div>
                                <span class="px-3 text-black-50">/</span>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-folder2"></i> <span class="ps-2">Sports</span>
                                </div>
                            </div>

                            <hr>

                            <a href="/news" class="readmore stretched-link"><span>Read More</span><i
                                    class="bi bi-arrow-right"></i></a>

                        </div>

                    </div>
                </div><!-- End post item -->

                <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="post-item position-relative h-100">

                        <div class="post-img position-relative overflow-hidden">
                            <img src="assets-user/img/blog/blog-3.jpg" class="img-fluid" alt="">
                            <span class="post-date">September 05</span>
                        </div>

                        <div class="post-content d-flex flex-column">

                            <h3 class="post-title">Quia assumenda est et veritati tirana ploder</h3>

                            <div class="meta d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person"></i> <span class="ps-2">Lisa Hunter</span>
                                </div>
                                <span class="px-3 text-black-50">/</span>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-folder2"></i> <span class="ps-2">Economics</span>
                                </div>
                            </div>

                            <hr>

                            <a href="/news" class="readmore stretched-link"><span>Read More</span><i
                                    class="bi bi-arrow-right"></i></a>

                        </div>

                    </div>
                </div><!-- End post item -->

            </div>

        </div>

    </section><!-- /Recent Posts Section -->

            <!-- Clients Section -->
        <section id="clients" class="clients section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <p>Partner Kami<br></p>
                <h2>Bekerja sama dengan Instansi Terpercaya</h2>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 40
                },
                "480": {
                  "slidesPerView": 3,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 4,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 6,
                  "spaceBetween": 120
                }
              }
            }
          </script>
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide"><img src="assets-user/img/clients/client-1.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets-user/img/clients/client-2.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets-user/img/clients/client-3.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets-user/img/clients/client-4.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets-user/img/clients/client-5.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets-user/img/clients/client-6.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets-user/img/clients/client-7.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets-user/img/clients/client-8.png" class="img-fluid"
                                alt=""></div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>

        </section><!-- /Clients Section -->

<section id="contact" class="contact section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <p>HUBUNGI KAMI</p>
    <h2>Informasi Kontak</h2>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row gy-4">

      <div class="col-lg-6">

        <div class="row gy-4">
          <div class="col-md-6">
            <div class="info-item" data-aos="fade" data-aos-delay="200">
              <i class="bi bi-geo-alt"></i>
              <h3>Address</h3>
              <p>A108 Adam Street</p>
              <p>New York, NY 535022</p>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item" data-aos="fade" data-aos-delay="300">
              <i class="bi bi-telephone"></i>
              <h3>Call Us</h3>
              <p>+1 5589 55488 55</p>
              <p>+1 6678 254445 41</p>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item" data-aos="fade" data-aos-delay="400">
              <i class="bi bi-envelope"></i>
              <h3>Email Us</h3>
              <p>info@example.com</p>
              <p>contact@example.com</p>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item" data-aos="fade" data-aos-delay="500">
              <i class="bi bi-clock"></i>
              <h3>Open Hours</h3>
              <p>Monday - Friday</p>
              <p>9:00AM - 05:00PM</p>
            </div>
          </div><!-- End Info Item -->
        </div>
      </div>

      <div class="col-lg-6">
        <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up"
          data-aos-delay="200">
          <div class="row gy-4">

            <div class="col-md-6">
              <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
            </div>

            <div class="col-md-6 ">
              <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
            </div>

            <div class="col-12">
              <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
            </div>

            <div class="col-12">
              <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
            </div>

            <div class="col-12 text-center">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>

              <button type="submit">Send Message</button>
            </div>

          </div>
        </form>
      </div><!-- End Contact Form -->

    </div>

      <!-- Section Title -->
</section><!-- /Contact Section -->

<section id="contact" class="contact section">
  <div class="container section-title" data-aos="fade-up" style="margin=top:50px">
    <p>LOKASI</p>
    <h2>Sekertariat RW 12</h2>
  </div><!-- End Section Title -->
    <!-- Google Maps dengan jarak 100px -->
    <div class="mb-4" data-aos="fade-up" data-aos-delay="200">
      <iframe style="border:0; width: 100%; height: 400px;"
        src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d247.87170514462053!2d106.921437154233!3d-6.270663441211563!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwMTYnMTQuNiJTIDEwNsKwNTUnMTcuMCJF!5e0!3m2!1sen!2sid!4v1759504656659!5m2!1sen!2sid"
        frameborder="0" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div><!-- End Google Maps -->

  </div>

      <!-- Section Title -->
</section><!-- /Contact Section -->

@endsection

@extends('user-temp.footer')
