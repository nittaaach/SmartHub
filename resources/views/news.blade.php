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

                                <div class="post-img position-relative overflow-hidden" style="height: 300px;">
                                    <img src="{{ asset('storage/' . $item->gambar) }}" class="img-fluid"
                                        style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $item->title }}">
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
                                                @if ($item->kategori && $item->kategori->count() > 0)
                                                    {{ $item->kategori->pluck('kategori_news')->implode(', ') }}
                                                @else
                                                    Tidak ada kategori
                                                @endif
                                            </span>
                                        </div>
                                    </div>

                                    <hr>
                                    @if (!empty($item->slug))
                                        {{-- Jika ada link eksternal, arahkan ke sana (buka di tab baru) --}}
                                        <a href="{{ $item->slug }}" class="readmore stretched-link" target="_blank"
                                            rel="noopener noreferrer">
                                            <span>Read More</span><i class="bi bi-arrow-right"></i>
                                        </a>
                                    @else
                                        {{-- Jika tidak ada, arahkan ke halaman detail internal --}}
                                        <a href="{{ url('/news_detail/') }}" class="readmore stretched-link">
                                            <span>Read More</span><i class="bi bi-arrow-right"></i>
                                        </a>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section><!-- /Recent Posts Section -->
@endsection

@extends('user-temp.footer')
