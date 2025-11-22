@extends('admin-temp.layout_katar')
@section('content_admin')
    <!-- [ Main Content ] start -->
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Home</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="ketua_rw/dashboard">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Home</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-4">
                <div class="card bg-success text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">{{ number_format($totalJadwal ?? 0) }}</h2>
                        <p class="text-white mb-0">Schedule Total</p>
                        <i class="ti ti-clipboard-list f-46 text-white"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-primary text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">{{ number_format($totalAktivitas ?? 0) }}</h2>
                        <p class="text-white mb-0">Total Publikasi</p>
                        <i class="ti ti-camera d-block f-46 text-white"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-danger text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">{{ number_format($totalJenisInventaris ?? 0) }}</h2>
                        <p class="text-white mb-0">Total Jenis Inventaris</p>
                        <i class="ti ti-folders d-block f-46 text-white"></i>
                    </div>
                </div>
            </div>


            <div class="col-md-12 col-xl-12">
                <h5 class="mb-3">Inventaris Terbaru</h5>
                <div class="card tbl-card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless mb-0">
                                <thead>
                                    <tr>
                                        <th>NAMA BARANG</th>
                                        <th>KATEGORI</th>
                                        <th>KODE BARANG</th>
                                        <th>KONDISI</th>
                                        <th>STOCK SAAT INI</th>
                                        <th>ACTIVITAS TERAKHIR</th>
                                        <th>PENANGGUNG JAWAB</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($inventarisTerbaru as $item)
                                        <tr>
                                            <td>{{ $item->nama_barang }}</td>
                                            <td>{{ $item->kategori }}</td>
                                            <td>{{ $item->kode_barang }}</td>
                                            <td>{{ $item->kondisi }}</td>
                                            <td>
                                                <strong>{{ $item->stok_akhir ?? 0 }}</strong> {{ $item->satuan }}
                                            </td>
                                            <td>
                                                @if ($item->riwayatTerakhir)
                                                    @if ($item->riwayatTerakhir->tipe_transaksi == 'Masuk')
                                                        <span class="d-flex align-items-center gap-2">
                                                            <i class="fas fa-circle text-success f-10 m-r-5"></i>
                                                            Masuk ({{ $item->riwayatTerakhir->jumlah }})
                                                        </span>
                                                    @else
                                                        <span class="d-flex align-items-center gap-2">
                                                            <i class="fas fa-circle text-danger f-10 m-r-5"></i>
                                                            Keluar ({{ $item->riwayatTerakhir->jumlah }})
                                                        </span>
                                                    @endif
                                                    <small class="d-block">{{ $item->riwayatTerakhir->keterangan }}</small>
                                                @else
                                                    <span class="d-flex align-items-center gap-2">
                                                        <i class="fas fa-circle text-warning f-10 m-r-5"></i>
                                                        Belum ada aktivitas
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $item->riwayatTerakhir?->penanggung_jawab ?? 'N/A' }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                Belum ada data inventaris.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-xl-8">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="mb-0">Statistics Inventory</h5>
                    <ul class="nav nav-pills justify-content-end mb-0" id="chart-tab-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="chart-tab-home-tab" data-bs-toggle="pill"
                                data-bs-target="#chart-tab-home" type="button" role="tab"
                                aria-controls="chart-tab-home" aria-selected="true">Month</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="chart-tab-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#chart-tab-profile" type="button" role="tab"
                                aria-controls="chart-tab-profile" aria-selected="false">Week</button>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content" id="chart-tab-tabContent">
                            <div class="tab-pane" id="chart-tab-home" role="tabpanel" aria-labelledby="chart-tab-home-tab"
                                tabindex="0">
                                <div id="visitor-chart-1"></div>
                            </div>
                            <div class="tab-pane show active" id="chart-tab-profile" role="tabpanel"
                                aria-labelledby="chart-tab-profile-tab" tabindex="0">
                                <div id="visitor-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-xl-4">
                <h5 class="mb-3">Transaction History</h5>
                <div class="card">
                    <div class="list-group list-group-flush">

                        @forelse ($riwayatTerbaru as $riwayat)
                            @php
                                // Logika untuk ikon dan warna (masih sama)
                                $iconClass = 'ti ti-help';
                                $bgClass = 'bg-light-secondary';
                                $textClass = 'text-secondary';
                                $prefix = '';

                                if ($riwayat->tipe_transaksi == 'Masuk') {
                                    $iconClass = 'ti ti-file-plus';
                                    $bgClass = 'bg-light-success';
                                    $textClass = 'text-success';
                                    $prefix = '+ ';
                                } elseif ($riwayat->tipe_transaksi == 'Keluar') {
                                    $iconClass = 'ti ti-file-minus';
                                    $bgClass = 'bg-light-danger';
                                    $textClass = 'text-danger';
                                    $prefix = '- ';
                                } elseif ($riwayat->tipe_transaksi == 'Penyesuaian') {
                                    $iconClass = 'ti ti-file-off';
                                    $bgClass = 'bg-light-primary';
                                    $textClass = 'text-primary';
                                    $prefix = '± ';
                                }
                            @endphp

                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex">
                                    <div class="shrink-0">
                                        <div class="avtar avtar-s rounded-circle {{ $bgClass }}">
                                            <i class="{{ $iconClass }} f-18"></i>
                                        </div>
                                    </div>
                                    <div class="grow ms-3">
                                        <h5 class="mb-1">
                                            <span class="{{ $textClass }}">
                                                {{ $prefix }}{{ $riwayat->jumlah }}
                                            </span>
                                            {{ $riwayat->inventaris?->nama_barang ?? 'Barang Dihapus' }}
                                            ({{ $riwayat->penanggung_jawab }})
                                        </h5>

                                        <p class="mb-0 text-muted fs-6">
                                            {{ $riwayat->tanggal_transaksi->format('d M Y, H:i') }}
                                        </p>
                                    </div>
                                </div>
                            </a>

                        @empty
                            <div class="list-group-item">
                                <p class="text-muted text-center mb-0">Belum ada riwayat transaksi.</p>
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection

