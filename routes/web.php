<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\VMController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\AdministrasiController;
use App\Http\Controllers\StrukturalController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\GaleriController;

use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

//route for home
Route::get('/', function () {
    return view('landing');
});
Route::get('/landing', [HomeController::class, 'HomeLanding'])->name('landing');
Route::get('/statistika', [StatistikController::class, 'stat'])->name('statistika');
Route::get('/profil', [VMController::class, 'profil'])->name('profil');
Route::get('/katalog', [KatalogController::class, 'katalog'])->name('katalog');
Route::get('/detail_katalog', [KatalogController::class, 'detail_katalog'])->name('detail_katalog');


//route for auth
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin/login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/admin/dashboard', function () {
    return view('admin/dashboard');
})->middleware('auth');
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
Route::middleware(['auth', 'role:rt'])->group(function () {
    Route::get('/rt/dashboard', [DashboardController::class, 'index'])->name('rt.dashboard');
});

// Route::get('/rw/dashboard', function () {
//     return view('rw/dashboard');
// })->middleware('auth');


//route for news
//route news (user)
Route::get('/news', [NewsController::class, 'userView'])->name('news');
Route::get('/news_detail', [NewsController::class, 'newsDetail'])->name('news_detail');

//route news (rw)
Route::get('/admin/news', [NewsController::class, 'showNews'])->name('news.index');
Route::post('/admin/news', [NewsController::class, 'store'])->name('news.store');
Route::put('/admin/news/{id}', [NewsController::class, 'update'])->name('news.update');
Route::delete('/admin/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
Route::get('/news', [NewsController::class, 'userView'])->name('News.user');
//routes for layanan
Route::get('/detaillayanan', [LayananController::class, 'detaillayanan'])->name('detaillayanan');
Route::get('/layanan', [LayananController::class, 'layanan'])->name('layanan');
//zdministrasi
Route::get('/administrasi', [AdministrasiController::class, 'administrasi'])->name('administrasi');
//stuktural
Route::get('/struktural', [StrukturalController::class, 'struktural'])->name('struktural');
Route::get('/rw', [StrukturalController::class, 'rw'])->name('rw');
Route::get('/katar', [StrukturalController::class, 'katar'])->name('katar');
Route::get('/pkk', [StrukturalController::class, 'pkk'])->name('pkk');
//fasilitas
Route::get('/fasilitas', [FasilitasController::class, 'fasilitas'])->name('fasilitas');
//news
Route::get('/news', [NewsController::class, 'news'])->name('news');
Route::get('/pengumuman', [NewsController::class, 'pengumuman'])->name('pengumuman');
Route::get('/aktivitas', [NewsController::class, 'aktivitas'])->name('aktivitas');

Route::get('/galeri', [GaleriController::class, 'galeri'])->name('galeri');
Route::get('/detailgaleri', [GaleriController::class, 'detailgaleri'])->name('detailgaleri');
