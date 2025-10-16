<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministrasiController extends Controller
{
    //for show administrator
    public function administrasi()
    {
        return view('/administrasi');
    }
}
