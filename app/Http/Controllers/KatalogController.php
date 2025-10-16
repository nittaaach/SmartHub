<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KatalogController extends Controller
{
    //for show home landing
    public function katalog()
    {
        return view('/katalog');
    }

    public function detail_katalog()
    {
        return view('/detail_katalog');
    }
}
