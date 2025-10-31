@extends('user-temp.head')

@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>News Details</h1>
                        <p class="mb-0">
                            Informasi Terkini
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="/landing">Home</a></li>
                    <li class="current">Blog Details</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Blog Details Section -->
                <section id="blog-details" class="blog-details section">
                    <div class="container">
                        <article class="article">
                            <!-- Gambar utama -->
                            <div class="post-img">
                                @if ($news->gambar)
                                    <img src="{{ asset('storage/' . $news->gambar) }}" alt="{{ $news->title }}"
                                        class="img-fluid">
                                @else
                                    <img src="{{ asset('assets-user/img/blog/blog-1.jpg') }}" alt="default"
                                        class="img-fluid">
                                @endif
                            </div>

                            <h2 class="title mt-3">{{ $news->title }}</h2>

                            <div class="meta-top">
                                <ul>
                                    <li class="d-flex align-items-center">
                                        <i class="bi bi-person"></i>
                                        <span class="ps-2">{{ $news->user->datadiri->name ?? 'Tidak diketahui' }}</span>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <i class="bi bi-clock"></i>
                                        <time datetime="{{ $news->published_at }}">
                                            {{ $news->published_at ? \Carbon\Carbon::parse($news->published_at)->format('d M Y') : '-' }}
                                        </time>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <i class="bi bi-folder2"></i>
                                        @if ($news->k_news)
                                            <span>{{ $news->k_news->kategori_news }}</span>
                                        @else
                                            <span>Tidak ada kategori</span>
                                        @endif
                                    </li>
                                </ul>
                            </div><!-- End meta top -->
                            <div class="content mt-4">
                                {!! nl2br(e($news->content)) !!}
                            </div>
                        </article>
                    </div>
                </section><!-- /Blog Details Section -->
            </div>

            <div class="col-lg-4 sidebar">
                <div class="widgets-container">
                    <!-- Search Widget -->
                    <div class="search-widget widget-item">
                        <h3 class="widget-title">Search</h3>
                        <form action="">
                            <input type="text">
                            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                        </form>
                    </div><!--/Search Widget -->

                    <!-- Categories Widget -->
                    <div class="categories-widget widget-item">
                        <h3 class="widget-title">Kategori</h3>
                        <ul class="mt-3">
                            @if ($k_news->isNotEmpty())
                                @foreach ($k_news as $kategori)
                                    <li><a href=""></a>{{ $kategori->kategori_news }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div><!--/Categories Widget -->

                    <!-- Recent Posts Widget -->
                    <div class="recent-posts-widget widget-item">
                        <h3 class="widget-title">Berita Terbaru</h3>
                        @foreach ($recentPosts as $recent)
                            <div class="post-item d-flex mb-3">
                                @if ($recent->gambar)
                                    <img src="{{ asset('storage/' . $recent->gambar) }}" alt="{{ $recent->title }}"
                                        class="shrink-0 me-3" style="width:80px; height:80px; object-fit:cover;">
                                @else
                                    <img src="{{ asset('assets-user/img/blog/blog-recent-1.jpg') }}" alt="default"
                                        class="shrink-0 me-3" style="width:80px; height:80px; object-fit:cover;">
                                @endif
                                <div>
                                    <h4 style="font-size:15px; margin-bottom:4px;">
                                        <a
                                            href="{{ url('/news_detail/' . $recent->id) }}">{{ Str::limit($recent->title, 50) }}</a>
                                    </h4>
                                    <time datetime="{{ $recent->published_at }}">
                                        {{ $recent->published_at ? \Carbon\Carbon::parse($recent->published_at)->format('d M Y') : '-' }}
                                    </time>
                                </div>
                            </div><!-- End recent post item-->
                        @endforeach
                    </div><!--/Recent Posts Widget -->

                    <!-- Tags Widget -->
                    <div class="tags-widget widget-item">

                        <h3 class="widget-title">Tags</h3>
                        <ul>
                            <li><a href="">
                                    @if ($news->k_news)
                                        <span>{{ $news->k_news->kategori_news }}</span>
                                    @else
                                        <span>Tidak ada kategori</span>
                                    @endif
                                </a></li>
                        </ul>
                    </div><!--/Tags Widget -->
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('user-temp.footer')
