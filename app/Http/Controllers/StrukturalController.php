<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StrukturalController extends Controller
{
    //view
    public function struktural()
    {
        return view('/struktural');
    }

    public function rw()
    {
        return view('/rw');
    }

    public function katar()
    {
        return view('/katar');
    }

    public function pkk()
    {
        return view('/pkk');
    }

    
}
