<?php

use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;


// | Web Routes

Route::get('/', [PublicController::class, 'index'])->name('home');

// ==========================================
// PROFIL
// ==========================================
Route::prefix('profil')->name('profil.')->group(function () {
    // Diarahkan ke controller semua agar rapi dan bisa di-cache
    Route::get('/visi-misi', [PublicController::class, 'visiMisi'])->name('visi-misi');
    Route::get('/tugas-fungsi', [PublicController::class, 'tugasFungsi'])->name('tugas-fungsi');
    Route::get('/struktur', [PublicController::class, 'struktur'])->name('struktur');
});

// ==========================================
// CUACA & IKLIM
// ==========================================
Route::get('/cuaca/peringatan-dini', [PublicController::class, 'peringatanDini'])->name('cuaca.peringatan');  
Route::get('/cuaca/prakiraan', [PublicController::class, 'prakiraan'])->name('cuaca.prakiraan');
Route::get('/cuaca/penerbangan', [PublicController::class, 'penerbangan'])->name('cuaca.penerbangan');
Route::get('/iklim/kualitas-udara', [PublicController::class, 'kualitasUdara'])->name('iklim.kualitas-udara');
Route::get('/iklim/peta', [PublicController::class, 'petaIklim'])->name('iklim.peta');

// ==========================================
// GEMPA BUMI
// ==========================================
Route::prefix('gempa')->name('gempa.')->group(function () {
    Route::get('/terkini', [PublicController::class, 'gempaTerkini'])->name('terkini');
    Route::get('/dirasakan', [PublicController::class, 'gempaDirasakan'])->name('dirasakan');
});

// ==========================================
// PUBLIKASI & LAYANAN
// ==========================================
Route::prefix('publikasi')->name('publikasi.')->group(function () {
    Route::get('/berita', [PublicController::class, 'berita'])->name('berita');
    Route::get('/berita/{slug}', [PublicController::class, 'beritaDetail'])->name('berita.detail');
    Route::get('/buletin', [PublicController::class, 'buletin'])->name('buletin');
});

// Logika database dipindah ke controller
Route::get('/layanan', [PublicController::class, 'layanan'])->name('layanan.index');

// require __DIR__.'/auth.php';