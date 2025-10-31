<?php

namespace App\Http\Controllers;

use App\Models\NewsModels;
use App\Models\K_NewsModels;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //for show home landing
    public function HomeLanding()
    {
        $berita = NewsModels::with('k_news')
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->get();

        // Ambil semua kategori berita
        $k_news = K_NewsModels::all();

        // Kirim ke view
        return view('landing', compact('berita', 'k_news'));
    }
}
