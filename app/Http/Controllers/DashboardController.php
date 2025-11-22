<?php

namespace App\Http\Controllers;

use App\Models\ActivitykatarModels;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\KatalogModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\InventariskatarModels;
use App\Models\JadwalkatarModels;
use App\Models\RiwayatinventarisModels;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            switch ($user->role) {
                case 'Ketua_RW':
                    return $this->dashboardKetuaRw();

                case 'Ketua_PKK':
                    return $this->dashboardKetuaPkk($request);

                case 'Ketua_Katar':
                    return $this->dashboardKetuaKatar();

                case 'Ketua_RT':
                    return view('rt/dashboard');

                default:
                    return redirect('/login');
            }
        }
        return redirect('/login');
    }

    protected function dashboardKetuaRw()
    {
        $dataPenduduk = $this->getStatistikPenduduk();
        $dataFasilitas = $this->getStatistikFasilitas();
        $dataLayanan = $this->getStatistikLayanan();
        $viewData = array_merge($dataPenduduk, $dataFasilitas, $dataLayanan);

        return view('ketua_rw/dashboard', $viewData);
    }

    // dashbord rw
    private function getStatistikPenduduk()
    {
        // --- Data Chart ---
        $ktpData = DB::table('ktp_rw12')->orderBy('rt')->get();
        $nonKtpData = DB::table('nonktp_rw12')->orderBy('rt')->get();

        $ktpLabels = $ktpData->pluck('rt');
        $ktpLaki = $ktpData->pluck('laki_laki');
        $ktpPerempuan = $ktpData->pluck('perempuan');

        $nonKtpLabels = $nonKtpData->pluck('rt');
        $nonKtpLaki = $nonKtpData->pluck('laki_laki');
        $nonKtpPerempuan = $nonKtpData->pluck('perempuan');

        // --- Data Total ---
        $jumlahTotalKtp = DB::table('ktp_rw12')->sum('jumlah');
        $jumlahTotalNonKtp = DB::table('nonktp_rw12')->sum('jumlah');
        $totalSeluruhPenduduk = $jumlahTotalKtp + $jumlahTotalNonKtp;

        // Mengembalikan data sebagai array
        return [
            'ktpLabels' => $ktpLabels,
            'ktpLaki' => $ktpLaki,
            'ktpPerempuan' => $ktpPerempuan,
            'nonKtpLabels' => $nonKtpLabels,
            'nonKtpLaki' => $nonKtpLaki,
            'nonKtpPerempuan' => $nonKtpPerempuan,
            'jumlahTotalKtp' => $jumlahTotalKtp,
            'jumlahTotalNonKtp' => $jumlahTotalNonKtp,
            'totalSeluruhPenduduk' => $totalSeluruhPenduduk,
        ];
    }

    private function getStatistikFasilitas()
    {
        $totalFacilities = DB::table('facilities')->count();
        return [
            'totalFacilities' => $totalFacilities,
        ];
    }
    private function getStatistikLayanan()
    {
        $totalServices = DB::table('layanan')->count();
        return [
            'totalServices' => $totalServices,
        ];
    }

    //dashboard pkk
    protected function dashboardKetuaPkk(Request $request)
    {
        $search_term = $request->query('search');
        $selected_categories = $request->query('kategori', []);
        $selected_range = $request->query('price_range');
        $sort_by = $request->query('sort', 'created_at_desc');

        $query = KatalogModels::query();

        if ($search_term) { // <-- PERBAIKAN 2: TAMBAHKAN BLOK IF INI
            $query->where('nama_produk', 'like', '%' . $search_term . '%');
        }

        $filtered_categories = array_filter($selected_categories, function ($value) {
            return $value !== null && $value !== '';
        });

        if (!empty($filtered_categories)) {
            $query->whereIn('kategori', $filtered_categories);
        }

        if ($selected_range) {
            $range = explode('-', $selected_range);
            if (count($range) == 2) {
                $query->whereBetween('harga', [$range[0], $range[1]]);
            }
        }

        switch ($sort_by) {
            case 'price_asc':
                $query->orderBy('harga', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('harga', 'desc');
                break;
            case 'created_at_desc':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $produks = $query->get();

        $all_categories = KatalogModels::pluck('kategori')->filter()->unique();
        $price_ranges = [
            ['value' => '0-49999', 'label' => 'Di bawah Rp 50.000'],
            ['value' => '50000-99999', 'label' => 'Rp 50.000 - Rp 99.999'],
            ['value' => '100000-249999', 'label' => 'Rp 100.000 - Rp 249.999'],
            ['value' => '250000-499999', 'label' => 'Rp 250.000 - Rp 499.999'],
            ['value' => '500000-99999999', 'label' => 'Di atas Rp 500.000'],
        ];

        return view('pkk.dashboard', [
            'produks' => $produks,
            'all_categories' => $all_categories,
            'price_ranges' => $price_ranges,
            'current_categories' => $selected_categories,
            'current_price_range' => $selected_range,
            'current_sort' => $sort_by,
            'current_search' => $search_term // <-- PERBAIKAN 3: TAMBAHKAN BARIS INI
        ]);
    }


    //dashboard katar
    protected function dashboardKetuaKatar()
    {
        $inventarisTerbaru = InventariskatarModels::with('riwayatTerakhir')
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get();

        $riwayatTerbaru = RiwayatinventarisModels::with('inventaris')
            ->orderBy('tanggal_transaksi', 'desc')
            ->take(5)
            ->get();

        $totalJenisInventaris = InventariskatarModels::count();
        $totalAktivitas = ActivityKatarModels::where('status', 'Published')->count();
        $totalJadwal = JadwalkatarModels::count();


        // DATA CHART MINGGUAN (7 Hari Terakhir) ---
        $mingguanStartDate = Carbon::now()->subDays(6)->startOfDay();
        $mingguanEndDate = Carbon::now()->endOfDay();

        $transaksiMingguan = RiwayatinventarisModels::whereBetween('tanggal_transaksi', [$mingguanStartDate, $mingguanEndDate])
            ->select(
                DB::raw('DATE(tanggal_transaksi) as tanggal'),
                DB::raw("SUM(CASE WHEN tipe_transaksi = 'Masuk' THEN jumlah ELSE 0 END) as total_masuk"),
                DB::raw("SUM(CASE WHEN tipe_transaksi = 'Keluar' THEN jumlah ELSE 0 END) as total_keluar")
            )
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get()->keyBy(fn($item) => Carbon::parse($item->tanggal)->format('Y-m-d'));

        $chartMingguanLabels = [];
        $chartMingguanDataMasuk = [];
        $chartMingguanDataKeluar = [];
        $totalMingguIni = 0;

        for ($i = 0; $i < 7; $i++) {
            $day = $mingguanStartDate->copy()->addDays($i);
            $dayString = $day->format('Y-m-d');
            $chartMingguanLabels[] = $day->format('D'); // 'Sun', 'Mon', ...

            if ($transaksiMingguan->has($dayString)) {
                $dataHariIni = $transaksiMingguan->get($dayString);
                $masuk = (int) $dataHariIni->total_masuk;
                $keluar = (int) $dataHariIni->total_keluar;
            } else {
                $masuk = 0;
                $keluar = 0;
            }
            $chartMingguanDataMasuk[] = $masuk;
            $chartMingguanDataKeluar[] = $keluar;
            $totalMingguIni += $masuk + $keluar;
        }


        // LOGIKA BARU: DATA CHART BULANAN (Bulan Ini) ---
        $bulananStartDate = Carbon::now()->startOfMonth();
        $bulananEndDate = Carbon::now()->endOfMonth();
        $daysInMonth = $bulananEndDate->day; // Jumlah hari di bulan ini

        $transaksiBulanan = RiwayatinventarisModels::whereBetween('tanggal_transaksi', [$bulananStartDate, $bulananEndDate])
            ->select(
                DB::raw('DATE(tanggal_transaksi) as tanggal'),
                DB::raw("SUM(CASE WHEN tipe_transaksi = 'Masuk' THEN jumlah ELSE 0 END) as total_masuk"),
                DB::raw("SUM(CASE WHEN tipe_transaksi = 'Keluar' THEN jumlah ELSE 0 END) as total_keluar")
            )
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get()->keyBy(fn($item) => Carbon::parse($item->tanggal)->format('Y-m-d'));

        $chartBulananLabels = [];
        $chartBulananDataMasuk = [];
        $chartBulananDataKeluar = [];

        for ($i = 0; $i < $daysInMonth; $i++) {
            $day = $bulananStartDate->copy()->addDays($i);
            $dayString = $day->format('Y-m-d');
            $chartBulananLabels[] = $day->format('d'); // '01', '02', ...

            if ($transaksiBulanan->has($dayString)) {
                $dataHariIni = $transaksiBulanan->get($dayString);
                $chartBulananDataMasuk[] = (int) $dataHariIni->total_masuk;
                $chartBulananDataKeluar[] = (int) $dataHariIni->total_keluar;
            } else {
                $chartBulananDataMasuk[] = 0;
                $chartBulananDataKeluar[] = 0;
            }
        }


        // Mengirim SEMUA data ke view ---
        return view('katar/dashboard', [
            // Data Tabel & History
            'inventarisTerbaru' => $inventarisTerbaru,
            'riwayatTerbaru'    => $riwayatTerbaru,

            // Data Kartu
            'totalJenisInventaris' => $totalJenisInventaris,
            'totalAktivitas'       => $totalAktivitas,
            'totalJadwal'          => $totalJadwal,

            // Data Chart Mingguan
            'totalMingguIni'           => $totalMingguIni,
            'chartMingguanLabels'      => $chartMingguanLabels,
            'chartMingguanDataMasuk'   => $chartMingguanDataMasuk,
            'chartMingguanDataKeluar'  => $chartMingguanDataKeluar,

            // Data Chart Bulanan (BARU)
            'chartBulananLabels'      => $chartBulananLabels,
            'chartBulananDataMasuk'   => $chartBulananDataMasuk,
            'chartBulananDataKeluar'  => $chartBulananDataKeluar,
        ]);
    }
}
