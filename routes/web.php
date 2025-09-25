<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;

//route for home
Route::get('/', function () {
    return view('landing');
});
Route::get('/landing', [HomeController::class, 'HomeLanding'])->name('landing');

//route for auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/admin_rw/dashboard', function () {
    return view('admin_rw/dashboard');
})->middleware('auth');


//route for news
//route news (user)
Route::get('/news', [NewsController::class, 'userView'])->name('news');
Route::get('/news_detail', [NewsController::class, 'newsDetail'])->name('news_detail');
//route news (admin)
Route::get('/admin/news', [NewsController::class, 'showNews'])->name('news.index');
Route::post('/admin/news', [NewsController::class, 'store'])->name('news.store');
Route::put('/admin/news/{id}', [NewsController::class, 'update'])->name('news.update');
Route::delete('/admin/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
Route::get('/news', [NewsController::class, 'userView'])->name('News.user');