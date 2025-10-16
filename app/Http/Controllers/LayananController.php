<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LayananController extends Controller
{
    //for show home landing
    public function detaillayanan()
    {
        return view('/detaillayanan');
    }


     //for show home landing
    public function layanan()
    {
        return view('/layanan');
    }
}
