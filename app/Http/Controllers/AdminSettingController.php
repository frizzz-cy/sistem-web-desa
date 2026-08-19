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
        // Ambil data APBDes dinamis dengan auto-seeding default jika kosong
        $data_apbdes_json = Setting::get('data_apbdes');
        if (!$data_apbdes_json) {
            $defaultApbdes = $this->getDefaultApbdes();
            Setting::set('data_apbdes', json_encode($defaultApbdes));
            $data_apbdes = $defaultApbdes;
        } else {
            $data_apbdes = json_decode($data_apbdes_json, true);
        }

        // Ambil data Demografi dinamis dengan auto-seeding default jika kosong
        $data_demografi_json = Setting::get('data_demografi');
        if (!$data_demografi_json) {
            $defaultDemografi = $this->getDefaultDemografi();
            Setting::set('data_demografi', json_encode($defaultDemografi));
            $data_demografi = $defaultDemografi;
        } else {
            $data_demografi = json_decode($data_demografi_json, true);
        }

        return view('admin.pengaturan', compact('slides', 'tentang', 'layanan_cards', 'data_potensi', 'data_perangkat', 'data_apbdes', 'data_demografi'));
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

        // 4. Update Data Perangkat Desa (Organogram)
        if ($request->has('perangkat_keys')) {
            $existing_perangkat_json = Setting::get('data_perangkat');
            $existing_perangkat = $existing_perangkat_json ? json_decode($existing_perangkat_json, true) : $this->getDefaultPerangkat();

            $perangkat_keys = $request->input('perangkat_keys', []);
            $perangkat_jabatan = $request->input('perangkat_jabatan', []);
            $perangkat_nama = $request->input('perangkat_nama', []);
            $perangkat_note = $request->input('perangkat_note', []);

            $new_perangkat = [];

            foreach ($perangkat_keys as $idx => $key) {
                $foto_path = $existing_perangkat[$key]['foto'] ?? '/images/perangkat/avatar.png';
                $fileFieldName = "perangkat_foto_" . $key;
                if ($request->hasFile($fileFieldName)) {
                    $file = $request->file($fileFieldName);
                    $path = ImageHelper::uploadAndCompress($file, 'perangkat');
                    if ($path) {
                        $foto_path = asset('storage/' . $path);
                    }
                }

                $new_perangkat[$key] = [
                    'jabatan' => $perangkat_jabatan[$idx] ?? '',
                    'nama' => $perangkat_nama[$idx] ?? '',
                    'foto' => $foto_path,
                    'note' => $perangkat_note[$idx] ?? ''
                ];
            }

            Setting::set('data_perangkat', json_encode($new_perangkat));
        }

        // 5. Update Potensi Ekonomi Desa
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

        // 6. Update Transparansi APBDes (Anggaran Desa)
        if ($request->has('apbdes')) {
            Setting::set('data_apbdes', json_encode($request->input('apbdes')));
        }

        // 7. Update Statistik Demografi (Kependudukan)
        if ($request->has('demografi')) {
            Setting::set('data_demografi', json_encode($request->input('demografi')));
        }

        return redirect('/admin/pengaturan')->with('success', 'Pengaturan Beranda, APBDes & Demografi Kependudukan berhasil disimpan!');
    }

    // Mendapatkan data default Rincian APBDes & Sumber Dana
    private function getDefaultApbdes()
    {
        return [
            'pendapatan_total' => 'Rp 1.663.629.803,00',
            'pad' => 'Rp 230.760.000,00',
            'dd' => 'Rp 303.093.000,00',
            'add' => 'Rp 376.615.000,00',
            'pdrd' => 'Rp 85.805.300,00',
            'bk' => 'Rp 539.600.603,00',
            'dll' => 'Rp 127.755.900,00',
            'keterangan_pendapatan' => 'Sumber penerimaan APBDes berasal dari Pendapatan Asli Desa (PAD), Dana Desa (DD APBN Pusat), Alokasi Dana Desa (ADD APBD Kab. Jombang), Bagi Hasil Pajak & Retribusi Daerah (PDRD), Bantuan Keuangan (BK Provinsi/Kabupaten), serta Lain-Lain Pendapatan Desa Sah.',

            'belanja_total' => 'Rp 1.676.895.127,92',
            'belanja_pemerintahan' => 'Rp 866.594.524,92',
            'belanja_pembangunan' => 'Rp 582.090.603,00',
            'belanja_pembinaan' => 'Rp 42.450.000,00',
            'belanja_pemberdayaan' => 'Rp 158.000.000,00',
            'belanja_bencana' => 'Rp 27.760.000,00',
            'keterangan_belanja' => 'Pengalokasian anggaran belanja desa diprioritaskan untuk Penyelenggaraan Pemerintahan Desa, Pembangunan Sarana & Prasarana Desa, Pembinaan Kemasyarakatan, Pemberdayaan Masyarakat, serta Penanggulangan Bencana/Darurat.',

            'pembiayaan_total' => 'Rp 13.265.324,92',
            'penerimaan_pembiayaan' => 'Rp 13.265.324,92',
            'pengeluaran_pembiayaan' => 'Rp 0,00',
            'keterangan_pembiayaan' => 'Penerimaan Pembiayaan Netto berasal dari Sisa Lebih Perhitungan Anggaran (SiLPA) tahun anggaran sebelumnya.'
        ];
    }

    // Mendapatkan data default Statistik Demografi Kependudukan
    private function getDefaultDemografi()
    {
        return [
            'total_penduduk' => '2.113',
            'total_kk' => '761',
            'laki_laki' => '1.042',
            'perempuan' => '1.071',
            'usia_balita' => '145',
            'usia_anak' => '312',
            'usia_produktif' => '1.169',
            'usia_pralansia' => '280',
            'usia_lansia' => '207',
            'petani_utama' => '986',
            'buruh_tani' => '457',
            'angkatan_kerja' => '1.169',
            'belum_kerja' => '55',
            'kk_miskin' => '450',
            'kk_sedang' => '300',
            'kk_kaya' => '11',
            'agama_islam' => '2.113',
            'pendidikan_sd' => '542',
            'pendidikan_s1' => '40',
            'ternak_ayam' => '450',
            'ternak_kambing' => '170',
            'ternak_sapi' => '76'
        ];
    }

    // Mendapatkan data default 12 posisi Perangkat Desa (Organogram)
    private function getDefaultPerangkat()
    {
        return [
            'kades' => [
                'jabatan' => 'Kepala Desa',
                'nama' => 'Sutrismi',
                'foto' => '/images/perangkat/kepala desa.png',
                'note' => 'Kepala Desa Munungkerep yang memimpin dan bertanggung jawab atas seluruh penyelenggaraan pemerintahan desa.'
            ],
            'sekdes' => [
                'jabatan' => 'Sekretaris Desa',
                'nama' => 'Siswanto',
                'foto' => '/images/perangkat/siswanto.jpg',
                'note' => 'Sekretaris Desa Munungkerep memimpin Sekretariat Desa dan membantu Kepala Desa dalam bidang administrasi dan pelayanan.'
            ],
            'kasi_kesra' => [
                'jabatan' => 'Kasi Kesra',
                'nama' => 'Rusdi',
                'foto' => '/images/perangkat/rusdi.jpg',
                'note' => 'Kepala Seksi Kesejahteraan Rakyat memimpin kegiatan pembangunan keagamaan, sosial, dan kesejahteraan warga desa.'
            ],
            'kasi_pelayanan' => [
                'jabatan' => 'Kasi Pelayanan',
                'nama' => 'Sugito',
                'foto' => '/images/perangkat/sugito.jpg',
                'note' => 'Kepala Seksi Pelayanan mengelola dan melayani permohonan surat-menyurat serta administrasi kependudukan warga.'
            ],
            'kasi_pemerintahan' => [
                'jabatan' => 'Kasi Pemerintahan',
                'nama' => 'Suyatemo',
                'foto' => '/images/perangkat/suyatemo.jpg',
                'note' => 'Kepala Seksi Pemerintahan mengelola administrasi pertanahan, ketentraman, ketertiban umum, dan tata pamong desa.'
            ],
            'kaur_tu' => [
                'jabatan' => 'Kaur TU & Umum',
                'nama' => 'Suntari',
                'foto' => '/images/perangkat/suntari.jpg',
                'note' => 'Kepala Urusan Tata Usaha & Umum mengelola urusan persuratan, inventaris kekayaan desa, dan operasional balai desa.'
            ],
            'kaur_keuangan' => [
                'jabatan' => 'Kaur Keuangan',
                'nama' => 'Agus Sukisno',
                'foto' => '/images/perangkat/agus-sukisno.jpg',
                'note' => 'Kepala Urusan Keuangan mengelola administrasi pembukuan, penerimaan, dan pengeluaran APBDes Munungkerep.'
            ],
            'kaur_perencanaan' => [
                'jabatan' => 'Kaur Perencanaan',
                'nama' => 'Iskan',
                'foto' => '/images/perangkat/iskan.jpg',
                'note' => 'Kepala Urusan Perencanaan mengelola penyusunan RKPDes, evaluasi pelaksanaan pembangunan, dan pelaporan berkala.'
            ],
            'kasun_1' => [
                'jabatan' => 'Kadus Munungkerep',
                'nama' => 'Juni Hadi',
                'foto' => '/images/perangkat/juni-hadi.jpg',
                'note' => 'Kepala Dusun Munungkerep membina ketentraman dan membantu pelayanan warga di wilayah Dusun Munungkerep.'
            ],
            'kasun_2' => [
                'jabatan' => 'Kadus Karanggebang & Slumbung',
                'nama' => 'Heru Purnadi',
                'foto' => '/images/perangkat/heru-purnadi.jpg',
                'note' => 'Kepala Dusun Karanggebang & Slumbung membina ketentraman dan pelayanan warga di Dusun Karanggebang & Slumbung.'
            ],
            'kasun_3' => [
                'jabatan' => 'Kadus Kadenan & Jatirubuh',
                'nama' => 'Wagimin',
                'foto' => '/images/perangkat/wagimin.jpg',
                'note' => 'Kepala Dusun Kadenan & Jatirubuh membina ketentraman dan pelayanan warga di Dusun Kadenan & Jatirubuh.'
            ],
            'kasun_4' => [
                'jabatan' => 'Kadus Kalipang & Duren',
                'nama' => 'Hartatik',
                'foto' => '/images/perangkat/hartatik.jpg',
                'note' => 'Kepala Dusun Kalipang & Duren membina ketentraman dan pelayanan warga di wilayah Dusun Kalipang & Duren.'
            ]
        ];
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
    }
}
