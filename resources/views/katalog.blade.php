@extends('user-temp.head')

@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Katalog PKK</h1>
                        <p class="mb-0">Produk UMKM RW 12</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="/landing">Home</a></li>
                    <li class="current">Informasi</li>
                    <li class="current">Katalog PKK</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->


    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">
        <div class="container">

            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                    <li data-filter="*" class="filter-active">All</li>
                    @foreach ($kategori as $kat)
                        <li data-filter=".filter-{{ Str::slug($kat, '-') }}">{{ $kat }}</li>
                    @endforeach
                </ul>

                <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                    @foreach ($katalog as $item)
                        <div
                            class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ Str::slug($item->kategori, '-') }}">
                            <div class="portfolio-content h-100">
                                <img src="{{ asset('storage/' . $item->foto) }}" class="img-fluid"
                                    alt="{{ $item->nama_produk }}"
                                    style="width:100%; height:250px; object-fit:cover; border-radius:10px;">

                                <div class="portfolio-info">
                                    <h4>{{ $item->nama_produk }}</h4>
                                    <p>{{ Str::limit($item->deskripsi, 80) }}</p>

                                    <a href="{{ asset('storage/' . $item->foto) }}" title="{{ $item->nama_produk }}"
                                        data-gallery="portfolio-gallery-{{ Str::slug($item->kategori, '-') }}"
                                        class="glightbox preview-link">
                                        <i class="bi bi-zoom-in"></i>
                                    </a>

                                    <a href="{{ url('/detail_katalog/' . $item->id) }}" title="More Details"
                                        class="details-link">
                                        <i class="bi bi-link-45deg"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div><!-- End Portfolio Container -->


            </div>

        </div>

    </section><!-- /Portfolio Section -->
@endsection

@extends('user-temp.footer')
