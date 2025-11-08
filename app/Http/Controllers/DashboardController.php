<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user) {
            switch ($user->role) {
                case 'Ketua_RW':
                    // Memanggil fungsi 'manager' untuk dashboard RW
                    return $this->dashboardKetuaRw();

                case 'Ketua_PKK':
                    return view('pkk/dashboard');

                case 'Ketua_Katar':
                    return view('katar/dashboard');

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
}
