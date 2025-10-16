<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VMController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\StatistikController;
<<<<<<< HEAD
use App\Http\Controllers\StrukturalController;
use App\Http\Controllers\ManagementPenggunaController;
=======
use App\Http\Controllers\VMController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\AdministrasiController;
use App\Http\Controllers\StrukturalController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\GaleriController;

use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
>>>>>>> bada

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
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['auth', 'role:Ketua_RW'])->group(function () {
    Route::get('/ketua_rw/dashboard', [DashboardController::class, 'index'])->name('Ketua_RW.dashboard');
});
Route::middleware(['auth', 'role:Ketua_PKK'])->group(function () {
    Route::get('/pkk/dashboard', [DashboardController::class, 'index'])->name('pkk.dashboard');
});
Route::middleware(['auth', 'role:Ketua_Katar'])->group(function () {
    Route::get('/katar/dashboard', [DashboardController::class, 'index'])->name('katar.dashboard');
});
Route::middleware(['auth', 'role:Ketua_RT'])->group(function () {
    Route::get('/rt/dashboard', [DashboardController::class, 'index'])->name('ketua_rt.dashboard');
});

//Route middleware for sidebar
Route::middleware(['auth'])->group(function () {
    Route::get('/ketua_rw/news', [NewsController::class, 'news_RW'])->name('Ketua_RW.news');
    Route::get('/ketua_rw/activity', [ActivityController::class, 'activity_RW'])->name('Ketua_RW.activity');
    Route::get('/ketua_rw/statispend', [StatistikController::class, 'index'])->name('Ketua_RW.statispend');
    Route::get('/ketua_rw/management_pengguna', [ManagementPenggunaController::class, 'index'])->name('Ketua_RW.management_pengguna');
    Route::get('/ketua_rw/struktural', [StrukturalController::class, 'index'])->name('Ketua_RW.struktural');
    Route::get('/ketua_rw/fasilitas', [FasilitasController::class, 'index'])->name('Ketua_RW.fasilitas');
    Route::get('/ketua_rw/layanan', [layananController::class, 'index'])->name('Ketua_RW.layanan');
    Route::get('/ketua_rw/berkas', [BerkasController::class, 'index'])->name('Ketua_RW.berkas');
    Route::get('/ketua_rw/news', [NewsController::class, 'index'])->name('Ketua_RW.news');

    // statistika (rw) crud
    // KTP
    Route::post('/ketua_rw/statispend/ktp', [StatistikController::class, 'store_ktp'])->name('statispend.store_ktp');
    Route::put('/ketua_rw/statispend/ktp/{id}', [StatistikController::class, 'update_ktp'])->name('statispend.update_ktp');
    // Non KTP
    Route::post('/ketua_rw/statispend/nonktp', [StatistikController::class, 'store_nonktp'])->name('statispend.store_nonktp');
    Route::put('/ketua_rw/statispend/nonktp/{id}', [StatistikController::class, 'update_nonktp'])->name('statispend.update_nonktp');

    // menagement pengguna (rw) crud
    Route::post('/ketua_rw/management_pengguna/', [ManagementPenggunaController::class, 'store_rw'])->name('management_pengguna.store_rw');
    Route::put('/ketua_rw/management_pengguna/{id}', [ManagementPenggunaController::class, 'update_rw'])->name('management_pengguna.update_rw');
    Route::delete('/ketua_rw/management_pengguna/{id}', [ManagementPenggunaController::class, 'destroy_rw'])->name('management_pengguna.destroy_rw');

    // fasilitas (rw) crud
    Route::post('/ketua_rw/fasilitas/', [FasilitasController::class, 'store_rw'])->name('fasilitas.store_rw');
    Route::put('/ketua_rw/fasilitas/{id}', [FasilitasController::class, 'update_rw'])->name('fasilitas.update_rw');
    Route::delete('/ketua_rw/fasilitas/{id}', [FasilitasController::class, 'destroy_rw'])->name('fasilitas.destroy_rw');

    // struktural (rw) crud
    Route::post('/ketua_rw/struktural', [StrukturalController::class, 'store_rw'])->name('struktural.store_rw');
    Route::put('/ketua_rw/struktural/{id}', [StrukturalController::class, 'update_rw'])->name('struktural.update_rw');
    Route::delete('/ketua_rw/struktural/{id}', [StrukturalController::class, 'destroy_rw'])->name('struktural.destroy_rw');

    // layanan (rw) crud
    Route::post('/ketua_rw/layanan/store', [layananController::class, 'store_rw'])->name('layanan.store_rw');
    Route::post('/ketua_rw/layanan/st', [layananController::class, 'store_st'])->name('layanan.store_st');
    Route::put('/ketua_rw/layanan/{id}', [layananController::class, 'update_rw'])->name('layanan.update_rw');
    Route::delete('/ketua_rw/layanan/{id}', [layananController::class, 'destroy_rw'])->name('layanan.destroy_rw');

    // berkas syarat (rw) crud
    Route::post('/ketua_rw/berkas', [BerkasController::class, 'store_rw'])->name('berkas.store_rw');
    Route::put('/ketua_rw/berkas/{id}', [BerkasController::class, 'update_rw'])->name('berkas.update_rw');
    Route::delete('/ketua_rw/berkas/{id}', [BerkasController::class, 'destroy_rw'])->name('berkas.destroy_rw');

    //route news (rw)
    Route::post('/ketua_rw/news', [NewsController::class, 'store_rw'])->name('news.store_rw');
    Route::post('/ketua_rw/news/kt', [NewsController::class, 'store_kt'])->name('news.store_kt');
    Route::put('/ketua_rw/news/{id}', [NewsController::class, 'update_rw'])->name('news.update_rw');
    Route::delete('/ketua_rw/news/{id}', [NewsController::class, 'destroy_rw'])->name('news.destroy_rw');
});

//route news (user)
Route::get('/news', [NewsController::class, 'userView'])->name('news');
Route::get('/news_detail', [NewsController::class, 'newsDetail'])->name('news_detail');
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
