<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivitypkkModels;
use App\Models\ActivitykatarModels;

class GaleriController extends Controller
{
    public function galeri()
    {
        $pkkActivities = ActivitypkkModels::with('dokumentasi')
            ->where('status', 'published')
            ->orderBy('tanggal_acara', 'desc')
            ->get();

        $katarActivities = ActivitykatarModels::with('dokumentasi')
            ->where('status', 'published')
            ->orderBy('tanggal_acara', 'desc')
            ->get();

        return view('galeri', compact('pkkActivities', 'katarActivities'));
    }


    public function detailgaleri($id, $type)
    {
        if ($type === 'pkk') {
            $activity = ActivitypkkModels::with('dokumentasi')
                ->where('status', 'published')
                ->findOrFail($id);
        } elseif ($type === 'katar') {
            $activity = ActivitykatarModels::with('dokumentasi')
                ->where('status', 'published')
                ->findOrFail($id);
        } else {
            abort(404);
        }

        return view('detailgaleri', compact('activity', 'type'));
    }
}
