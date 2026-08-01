<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Berita;
use App\Models\Kegiatan;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_produk' => Produk::count(),
            'total_berita' => Berita::count(),
            'total_kegiatan' => Kegiatan::count(),
            'total_views' => Berita::sum('views'),
            'total_user' => User::count(),
        ];

        // 5 data terbaru untuk tinjauan aktivitas
        $recent_produks = Produk::latest()->take(5)->get();
        $recent_beritas = Berita::latest()->take(5)->get();
        $recent_kegiatans = Kegiatan::latest()->take(5)->get();

        // 5 berita paling populer
        $popular_beritas = Berita::orderBy('views', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_produks', 'recent_beritas', 'recent_kegiatans', 'popular_beritas'));
    }
}
