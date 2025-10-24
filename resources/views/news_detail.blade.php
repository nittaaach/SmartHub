@extends('user-temp.head')

@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
<<<<<<< HEAD
                        <h1>Berita</h1>
                        <p class="mb-0">
                            Informasi Terkini
                        </p>
=======
                        <h1>News Details</h1>
                        <p class="mb-0">Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint
                            voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores.
                            Quasi
                            ratione sint. Sit quaerat ipsum dolorem.</p>
>>>>>>> origin/main
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

<<<<<<< HEAD
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

                            <!-- Konten berita -->
                            <div class="content mt-4">
                                {!! nl2br(e($news->content)) !!}
                            </div>
                        </article>
                    </div>
                </section><!-- /Blog Details Section -->
            </div>

            <!-- Sidebar kanan -->
            <div class="col-lg-4 sidebar">
                <div class="widgets-container">

                    <!-- Search Widget -->
                    <div class="search-widget widget-item">
                        <h3 class="widget-title">Search</h3>
                        <form action="{{ url('/news') }}" method="GET">
                            <input type="text" name="q" placeholder="Cari berita...">
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
                    </div>{{-- <!--/Categories Widget --> --}}

                    <!-- Recent Posts Widget -->
                    <div class="recent-posts-widget widget-item">
                        <h3 class="widget-title">Berita Terbaru</h3>

                        @foreach ($recentPosts as $recent)
                            <div class="post-item d-flex mb-3">
                                @if ($recent->gambar)
                                    <img src="{{ asset('storage/' . $recent->gambar) }}" alt="{{ $recent->title }}"
                                        class="flex-shrink-0 me-3" style="width:80px; height:80px; object-fit:cover;">
                                @else
                                    <img src="{{ asset('assets-user/img/blog/blog-recent-1.jpg') }}" alt="default"
                                        class="flex-shrink-0 me-3" style="width:80px; height:80px; object-fit:cover;">
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
=======
    @foreach ($news as $item)
        <div class="container">
            <div class="row">

                <div class="col-lg-8">

                    <!-- Blog Details Section -->
                    <section id="blog-details" class="blog-details section">
                        <div class="container">

                            <article class="article">

                                <div class="post-img">
                                    <img src="assets-user/img/blog/blog-1.jpg" alt="" class="img-fluid">
                                </div>

                                <h2 class="title">
                                </h2>

                                <div class="meta-top">
                                    <ul>
                                        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                                href="blog-details.html">John Doe</a></li>
                                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                                href="blog-details.html"><time datetime="2020-01-01">Jan 1, 2022</time></a>
                                        </li>
                                        <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a
                                                href="blog-details.html">12 Comments</a></li>
                                    </ul>
                                </div><!-- End meta top -->

                                <div class="content">
                                    <p>
                                        Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi
                                        praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta.
                                        Et eveniet enim. Qui velit est ea dolorem doloremque deleniti aperiam unde soluta.
                                        Est
                                        cum et quod quos aut ut et sit sunt. Voluptate porro consequatur assumenda
                                        perferendis
                                        dolore.
                                    </p>

                                    <p>
                                        Sit repellat hic cupiditate hic ut nemo. Quis nihil sunt non reiciendis. Sequi in
                                        accusamus harum vel aspernatur. Excepturi numquam nihil cumque odio. Et voluptate
                                        cupiditate.
                                    </p>

                                    <blockquote>
                                        <p>
                                            Et vero doloremque tempore voluptatem ratione vel aut. Deleniti sunt animi aut.
                                            Aut
                                            eos aliquam doloribus minus autem quos.
                                        </p>
                                    </blockquote>

                                    <p>
                                        Sed quo laboriosam qui architecto. Occaecati repellendus omnis dicta inventore
                                        tempore
                                        provident voluptas mollitia aliquid. Id repellendus quia. Asperiores nihil magni
                                        dicta
                                        est suscipit perspiciatis. Voluptate ex rerum assumenda dolores nihil quaerat.
                                        Dolor porro tempora et quibusdam voluptas. Beatae aut at ad qui tempore corrupti
                                        velit
                                        quisquam rerum. Omnis dolorum exercitationem harum qui qui blanditiis neque.
                                        Iusto autem itaque. Repudiandae hic quae aspernatur ea neque qui. Architecto
                                        voluptatem
                                        magni. Vel magnam quod et tempora deleniti error rerum nihil tempora.
                                    </p>

                                    <h3>Et quae iure vel ut odit alias.</h3>
                                    <p>
                                        Officiis animi maxime nulla quo et harum eum quis a. Sit hic in qui quos fugit ut
                                        rerum
                                        atque. Optio provident dolores atque voluptatem rem excepturi molestiae qui.
                                        Voluptatem
                                        laborum omnis ullam quibusdam perspiciatis nulla nostrum. Voluptatum est libero eum
                                        nesciunt aliquid qui.
                                        Quia et suscipit non sequi. Maxime sed odit. Beatae nesciunt nesciunt accusamus quia
                                        aut
                                        ratione aspernatur dolor. Sint harum eveniet dicta exercitationem minima.
                                        Exercitationem
                                        omnis asperiores natus aperiam dolor consequatur id ex sed. Quibusdam rerum dolores
                                        sint
                                        consequatur quidem ea.
                                        Beatae minima sunt libero soluta sapiente in rem assumenda. Et qui odit voluptatem.
                                        Cum
                                        quibusdam voluptatem voluptatem accusamus mollitia aut atque aut.
                                    </p>
                                    <img src="assets-user/img/blog/blog-inside-post.jpg" class="img-fluid" alt="">

                                    <h3>Ut repellat blanditiis est dolore sunt dolorum quae.</h3>
                                    <p>
                                        Rerum ea est assumenda pariatur quasi et quam. Facilis nam porro amet nostrum. In
                                        assumenda quia quae a id praesentium. Quos deleniti libero sed occaecati aut porro
                                        autem. Consectetur sed excepturi sint non placeat quia repellat incidunt labore.
                                        Autem
                                        facilis hic dolorum dolores vel.
                                        Consectetur quasi id et optio praesentium aut asperiores eaque aut. Explicabo omnis
                                        quibusdam esse. Ex libero illum iusto totam et ut aut blanditiis. Veritatis numquam
                                        ut
                                        illum ut a quam vitae.
                                    </p>
                                    <p>
                                        Alias quia non aliquid. Eos et ea velit. Voluptatem maxime enim omnis ipsa voluptas
                                        incidunt. Nulla sit eaque mollitia nisi asperiores est veniam.
                                    </p>

                                </div><!-- End post content -->

                                <div class="meta-bottom">
                                    <i class="bi bi-folder"></i>
                                    <ul class="cats">
                                        <li><a href="#">Business</a></li>
                                    </ul>

                                    <i class="bi bi-tags"></i>
                                    <ul class="tags">
                                        <li><a href="#">Creative</a></li>
                                        <li><a href="#">Tips</a></li>
                                        <li><a href="#">Marketing</a></li>
                                    </ul>
                                </div><!-- End meta bottom -->

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

                            <h3 class="widget-title">Categories</h3>
                            <ul class="mt-3">
                                <li><a href="#">General <span>(25)</span></a></li>
                                <li><a href="#">Lifestyle <span>(12)</span></a></li>
                                <li><a href="#">Travel <span>(5)</span></a></li>
                                <li><a href="#">Design <span>(22)</span></a></li>
                                <li><a href="#">Creative <span>(8)</span></a></li>
                                <li><a href="#">Educaion <span>(14)</span></a></li>
                            </ul>

                        </div><!--/Categories Widget -->

                        <!-- Recent Posts Widget -->
                        <div class="recent-posts-widget widget-item">

                            <h3 class="widget-title">Recent Posts</h3>

                            <div class="post-item">
                                <img src="assets-user/img/blog/blog-recent-1.jpg" alt="" class="shrink-0">
                                <div>
                                    <h4><a href="blog-details.html">Nihil blanditiis at in nihil autem</a></h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>
                            </div><!-- End recent post item-->

                            <div class="post-item">
                                <img src="assets-user/img/blog/blog-recent-2.jpg" alt="" class="shrink-0">
                                <div>
                                    <h4><a href="blog-details.html">Quidem autem et impedit</a></h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>
                            </div><!-- End recent post item-->

                            <div class="post-item">
                                <img src="assets-user/img/blog/blog-recent-3.jpg" alt="" class="shrink-0">
                                <div>
                                    <h4><a href="blog-details.html">Id quia et et ut maxime similique occaecati ut</a></h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>
                            </div><!-- End recent post item-->

                            <div class="post-item">
                                <img src="assets-user/img/blog/blog-recent-4.jpg" alt="" class="shrink-0">
                                <div>
                                    <h4><a href="blog-details.html">Laborum corporis quo dara net para</a></h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>
                            </div><!-- End recent post item-->

                            <div class="post-item">
                                <img src="assets-user/img/blog/blog-recent-5.jpg" alt="" class="shrink-0">
                                <div>
                                    <h4><a href="blog-details.html">Et dolores corrupti quae illo quod dolor</a></h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>
                            </div><!-- End recent post item-->

                        </div><!--/Recent Posts Widget -->

                        <!-- Tags Widget -->
                        <div class="tags-widget widget-item">

                            <h3 class="widget-title">Tags</h3>
                            <ul>
                                <li><a href="#">App</a></li>
                                <li><a href="#">IT</a></li>
                                <li><a href="#">Business</a></li>
                                <li><a href="#">Mac</a></li>
                                <li><a href="#">Design</a></li>
                                <li><a href="#">Office</a></li>
                                <li><a href="#">Creative</a></li>
                                <li><a href="#">Studio</a></li>
                                <li><a href="#">Smart</a></li>
                                <li><a href="#">Tips</a></li>
                                <li><a href="#">Marketing</a></li>
                            </ul>

                        </div><!--/Tags Widget -->

                    </div>
>>>>>>> origin/main


                </div>
            </div>
        </div>
<<<<<<< HEAD
    </div>
    </section><!-- /Recent Posts Section -->
=======
    @endforeach
>>>>>>> origin/main
@endsection
@extends('user-temp.footer')
