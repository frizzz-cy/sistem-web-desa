<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminProdukController;

// Halaman Publik
Route::get('/', function () { return view('beranda'); });
Route::get('/peta', function () { return view('home'); });
Route::get('/profil-desa', function () { return view('profil-desa'); });
Route::get('/kegiatan', function () { return view('kegiatan'); });
Route::get('/berita-detail', function () { return view('berita-detail'); }); // Template Detail
Route::get('/produk', [ProdukController::class, 'index']);

// Fitur Auth (Login & Logout)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');


Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('produk', AdminProdukController::class);
});


Route::get('/buat-akun-admin', function () {
    // Hapus dulu jika sudah ada agar tidak duplikat
    \App\Models\User::where('email', 'admin@desa.id')->delete();

    // Buat akun baru dengan enkripsi otomatis Laravel
    \App\Models\User::create([
        'name' => 'Admin Desa',
        'username' => 'admin',
        'email' => 'admin@desa.id',
        'password' => \Illuminate\Support\Facades\Hash::make('123')
    ]);

    return 'Akun Berhasil Dibuat! Silakan buka /login';
});