<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AdminBeritaController;
use App\Http\Controllers\AdminKegiatanController;
use App\Models\Berita;
use App\Models\Kegiatan;

// Halaman Publik
Route::get('/', function () { 
    $beritas = Berita::latest()->take(3)->get();
    return view('beranda', compact('beritas')); 
});
Route::get('/berita/{berita}/view', function (Berita $berita) {
    $berita->increment('views');
    return response()->json(['views' => $berita->views]);
});
Route::get('/peta', function () { return view('home'); });
Route::get('/profil-desa', function () { return view('profil-desa'); });
Route::get('/kegiatan', function () { 
    $kegiatans = Kegiatan::latest()->get();
    return view('kegiatan', compact('kegiatans')); 
});
Route::get('/berita-detail', function () { return view('berita-detail'); }); // Template Detail
Route::get('/produk', [ProdukController::class, 'index']);

// Fitur Auth (Login & Logout)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');


Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('produk', AdminProdukController::class);
    Route::resource('berita', AdminBeritaController::class)->parameters(['berita' => 'berita']);
    Route::resource('kegiatan', AdminKegiatanController::class);
});