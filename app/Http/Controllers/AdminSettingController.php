<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    // Redirect rute lama ke sub-modul beranda
    public function index()
    {
        return redirect('/admin/pengaturan/beranda');
    }

    // =========================================================================
    // 1. MODUL PENGATURAN BERANDA (Hero Slides, Tentang Desa, 6 Kartu Portal)
    // =========================================================================
    public function beranda()
    {
        $hero_slides_json = Setting::get('hero_slides');
        if ($hero_slides_json) {
            $slides = json_decode($hero_slides_json, true);
        } else {
            $slides = [
                Setting::get('hero_slide_1', '/images/slider/sdn2.jpeg'),
                Setting::get('hero_slide_2', '/images/slider/tknusa.jpeg'),
                Setting::get('hero_slide_3', '/images/slider/sentra.jpg'),
                Setting::get('hero_slide_4', '/images/carousel/slide-4.jpg'),
            ];
        }

        $tentang = [
            'tentang_p1' => Setting::get('tentang_p1'),
            'tentang_p2' => Setting::get('tentang_p2'),
            'tentang_p3' => Setting::get('tentang_p3'),
        ];

        $layanan_cards_json = Setting::get('layanan_cards');
        $layanan_cards = $layanan_cards_json ? json_decode($layanan_cards_json, true) : $this->getDefaultCards();

        $poster_agendas_raw = Setting::get('poster_agendas');
        $poster_agendas = $poster_agendas_raw ? json_decode($poster_agendas_raw, true) : [];

        return view('admin.pengaturan.beranda', compact('slides', 'tentang', 'layanan_cards', 'poster_agendas'));
    }

    public function updateBeranda(Request $request)
    {
        // Fitur Reset Kartu Layanan ke Default
        if ($request->input('action') === 'reset_cards') {
            Setting::set('layanan_cards', json_encode($this->getDefaultCards()));
            return redirect('/admin/pengaturan/beranda')->with('success', '6 Kartu layanan berhasil dikembalikan ke pengaturan bawaan!');
        }

        // 1. Update Tentang Desa
        Setting::set('tentang_p1', $request->input('tentang_p1'));
        Setting::set('tentang_p2', $request->input('tentang_p2'));
        Setting::set('tentang_p3', $request->input('tentang_p3'));

        // 2. Update Dynamic Slides (Tambah, Hapus, Upload Baru & Kompresi)
        $existing_slides = $request->input('slide_existing', []);
        $slide_keys = $request->input('slide_keys', []);
        $new_slides = [];

        foreach ($slide_keys as $idx => $key) {
            $current_url = $existing_slides[$idx] ?? '';
            $file_input_name = "slide_file_" . $key;

            if ($request->hasFile($file_input_name)) {
                $file = $request->file($file_input_name);
                $path = ImageHelper::uploadAndCompress($file, 'slider');
                if ($path) {
                    $current_url = asset('storage/' . $path);
                }
            }

            if (!empty($current_url)) {
                $new_slides[] = $current_url;
            }
        }

        // Jika user menghapus semua slide sampai kosong, pasang setidaknya 1 fallback
        if (empty($new_slides)) {
            $new_slides = ['/images/slider/sdn2.jpeg'];
        }

        Setting::set('hero_slides', json_encode(array_values($new_slides)));

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

        // 4. Update Poster Perlombaan & Agenda Informasi Publik
        if ($request->has('poster_keys')) {
            $existing_posters_json = Setting::get('poster_agendas');
            $existing_posters = $existing_posters_json ? json_decode($existing_posters_json, true) : [];

            $poster_keys = $request->input('poster_keys', []);
            $poster_judul = $request->input('poster_judul', []);
            $poster_kategori = $request->input('poster_kategori', []);
            $poster_tanggal = $request->input('poster_tanggal', []);
            $poster_waktu = $request->input('poster_waktu', []);
            $poster_lokasi = $request->input('poster_lokasi', []);
            $poster_rincian = $request->input('poster_rincian', []);
            $poster_hadiah = $request->input('poster_hadiah', []);

            $new_posters = [];

            foreach ($poster_keys as $idx => $key) {
                if (empty($poster_judul[$idx]) && empty($key)) continue;
                
                $foto_path = $existing_posters[$key]['foto'] ?? '';
                $fileFieldName = "poster_foto_" . $key;
                if ($request->hasFile($fileFieldName)) {
                    $file = $request->file($fileFieldName);
                    $path = ImageHelper::uploadAndCompress($file, 'posters');
                    if ($path) {
                        $foto_path = asset('storage/' . $path);
                    }
                }

                $new_posters[$key] = [
                    'judul' => $poster_judul[$idx] ?? '',
                    'kategori' => $poster_kategori[$idx] ?? '🏆 Perlombaan Desa',
                    'tanggal' => $poster_tanggal[$idx] ?? '',
                    'waktu' => $poster_waktu[$idx] ?? '',
                    'lokasi' => $poster_lokasi[$idx] ?? '',
                    'rincian' => $poster_rincian[$idx] ?? '',
                    'hadiah' => $poster_hadiah[$idx] ?? '',
                    'foto' => $foto_path
                ];
            }

            Setting::set('poster_agendas', json_encode($new_posters));
        }

        return redirect('/admin/pengaturan/beranda')->with('success', 'Pengaturan Beranda (Hero Slides dinamis, Tentang Desa, Kartu Portal, dan Poster Agenda) berhasil disimpan!');
    }

    // =========================================================================
    // 2. MODUL TRANSPARANSI APBDES (Multi-Tahun & Dynamic Item Boxes)
    // =========================================================================
    public function apbdes()
    {
        $data_apbdes_raw = Setting::get('data_apbdes');
        if (!$data_apbdes_raw) {
            $defaultApbdes = $this->getDefaultApbdes();
            Setting::set('data_apbdes', json_encode($defaultApbdes));
            $data_apbdes = $defaultApbdes;
        } else {
            $decoded = json_decode($data_apbdes_raw, true);
            if (isset($decoded['pendapatan_total'])) {
                $data_apbdes = [
                    '2026' => array_merge(['tahun' => '2026', 'status' => 'Murni (Berjalan)'], $decoded)
                ];
            } else {
                $data_apbdes = $decoded;
            }

            // Normalisasi dynamic items jika belum ada
            foreach ($data_apbdes as $yKey => &$yVal) {
                if (!isset($yVal['pendapatan_items'])) {
                    $yVal['pendapatan_items'] = [
                        ['label' => 'Pendapatan Asli Desa (PAD)', 'sub' => 'Hasil Usaha Desa & Tanah Kas', 'nilai' => $yVal['pad'] ?? 'Rp 230.760.000,00'],
                        ['label' => 'Dana Desa (DD - APBN Pusat)', 'sub' => 'Transfer APBN Pusat', 'nilai' => $yVal['dd'] ?? 'Rp 303.093.000,00'],
                        ['label' => 'Alokasi Dana Desa (ADD - APBD Jombang)', 'sub' => 'Alokasi APBD Kabupaten', 'nilai' => $yVal['add'] ?? 'Rp 376.615.000,00'],
                        ['label' => 'Bagi Hasil Pajak & Retribusi (PDRD)', 'sub' => 'Bagi Hasil Pajak Daerah', 'nilai' => $yVal['pdrd'] ?? 'Rp 85.805.300,00'],
                        ['label' => 'Bantuan Keuangan (BK Provinsi/Kabupaten)', 'sub' => 'Bantuan Khusus Pemda', 'nilai' => $yVal['bk'] ?? 'Rp 539.600.603,00'],
                        ['label' => 'Lain-Lain Pendapatan Desa Sah (DLL)', 'sub' => 'Penerimaan Lain yang Sah', 'nilai' => $yVal['dll'] ?? 'Rp 127.755.900,00']
                    ];
                }
                if (!isset($yVal['belanja_items'])) {
                    $yVal['belanja_items'] = [
                        ['label' => 'Penyelenggaraan Pemerintahan Desa', 'sub' => 'Operasional & Aparatur', 'nilai' => $yVal['belanja_pemerintahan'] ?? 'Rp 866.594.524,92'],
                        ['label' => 'Pelaksanaan Pembangunan Desa', 'sub' => 'Infrastruktur & Sarpras', 'nilai' => $yVal['belanja_pembangunan'] ?? 'Rp 582.090.603,00'],
                        ['label' => 'Pembinaan Kemasyarakatan', 'sub' => 'Kepemudaan & Keagamaan', 'nilai' => $yVal['belanja_pembinaan'] ?? 'Rp 42.450.000,00'],
                        ['label' => 'Pemberdayaan Masyarakat', 'sub' => 'Pelatihan Warga & Kelompok Tani', 'nilai' => $yVal['belanja_pemberdayaan'] ?? 'Rp 158.000.000,00'],
                        ['label' => 'Penanggulangan Bencana & Keadaan Darurat', 'sub' => 'Keadaan Mendesak', 'nilai' => $yVal['belanja_bencana'] ?? 'Rp 27.760.000,00']
                    ];
                }
                if (!isset($yVal['pembiayaan_items'])) {
                    $yVal['pembiayaan_items'] = [
                        ['label' => 'Penerimaan Pembiayaan (SiLPA)', 'sub' => 'Sisa Lebih Perhitungan Anggaran', 'nilai' => $yVal['penerimaan_pembiayaan'] ?? 'Rp 13.265.324,92'],
                        ['label' => 'Pengeluaran Pembiayaan', 'sub' => 'Penyertaan Modal BUMDes', 'nilai' => $yVal['pengeluaran_pembiayaan'] ?? 'Rp 0,00']
                    ];
                }
            }
        }

        return view('admin.pengaturan.apbdes', compact('data_apbdes'));
    }

    public function updateApbdes(Request $request)
    {
        if ($request->has('apbdes_tahun')) {
            $tahuns = $request->input('apbdes_tahun', []);
            $status_list = $request->input('apbdes_status', []);
            $pendapatan_total_list = $request->input('apbdes_pendapatan_total', []);
            $ket_pendapatan_list = $request->input('apbdes_keterangan_pendapatan', []);
            $belanja_total_list = $request->input('apbdes_belanja_total', []);
            $ket_belanja_list = $request->input('apbdes_keterangan_belanja', []);
            $pembiayaan_total_list = $request->input('apbdes_pembiayaan_total', []);
            $ket_pembiayaan_list = $request->input('apbdes_keterangan_pembiayaan', []);

            $new_apbdes = [];
            foreach ($tahuns as $idx => $thn) {
                $thn = trim($thn);
                if (empty($thn)) continue;

                // Pendapatan Items
                $p_labels = $request->input("apbdes_pendapatan_label_{$idx}", []);
                $p_subs = $request->input("apbdes_pendapatan_sub_{$idx}", []);
                $p_values = $request->input("apbdes_pendapatan_nilai_{$idx}", []);
                $pendapatan_items = [];
                foreach ($p_labels as $pIdx => $pLab) {
                    if (!empty(trim($pLab))) {
                        $pendapatan_items[] = [
                            'label' => $pLab,
                            'sub' => trim($p_subs[$pIdx] ?? ''),
                            'nilai' => $p_values[$pIdx] ?? 'Rp 0,00'
                        ];
                    }
                }

                // Belanja Items
                $b_labels = $request->input("apbdes_belanja_label_{$idx}", []);
                $b_subs = $request->input("apbdes_belanja_sub_{$idx}", []);
                $b_values = $request->input("apbdes_belanja_nilai_{$idx}", []);
                $belanja_items = [];
                foreach ($b_labels as $bIdx => $bLab) {
                    if (!empty(trim($bLab))) {
                        $belanja_items[] = [
                            'label' => $bLab,
                            'sub' => trim($b_subs[$bIdx] ?? ''),
                            'nilai' => $b_values[$bIdx] ?? 'Rp 0,00'
                        ];
                    }
                }

                // Pembiayaan Items
                $pb_labels = $request->input("apbdes_pembiayaan_label_{$idx}", []);
                $pb_subs = $request->input("apbdes_pembiayaan_sub_{$idx}", []);
                $pb_values = $request->input("apbdes_pembiayaan_nilai_{$idx}", []);
                $pembiayaan_items = [];
                foreach ($pb_labels as $pbIdx => $pbLab) {
                    if (!empty(trim($pbLab))) {
                        $pembiayaan_items[] = [
                            'label' => $pbLab,
                            'sub' => trim($pb_subs[$pbIdx] ?? ''),
                            'nilai' => $pb_values[$pbIdx] ?? 'Rp 0,00'
                        ];
                    }
                }

                $new_apbdes[$thn] = [
                    'tahun' => $thn,
                    'status' => $status_list[$idx] ?? 'Murni (Tahun Berjalan)',
                    'pendapatan_total' => $pendapatan_total_list[$idx] ?? 'Rp 0,00',
                    'pendapatan_items' => $pendapatan_items,
                    'keterangan_pendapatan' => $ket_pendapatan_list[$idx] ?? '',

                    'belanja_total' => $belanja_total_list[$idx] ?? 'Rp 0,00',
                    'belanja_items' => $belanja_items,
                    'keterangan_belanja' => $ket_belanja_list[$idx] ?? '',

                    'pembiayaan_total' => $pembiayaan_total_list[$idx] ?? 'Rp 0,00',
                    'pembiayaan_items' => $pembiayaan_items,
                    'keterangan_pembiayaan' => $ket_pembiayaan_list[$idx] ?? ''
                ];
            }

            // Urutkan tahun terbaru di atas (descending)
            krsort($new_apbdes);

            Setting::set('data_apbdes', json_encode($new_apbdes));
        }

        return redirect('/admin/pengaturan/apbdes')->with('success', 'Data Transparansi APBDes berhasil diperbarui!');
    }

    // =========================================================================
    // 3. MODUL DATA DEMOGRAFI & MONOGRAFI KEPENDUDUKAN
    // =========================================================================
    public function demografi()
    {
        $data_demografi_json = Setting::get('data_demografi');
        if (!$data_demografi_json) {
            $defaultDemografi = $this->getDefaultDemografi();
            Setting::set('data_demografi', json_encode($defaultDemografi));
            $data_demografi = $defaultDemografi;
        } else {
            $data_demografi = json_decode($data_demografi_json, true);
        }

        return view('admin.pengaturan.demografi', compact('data_demografi'));
    }

    public function updateDemografi(Request $request)
    {
        if ($request->has('demo_pokok_label')) {
            $collectItems = function($labelKey, $nilaiKey) use ($request) {
                $labels = $request->input($labelKey, []);
                $values = $request->input($nilaiKey, []);
                $result = [];
                foreach ($labels as $idx => $lbl) {
                    if (!empty(trim($lbl))) {
                        $result[] = [
                            'label' => $lbl,
                            'nilai' => $values[$idx] ?? ''
                        ];
                    }
                }
                return $result;
            };

            $new_demografi = [
                'pokok' => $collectItems('demo_pokok_label', 'demo_pokok_nilai'),
                'usia' => $collectItems('demo_usia_label', 'demo_usia_nilai'),
                'pekerjaan' => $collectItems('demo_pekerjaan_label', 'demo_pekerjaan_nilai'),
                'kesejahteraan' => $collectItems('demo_kesejahteraan_label', 'demo_kesejahteraan_nilai'),
                'pendidikan_ternak' => $collectItems('demo_pendidikan_ternak_label', 'demo_pendidikan_ternak_nilai')
            ];

            Setting::set('data_demografi', json_encode($new_demografi));
        }

        return redirect('/admin/pengaturan/demografi')->with('success', 'Data Statistik Demografi & Kependudukan berhasil disimpan!');
    }

    // =========================================================================
    // 4. MODUL POTENSI EKONOMI DESA (Tembakau, Pandan, Padi)
    // =========================================================================
    public function potensi()
    {
        $data_potensi_json = Setting::get('data_potensi');
        if (!$data_potensi_json) {
            $defaultPotensi = $this->getDefaultPotensi();
            Setting::set('data_potensi', json_encode($defaultPotensi));
            $data_potensi = $defaultPotensi;
        } else {
            $data_potensi = json_decode($data_potensi_json, true);
        }

        return view('admin.pengaturan.potensi', compact('data_potensi'));
    }

    public function updatePotensi(Request $request)
    {
        if ($request->has('potensi_keys')) {
            $existing_potensi_json = Setting::get('data_potensi');
            $existing_potensi = $existing_potensi_json ? json_decode($existing_potensi_json, true) : $this->getDefaultPotensi();

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
                $mediaFieldName = "potensi_foto_media_" . $key;

                if ($request->hasFile($fileFieldName)) {
                    $file = $request->file($fileFieldName);
                    $path = ImageHelper::uploadAndCompress($file, 'potensi');
                    if ($path) {
                        $foto_arr[0] = asset('storage/' . $path);
                    }
                } elseif ($request->filled($mediaFieldName)) {
                    $foto_arr[0] = $request->input($mediaFieldName);
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

        return redirect('/admin/pengaturan/potensi')->with('success', 'Data Potensi Ekonomi Komoditas Desa berhasil disimpan!');
    }

    // =========================================================================
    // 5. MODUL STRUKTUR PERANGKAT DESA & ORGANOGRAM
    // =========================================================================
    public function perangkat()
    {
        $data_perangkat_json = Setting::get('data_perangkat');
        if (!$data_perangkat_json) {
            $defaultPerangkat = $this->getDefaultPerangkat();
            Setting::set('data_perangkat', json_encode($defaultPerangkat));
            $data_perangkat = $defaultPerangkat;
        } else {
            $data_perangkat = json_decode($data_perangkat_json, true);
        }

        return view('admin.pengaturan.perangkat', compact('data_perangkat'));
    }

    public function updatePerangkat(Request $request)
    {
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
                $mediaFieldName = "perangkat_foto_media_" . $key;

                if ($request->hasFile($fileFieldName)) {
                    $file = $request->file($fileFieldName);
                    $path = ImageHelper::uploadAndCompress($file, 'perangkat');
                    if ($path) {
                        $foto_path = asset('storage/' . $path);
                    }
                } elseif ($request->filled($mediaFieldName)) {
                    $foto_path = $request->input($mediaFieldName);
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

        return redirect('/admin/pengaturan/perangkat')->with('success', 'Bagan Struktur Organisasi & Foto Perangkat Desa berhasil disimpan!');
    }

    // =========================================================================
    // HELPER DATA BAWAAN (DEFAULT SEEDERS)
    // =========================================================================

    private function getDefaultPotensi()
    {
        return [
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
    }

    private function getDefaultApbdes()
    {
        return [
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
    }

    private function getDefaultDemografi()
    {
        return [
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
                ['label' => 'KK Prasejahtera (Miskin)', 'nilai' => '450 KK'],
                ['label' => 'KK Ekonomi Menengah (Sedang)', 'nilai' => '300 KK'],
                ['label' => 'KK Ekonomi Sejahtera (Kaya)', 'nilai' => '11 KK']
            ],
            'pendidikan_ternak' => [
                ['label' => 'Jumlah Agama Islam (Orang)', 'nilai' => '2.113 Orang'],
                ['label' => 'Belum / Tidak Tamat SD (Orang)', 'nilai' => '542 Orang'],
                ['label' => 'Lulusan Sarjana S-1 (Orang)', 'nilai' => '40 Orang'],
                ['label' => 'Populasi Ternak Ayam & Itik (Ekor)', 'nilai' => '450 Ekor'],
                ['label' => 'Populasi Ternak Kambing (Ekor)', 'nilai' => '170 Ekor'],
                ['label' => 'Populasi Ternak Sapi (Ekor)', 'nilai' => '76 Ekor']
            ]
        ];
    }

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
