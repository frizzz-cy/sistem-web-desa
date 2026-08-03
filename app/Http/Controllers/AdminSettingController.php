<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    // Tampilkan form pengaturan beranda
    public function index()
    {
        $slides = [
            'hero_slide_1' => Setting::get('hero_slide_1', '/images/slider/sdn2.jpeg'),
            'hero_slide_2' => Setting::get('hero_slide_2', '/images/slider/tknusa.jpeg'),
            'hero_slide_3' => Setting::get('hero_slide_3', '/images/slider/sentra.jpg'),
            'hero_slide_4' => Setting::get('hero_slide_4', '/images/carousel/slide-4.jpg'),
        ];

        $tentang = [
            'tentang_p1' => Setting::get('tentang_p1'),
            'tentang_p2' => Setting::get('tentang_p2'),
            'tentang_p3' => Setting::get('tentang_p3'),
        ];

        $layanan_cards_json = Setting::get('layanan_cards');
        $layanan_cards = $layanan_cards_json ? json_decode($layanan_cards_json, true) : [];

        // Ambil data potensi ekonomi dengan auto-seeding default jika kosong
        $data_potensi_json = Setting::get('data_potensi');
        if (!$data_potensi_json) {
            $defaultPotensi = [
                'tembakau' => [
                    'tag' => 'Komoditas Utama',
                    'judul' => 'Tembakau',
                    'foto' => ['/images/tembakau.jpg'],
                    'isi' => 'Komoditas unggulan Desa Munungkerep, ditanam di lahan tegalan/kering pada musim kemarau karena tidak membutuhkan banyak air dibanding tanaman lain, sehingga cocok dengan kondisi tanah desa yang berada di dataran tinggi Kecamatan Kabuh. Masa panen berlangsung antara bulan Juli hingga November.',
                    'manfaat' => [
                        'Diolah menjadi tembakau rajangan sebagai bahan baku rokok kretek — produk utama yang dijual ke pengepul',
                        'Bisa diolah lebih lanjut jadi cerutu atau tembakau lintingan, produk olahan bernilai jual lebih tinggi',
                        'Sisa/ampas tembakau dimanfaatkan sebagai pestisida alami — kandungan nikotinnya efektif mengusir hama tanaman',
                        'Batang dan daun sisa panen bisa diolah jadi pupuk kompos organik',
                        'Jadi sumber penghasilan utama petani saat musim kemarau, ketika tanaman lain sulit tumbuh di lahan kering'
                    ],
                    'catatan' => '📝 Masih perlu: luas lahan, jumlah petani/dusun penghasil, titik lokasi lahan',
                    'produk' => ['Rajangan', 'Cerutu', 'Lintingan', 'Pestisida Alami', 'Pupuk Kompos'],
                    'cara' => [
                        'Daun dipetik saat sudah matang, biasanya pagi hari setelah embun mengering',
                        'Daun diperam (curing) dulu sampai warnanya berubah dan agak lentur, tidak mudah hancur',
                        'Dirajang tipis-tipis pakai pisau tajam atau alat rajang tradisional',
                        'Hasil rajangan dijemur langsung di bawah matahari selama beberapa hari sampai kering merata',
                        'Setelah kering, difermentasi agar aroma dan rasanya lebih matang sebelum dikemas dan dijual'
                    ]
                ],
                'pandan' => [
                    'tag' => 'Komoditas Pendukung',
                    'judul' => 'Pandan',
                    'foto' => ['/images/pandan.jpeg'],
                    'isi' => 'Komoditas pendukung yang ditanam merata di seluruh wilayah Desa Munungkerep, bukan terpusat di dusun tertentu. Pembuatan anyaman tikar pandan dilakukan sebagai usaha sampingan warga.',
                    'manfaat' => [
                        'Bahan pewangi & pewarna hijau alami untuk masakan dan kue tradisional',
                        'Bahan baku anyaman — tikar, tas, dan kerajinan tangan warga',
                        'Pembungkus alami untuk makanan tradisional',
                        'Diolah menjadi dupa atau pengharum ruangan alami',
                        'Akarnya kadang dimanfaatkan warga dalam ramuan tradisional rumahan',
                        'Ditanam di lahan miring juga membantu menahan erosi tanah, selain nilai ekonominya'
                    ],
                    'catatan' => '📝 Masih perlu: dijual ke mana/pembeli utama, titik lokasi lahan (kalau ada yang representatif)',
                    'produk' => ['Dupa', 'Pewarna Masakan', 'Pembungkus Makanan', 'Ramuan Tradisional'],
                    'cara' => [
                        'Daun pandan dipetik, lalu duri di tepinya dibersihkan pakai pisau atau senar',
                        'Daun dipotong/dibelah jadi ukuran seragam, biasanya sekitar 0,5–0,7 cm lebar',
                        'Direbus sebentar untuk menghilangkan getah dan melunakkan seratnya',
                        'Dijemur sampai benar-benar kering, lalu diluruskan dan dihaluskan',
                        'Setelah siap, baru dianyam sesuai motif dan bentuk yang diinginkan — tikar, tas, dompet, dan lainnya'
                    ]
                ],
                'padi' => [
                    'tag' => 'Produk Olahan',
                    'judul' => 'Padi',
                    'foto' => ['/images/padi.jpg'],
                    'isi' => 'Padi merupakan salah satu hasil pertanian utama di Desa Munungkerep yang ditanam oleh warga pada musim hujan di lahan basah/sawah. Hasil panen padi menjadi komoditas pangan pokok warga desa dan sebagian dipasarkan ke luar daerah.',
                    'manfaat' => [
                        'Sumber makanan pokok utama bagi warga Desa Munungkerep',
                        'Diolah menjadi beras konsumsi dan dipasarkan untuk meningkatkan ekonomi keluarga petani',
                        'Jerami sisa panen diolah menjadi pakan ternak sapi atau kambing',
                        'Sisa sekam padi digunakan sebagai bahan bakar pembuatan batu bata atau media tanam'
                    ],
                    'catatan' => '📝 Masih perlu: produktivitas panen per hektar dan data pemasaran beras',
                    'produk' => ['Beras', 'Tepung Beras', 'Pakan Ternak', 'Sekam Bakar'],
                    'cara' => [
                        'Pembibitan dan penanaman padi di sawah tadah hujan pada awal musim penghujan',
                        'Perawatan berkala meliputi pemupukan, pengairan yang cukup, dan penyiangan gulma',
                        'Pemanenan padi menggunakan sabit atau mesin combine harvester saat bulir padi menguning',
                        'Perontokan bulir padi dan penjemuran gabah hingga kadar air cukup rendah',
                        'Penggilingan gabah menjadi beras siap konsumsi'
                    ]
                ]
            ];
            Setting::set('data_potensi', json_encode($defaultPotensi));
            $data_potensi = $defaultPotensi;
        } else {
            $data_potensi = json_decode($data_potensi_json, true);
        }

        return view('admin.pengaturan', compact('slides', 'tentang', 'layanan_cards', 'data_potensi'));
    }

    // Perbarui seluruh konfigurasi beranda
    public function update(Request $request)
    {
        // Fitur Reset Kartu Layanan ke Default
        if ($request->input('action') === 'reset_cards') {
            Setting::set('layanan_cards', json_encode($this->getDefaultCards()));
            return redirect('/admin/pengaturan')->with('success', '6 Kartu layanan berhasil direset ke pengaturan bawaan (default)!');
        }

        // 1. Update Tentang Desa
        Setting::set('tentang_p1', $request->input('tentang_p1'));
        Setting::set('tentang_p2', $request->input('tentang_p2'));
        Setting::set('tentang_p3', $request->input('tentang_p3'));

        // 2. Update Slides (Upload Baru & Kompresi jika ada)
        for ($i = 1; $i <= 4; $i++) {
            $fieldName = "hero_slide_" . $i;
            if ($request->hasFile($fieldName)) {
                $file = $request->file($fieldName);
                // Gunakan Helper untuk mengompresi gambar ke WebP 80%
                $path = ImageHelper::uploadAndCompress($file, 'slider');
                if ($path) {
                    Setting::set($fieldName, asset('storage/' . $path));
                }
            }
        }

        // 3. Update Layanan & Informasi Cards
        $cards = [];
        $titles = $request->input('card_title', []);
        $descs = $request->input('card_desc', []);
        $links = $request->input('card_link', []);
        $icons = $request->input('card_icon', []);

        for ($i = 0; $i < 6; $i++) {
            $cards[] = [
                'title' => $titles[$i] ?? '',
                'desc' => $descs[$i] ?? '',
                'link' => $links[$i] ?? '',
                'icon' => $icons[$i] ?? ''
            ];
        }
        Setting::set('layanan_cards', json_encode($cards));

        // 4. Update Potensi Ekonomi Desa
        if ($request->has('potensi_keys')) {
            $existing_potensi_json = Setting::get('data_potensi');
            $existing_potensi = $existing_potensi_json ? json_decode($existing_potensi_json, true) : [];

            $potensi_keys = $request->input('potensi_keys', []);
            $potensi_judul = $request->input('potensi_judul', []);
            $potensi_tag = $request->input('potensi_tag', []);
            $potensi_catatan = $request->input('potensi_catatan', []);
            $potensi_isi = $request->input('potensi_isi', []);
            $potensi_manfaat = $request->input('potensi_manfaat', []);
            $potensi_cara = $request->input('potensi_cara', []);
            $potensi_produk = $request->input('potensi_produk', []);

            $new_potensi = [];

            foreach ($potensi_keys as $idx => $key) {
                // Manfaat split per baris
                $manfaat_lines = explode("\n", $potensi_manfaat[$idx] ?? '');
                $manfaat_arr = array_filter(array_map('trim', $manfaat_lines));

                // Cara split per baris
                $cara_lines = explode("\n", $potensi_cara[$idx] ?? '');
                $cara_arr = array_filter(array_map('trim', $cara_lines));

                // Produk olahan split koma
                $produk_parts = explode(",", $potensi_produk[$idx] ?? '');
                $produk_arr = array_filter(array_map('trim', $produk_parts));

                // Kelola foto
                $foto_arr = $existing_potensi[$key]['foto'] ?? [];
                $fileFieldName = "potensi_foto_" . $key;
                if ($request->hasFile($fileFieldName)) {
                    $file = $request->file($fileFieldName);
                    $path = ImageHelper::uploadAndCompress($file, 'potensi');
                    if ($path) {
                        $foto_arr[0] = asset('storage/' . $path);
                    }
                }

                $new_potensi[$key] = [
                    'tag' => $potensi_tag[$idx] ?? '',
                    'judul' => $potensi_judul[$idx] ?? '',
                    'foto' => $foto_arr,
                    'isi' => $potensi_isi[$idx] ?? '',
                    'manfaat' => array_values($manfaat_arr),
                    'catatan' => $potensi_catatan[$idx] ?? '',
                    'produk' => array_values($produk_arr),
                    'cara' => array_values($cara_arr)
                ];
            }

            Setting::set('data_potensi', json_encode($new_potensi));
        }

        return redirect('/admin/pengaturan')->with('success', 'Pengaturan Beranda berhasil disimpan!');
    }

    // Mendapatkan data default untuk 6 kartu portal
    private function getDefaultCards()
    {
        return [
            [
                'icon' => '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M7 3h8l4 4v14a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z"/><path d="M15 3v4h4"/><path d="M9 12h6M9 16h6M9 8h3"/></svg>',
                'title' => 'Layanan Administrasi',
                'desc' => 'Persyaratan lengkap surat-menyurat desa — domisili, usaha, KTP, KK, hingga surat tidak mampu.',
                'link' => '#modal-layanan'
            ],
            [
                'icon' => '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 21V7l8-4 8 4v14"/><path d="M9 21v-6h6v6M4 21h16"/></svg>',
                'title' => 'Informasi Publik',
                'desc' => 'Struktur organisasi pemerintah desa, anggaran APBDes, kondisi geografis, data demografis, hingga visi & misi.',
                'link' => '/profil-desa'
            ],
            [
                'icon' => '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="7" r="3"/><path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6"/><circle cx="18" cy="8" r="2.2"/><path d="M15.5 20c.3-2.5 2-4.5 4.3-5"/></svg>',
                'title' => 'Struktur Pemerintahan',
                'desc' => 'Kenali Kepala Desa, perangkat desa, dan Kepala Dusun yang melayani warga Munungkerep.',
                'link' => '/profil-desa#pemerintahan'
            ],
            [
                'icon' => '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20.5s-7.5-4.6-9.8-9.2C.6 7.8 2.4 4.5 5.6 4c2-.3 3.9.7 4.9 2.4 1-1.7 2.9-2.7 4.9-2.4 3.2.5 5 3.8 3.4 7.3-2.3 4.6-9.8 9.2-9.8 9.2Z"/></svg>',
                'title' => 'Bantuan Sosial',
                'desc' => 'Lihat rincian APBDes — realisasi tahun berjalan dan rencana anggaran tahun berikutnya, terbuka untuk warga.',
                'link' => '/profil-desa#anggaran'
            ],
            [
                'icon' => '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="8" r="3.2"/><path d="M2.5 20c0-3.6 2.5-6.5 5.5-6.5s5.5 2.9 5.5 6.5"/><path d="M16 21c0-3 2-5.5 4.5-5.5"/><circle cx="18.5" cy="9" r="2.3"/></svg>',
                'title' => 'Data Kependudukan',
                'desc' => 'Statistik jumlah penduduk, KK, usia, dan sarana-prasarana desa berdasarkan data monografi.',
                'link' => '/profil-desa#demografis'
            ],
            [
                'icon' => '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18M8 3v4M16 3v4"/></svg>',
                'title' => 'Event & Kegiatan',
                'desc' => 'Dokumentasi dan informasi kegiatan warga — gotong royong, posyandu, dan agenda desa lainnya.',
                'link' => '/kegiatan'
            ]
        ];
    }
}
