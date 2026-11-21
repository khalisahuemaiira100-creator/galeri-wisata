<?php

use App\Http\Controllers\Admin\ArtikelController as AdminArtikelController;
use App\Http\Controllers\Admin\DestinasiController as AdminDestinasiController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use App\Http\Controllers\Admin\PromosiController as AdminPromosiController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\PromosiController;
use App\Http\Middleware\AdminOnly;
use App\Models\Destinasi;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/destinasi', [DestinasiController::class, 'index']);
    Route::get('/artikel', [ArtikelController::class, 'index']);
    Route::get('/artikel/{artikel}', [ArtikelController::class, 'show']);
    Route::get('/promosi', [PromosiController::class, 'index']);
    Route::get('/galeri', [GaleriController::class, 'index']);
});

Route::middleware(['auth', AdminOnly::class])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard', [
            'jumlahPengguna' => User::count(),
            'jumlahDestinasi' => Destinasi::count(),
            'jumlahKategori' => Kategori::count(),
        ]);
    });

    Route::get('/laporan', [AdminLaporanController::class, 'index']);
    Route::get('/laporan/unduh', [AdminLaporanController::class, 'unduh']);

    Route::get('/destinasi', [AdminDestinasiController::class, 'index']);
    Route::get('/destinasi/create', [AdminDestinasiController::class, 'create']);
    Route::post('/destinasi', [AdminDestinasiController::class, 'store']);
    Route::get('/destinasi/{destinasi}/edit', [AdminDestinasiController::class, 'edit']);
    Route::put('/destinasi/{destinasi}', [AdminDestinasiController::class, 'update']);
    Route::delete('/destinasi/{destinasi}', [AdminDestinasiController::class, 'destroy']);

    Route::get('/artikel', [AdminArtikelController::class, 'index']);
    Route::get('/artikel/create', [AdminArtikelController::class, 'create']);
    Route::post('/artikel', [AdminArtikelController::class, 'store']);
    Route::get('/artikel/{artikel}/edit', [AdminArtikelController::class, 'edit']);
    Route::put('/artikel/{artikel}', [AdminArtikelController::class, 'update']);
    Route::delete('/artikel/{artikel}', [AdminArtikelController::class, 'destroy']);

    Route::get('/promosi', [AdminPromosiController::class, 'index']);
    Route::get('/promosi/create', [AdminPromosiController::class, 'create']);
    Route::post('/promosi', [AdminPromosiController::class, 'store']);
    Route::get('/promosi/{promosi}/edit', [AdminPromosiController::class, 'edit']);
    Route::put('/promosi/{promosi}', [AdminPromosiController::class, 'update']);
    Route::delete('/promosi/{promosi}', [AdminPromosiController::class, 'destroy']);

    Route::get('/galeri', [AdminGaleriController::class, 'index']);
    Route::get('/galeri/create', [AdminGaleriController::class, 'create']);
    Route::post('/galeri', [AdminGaleriController::class, 'store']);
    Route::get('/galeri/{galeri}/edit', [AdminGaleriController::class, 'edit']);
    Route::put('/galeri/{galeri}', [AdminGaleriController::class, 'update']);
    Route::delete('/galeri/{galeri}', [AdminGaleriController::class, 'destroy']);
});