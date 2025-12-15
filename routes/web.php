<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\FeedbackController as AdminFeedbackController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/berita', [PublicController::class, 'newsIndex'])->name('news.index');
Route::get('/berita/{slug}', [PublicController::class, 'showNews'])->name('news.show');

// Halaman Daftar Divisi
Route::get('/divisi', function () {
    return view('pages.divisi');
})->name('divisi.index');

// Halaman Detail Divisi 1: Tata Lingkungan dan Kehutanan
Route::get('/divisi/tata-lingkungan', function () {
    return view('pages.divisi_1');
})->name('divisi.show_tata_lingkungan');

// Halaman Detail Divisi 2: Pengelolaan Sampah Limbah B3 (Sudah ada)
Route::get('/divisi/pengelolaan-sampah', function () {
    return view('pages.divisi_2');
})->name('divisi.show_sampah');

// Halaman Detail Divisi 3: Pengendalian Pencemaran dan Kerusakan Lingkungan
Route::get('/divisi/pengendalian-pencemaran', function () {
    return view('pages.divisi_3');
})->name('divisi.show_pengendalian');

// Halaman Detail Divisi 4: Penataan dan Peningkatan Kapasitas Lingkungan Hidup
Route::get('/divisi/penataan-kapasitas', function () {
    return view('pages.divisi_4');
})->name('divisi.show_kapasitas');

Route::post('/feedback', [PublicController::class, 'submitFeedback'])->name('feedback.submit');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.post')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');


/*
|--------------------------------------------------------------------------
| Admin Routes (Membutuhkan Login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Berita (CRUD Lengkap)
    Route::resource('admin/news', NewsController::class)->except(['show'])->names('news');

    // Manajemen Feedback (Hanya View/Show, Update(is_read), dan Delete)
    Route::resource('admin/feedback', AdminFeedbackController::class)->only(['index', 'show', 'update', 'destroy'])->names('feedback');
});