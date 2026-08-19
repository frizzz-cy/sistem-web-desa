<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaultSettings = [
            'hero_slide_1' => '/images/slider/sdn2.jpeg',
            'hero_slide_2' => '/images/slider/tknusa.jpeg',
            'hero_slide_3' => '/images/slider/sentra.jpg',
            'hero_slide_4' => '/images/carousel/slide-4.jpg',
            
            'tentang_p1'   => 'Desa Munungkerep merupakan salah satu desa di Kecamatan Kabuh, Kabupaten Jombang, Jawa Timur, yang berada di kawasan dataran tinggi dengan kondisi tanah kering pada musim kemarau.',
            'tentang_p2'   => 'Desa ini terdiri dari 7 dusun Munungkerep, Karanggebang, Duren, Slumbung, Kalipang, Kadenan, dan Jatirubuh dengan mayoritas warga berprofesi sebagai petani. Tembakau menjadi komoditas unggulan yang ditanam warga saat musim kemarau, didampingi pandan sebagai komoditas pendukung yang tumbuh merata di seluruh wilayah desa.',
            'tentang_p3'   => 'Melalui portal ini, kami berupaya menghadirkan informasi desa secara terbuka — mulai dari peta wilayah, potensi ekonomi, struktur pemerintahan, hingga data profil desa agar mudah diakses oleh warga dan masyarakat umum.',
            
            'layanan_cards' => json_encode([
                [
                    'icon' => '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M7 3h8l4 4v14a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z"/><path d="M15 3v4h4"/><path d="M9 12h6M9 16h6M9 8h3"/></svg>',
                    'title' => 'Layanan Administrasi',
                    'desc' => 'Persyaratan lengkap surat-menyurat desa — domisili, usaha, KTP, KK, hingga surat tidak mampu.',
                    'link' => '#modal-layanan'
                ],
                [
                    'icon' => '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 21V7l8-4 8 4v14"/><path d="M9 21v-6h6v6M4 21h16"/></svg>',
                    'title' => 'Informasi Publik',
                    'desc' => 'Transparansi APBDes dan rincian anggaran.',
                    'link' => '#modal-informasi'
                ],
                [
                    'icon' => '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="7" r="3"/><path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6"/><circle cx="18" cy="8" r="2.2"/><path d="M15.5 20c.3-2.5 2-4.5 4.3-5"/></svg>',
                    'title' => 'Struktur Pemerintahan',
                    'desc' => 'Kenali Kepala Desa, perangkat desa, dan Kepala Dusun yang melayani warga Munungkerep.',
                    'link' => '/profil-desa#pemerintahan'
                ],
                [
                    'icon' => '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>',
                    'title' => 'Anggaran Desa',
                    'desc' => 'Transparansi APBDes, rincian belanja, serta sumber pendapatan desa secara terbuka.',
                    'link' => '#modal-informasi'
                ],
                [
                    'icon' => '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="8" r="3.2"/><path d="M2.5 20c0-3.6 2.5-6.5 5.5-6.5s5.5 2.9 5.5 6.5"/><path d="M16 21c0-3 2-5.5 4.5-5.5"/><circle cx="18.5" cy="9" r="2.3"/></svg>',
                    'title' => 'Data Kependudukan',
                    'desc' => 'Statistik jumlah penduduk, KK, usia, dan sarana-prasarana desa berdasarkan data monografi.',
                    'link' => '#modal-demografi'
                ],
                [
                    'icon' => '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18M8 3v4M16 3v4"/></svg>',
                    'title' => 'Event & Kegiatan',
                    'desc' => 'Dokumentasi dan informasi kegiatan warga — gotong royong, posyandu, dan agenda desa lainnya.',
                    'link' => '/kegiatan'
                ]
            ])
        ];

        foreach ($defaultSettings as $key => $value) {
            DB::table('settings')->updateOrInsert(
                ['key' => $key],
                ['value' => $value, 'created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
