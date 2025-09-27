<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DashboardController;

//route for home
Route::get('/', function () {
    return view('landing');
});
Route::get('/landing', [HomeController::class, 'HomeLanding'])->name('landing');

//Route middleware for sidebar
Route::middleware(['auth'])->group(function () {
    Route::get('/ketua_rw/news', [NewsController::class, 'news_RW'])->name('ketua_rw.news');
    Route::get('/ketua_rw/activity', [ActivityController::class, 'activity_RW'])->name('ketua_rw.activity');
    // // Rute untuk Icons
    // Route::get('/ui/icons', [UIController::class, 'icons'])->name('ui.icons');
});

//route for auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['auth', 'role:ketua_rw'])->group(function () {
    Route::get('/ketua_rw/dashboard', [DashboardController::class, 'index'])->name('ketua_rw.dashboard');
});
Route::middleware(['auth', 'role:pkk'])->group(function () {
    Route::get('/pkk/dashboard', [DashboardController::class, 'index'])->name('pkk.dashboard');
});
Route::middleware(['auth', 'role:katar'])->group(function () {
    Route::get('/katar/dashboard', [DashboardController::class, 'index'])->name('katar.dashboard');
});

// Route::get('/rw/dashboard', function () {
//     return view('rw/dashboard');
// })->middleware('auth');

//route for news
//route news (user)
Route::get('/news', [NewsController::class, 'userView'])->name('news');
Route::get('/news_detail', [NewsController::class, 'newsDetail'])->name('news_detail');

//route news (admin)
Route::get('/admin/news', [NewsController::class, 'showNews'])->name('news.index');
Route::post('/admin/news', [NewsController::class, 'store'])->name('news.store');
Route::put('/admin/news/{id}', [NewsController::class, 'update'])->name('news.update');
Route::delete('/admin/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');

//routes for layanan
Route::get('/layanan', [LayananController::class, 'layanan'])->name('layanan');

