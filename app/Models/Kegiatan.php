<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul',
        'kategori',
        'tanggal',
        'lokasi',
        'foto',
        'nama_pembuat',
        'deskripsi',
        'is_hidden',
    ];

    protected $casts = [
        'is_hidden' => 'boolean',
    ];

    /**
     * Relasi ke User pembuat kegiatan
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope query untuk konten yang tampil / tidak disembunyikan
     */
    public function scopeVisible($query)
    {
        return $query->where('is_hidden', false);
    }
}
