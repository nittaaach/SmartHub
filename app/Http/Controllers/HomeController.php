<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //for show home landing
    public function HomeLanding()
    {
        return view('/landing');
    }
    
}
