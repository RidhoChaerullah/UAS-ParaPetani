<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\PageController; 
use App\Http\Controllers\ProfileController;

// Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman Berita
Route::get('/berita', [NewsController::class, 'index'])->name('news.index');

// Grup Rute yang Membutuhkan Login (Authenticated)
Route::middleware('auth')->group(function () {
    // Halaman Tanaman
    Route::get('/tanaman', [PlantController::class, 'index'])->name('plants.index');
    Route::post('/tanaman', [PlantController::class, 'store'])->name('plants.store');
    Route::delete('/tanaman/{plant}', [PlantController::class, 'destroy'])->name('plants.destroy');

    // Halaman Profil (Breeze sudah membuat ini, kita hanya perlu memodifikasinya)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/tentang-kami', [PageController::class, 'about'])->name('about.us');

// Rute ini akan dibuat otomatis oleh 'php artisan breeze:install'
require __DIR__.'/auth.php';