<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\KategoriController;
use Illuminate\Support\Facades\Route;

// Guest Routes
Route::view('/', 'home')->name('home');
Route::prefix('guest')->group(function () {
    Route::view('/profilsekolah', 'guest.profilsekolah')->name('guest.profilsekolah');
    Route::view('/agenda', 'guest.agenda')->name('guest.agenda');
    Route::view('/prestasi', 'guest.prestasi')->name('guest.prestasi');
    Route::view('/faq', 'guest.faq')->name('guest.faq');
    Route::view('/fasilitas', 'guest.fasilitas')->name('guest.fasilitas');
    Route::view('/news', 'guest.news')->name('guest.news');
    Route::view('/saranpengaduan', 'guest.saranpengaduan')->name('guest.saranpengaduan');
    Route::view('/sejarah', 'guest.sejarah')->name('guest.sejarah');
    Route::view('/visimisi', 'guest.visimisi')->name('guest.visimisi');
    Route::view('/publikasi', 'guest.publikasi')->name('guest.publikasi');
});

// Admin Routes (Protected by Authentication & Verification)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/faq', 'admin.faq')->name('faq');
    Route::view('/fasilitas', 'admin.fasilitas')->name('fasilitas');
    Route::view('/news', 'admin.news')->name('news');
    Route::view('/prestasi', 'admin.prestasi')->name('prestasi');
    Route::view('/publikasi', 'admin.publikasi')->name('publikasi');
    Route::view('/visimisi', 'admin.visimisi')->name('visimisi');
    Route::view('/saranpengaduan', 'admin.saranpengaduan')->name('saranpengaduan');
    Route::view('/agenda', 'admin.agenda')->name('agenda');
    Route::view('/profilsekolah', 'admin.profilsekolah')->name('profilsekolah');
    Route::view('/carousel', 'admin.carousel')->name('carousel');
    
    // Kategori CRUD Routes
    Route::resource('categories', KategoriController::class)->except(['show', 'create']);
});

// Profile Routes (Requires Authentication)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
