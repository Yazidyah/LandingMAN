<?php

use App\Http\Controllers\Admin\VisiMisiController;
use App\Http\Controllers\ControllerBanner;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KontenController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\KritsarController;
use App\Http\Controllers\Admin\KuesionerController;
use App\Http\Controllers\Admin\SurveyController;
use App\Http\Controllers\Admin\RespondenController;
use App\Http\Controllers\Admin\IkmController;
use App\Http\Controllers\Admin\UnsurController;
use App\Http\Controllers\Admin\PrestasiController;
use App\Http\Controllers\Admin\SejarahController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// Guest Routes
Route::get('/', [\App\Http\Controllers\BannerController::class, 'index'])->name('home');
Route::get('/profilsekolah', [\App\Http\Controllers\GuestController::class, 'profilsekolah'])->name('guest.profilsekolah');
Route::get('/agenda', [\App\Http\Controllers\GuestController::class, 'agenda'])->name('guest.agenda');
Route::get('/prestasi', [\App\Http\Controllers\GuestController::class, 'prestasi'])->name('guest.prestasi');
Route::get('/faq', [\App\Http\Controllers\GuestController::class, 'faq'])->name('guest.faq');
Route::get('/fasilitas', [\App\Http\Controllers\GuestController::class, 'fasilitas'])->name('guest.fasilitas');
Route::get('/news', [\App\Http\Controllers\GuestController::class, 'news'])->name('guest.news');
Route::get('/news/{slug}', [\App\Http\Controllers\GuestController::class, 'newsDetail'])->name('guest.newsDetail');
Route::get('/sejarah', [\App\Http\Controllers\GuestController::class, 'sejarah'])->name('guest.sejarah');
Route::get('/visimisi', [\App\Http\Controllers\GuestController::class, 'visimisi'])->name('guest.visimisi');
Route::get('/publikasi', [\App\Http\Controllers\GuestController::class, 'publikasi'])->name('guest.publikasi');
Route::get('/ppdb/survey', [\App\Http\Controllers\SurveyPpdbController::class, 'index'])->name('ppdb.survey');
Route::post('/ppdb/survey', [\App\Http\Controllers\SurveyPpdbController::class, 'store'])->name('ppdb.survey.store');
Route::get('/survey', [\App\Http\Controllers\SurveyController::class, 'index'])->name('guest.survey');
Route::post('/survey', [\App\Http\Controllers\SurveyController::class, 'store'])->name('guest.survey.store');

// Admin Routes (Protected by Authentication & Verification)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
    Route::view('/faq', 'admin.faq')->name('faq');
    Route::view('/fasilitas', 'admin.fasilitas')->name('fasilitas');
    Route::view('/news', 'admin.news')->name('news');
    Route::view('/prestasi', 'admin.prestasi')->name('prestasi');
    Route::view('/publikasi', 'admin.publikasi')->name('publikasi');
    Route::view('/agenda', 'admin.agenda')->name('agenda');
    Route::view('/profilsekolah', 'admin.profilsekolah')->name('profilsekolah');
    Route::view('/carousel', 'admin.carousel')->name('carousel');
    Route::get('/kritiksaran', [KritsarController::class, 'index'])->name('kritiksaran.index');
    Route::get('/responden', [RespondenController::class, 'index'])->name('responden.index');
    
    // Kategori CRUD Routes
    Route::resource('categories', KategoriController::class)->except(['show', 'create']);
    Route::resource('contents', KontenController::class)->except(['show', 'create']);
    Route::resource('survey', SurveyController::class);
    Route::resource('kuesioner', KuesionerController::class);
    Route::resource('ikm', IkmController::class)->except(['show', 'create']);
    Route::resource('visimisi', VisiMisiController::class);
    Route::resource('faq', FaqController::class);
    Route::resource('banner', BannerController::class);
    Route::resource('unsur', UnsurController::class);
    Route::resource('prestasi', PrestasiController::class);
    Route::resource('sejarah', SejarahController::class);

    // Hanya superadmin yang bisa akses users
    Route::resource('users', UserController::class);

    Route::delete('/admin/banner/{id}', [BannerController::class, 'destroy'])->name('admin.banner.destroy');
    Route::delete('/contents/images/{id}', [KontenController::class, 'deleteImage'])->name('contents.images.destroy');
});

// Profile Routes (Requires Authentication)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
