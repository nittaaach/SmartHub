@extends('user-temp.head')
@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Berita</h1>
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
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Recent Posts Section -->
    <section id="recent-posts" class="recent-posts section">
        <div class="container">

            <div class="row gy-5">

                <div class="row gy-4 posts-list">
                    @foreach ($news as $item)
                        <div class="col-xl-4 col-md-6">
                            <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">

                                <div class="post-img position-relative overflow-hidden" style="height: 250px;">
                                    <img src="{{ asset('storage/' . $item->gambar) }} " style="object-fit: cover;"class="img-fluid"
                                        alt="{{ $item->title }}">
                                    <span
                                        class="post-date">{{ \Carbon\Carbon::parse($item->published_at)->format('F d, Y') }}</span>
                                </div>

                                <div class="post-content d-flex flex-column">
                                    <h3 class="post-title">{{ $item->title }}</h3>

                                    <div class="meta d-flex align-items-center">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-person"></i>
                                            <span class="ps-2">{{ $item->user->datadiri->name ?? '-' }}</span>
                                        </div>
                                        <span class="px-3 text-black-50">/</span>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-folder2"></i>
                                            <span class="ps-2">
                                                {{ $item->k_news->kategori_news ?? 'Tidak ada kategori' }}
                                            </span>
                                        </div>
                                    </div>

                                    <hr>
                                    <a href="{{ url('/news_detail/' . $item->id) }}" class="readmore stretched-link">
                                        <span>Read More</span><i class="bi bi-arrow-right"></i>
                                    </a>

                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>



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

                            <a href="/news_detail" class="readmore stretched-link"><span>Read More</span><i
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

                            <a href="/news_detail" class="readmore stretched-link"><span>Read More</span><i
                                    class="bi bi-arrow-right"></i></a>

                        </div>

                    </div>
                </div><!-- End post item -->

            </div>

        </div>

    </section><!-- /Recent Posts Section -->
@endsection
@extends('user-temp.footer')
