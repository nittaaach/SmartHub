<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivitypkkModels;

class GaleriController extends Controller
{
    public function galeri()
    {
        // Ambil semua data aktivitas dengan relasi dokumentasi (jika ada)
        $activities = ActivitypkkModels::with('dokumentasi')
            ->where('status', 'published')
            ->orderBy('tanggal_acara', 'desc')
            ->get();


        // Kirim data ke view
        return view('galeri', compact('activities'));
    }


    public function detailgaleri($id)
    {
        // Ambil satu data aktivitas berdasarkan ID, beserta relasi dokumentasinya
        $activity = ActivitypkkModels::with('dokumentasi')
            ->where('status', 'published')
            ->findOrFail($id);


        // Kirim data ke view
        return view('detailgaleri', compact('activity'));
    }
}
