<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // Kolom yang diizinkan untuk diisi CRUD
    protected $fillable = [
        'nama_produk',
        'kategori',
        'harga',
        'status_stok',
        'deskripsi',
        'nama_penjual',
        'no_whatsapp',
        'foto_produk',
    ];
}