@push('scripts')
    <script>
        if (typeof ApexCharts !== 'undefined') {

            // --- AMBIL SEMUA DATA DARI CONTROLLER ---
            var weekLabels = {!! json_encode($chartMingguanLabels) !!};
            var weekDataMasuk = {!! json_encode($chartMingguanDataMasuk) !!};
            var weekDataKeluar = {!! json_encode($chartMingguanDataKeluar) !!};

            var monthLabels = {!! json_encode($chartBulananLabels) !!};
            var monthDataMasuk = {!! json_encode($chartBulananDataMasuk) !!};
            var monthDataKeluar = {!! json_encode($chartBulananDataKeluar) !!};

            // --- OPSI CHART DEFAULT (Bisa dipakai ulang) ---
            var chartOptions = {
                chart: {
                    type: 'area',
                    height: 250,
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                colors: ['#00E396', '#FF4560'], // Hijau (Masuk), Merah (Keluar)
                yaxis: {
                    title: {
                        text: 'Jumlah Item'
                    }
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right'
                }
            };

            // --- 1. RENDER CHART MINGGUAN (Default Aktif) ---
            var weekChartOptions = {
                ...chartOptions, // Salin opsi default
                series: [{
                        name: 'Barang Masuk',
                        data: weekDataMasuk
                    },
                    {
                        name: 'Barang Keluar',
                        data: weekDataKeluar
                    }
                ],
                xaxis: {
                    categories: weekLabels
                }
            };

            var weekChart = new ApexCharts(document.querySelector("#visitor-chart"), weekChartOptions);
            weekChart.render();

            // --- 2. RENDER CHART BULANAN (Saat Tab Diklik) ---
            var monthChart = null; // Variabel untuk menyimpan chart bulanan
            var monthTab = document.querySelector('#chart-tab-home-tab'); // Tombol tab 'Month'

            // Dengarkan event 'shown.bs.tab' (event dari Bootstrap saat tab ditampilkan)
            monthTab.addEventListener('shown.bs.tab', function(event) {

                // Cek agar chart tidak di-render ulang setiap kali diklik
                if (monthChart === null) {
                    var monthChartOptions = {
                        ...chartOptions, // Salin opsi default
                        series: [{
                                name: 'Barang Masuk',
                                data: monthDataMasuk
                            },
                            {
                                name: 'Barang Keluar',
                                data: monthDataKeluar
                            }
                        ],
                        xaxis: {
                            categories: monthLabels,
                            tickAmount: 5 // Batasi jumlah label di sumbu X agar tidak numpuk
                        },
                        tooltip: {
                            x: {
                                format: 'dd'
                            }
                        } // Tooltip untuk harian
                    };

                    // Targetkan div '#visitor-chart-1'
                    monthChart = new ApexCharts(document.querySelector("#visitor-chart-1"), monthChartOptions);
                    monthChart.render();
                }
            });

        } else {
            console.error("ApexCharts library is not loaded.");
        }
    </script>
@endpush
