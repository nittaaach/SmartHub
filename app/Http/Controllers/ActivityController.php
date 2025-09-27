<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('role')->only('load'); // atau ->except(...) atau langsung di route
    // }

    public function activity_RW()
    {
        return view('/ketua_rw/activity');
    }
}
