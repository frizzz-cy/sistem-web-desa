<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // Fungsi untuk menampilkan halaman publik
    public function index()
    {
        // Ambil semua data produk yang tidak disembunyikan, urutkan dari yang terbaru
        $produks = Produk::visible()->latest()->get(); 
        
        // Kirim data $produks ke file produk.blade.php
        return view('produk', compact('produks'));
    }
}