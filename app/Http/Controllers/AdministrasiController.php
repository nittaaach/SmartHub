<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LayananModels;
use App\Models\SyaratLayananModels;
use App\Models\TemplateSuratModels;

class AdministrasiController extends Controller
{
    public function tampilLayanan()
    {
        // Ambil semua layanan
        $layanan = LayananModels::all();

        // Ambil semua syarat dan template (buat referensi di view)
        $syarat_layanan = SyaratLayananModels::all();
        $template_surat = TemplateSuratModels::all();

        return view('administrasi', compact('layanan', 'syarat_layanan', 'template_surat'));
    }
}
