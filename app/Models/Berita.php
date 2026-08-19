<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'kategori',
        'tanggal',
        'foto',
        'isi',
        'views',
        'is_hidden',
    ];

    protected $casts = [
        'is_hidden' => 'boolean',
    ];

    /**
     * Scope query untuk konten yang tampil / tidak disembunyikan
     */
    public function scopeVisible($query)
    {
        return $query->where('is_hidden', false);
    }
}
