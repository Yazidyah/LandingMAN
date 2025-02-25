<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('home');})->name('home');
Route::get('/profilsekolah', function () {return view('guest.profilsekolah');})->name('guest.profilsekolah');
Route::get('/agenda', function () {return view('guest.agenda');})->name('guest.agenda');
Route::get('/prestasi', function () {return view('guest.prestasi');})->name('guest.prestasi');
Route::get('/faq', function () {return view('guest.faq');})->name('guest.faq');
Route::get('/fasilitas', function () {return view('guest.fasilitas');})->name('guest.fasilitas');
Route::get('/news', function () {return view('guest.news');})->name('guest.news');
Route::get('/saranpengaduan', function () {return view('guest.saranpengaduan');})->name('guest.saranpengaduan');
Route::get('/sejarah', function () {return view('guest.sejarah');})->name('guest.sejarah');
Route::get('/visimisi', function () {return view('guest.visimisi');})->name('guest.visimisi ');
Route::get('/publikasi', function () {return view('guest.publikasi');})->name('guest.publikasi');


Route::middleware(['auth', 'verified', 'web'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('admin.dashboard');
    Route::get('/admin/faq', function () {
        return view('admin.faq');
    })->name('admin.faq');
    Route::get('/admin/fasilitas', function () {
        return view('admin.fasilitas');
    })->name('admin.fasilitas');
    Route::get('/admin/news', function () {
        return view('admin.news');
    })->name('admin.news');
    Route::get('/admin/prestasi', function () {
        return view('admin.prestasi');
    })->name('admin.prestasi');
    Route::get('/admin/publikasi', function () {
        return view('admin.publikasi');
    })->name('admin.publikasi');
    Route::get('/admin/visimisi', function () {
        return view('admin.visimisi');
    })->name('admin.visimisi');
    Route::get('/admin/saranpengaduan', function () {
        return view('admin.saranpengaduan');
    })->name('admin.saranpengaduan');
    Route::get('/admin/publikasi', function () {
        return view('admin.publikasi');
    })->name('admin.publikasi');
    Route::get('/admin/agenda', function () {
        return view('admin.agenda');
    })->name('admin.agenda');
    Route::get('/admin/profilsekolah', function () {
        return view('admin.profilsekolah');
    })->name('admin.profilsekolah');
    Route::get('/admin/carousel', function () {
        return view('admin.carousel');
    })->name('admin.carousel');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
