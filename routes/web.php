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
    $beritas = Berita::latest()->take(3)->get();
    
    $hero_slides = [
        Setting::get('hero_slide_1', '/images/slider/sdn2.jpeg'),
        Setting::get('hero_slide_2', '/images/slider/tknusa.jpeg'),
        Setting::get('hero_slide_3', '/images/slider/sentra.jpg'),
        Setting::get('hero_slide_4', '/images/carousel/slide-4.jpg'),
    ];

    $tentang = [
        Setting::get('tentang_p1'),
        Setting::get('tentang_p2'),
        Setting::get('tentang_p3'),
    ];

    $layanan_cards_json = Setting::get('layanan_cards');
    $layanan_cards = $layanan_cards_json ? json_decode($layanan_cards_json, true) : [];
    if (!empty($layanan_cards)) {
        foreach ($layanan_cards as &$card) {
            if (isset($card['title']) && ($card['title'] === 'Informasi Publik' || $card['link'] === '#modal-informasi')) {
                $card['desc'] = 'Transparansi APBDes dan rincian anggaran.';
            }
            if (isset($card['title']) && ($card['title'] === 'Anggaran Desa' || $card['title'] === 'Kelembagaan Desa')) {
                $card['title'] = 'Kelembagaan Desa';
                $card['desc'] = 'Organisasi aktif kemasyarakatan — BPD, PKK Dharma Wanita, Karang Taruna, Remaja Masjid, hingga Posyandu.';
                $card['link'] = '#modal-kelembagaan';
                $card['icon'] = '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>';
            }
            if (isset($card['title']) && $card['title'] === 'Data Kependudukan') {
                $card['link'] = '#modal-demografi';
            }
        }
    }

    return view('beranda', compact('beritas', 'hero_slides', 'tentang', 'layanan_cards')); 
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
Route::get('/profil-desa', function () { return view('profil-desa'); });
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