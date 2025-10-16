<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    //for show news
    public function userView()
    {
        return view('/news');
    }

    public function newsDetail()
    {
        return view('/news_detail');
    }


    public function news_RW()
    {
        return view('/ketua_rw/news');
    }

    public function news()
    {
        return view('/news');
    }

    public function pengumuman()
    {
        return view('/pengumuman');
    }

    public function aktivitas()
    {
        return view('/aktivitas');
    }
}
