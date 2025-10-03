<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\LayananController;
<<<<<<< HEAD
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
=======
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManagementPenggunaController;
use App\Http\Controllers\StatistikController;
>>>>>>> 48e710125124d44c28cebfa1ff3e710a51d43118

//route for home
Route::get('/', function () {
    return view('landing');
});
Route::get('/landing', [HomeController::class, 'HomeLanding'])->name('landing');

//route for auth
<<<<<<< HEAD
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin/login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/admin/dashboard', function () {
    return view('admin/dashboard');
})->middleware('auth');
=======
>>>>>>> 48e710125124d44c28cebfa1ff3e710a51d43118
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

<<<<<<< HEAD
// Route::get('/rw/dashboard', function () {
//     return view('rw/dashboard');
// })->middleware('auth');
=======
//Route middleware for sidebar
Route::middleware(['auth'])->group(function () {
    Route::get('/ketua_rw/news', [NewsController::class, 'news_RW'])->name('ketua_rw.news');
    Route::get('/ketua_rw/activity', [ActivityController::class, 'activity_RW'])->name('ketua_rw.activity');
    Route::get('/ketua_rw/statispend', [StatistikController::class, 'index'])->name('ketua_rw.statispend');
    Route::get('/ketua_rw/management_pengguna', [ManagementPenggunaController::class, 'index'])->name('ketua_rw.management_pengguna');

    // route statistika (rw) crud
    // KTP
    Route::post('/ketua_rw/statispend/ktp', [StatistikController::class, 'store_ktp'])->name('statispend.store_ktp');
    Route::put('/ketua_rw/statispend/ktp/{id}', [StatistikController::class, 'update_ktp'])->name('statispend.update_ktp');
    // Non KTP
    Route::post('/ketua_rw/statispend/nonktp', [StatistikController::class, 'store_nonktp'])->name('statispend.store_nonktp');
    Route::put('/ketua_rw/statispend/nonktp/{id}', [StatistikController::class, 'update_nonktp'])->name('statispend.update_nonktp');


    // // route menagement pengguna (rw) crud
    // // KTP
    // Route::post('/ketua_rw/management_pengguna/rw', [StatistikController::class, 'store_rw'])->name('management_pengguna.store_rw');
    // Route::put('/ketua_rw/management_pengguna/rw/{id}', [StatistikController::class, 'update_rw'])->name('management_pengguna.update_rw');
    // // Non KTP
    // Route::post('/ketua_rw/management_pengguna/nonktp', [StatistikController::class, 'store_nonktp'])->name('management_pengguna.store_nonktp');
    // Route::put('/ketua_rw/management_pengguna/nonktp/{id}', [StatistikController::class, 'update_nonktp'])->name('management_pengguna.update_nonktp');
});
>>>>>>> 48e710125124d44c28cebfa1ff3e710a51d43118


//route for news
//route news (user)
Route::get('/news', [NewsController::class, 'userView'])->name('news');
Route::get('/news_detail', [NewsController::class, 'newsDetail'])->name('news_detail');

//route news (rw)
Route::get('/admin/news', [NewsController::class, 'showNews'])->name('news.index');
Route::post('/admin/news', [NewsController::class, 'store'])->name('news.store');
Route::put('/admin/news/{id}', [NewsController::class, 'update'])->name('news.update');
Route::delete('/admin/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
<<<<<<< HEAD
Route::get('/news', [NewsController::class, 'userView'])->name('News.user');
=======

>>>>>>> 48e710125124d44c28cebfa1ff3e710a51d43118
//routes for layanan
Route::get('/layanan', [LayananController::class, 'layanan'])->name('layanan');
