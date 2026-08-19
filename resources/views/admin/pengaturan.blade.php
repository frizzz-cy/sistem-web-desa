@extends('layouts.admin', ['activePage' => 'pengaturan'])

@section('title', 'Pengaturan Beranda')

@section('styles')
    <style>
        .setting-section {
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            padding: 24px;
            background: #FFF;
            margin-bottom: 30px;
        }
        .section-header {
            font-size: 16px;
            font-weight: 700;
            color: var(--biru-tua);
            margin-top: 0;
            margin-bottom: 20px;
            border-bottom: 2px solid var(--border);
            padding-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .slide-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }
        .slide-card {
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            padding: 16px;
            background: #F8FAFC;
        }
        .slide-img-preview {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 6px;
            margin-bottom: 12px;
            background: #CBD5E1;
            border: 1px solid #DDE3E8;
        }
        
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        .portal-edit-card {
            border: 1px solid #E2E8F0;
            border-radius: 10px;
            padding: 20px;
            background: #F8FAFC;
        }
    </style>
@endsection

@section('content')
    <div class="admin-box">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
            <h1 style="margin: 0; font-size: 24px; color: var(--biru-tua); font-weight: 800;">Pengaturan Halaman Beranda</h1>
            <a href="/" class="btn btn-secondary" target="_blank">Lihat Web Publik</a>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="/admin/pengaturan" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- SECTION 1: HERO SLIDER BACKGROUND -->
            <div class="setting-section">
                <div class="section-header">1. Background Slide Hero Header</div>
                <p style="margin-top:0; margin-bottom:16px; font-size:12.5px; color:var(--teks-muted);">Unggah gambar baru untuk mengganti latar belakang slider beranda desa. Gambar akan otomatis dikompresi agar loading cepat.</p>
                <div class="slide-grid">
                    @for($i = 1; $i <= 4; $i++)
                        @php $slideKey = 'hero_slide_' . $i; @endphp
                        <div class="slide-card">
                            <label style="font-weight:700; font-size:13px; display:block; margin-bottom:8px; color:var(--teks);">Slide Ke-{{ $i }}</label>
                            <img src="{{ $slides[$slideKey] }}" class="slide-img-preview" alt="Preview Slide {{ $i }}">
                            <input type="file" name="{{ $slideKey }}" accept="image/*" style="font-size:12px;">
                        </div>
                    @endfor
                </div>
            </div>

            <!-- SECTION 2: TENTANG DESA -->
            <div class="setting-section">
                <div class="section-header">2. Teks "Tentang Desa" Beranda</div>
                <p style="margin-top:0; margin-bottom:16px; font-size:12.5px; color:var(--teks-muted);">Sesuaikan paragraf deskripsi Mengenal Desa Munungkerep di bagian atas halaman beranda.</p>
                
                <div class="form-group">
                    <label>Paragraf Pertama (Pengenalan Singkat)</label>
                    <textarea name="tentang_p1" rows="3" required placeholder="Tulis paragraf pertama...">{{ old('tentang_p1', $tentang['tentang_p1']) }}</textarea>
                </div>
                
                <div class="form-group">
                    <label>Paragraf Kedua (Kondisi Dusun & Komoditas)</label>
                    <textarea name="tentang_p2" rows="3" required placeholder="Tulis paragraf kedua...">{{ old('tentang_p2', $tentang['tentang_p2']) }}</textarea>
                </div>

                <div class="form-group">
                    <label>Paragraf Ketiga (Ajakan / Penutup)</label>
                    <textarea name="tentang_p3" rows="3" required placeholder="Tulis paragraf ketiga...">{{ old('tentang_p3', $tentang['tentang_p3']) }}</textarea>
                </div>
            </div>

            <!-- SECTION 3: LAYANAN & INFORMASI CARDS -->
            <div class="setting-section">
                <div class="section-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                    <span>3. Kartu Layanan & Informasi (6 Kotak Portal)</span>
                    <button type="submit" name="action" value="reset_cards" class="btn btn-secondary" style="font-size: 11.5px; padding: 6px 12px; background: #FFE4E6; color: #9F1239; border: 1px solid #FECDD3;" onclick="return confirm('Apakah Anda yakin ingin mengembalikan seluruh 6 kartu layanan ke pengaturan bawaan (default)? Semua perubahan pada kartu saat ini akan ditimpa.');">
                        Kembalikan Kartu ke Default
                    </button>
                </div>
                <p style="margin-top:0; margin-bottom:16px; font-size:12.5px; color:var(--teks-muted);">Atur informasi, tautan tujuan, dan ikon SVG pada masing-masing 6 kotak layanan publik.</p>
                
                <div class="card-grid">
                    @foreach($layanan_cards as $index => $card)
                        <div class="portal-edit-card">
                            <div style="background:var(--biru-tua); color:#fff; font-size:11px; font-weight:800; padding:4px 10px; border-radius:4px; display:inline-block; margin-bottom:12px;">KOTAK KE-{{ $index + 1 }}</div>
                            
                            <div class="form-group" style="margin-bottom:12px;">
                                <label style="font-size:12.5px;">Judul Portal</label>
                                <input type="text" name="card_title[]" value="{{ $card['title'] }}" required placeholder="Contoh: Layanan Administrasi">
                            </div>

                            <div class="form-group" style="margin-bottom:12px;">
                                <label style="font-size:12.5px;">Deskripsi Singkat</label>
                                <textarea name="card_desc[]" rows="2" required placeholder="Tulis ringkasan info..." style="width:100%; padding:10px; border:1px solid #DDE3E8; border-radius:6px; font-family:inherit; font-size:14px; box-sizing:border-box;">{{ $card['desc'] }}</textarea>
                            </div>

                            <div class="form-group" style="margin-bottom:12px;">
                                <label style="font-size:12.5px;">Tautan / Link Tujuan (Gunakan <code>#modal-layanan</code> untuk memicu pop-up syarat surat)</label>
                                <input type="text" name="card_link[]" value="{{ $card['link'] }}" required placeholder="Contoh: /profil-desa atau #modal-layanan">
                            </div>

                            <div class="form-group" style="margin-bottom:0;">
                                <label style="font-size:12.5px;">Kode SVG Ikon (Pilih/Salin dari situs SVG seperti Heroicons)</label>
                                <textarea name="card_icon[]" rows="3" required placeholder="Tempel kode <svg>...</svg> disini" style="width:100%; padding:10px; border:1px solid #DDE3E8; border-radius:6px; font-family:monospace; font-size:11px; box-sizing:border-box;">{{ $card['icon'] }}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- SECTION 4: POTENSI EKONOMI DESA -->
            <div class="setting-section">
                <div class="section-header">4. Potensi Ekonomi Desa (Masing-masing Komoditas)</div>
                <p style="margin-top:0; margin-bottom:20px; font-size:12.5px; color:var(--teks-muted);">Sesuaikan isi info detail, gambar, manfaat, produk olahan, dan cara pengolahan untuk komoditas hasil bumi desa.</p>
                
                @foreach(['tembakau' => 'Tembakau', 'pandan' => 'Pandan', 'padi' => 'Padi'] as $key => $label)
                    @php $item = $data_potensi[$key] ?? []; @endphp
                    <div style="border: 1px solid #E2E8F0; border-radius: 8px; padding: 20px; background: #F8FAFC; margin-bottom: 20px;">
                        <div style="background:var(--biru-tua); color:#fff; font-size:12px; font-weight:800; padding:6px 12px; border-radius:4px; display:inline-block; margin-bottom:16px; text-transform:uppercase;">POTENSI: {{ $label }}</div>
                        
                        <input type="hidden" name="potensi_keys[]" value="{{ $key }}">
                        
                        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px; margin-bottom:12px;">
                            <div class="form-group" style="margin-bottom:0;">
                                <label style="font-size:12.5px;">Judul Komoditas</label>
                                <input type="text" name="potensi_judul[]" value="{{ $item['judul'] ?? '' }}" required>
                            </div>
                            <div class="form-group" style="margin-bottom:0;">
                                <label style="font-size:12.5px;">Tag Label</label>
                                <input type="text" name="potensi_tag[]" value="{{ $item['tag'] ?? '' }}" required>
                            </div>
                        </div>

                        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px; margin-bottom:12px;">
                            <div class="form-group" style="margin-bottom:0;">
                                <label style="font-size:12.5px;">Gambar Utama (Kosongkan jika tetap)</label>
                                <input type="file" name="potensi_foto_{{ $key }}" accept="image/*" style="font-size:12px;">
                                @if(!empty($item['foto'][0]))
                                    <div style="margin-top:6px; font-size:11px; color:var(--teks-muted);">
                                        File saat ini: <a href="{{ $item['foto'][0] }}" target="_blank" style="color:var(--biru); text-decoration:underline;">Lihat Gambar</a>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group" style="margin-bottom:0;">
                                <label style="font-size:12.5px;">Catatan Tambahan</label>
                                <input type="text" name="potensi_catatan[]" value="{{ $item['catatan'] ?? '' }}">
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom:12px;">
                            <label style="font-size:12.5px;">Deskripsi / Ringkasan Penjelasan</label>
                            <textarea name="potensi_isi[]" rows="3" required placeholder="Tulis deskripsi penjelasan komoditas...">{{ $item['isi'] ?? '' }}</textarea>
                        </div>

                        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px; margin-bottom:12px;">
                            <div class="form-group" style="margin-bottom:0;">
                                <label style="font-size:12.5px;">Daftar Manfaat (Tulis 1 poin per baris)</label>
                                <textarea name="potensi_manfaat[]" rows="5" required placeholder="Poin 1&#10;Poin 2&#10;Poin 3...">{{ isset($item['manfaat']) ? implode("\n", $item['manfaat']) : '' }}</textarea>
                            </div>
                            <div class="form-group" style="margin-bottom:0;">
                                <label style="font-size:12.5px;">Cara Pengolahan (Tulis 1 langkah per baris)</label>
                                <textarea name="potensi_cara[]" rows="5" required placeholder="Langkah 1&#10;Langkah 2&#10;Langkah 3...">{{ isset($item['cara']) ? implode("\n", $item['cara']) : '' }}</textarea>
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom:0;">
                            <label style="font-size:12.5px;">Daftar Produk Olahan (Pisahkan dengan tanda koma)</label>
                            <input type="text" name="potensi_produk[]" value="{{ isset($item['produk']) ? implode(", ", $item['produk']) : '' }}" placeholder="Contoh: Beras, Tepung Beras, Pakan Ternak" required>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- SECTION 5: PERANGKAT DESA & ORGANOGRAM -->
            <div class="setting-section">
                <div class="section-header">5. Perangkat Desa &amp; Bagan Organogram</div>
                <p style="margin-top:0; margin-bottom:16px; font-size:12.5px; color:var(--teks-muted);">Kelola foto, nama pejabat, jabatan, dan profil singkat 12 posisi Perangkat Desa. Perubahan di sini akan langsung memperbarui bagan susunan organisasi pada halaman Profil Desa secara otomatis.</p>
                
                <div class="card-grid">
                    @foreach($data_perangkat as $key => $item)
                        <div class="portal-edit-card">
                            <input type="hidden" name="perangkat_keys[]" value="{{ $key }}">
                            <div style="display:flex; align-items:center; gap:12px; margin-bottom:14px;">
                                <img src="{{ $item['foto'] ?? '/images/perangkat/avatar.png' }}" style="width:54px; height:54px; border-radius:50%; object-fit:cover; border:2px solid var(--biru-tua);" alt="Foto {{ $item['nama'] }}">
                                <div>
                                    <span style="font-size:11px; font-weight:800; background:#E0F2FE; color:#0369A1; padding:3px 8px; border-radius:4px; text-transform:uppercase;">POSISI: {{ strtoupper($key) }}</span>
                                    <h4 style="margin:4px 0 0; font-size:14px; color:var(--biru-tua);">{{ $item['jabatan'] }}</h4>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <label style="font-size:12px;">Jabatan Resmi</label>
                                <input type="text" name="perangkat_jabatan[]" value="{{ old('perangkat_jabatan.'.$loop->index, $item['jabatan']) }}" required>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <label style="font-size:12px;">Nama Pejabat</label>
                                <input type="text" name="perangkat_nama[]" value="{{ old('perangkat_nama.'.$loop->index, $item['nama']) }}" required>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <label style="font-size:12px;">Upload Foto Pejabat (Opsional)</label>
                                <input type="file" name="perangkat_foto_{{ $key }}" accept="image/*" style="font-size:12px;">
                            </div>

                            <div class="form-group" style="margin-bottom:0;">
                                <label style="font-size:12px;">Profil Singkat / Tugas Utama</label>
                                <textarea name="perangkat_note[]" rows="3" required placeholder="Tulis profil singkat atau deskripsi tugas...">{{ old('perangkat_note.'.$loop->index, $item['note']) }}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- SECTION 5: TRANSPARANSI APBDES & RINCIAN SUMBER DANA -->
            <div class="card" style="margin-bottom:30px;">
                <h3 style="margin-top:0; color:var(--biru-tua); font-size:18px; margin-bottom:6px;">💰 Section 5: Transparansi APBDes &amp; Rincian Sumber Dana</h3>
                <p style="font-size:13px; color:var(--teks-muted); margin-bottom:20px;">Kelola rincian nominal pendapatan, belanja, pembiayaan, serta keterangan asal-usul sumber dana APBDes.</p>

                @php $ap = $data_apbdes ?? []; @endphp

                <!-- 1. PENDAPATAN DESA -->
                <div style="background:#F8FAFC; border:1px solid #CBD5E1; border-radius:8px; padding:16px; margin-bottom:20px;">
                    <h4 style="margin:0 0 12px; font-size:14px; color:#0369A1;">1. Pendapatan Desa &amp; Sumber Dana</h4>
                    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:12px;">
                        <div class="form-group">
                            <label style="font-size:12px;">Total Pendapatan Desa</label>
                            <input type="text" name="apbdes[pendapatan_total]" value="{{ old('apbdes.pendapatan_total', $ap['pendapatan_total'] ?? 'Rp 1.663.629.803,00') }}" required>
                        </div>
                        <div class="form-group">
                            <label style="font-size:12px;">PAD (Pendapatan Asli Desa)</label>
                            <input type="text" name="apbdes[pad]" value="{{ old('apbdes.pad', $ap['pad'] ?? 'Rp 230.760.000,00') }}" required>
                        </div>
                        <div class="form-group">
                            <label style="font-size:12px;">DD (Dana Desa APBN Pusat)</label>
                            <input type="text" name="apbdes[dd]" value="{{ old('apbdes.dd', $ap['dd'] ?? 'Rp 303.093.000,00') }}" required>
                        </div>
                        <div class="form-group">
                            <label style="font-size:12px;">ADD (Alokasi Dana Desa Jombang)</label>
                            <input type="text" name="apbdes[add]" value="{{ old('apbdes.add', $ap['add'] ?? 'Rp 376.615.000,00') }}" required>
                        </div>
                        <div class="form-group">
                            <label style="font-size:12px;">PDRD (Bagi Hasil Pajak &amp; Retribusi)</label>
                            <input type="text" name="apbdes[pdrd]" value="{{ old('apbdes.pdrd', $ap['pdrd'] ?? 'Rp 85.805.300,00') }}" required>
                        </div>
                        <div class="form-group">
                            <label style="font-size:12px;">BK (Bantuan Keuangan Kab/Prov)</label>
                            <input type="text" name="apbdes[bk]" value="{{ old('apbdes.bk', $ap['bk'] ?? 'Rp 539.600.603,00') }}" required>
                        </div>
                        <div class="form-group">
                            <label style="font-size:12px;">DLL (Pendapatan Lain-Lain Sah)</label>
                            <input type="text" name="apbdes[dll]" value="{{ old('apbdes.dll', $ap['dll'] ?? 'Rp 127.755.900,00') }}" required>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <label style="font-size:12px;">Catatan Keterangan Sumber Dana Pendapatan</label>
                        <textarea name="apbdes[keterangan_pendapatan]" rows="2" required placeholder="Jelaskan dari mana saja dana pendapatan desa berasal...">{{ old('apbdes.keterangan_pendapatan', $ap['keterangan_pendapatan'] ?? '') }}</textarea>
                    </div>
                </div>

                <!-- 2. BELANJA DESA -->
                <div style="background:#F8FAFC; border:1px solid #CBD5E1; border-radius:8px; padding:16px; margin-bottom:20px;">
                    <h4 style="margin:0 0 12px; font-size:14px; color:#B91C1C;">2. Belanja Desa &amp; Alokasi</h4>
                    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:12px;">
                        <div class="form-group">
                            <label style="font-size:12px;">Total Belanja Desa</label>
                            <input type="text" name="apbdes[belanja_total]" value="{{ old('apbdes.belanja_total', $ap['belanja_total'] ?? 'Rp 1.676.895.127,92') }}" required>
                        </div>
                        <div class="form-group">
                            <label style="font-size:12px;">Belanja Penyelenggaraan Pemerintahan</label>
                            <input type="text" name="apbdes[belanja_pemerintahan]" value="{{ old('apbdes.belanja_pemerintahan', $ap['belanja_pemerintahan'] ?? 'Rp 866.594.524,92') }}" required>
                        </div>
                        <div class="form-group">
                            <label style="font-size:12px;">Belanja Pembangunan Desa</label>
                            <input type="text" name="apbdes[belanja_pembangunan]" value="{{ old('apbdes.belanja_pembangunan', $ap['belanja_pembangunan'] ?? 'Rp 582.090.603,00') }}" required>
                        </div>
                        <div class="form-group">
                            <label style="font-size:12px;">Belanja Pembinaan Kemasyarakatan</label>
                            <input type="text" name="apbdes[belanja_pembinaan]" value="{{ old('apbdes.belanja_pembinaan', $ap['belanja_pembinaan'] ?? 'Rp 42.450.000,00') }}" required>
                        </div>
                        <div class="form-group">
                            <label style="font-size:12px;">Belanja Pemberdayaan Masyarakat</label>
                            <input type="text" name="apbdes[belanja_pemberdayaan]" value="{{ old('apbdes.belanja_pemberdayaan', $ap['belanja_pemberdayaan'] ?? 'Rp 158.000.000,00') }}" required>
                        </div>
                        <div class="form-group">
                            <label style="font-size:12px;">Belanja Bencana &amp; Darurat</label>
                            <input type="text" name="apbdes[belanja_bencana]" value="{{ old('apbdes.belanja_bencana', $ap['belanja_bencana'] ?? 'Rp 27.760.000,00') }}" required>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <label style="font-size:12px;">Catatan Keterangan Alokasi Belanja</label>
                        <textarea name="apbdes[keterangan_belanja]" rows="2" required placeholder="Jelaskan untuk apa saja alokasi belanja diprioritaskan...">{{ old('apbdes.keterangan_belanja', $ap['keterangan_belanja'] ?? '') }}</textarea>
                    </div>
                </div>

                <!-- 3. PEMBIAYAAN DESA -->
                <div style="background:#F8FAFC; border:1px solid #CBD5E1; border-radius:8px; padding:16px;">
                    <h4 style="margin:0 0 12px; font-size:14px; color:#047857;">3. Pembiayaan Desa (Netto &amp; SiLPA)</h4>
                    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:12px;">
                        <div class="form-group">
                            <label style="font-size:12px;">Total Pembiayaan Netto</label>
                            <input type="text" name="apbdes[pembiayaan_total]" value="{{ old('apbdes.pembiayaan_total', $ap['pembiayaan_total'] ?? 'Rp 13.265.324,92') }}" required>
                        </div>
                        <div class="form-group">
                            <label style="font-size:12px;">Penerimaan Pembiayaan (SiLPA)</label>
                            <input type="text" name="apbdes[penerimaan_pembiayaan]" value="{{ old('apbdes.penerimaan_pembiayaan', $ap['penerimaan_pembiayaan'] ?? 'Rp 13.265.324,92') }}" required>
                        </div>
                        <div class="form-group">
                            <label style="font-size:12px;">Pengeluaran Pembiayaan</label>
                            <input type="text" name="apbdes[pengeluaran_pembiayaan]" value="{{ old('apbdes.pengeluaran_pembiayaan', $ap['pengeluaran_pembiayaan'] ?? 'Rp 0,00') }}" required>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <label style="font-size:12px;">Catatan Keterangan Pembiayaan</label>
                        <textarea name="apbdes[keterangan_pembiayaan]" rows="2" required placeholder="Jelaskan asal usul penerimaan pembiayaan...">{{ old('apbdes.keterangan_pembiayaan', $ap['keterangan_pembiayaan'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- SECTION 6: STATISTIK DEMOGRAFI & KEPENDUDUKAN -->
            <div class="card" style="margin-bottom:30px;">
                <h3 style="margin-top:0; color:var(--biru-tua); font-size:18px; margin-bottom:6px;">📊 Section 6: Statistik Demografi &amp; Kependudukan</h3>
                <p style="font-size:13px; color:var(--teks-muted); margin-bottom:20px;">Sesuaikan angka monografi kependudukan, mata pencaharian, tingkat kesejahteraan, dan peternakan warga.</p>

                @php $dm = $data_demografi ?? []; @endphp

                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:14px;">
                    <!-- Pokok Penduduk -->
                    <div class="form-group">
                        <label style="font-size:12px;">Total Penduduk (Jiwa)</label>
                        <input type="text" name="demografi[total_penduduk]" value="{{ old('demografi.total_penduduk', $dm['total_penduduk'] ?? '2.113') }}" required>
                    </div>
                    <div class="form-group">
                        <label style="font-size:12px;">Total Kepala Keluarga (KK)</label>
                        <input type="text" name="demografi[total_kk]" value="{{ old('demografi.total_kk', $dm['total_kk'] ?? '761') }}" required>
                    </div>
                    <div class="form-group">
                        <label style="font-size:12px;">Penduduk Laki-Laki (Jiwa)</label>
                        <input type="text" name="demografi[laki_laki]" value="{{ old('demografi.laki_laki', $dm['laki_laki'] ?? '1.042') }}" required>
                    </div>
                    <div class="form-group">
                        <label style="font-size:12px;">Penduduk Perempuan (Jiwa)</label>
                        <input type="text" name="demografi[perempuan]" value="{{ old('demografi.perempuan', $dm['perempuan'] ?? '1.071') }}" required>
                    </div>

                    <!-- Kelompok Usia -->
                    <div class="form-group">
                        <label style="font-size:12px;">Usia Balita (0 - 4 Thn)</label>
                        <input type="text" name="demografi[usia_balita]" value="{{ old('demografi.usia_balita', $dm['usia_balita'] ?? '145') }}" required>
                    </div>
                    <div class="form-group">
                        <label style="font-size:12px;">Usia Anak-Anak (5 - 14 Thn)</label>
                        <input type="text" name="demografi[usia_anak]" value="{{ old('demografi.usia_anak', $dm['usia_anak'] ?? '312') }}" required>
                    </div>
                    <div class="form-group">
                        <label style="font-size:12px;">Usia Produktif (15 - 55 Thn)</label>
                        <input type="text" name="demografi[usia_produktif]" value="{{ old('demografi.usia_produktif', $dm['usia_produktif'] ?? '1.169') }}" required>
                    </div>
                    <div class="form-group">
                        <label style="font-size:12px;">Usia Pra-Lansia (56 - 64 Thn)</label>
                        <input type="text" name="demografi[usia_pralansia]" value="{{ old('demografi.usia_pralansia', $dm['usia_pralansia'] ?? '280') }}" required>
                    </div>
                    <div class="form-group">
                        <label style="font-size:12px;">Usia Lansia (65+ Thn)</label>
                        <input type="text" name="demografi[usia_lansia]" value="{{ old('demografi.usia_lansia', $dm['usia_lansia'] ?? '207') }}" required>
                    </div>

                    <!-- Pekerjaan & Ekonomi -->
                    <div class="form-group">
                        <label style="font-size:12px;">Petani Pemilik Lahan Utama</label>
                        <input type="text" name="demografi[petani_utama]" value="{{ old('demografi.petani_utama', $dm['petani_utama'] ?? '986') }}" required>
                    </div>
                    <div class="form-group">
                        <label style="font-size:12px;">Buruh Tani</label>
                        <input type="text" name="demografi[buruh_tani]" value="{{ old('demografi.buruh_tani', $dm['buruh_tani'] ?? '457') }}" required>
                    </div>
                    <div class="form-group">
                        <label style="font-size:12px;">Angkatan Kerja Aktif (15-55 Thn)</label>
                        <input type="text" name="demografi[angkatan_kerja]" value="{{ old('demografi.angkatan_kerja', $dm['angkatan_kerja'] ?? '1.169') }}" required>
                    </div>
                    <div class="form-group">
                        <label style="font-size:12px;">Belum / Dalam Pencarian Kerja</label>
                        <input type="text" name="demografi[belum_kerja]" value="{{ old('demografi.belum_kerja', $dm['belum_kerja'] ?? '55') }}" required>
                    </div>

                    <!-- Kesejahteraan KK -->
                    <div class="form-group">
                        <label style="font-size:12px;">KK Prasejahtera (Miskin)</label>
                        <input type="text" name="demografi[kk_miskin]" value="{{ old('demografi.kk_miskin', $dm['kk_miskin'] ?? '450') }}" required>
                    </div>
                    <div class="form-group">
                        <label style="font-size:12px;">KK Ekonomi Menengah (Sedang)</label>
                        <input type="text" name="demografi[kk_sedang]" value="{{ old('demografi.kk_sedang', $dm['kk_sedang'] ?? '300') }}" required>
                    </div>
                    <div class="form-group">
                        <label style="font-size:12px;">KK Ekonomi Sejahtera (Kaya)</label>
                        <input type="text" name="demografi[kk_kaya]" value="{{ old('demografi.kk_kaya', $dm['kk_kaya'] ?? '11') }}" required>
                    </div>

                    <!-- Pendidikan & Peternakan -->
                    <div class="form-group">
                        <label style="font-size:12px;">Jumlah Agama Islam (Orang)</label>
                        <input type="text" name="demografi[agama_islam]" value="{{ old('demografi.agama_islam', $dm['agama_islam'] ?? '2.113') }}" required>
                    </div>
                    <div class="form-group">
                        <label style="font-size:12px;">Belum / Tidak Tamat SD (Orang)</label>
                        <input type="text" name="demografi[pendidikan_sd]" value="{{ old('demografi.pendidikan_sd', $dm['pendidikan_sd'] ?? '542') }}" required>
                    </div>
                    <div class="form-group">
                        <label style="font-size:12px;">Lulusan Sarjana S-1 (Orang)</label>
                        <input type="text" name="demografi[pendidikan_s1]" value="{{ old('demografi.pendidikan_s1', $dm['pendidikan_s1'] ?? '40') }}" required>
                    </div>
                    <div class="form-group">
                        <label style="font-size:12px;">Populasi Ternak Ayam &amp; Itik (Ekor)</label>
                        <input type="text" name="demografi[ternak_ayam]" value="{{ old('demografi.ternak_ayam', $dm['ternak_ayam'] ?? '450') }}" required>
                    </div>
                    <div class="form-group">
                        <label style="font-size:12px;">Populasi Ternak Kambing (Ekor)</label>
                        <input type="text" name="demografi[ternak_kambing]" value="{{ old('demografi.ternak_kambing', $dm['ternak_kambing'] ?? '170') }}" required>
                    </div>
                    <div class="form-group">
                        <label style="font-size:12px;">Populasi Ternak Sapi (Ekor)</label>
                        <input type="text" name="demografi[ternak_sapi]" value="{{ old('demografi.ternak_sapi', $dm['ternak_sapi'] ?? '76') }}" required>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div style="display:flex; justify-content:flex-end; gap:10px; margin-bottom:40px;">
                <a href="/admin/dashboard" class="btn btn-secondary">Batal</a>
                <button type="submit" id="btn-simpan" class="btn btn-primary">Simpan Pengaturan</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <!-- Script Prevent Double Submit -->
    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            // Jangan tampilkan spinner simpan jika tombol reset diklik
            const clickedBtn = document.activeElement;
            if (clickedBtn && clickedBtn.value === 'reset_cards') {
                return;
            }

            const submitBtn = document.getElementById('btn-simpan');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'Menyimpan...';
                submitBtn.style.opacity = '0.7';
                submitBtn.style.cursor = 'not-allowed';
            }
        });
    </script>
@endsection
