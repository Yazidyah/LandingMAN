<?php

use App\Http\Controllers\Admin\VisiMisiController;
use App\Http\Controllers\ControllerBanner;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KontenController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\BannerController;
use Illuminate\Support\Facades\Route;

// Guest Routes
Route::get('/', [\App\Http\Controllers\BannerController::class, 'index'])->name('home');
Route::prefix('guest')->group(function () {
    Route::get('/profilsekolah', 'guest.profilsekolah')->name('guest.profilsekolah');
    Route::get('/agenda', 'guest.agenda')->name('guest.agenda');
    Route::get('/prestasi', 'guest.prestasi')->name('guest.prestasi');
    Route::get('/faq', 'guest.faq')->name('guest.faq');
    Route::get('/fasilitas', 'guest.fasilitas')->name('guest.fasilitas');
    Route::get('/news', 'guest.news')->name('guest.news');
    Route::get('/saranpengaduan', 'guest.saranpengaduan')->name('guest.saranpengaduan');
    Route::get('/sejarah', 'guest.sejarah')->name('guest.sejarah');
    Route::get('/visimisi', 'guest.visimisi')->name('guest.visimisi');
    Route::get('/publikasi', 'guest.publikasi')->name('guest.publikasi');
});

// Admin Routes (Protected by Authentication & Verification)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/faq', 'admin.faq')->name('faq');
    Route::view('/fasilitas', 'admin.fasilitas')->name('fasilitas');
    Route::view('/news', 'admin.news')->name('news');
    Route::view('/prestasi', 'admin.prestasi')->name('prestasi');
    Route::view('/publikasi', 'admin.publikasi')->name('publikasi');
    Route::view('/saranpengaduan', 'admin.saranpengaduan')->name('saranpengaduan');
    Route::view('/agenda', 'admin.agenda')->name('agenda');
    Route::view('/profilsekolah', 'admin.profilsekolah')->name('profilsekolah');
    Route::view('/carousel', 'admin.carousel')->name('carousel');
    
    // Kategori CRUD Routes
    Route::resource('categories', KategoriController::class)->except(['show', 'create']);
    Route::resource('contents', KontenController::class)->except(['show', 'create']);
    Route::resource('visimisi', VisiMisiController::class);
    Route::resource('faq', FaqController::class);
    Route::resource('banner', BannerController::class);
    Route::delete('/admin/banner/{id}', [App\Http\Controllers\Admin\BannerController::class, 'destroy'])->name('admin.banner.destroy');
});

// Profile Routes (Requires Authentication)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
