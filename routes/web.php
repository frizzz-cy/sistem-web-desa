<?php

use Illuminate\Support\Facades\Route;

// Beranda: portal utama Sistem Informasi Desa
Route::get('/', function () {
    return view('beranda');
});

// Peta interaktif + Potensi Ekonomi Desa
Route::get('/peta', function () {
    return view('home');
});

// Profil desa: struktur organisasi, anggaran, geografis, demografis, visi & misi
Route::get('/profil-desa', function () {
    return view('profil-desa');
});