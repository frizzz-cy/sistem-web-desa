<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AdminBeritaController;
use App\Http\Controllers\AdminKegiatanController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminMediaController;
use App\Http\Controllers\AdminSettingController;
use App\Models\Berita;
use App\Models\Kegiatan;
use App\Models\Setting;

// Halaman Publik
Route::get('/', function () { 
    $beritas = Berita::latest()->get();
    
    $hero_slides = [
        Setting::get('hero_slide_1', '/images/slider/sdn2.jpeg'),
        Setting::get('hero_slide_2', '/images/slider/tknusa.jpeg'),
        Setting::get('hero_slide_3', '/images/slider/sentra.jpg'),
        Setting::get('hero_slide_4', '/images/carousel/slide-4.jpg'),
    ];

    $tentang = [
        Setting::get('tentang_p1', 'Desa Munungkerep merupakan salah satu desa di Kecamatan Kabuh, Kabupaten Jombang, Jawa Timur, yang berada di kawasan dataran tinggi dengan kondisi tanah kering pada musim kemarau.'),
        Setting::get('tentang_p2', 'Desa ini terdiri dari 7 dusun Munungkerep, Karanggebang, Duren, Slumbung, Kalipang, Kadenan, dan Jatirubuh dengan mayoritas warga berprofesi sebagai petani. Tembakau menjadi komoditas unggulan yang ditanam warga saat musim kemarau, didampingi pandan sebagai komoditas pendukung yang tumbuh merata di seluruh wilayah desa.'),
        Setting::get('tentang_p3', 'Melalui portal ini, kami berupaya menghadirkan informasi desa secara terbuka — mulai dari peta wilayah, potensi ekonomi, struktur pemerintahan, hingga data profil desa agar mudah diakses oleh warga dan masyarakat umum.'),
    ];

    $default_cards = [
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
            'icon' => '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
            'title' => 'Kelembagaan Desa',
            'desc' => 'Organisasi aktif kemasyarakatan — BPD, PKK Dharma Wanita, Karang Taruna, Remaja Masjid, hingga Posyandu.',
            'link' => '#modal-kelembagaan'
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
    ];

    $layanan_cards_json = Setting::get('layanan_cards');
    $layanan_cards = $layanan_cards_json ? json_decode($layanan_cards_json, true) : $default_cards;
    if (!empty($layanan_cards)) {
        foreach ($layanan_cards as &$card) {
            if (isset($card['title']) && $card['title'] === 'Anggaran Desa') {
                $card['title'] = 'Kelembagaan Desa';
                $card['link'] = '#modal-kelembagaan';
            }
        }
    }

    $default_apbdes = [
        '2026' => [
            'tahun' => '2026',
            'status' => 'Murni (Tahun Berjalan)',
            'pendapatan_total' => 'Rp 1.663.629.803,00',
            'pendapatan_items' => [
                ['label' => 'Pendapatan Asli Desa (PAD)', 'sub' => 'Hasil Usaha Desa, Tanah Kas Desa, dan Swadaya Masyarakat', 'nilai' => 'Rp 230.760.000,00'],
                ['label' => 'Dana Desa (DD - APBN Pusat)', 'sub' => 'Dana Transfer APBN dari Pemerintah Pusat', 'nilai' => 'Rp 303.093.000,00'],
                ['label' => 'Alokasi Dana Desa (ADD - APBD Jombang)', 'sub' => 'Alokasi Dana Desa dari APBD Kabupaten Jombang', 'nilai' => 'Rp 376.615.000,00'],
                ['label' => 'Bagi Hasil Pajak & Retribusi (PDRD)', 'sub' => 'Bagi Hasil Pajak Daerah dan Retribusi Daerah', 'nilai' => 'Rp 85.805.300,00'],
                ['label' => 'Bantuan Keuangan (BK Provinsi/Kabupaten)', 'sub' => 'Bantuan Keuangan Khusus Provinsi & Kabupaten', 'nilai' => 'Rp 539.600.603,00'],
                ['label' => 'Lain-Lain Pendapatan Desa Sah (DLL)', 'sub' => 'Penerimaan lain-lain desa yang sah', 'nilai' => 'Rp 127.755.900,00']
            ],
            'keterangan_pendapatan' => 'Sumber penerimaan APBDes 2026 berasal dari Pendapatan Asli Desa (PAD), Dana Desa (DD APBN Pusat), Alokasi Dana Desa (ADD APBD Kab. Jombang), Bagi Hasil Pajak & Retribusi Daerah (PDRD), Bantuan Keuangan (BK Provinsi/Kabupaten), serta Lain-Lain Pendapatan Desa Sah.',
            'belanja_total' => 'Rp 1.676.895.127,92',
            'belanja_items' => [
                ['label' => 'Penyelenggaraan Pemerintahan Desa', 'sub' => 'Penghasilan tetap, operasional kantor desa, dan BPD', 'nilai' => 'Rp 866.594.524,92'],
                ['label' => 'Pelaksanaan Pembangunan Desa', 'sub' => 'Pembangunan sarana prasarana, jalan usaha tani, dan drainase', 'nilai' => 'Rp 582.090.603,00'],
                ['label' => 'Pembinaan Kemasyarakatan', 'sub' => 'Kegiatan kepemudaan, keagamaan, dan seni budaya', 'nilai' => 'Rp 42.450.000,00'],
                ['label' => 'Pemberdayaan Masyarakat', 'sub' => 'Pelatihan kelompok tani, PKK, dan UMKM desa', 'nilai' => 'Rp 158.000.000,00'],
                ['label' => 'Penanggulangan Bencana & Keadaan Darurat', 'sub' => 'Penanganan tanggap darurat dan kejadian mendesak', 'nilai' => 'Rp 27.760.000,00']
            ],
            'keterangan_belanja' => 'Pengalokasian anggaran belanja desa diprioritaskan untuk Penyelenggaraan Pemerintahan Desa, Pembangunan Sarana & Prasarana Desa, Pembinaan Kemasyarakatan, Pemberdayaan Masyarakat, serta Penanggulangan Bencana/Darurat.',
            'pembiayaan_total' => 'Rp 13.265.324,92',
            'pembiayaan_items' => [
                ['label' => 'Penerimaan Pembiayaan (SiLPA)', 'sub' => 'Sisa Lebih Perhitungan Anggaran tahun anggaran sebelumnya', 'nilai' => 'Rp 13.265.324,92'],
                ['label' => 'Pengeluaran Pembiayaan', 'sub' => 'Penyertaan modal BUMDes dan dana cadangan', 'nilai' => 'Rp 0,00']
            ],
            'keterangan_pembiayaan' => 'Penerimaan Pembiayaan Netto berasal dari Sisa Lebih Perhitungan Anggaran (SiLPA) tahun anggaran sebelumnya.'
        ],
        '2025' => [
            'tahun' => '2025',
            'status' => 'Laporan Realisasi / LPJ',
            'pendapatan_total' => 'Rp 1.540.210.000,00',
            'pendapatan_items' => [
                ['label' => 'Pendapatan Asli Desa (PAD)', 'sub' => 'Realisasi Pendapatan Asli Desa', 'nilai' => 'Rp 210.500.000,00'],
                ['label' => 'Dana Desa (DD - APBN Pusat)', 'sub' => 'Realisasi Dana Desa APBN', 'nilai' => 'Rp 295.000.000,00'],
                ['label' => 'Alokasi Dana Desa (ADD - APBD Jombang)', 'sub' => 'Realisasi ADD Kabupaten Jombang', 'nilai' => 'Rp 360.200.000,00'],
                ['label' => 'Bagi Hasil Pajak & Retribusi (PDRD)', 'sub' => 'Realisasi PDRD Daerah', 'nilai' => 'Rp 78.510.000,00'],
                ['label' => 'Bantuan Keuangan (BK Provinsi/Kabupaten)', 'sub' => 'Realisasi Bantuan Keuangan', 'nilai' => 'Rp 480.000.000,00'],
                ['label' => 'Lain-Lain Pendapatan Desa Sah (DLL)', 'sub' => 'Realisasi pendapatan sah lainnya', 'nilai' => 'Rp 116.000.000,00']
            ],
            'keterangan_pendapatan' => 'Realisasi penerimaan APBDes Tahun Anggaran 2025 dari seluruh pos pendapatan sah.',
            'belanja_total' => 'Rp 1.535.100.000,00',
            'belanja_items' => [
                ['label' => 'Penyelenggaraan Pemerintahan Desa', 'sub' => 'Realisasi operasional dan aparatur desa', 'nilai' => 'Rp 790.000.000,00'],
                ['label' => 'Pelaksanaan Pembangunan Desa', 'sub' => 'Realisasi infrastruktur & sarpras', 'nilai' => 'Rp 530.000.000,00'],
                ['label' => 'Pembinaan Kemasyarakatan', 'sub' => 'Realisasi pembinaan kemasyarakatan', 'nilai' => 'Rp 38.500.000,00'],
                ['label' => 'Pemberdayaan Masyarakat', 'sub' => 'Realisasi pemberdayaan warga & UMKM', 'nilai' => 'Rp 151.600.000,00'],
                ['label' => 'Penanggulangan Bencana & Keadaan Darurat', 'sub' => 'Realisasi penanganan keadaan darurat', 'nilai' => 'Rp 25.000.000,00']
            ],
            'keterangan_belanja' => 'Realisasi belanja APBDes Tahun Anggaran 2025 untuk pembangunan dan pelayanan masyarakat.',
            'pembiayaan_total' => 'Rp 5.110.000,00',
            'pembiayaan_items' => [
                ['label' => 'Penerimaan Pembiayaan (SiLPA)', 'sub' => 'Sisa Lebih Perhitungan Anggaran tahun 2024', 'nilai' => 'Rp 5.110.000,00'],
                ['label' => 'Pengeluaran Pembiayaan', 'sub' => 'Pengeluaran pembiayaan modal desa', 'nilai' => 'Rp 0,00']
            ],
            'keterangan_pembiayaan' => 'Sisa Lebih Perhitungan Anggaran (SiLPA) Tahun Anggaran 2025.'
        ]
    ];

    $apbdes_raw = Setting::get('data_apbdes');
    if ($apbdes_raw) {
        $decoded = json_decode($apbdes_raw, true);
        if (isset($decoded['pendapatan_total'])) {
            $apbdes = ['2026' => array_merge(['tahun' => '2026', 'status' => 'Murni (Tahun Berjalan)'], $decoded)];
        } else {
            $apbdes = $decoded;
        }
    } else {
        $apbdes = $default_apbdes;
    }

    $default_demografi = [
        'pokok' => [
            ['label' => 'Total Penduduk (Jiwa)', 'nilai' => '2.113'],
            ['label' => 'Total Kepala Keluarga (KK)', 'nilai' => '761'],
            ['label' => 'Penduduk Laki-Laki (Jiwa)', 'nilai' => '1.042'],
            ['label' => 'Penduduk Perempuan (Jiwa)', 'nilai' => '1.071']
        ],
        'usia' => [
            ['label' => 'Usia Balita (0 – 4 Tahun)', 'nilai' => '145 Orang'],
            ['label' => 'Usia Anak-Anak (5 – 14 Tahun)', 'nilai' => '312 Orang'],
            ['label' => 'Usia Produktif / Angkatan Kerja (15 – 55 Tahun)', 'nilai' => '1.169 Orang'],
            ['label' => 'Usia Dewasa / Pra-Lansia (56 – 64 Tahun)', 'nilai' => '280 Orang'],
            ['label' => 'Usia Lansia (65+ Tahun)', 'nilai' => '207 Orang']
        ],
        'pekerjaan' => [
            ['label' => 'Petani Pemilik Lahan Utama', 'nilai' => '986 Orang'],
            ['label' => 'Buruh Tani', 'nilai' => '457 Orang'],
            ['label' => 'Total Angkatan Kerja Aktif (Usia 15-55 Thn)', 'nilai' => '1.169 Orang'],
            ['label' => 'Belum / Dalam Pencarian Kerja', 'nilai' => '55 Orang']
        ],
        'kesejahteraan' => [
            ['label' => 'Masyarakat Ekonomi Prasejahtera (Miskin)', 'nilai' => '450 KK'],
            ['label' => 'Masyarakat Ekonomi Menengah (Sedang)', 'nilai' => '300 KK'],
            ['label' => 'Masyarakat Ekonomi Sejahtera (Kaya)', 'nilai' => '11 KK']
        ],
        'pendidikan_ternak' => [
            ['label' => 'Populasi Ternak Ayam & Itik', 'nilai' => '450 Ekor'],
            ['label' => 'Populasi Ternak Kambing', 'nilai' => '170 Ekor'],
            ['label' => 'Populasi Ternak Sapi', 'nilai' => '76 Ekor'],
            ['label' => 'Agama Warga', 'nilai' => 'Islam (100% / 2.113 Orang)'],
            ['label' => 'Rentang Pendidikan Tidak / Belum Tamat SD', 'nilai' => '542 Orang'],
            ['label' => 'Lulusan Sarjana / Perguruan Tinggi (S-1)', 'nilai' => '40 Orang']
        ]
    ];

    $demografi_json = Setting::get('data_demografi');
    $demografi = $demografi_json ? json_decode($demografi_json, true) : $default_demografi;

    return view('beranda', compact('beritas', 'hero_slides', 'tentang', 'layanan_cards', 'apbdes', 'demografi')); 
});
Route::get('/berita/{berita}/view', function (Berita $berita) {
    $berita->increment('views');
    return response()->json(['views' => $berita->views]);
});
Route::get('/peta', function () { 
    $data_potensi_json = Setting::get('data_potensi');
    if (!$data_potensi_json) {
        $data_potensi = [
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
    } else {
        $data_potensi = json_decode($data_potensi_json, true);
    }
    return view('home', compact('data_potensi'));
});
Route::get('/profil-desa', function () { 
    $perangkat_json = Setting::get('data_perangkat');
    $perangkat = $perangkat_json ? json_decode($perangkat_json, true) : [];
    return view('profil-desa', compact('perangkat')); 
});
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
    Route::get('/', [AdminDashboardController::class, 'index']);
    Route::get('dashboard', [AdminDashboardController::class, 'index']);

    Route::resource('produk', AdminProdukController::class);
    
    Route::post('berita/upload-image', [AdminBeritaController::class, 'uploadImage']);
    Route::resource('berita', AdminBeritaController::class)->parameters(['berita' => 'berita']);
    
    Route::resource('kegiatan', AdminKegiatanController::class);
    
    Route::resource('user', AdminUserController::class);
    
    Route::get('media', [AdminMediaController::class, 'index']);
    Route::post('media', [AdminMediaController::class, 'store']);
    Route::delete('media', [AdminMediaController::class, 'destroy']);

    Route::get('pengaturan', [AdminSettingController::class, 'index']);
    Route::post('pengaturan', [AdminSettingController::class, 'update']);
});