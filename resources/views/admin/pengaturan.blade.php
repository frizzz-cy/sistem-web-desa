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

            <!-- SECTION 5: TRANSPARANSI APBDES (REKAP MULTI-TAHUN) -->
            <div class="setting-section">
                <div class="section-header" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:8px;">
                    <span>💰 Section 5: Transparansi APBDes (Rekap Multi-Tahun)</span>
                    <button type="button" class="btn btn-secondary" onclick="tambahTahunApbdes()" style="font-size:12px; padding:6px 12px; background:#E0F2FE; color:#0369A1; border:1px solid #BAE6FD;">
                        + Tambah Tahun Anggaran Baru
                    </button>
                </div>
                <p style="margin-top:0; margin-bottom:16px; font-size:12.5px; color:var(--teks-muted);">Kelola data rincian APBDes untuk setiap tahun anggaran. Anda dapat menambah atau mengurangi kotak pos anggaran secara bebas menggunakan tombol tambah (+).</p>

                <div id="apbdes-years-container" style="display:flex; flex-direction:column; gap:24px;">
                    @php $ap_list = $data_apbdes ?? []; @endphp
                    @foreach($ap_list as $thnKey => $ap)
                        @php $yearIdx = $loop->index; @endphp
                        <div class="apbdes-year-card" data-year-idx="{{ $yearIdx }}" style="border: 1.5px solid #CBD5E1; border-radius: 12px; padding: 20px; background: #F8FAFC; position: relative;">
                            <!-- Header Tahun -->
                            <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px; margin-bottom:16px; border-bottom:1px solid #E2E8F0; padding-bottom:12px;">
                                <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                                    <span style="background:var(--biru-tua); color:#fff; font-size:12px; font-weight:800; padding:4px 10px; border-radius:6px; letter-spacing:0.5px;">TAHUN ANGGARAN</span>
                                    <input type="text" name="apbdes_tahun[]" value="{{ $ap['tahun'] ?? $thnKey }}" style="width:100px; font-weight:800; font-size:15px; text-align:center; padding:5px 8px; border:1.5px solid #94A3B8; border-radius:6px; background:#FFF;" required placeholder="Contoh: 2026">
                                    
                                    <select name="apbdes_status[]" style="font-size:12.5px; padding:6px 10px; border-radius:6px; border:1px solid #CBD5E1; font-weight:600; background:#FFF; color:#334155;">
                                        <option value="Murni (Tahun Berjalan)" {{ ($ap['status'] ?? '') === 'Murni (Tahun Berjalan)' || ($ap['status'] ?? '') === 'Murni (Berjalan)' ? 'selected' : '' }}>🟢 Murni (Tahun Berjalan)</option>
                                        <option value="Laporan Realisasi / LPJ" {{ ($ap['status'] ?? '') === 'Laporan Realisasi / LPJ' ? 'selected' : '' }}>🔵 Laporan Realisasi / LPJ</option>
                                        <option value="Perubahan (P-APBDes)" {{ ($ap['status'] ?? '') === 'Perubahan (P-APBDes)' ? 'selected' : '' }}>🟠 Perubahan (P-APBDes)</option>
                                    </select>
                                </div>
                                <button type="button" onclick="hapusTahunApbdes(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; padding:6px 12px; font-size:12px; font-weight:700; cursor:pointer;">
                                    Hapus Tahun Ini
                                </button>
                            </div>

                            <!-- 1. PENDAPATAN DESA -->
                            <div style="background:#FFF; border:1px solid #BAE6FD; border-left:4px solid #0284C7; border-radius:8px; padding:16px; margin-bottom:16px;">
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; flex-wrap:wrap; gap:8px;">
                                    <h4 style="margin:0; font-size:14px; color:#0369A1;">1. Pendapatan Desa &amp; Sumber Dana</h4>
                                    <button type="button" onclick="tambahItemBox('pendapatan', {{ $yearIdx }})" style="font-size:11.5px; padding:4px 10px; background:#E0F2FE; color:#0369A1; border:1px solid #BAE6FD; border-radius:6px; font-weight:700; cursor:pointer;">
                                        + Tambah Pos Pendapatan
                                    </button>
                                </div>

                                <div class="form-group" style="margin-bottom:12px;">
                                    <label style="font-size:12px; font-weight:700; color:#0369A1;">Total Pendapatan Desa (Header Total)</label>
                                    <input type="text" name="apbdes_pendapatan_total[]" value="{{ $ap['pendapatan_total'] ?? 'Rp 0,00' }}" required>
                                </div>

                                <div class="item-boxes-container" id="container-pendapatan-{{ $yearIdx }}" style="display:flex; flex-direction:column; gap:8px; margin-bottom:12px;">
                                    @php $p_items = $ap['pendapatan_items'] ?? []; @endphp
                                    @foreach($p_items as $item)
                                        <div class="dynamic-item-row" style="background:#FFF; border:1px solid #E2E8F0; border-radius:8px; padding:10px 12px;">
                                            <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px;">
                                                <input type="text" name="apbdes_pendapatan_label_{{ $yearIdx }}[]" value="{{ $item['label'] ?? '' }}" placeholder="Nama Pos Utama (Tulisan Besar)" style="flex:2; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:600;" required>
                                                <input type="text" name="apbdes_pendapatan_nilai_{{ $yearIdx }}[]" value="{{ $item['nilai'] ?? '' }}" placeholder="Nominal (misal: Rp 0,00)" style="flex:1.5; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:700;" required>
                                                <button type="button" onclick="hapusItemBox(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; width:34px; height:34px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-weight:700;">✕</button>
                                            </div>
                                            <div style="display:flex; align-items:center; gap:6px;">
                                                <span style="font-size:11px; color:#64748B; font-weight:700; white-space:nowrap;">↳ Sub-keterangan (opsional):</span>
                                                <input type="text" name="apbdes_pendapatan_sub_{{ $yearIdx }}[]" value="{{ $item['sub'] ?? '' }}" placeholder="Tulisan kecil di bawah judul (opsional / boleh dikosongkan)" style="flex:1; font-size:11.5px; padding:5px 8px; border:1px dashed #CBD5E1; border-radius:4px; color:#475569; background:#FAFAFA;">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group" style="margin-bottom:0;">
                                    <label style="font-size:12px;">Catatan Keterangan Sumber Dana Pendapatan</label>
                                    <textarea name="apbdes_keterangan_pendapatan[]" rows="2" required placeholder="Jelaskan dari mana saja dana pendapatan desa berasal...">{{ $ap['keterangan_pendapatan'] ?? '' }}</textarea>
                                </div>
                            </div>

                            <!-- 2. BELANJA DESA -->
                            <div style="background:#FFF; border:1px solid #FECACA; border-left:4px solid #EF4444; border-radius:8px; padding:16px; margin-bottom:16px;">
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; flex-wrap:wrap; gap:8px;">
                                    <h4 style="margin:0; font-size:14px; color:#B91C1C;">2. Belanja Desa &amp; Alokasi Bidang</h4>
                                    <button type="button" onclick="tambahItemBox('belanja', {{ $yearIdx }})" style="font-size:11.5px; padding:4px 10px; background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; font-weight:700; cursor:pointer;">
                                        + Tambah Pos Belanja
                                    </button>
                                </div>

                                <div class="form-group" style="margin-bottom:12px;">
                                    <label style="font-size:12px; font-weight:700; color:#B91C1C;">Total Belanja Desa (Header Total)</label>
                                    <input type="text" name="apbdes_belanja_total[]" value="{{ $ap['belanja_total'] ?? 'Rp 0,00' }}" required>
                                </div>

                                <div class="item-boxes-container" id="container-belanja-{{ $yearIdx }}" style="display:flex; flex-direction:column; gap:8px; margin-bottom:12px;">
                                    @php $b_items = $ap['belanja_items'] ?? []; @endphp
                                    @foreach($b_items as $item)
                                        <div class="dynamic-item-row" style="background:#FFF; border:1px solid #E2E8F0; border-radius:8px; padding:10px 12px;">
                                            <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px;">
                                                <input type="text" name="apbdes_belanja_label_{{ $yearIdx }}[]" value="{{ $item['label'] ?? '' }}" placeholder="Nama Pos Belanja (Tulisan Besar)" style="flex:2; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:600;" required>
                                                <input type="text" name="apbdes_belanja_nilai_{{ $yearIdx }}[]" value="{{ $item['nilai'] ?? '' }}" placeholder="Nominal (misal: Rp 0,00)" style="flex:1.5; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:700;" required>
                                                <button type="button" onclick="hapusItemBox(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; width:34px; height:34px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-weight:700;">✕</button>
                                            </div>
                                            <div style="display:flex; align-items:center; gap:6px;">
                                                <span style="font-size:11px; color:#64748B; font-weight:700; white-space:nowrap;">↳ Sub-keterangan (opsional):</span>
                                                <input type="text" name="apbdes_belanja_sub_{{ $yearIdx }}[]" value="{{ $item['sub'] ?? '' }}" placeholder="Tulisan kecil di bawah judul (opsional / boleh dikosongkan)" style="flex:1; font-size:11.5px; padding:5px 8px; border:1px dashed #CBD5E1; border-radius:4px; color:#475569; background:#FAFAFA;">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group" style="margin-bottom:0;">
                                    <label style="font-size:12px;">Catatan Keterangan Alokasi Belanja</label>
                                    <textarea name="apbdes_keterangan_belanja[]" rows="2" required placeholder="Jelaskan untuk apa saja alokasi belanja diprioritaskan...">{{ $ap['keterangan_belanja'] ?? '' }}</textarea>
                                </div>
                            </div>

                            <!-- 3. PEMBIAYAAN DESA -->
                            <div style="background:#FFF; border:1px solid #A7F3D0; border-left:4px solid #10B981; border-radius:8px; padding:16px;">
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; flex-wrap:wrap; gap:8px;">
                                    <h4 style="margin:0; font-size:14px; color:#047857;">3. Pembiayaan Desa (Netto &amp; SiLPA)</h4>
                                    <button type="button" onclick="tambahItemBox('pembiayaan', {{ $yearIdx }})" style="font-size:11.5px; padding:4px 10px; background:#D1FAE5; color:#047857; border:1px solid #A7F3D0; border-radius:6px; font-weight:700; cursor:pointer;">
                                        + Tambah Pos Pembiayaan
                                    </button>
                                </div>

                                <div class="form-group" style="margin-bottom:12px;">
                                    <label style="font-size:12px; font-weight:700; color:#047857;">Total Pembiayaan Netto (Header Total)</label>
                                    <input type="text" name="apbdes_pembiayaan_total[]" value="{{ $ap['pembiayaan_total'] ?? 'Rp 0,00' }}" required>
                                </div>

                                <div class="item-boxes-container" id="container-pembiayaan-{{ $yearIdx }}" style="display:flex; flex-direction:column; gap:8px; margin-bottom:12px;">
                                    @php $pb_items = $ap['pembiayaan_items'] ?? []; @endphp
                                    @foreach($pb_items as $item)
                                        <div class="dynamic-item-row" style="background:#FFF; border:1px solid #E2E8F0; border-radius:8px; padding:10px 12px;">
                                            <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px;">
                                                <input type="text" name="apbdes_pembiayaan_label_{{ $yearIdx }}[]" value="{{ $item['label'] ?? '' }}" placeholder="Nama Pos Pembiayaan (Tulisan Besar)" style="flex:2; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:600;" required>
                                                <input type="text" name="apbdes_pembiayaan_nilai_{{ $yearIdx }}[]" value="{{ $item['nilai'] ?? '' }}" placeholder="Nominal (misal: Rp 0,00)" style="flex:1.5; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:700;" required>
                                                <button type="button" onclick="hapusItemBox(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; width:34px; height:34px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-weight:700;">✕</button>
                                            </div>
                                            <div style="display:flex; align-items:center; gap:6px;">
                                                <span style="font-size:11px; color:#64748B; font-weight:700; white-space:nowrap;">↳ Sub-keterangan (opsional):</span>
                                                <input type="text" name="apbdes_pembiayaan_sub_{{ $yearIdx }}[]" value="{{ $item['sub'] ?? '' }}" placeholder="Tulisan kecil di bawah judul (opsional / boleh dikosongkan)" style="flex:1; font-size:11.5px; padding:5px 8px; border:1px dashed #CBD5E1; border-radius:4px; color:#475569; background:#FAFAFA;">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group" style="margin-bottom:0;">
                                    <label style="font-size:12px;">Catatan Keterangan Pembiayaan</label>
                                    <textarea name="apbdes_keterangan_pembiayaan[]" rows="2" required placeholder="Jelaskan asal usul penerimaan pembiayaan...">{{ $ap['keterangan_pembiayaan'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- SECTION 6: STATISTIK DEMOGRAFI & KEPENDUDUKAN (DYNAMIC BOXES) -->
            <div class="setting-section">
                <div class="section-header">
                    <span>📊 Section 6: Statistik Demografi &amp; Kependudukan (Form Kotak A &amp; B)</span>
                </div>
                <p style="margin-top:0; margin-bottom:20px; font-size:12.5px; color:var(--teks-muted);">Kelola indikator monografi kependudukan, kelompok usia, mata pencaharian, kesejahteraan, dan fasilitas/hewan ternak dengan format kotak pasangan nama &amp; nilai.</p>

                @php $dm = $data_demografi ?? []; @endphp

                <!-- 1. DATA POKOK KEPENDUDUKAN -->
                <div style="background:#F8FAFC; border:1.5px solid #CBD5E1; border-radius:10px; padding:16px; margin-bottom:18px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                        <h4 style="margin:0; font-size:13.5px; color:var(--biru-tua); font-weight:800;">1. Data Pokok Kependudukan (4 Kartu Highlight)</h4>
                        <button type="button" onclick="tambahDemoRow('pokok')" style="font-size:11.5px; padding:4px 10px; background:#E0F2FE; color:#0369A1; border:1px solid #BAE6FD; border-radius:6px; font-weight:700; cursor:pointer;">
                            + Tambah Indikator
                        </button>
                    </div>
                    <div id="container-demo-pokok" style="display:flex; flex-direction:column; gap:8px;">
                        @foreach($dm['pokok'] ?? [] as $item)
                            <div class="dynamic-item-row" style="display:flex; align-items:center; gap:8px;">
                                <input type="text" name="demo_pokok_label[]" value="{{ $item['label'] ?? '' }}" placeholder="Kotak A: Nama Indikator (misal: Total Penduduk)" style="flex:2; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px;" required>
                                <input type="text" name="demo_pokok_nilai[]" value="{{ $item['nilai'] ?? '' }}" placeholder="Kotak B: Nilai (misal: 2.113)" style="flex:1.5; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:600;" required>
                                <button type="button" onclick="hapusItemBox(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; width:34px; height:34px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-weight:700;">✕</button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 2. KOMPOSISI KELOMPOK USIA -->
                <div style="background:#F8FAFC; border:1.5px solid #CBD5E1; border-radius:10px; padding:16px; margin-bottom:18px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                        <h4 style="margin:0; font-size:13.5px; color:#0B3B60; font-weight:800;">2. Komposisi Kelompok Usia Penduduk</h4>
                        <button type="button" onclick="tambahDemoRow('usia')" style="font-size:11.5px; padding:4px 10px; background:#E0F2FE; color:#0369A1; border:1px solid #BAE6FD; border-radius:6px; font-weight:700; cursor:pointer;">
                            + Tambah Kelompok Usia
                        </button>
                    </div>
                    <div id="container-demo-usia" style="display:flex; flex-direction:column; gap:8px;">
                        @foreach($dm['usia'] ?? [] as $item)
                            <div class="dynamic-item-row" style="display:flex; align-items:center; gap:8px;">
                                <input type="text" name="demo_usia_label[]" value="{{ $item['label'] ?? '' }}" placeholder="Kotak A: Rentang Usia (misal: Usia Balita 0 - 4 Thn)" style="flex:2; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px;" required>
                                <input type="text" name="demo_usia_nilai[]" value="{{ $item['nilai'] ?? '' }}" placeholder="Kotak B: Jumlah (misal: 145 Orang)" style="flex:1.5; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:600;" required>
                                <button type="button" onclick="hapusItemBox(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; width:34px; height:34px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-weight:700;">✕</button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 3. MATA PENCAHARIAN & KETENAGAKERJAAN -->
                <div style="background:#F8FAFC; border:1.5px solid #CBD5E1; border-radius:10px; padding:16px; margin-bottom:18px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                        <h4 style="margin:0; font-size:13.5px; color:#1668A3; font-weight:800;">3. Mata Pencaharian &amp; Ketenagakerjaan</h4>
                        <button type="button" onclick="tambahDemoRow('pekerjaan')" style="font-size:11.5px; padding:4px 10px; background:#E0F2FE; color:#0369A1; border:1px solid #BAE6FD; border-radius:6px; font-weight:700; cursor:pointer;">
                            + Tambah Pekerjaan
                        </button>
                    </div>
                    <div id="container-demo-pekerjaan" style="display:flex; flex-direction:column; gap:8px;">
                        @foreach($dm['pekerjaan'] ?? [] as $item)
                            <div class="dynamic-item-row" style="display:flex; align-items:center; gap:8px;">
                                <input type="text" name="demo_pekerjaan_label[]" value="{{ $item['label'] ?? '' }}" placeholder="Kotak A: Profesi / Ketenagakerjaan" style="flex:2; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px;" required>
                                <input type="text" name="demo_pekerjaan_nilai[]" value="{{ $item['nilai'] ?? '' }}" placeholder="Kotak B: Jumlah Jiwa (misal: 986 Orang)" style="flex:1.5; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:600;" required>
                                <button type="button" onclick="hapusItemBox(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; width:34px; height:34px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-weight:700;">✕</button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 4. TINGKAT KESEJAHTERAAN KELUARGA (KK) -->
                <div style="background:#F8FAFC; border:1.5px solid #CBD5E1; border-radius:10px; padding:16px; margin-bottom:18px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                        <h4 style="margin:0; font-size:13.5px; color:#D4A017; font-weight:800;">4. Tingkat Kesejahteraan Keluarga (KK)</h4>
                        <button type="button" onclick="tambahDemoRow('kesejahteraan')" style="font-size:11.5px; padding:4px 10px; background:#FEF3C7; color:#B45309; border:1px solid #FDE68A; border-radius:6px; font-weight:700; cursor:pointer;">
                            + Tambah Kategori KK
                        </button>
                    </div>
                    <div id="container-demo-kesejahteraan" style="display:flex; flex-direction:column; gap:8px;">
                        @foreach($dm['kesejahteraan'] ?? [] as $item)
                            <div class="dynamic-item-row" style="display:flex; align-items:center; gap:8px;">
                                <input type="text" name="demo_kesejahteraan_label[]" value="{{ $item['label'] ?? '' }}" placeholder="Kotak A: Tingkat Kesejahteraan" style="flex:2; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px;" required>
                                <input type="text" name="demo_kesejahteraan_nilai[]" value="{{ $item['nilai'] ?? '' }}" placeholder="Kotak B: Jumlah KK (misal: 450 KK)" style="flex:1.5; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:600;" required>
                                <button type="button" onclick="hapusItemBox(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; width:34px; height:34px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-weight:700;">✕</button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 5. SARANA, PENDIDIKAN, AGAMA & PETERNAKAN -->
                <div style="background:#F8FAFC; border:1.5px solid #CBD5E1; border-radius:10px; padding:16px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                        <h4 style="margin:0; font-size:13.5px; color:#047857; font-weight:800;">5. Sarana, Pendidikan, Agama &amp; Peternakan</h4>
                        <button type="button" onclick="tambahDemoRow('pendidikan_ternak')" style="font-size:11.5px; padding:4px 10px; background:#D1FAE5; color:#047857; border:1px solid #A7F3D0; border-radius:6px; font-weight:700; cursor:pointer;">
                            + Tambah Data Fasilitas / Ternak
                        </button>
                    </div>
                    <div id="container-demo-pendidikan_ternak" style="display:flex; flex-direction:column; gap:8px;">
                        @foreach($dm['pendidikan_ternak'] ?? [] as $item)
                            <div class="dynamic-item-row" style="display:flex; align-items:center; gap:8px;">
                                <input type="text" name="demo_pendidikan_ternak_label[]" value="{{ $item['label'] ?? '' }}" placeholder="Kotak A: Fasilitas / Ternak" style="flex:2; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px;" required>
                                <input type="text" name="demo_pendidikan_ternak_nilai[]" value="{{ $item['nilai'] ?? '' }}" placeholder="Kotak B: Jumlah / Populasi (misal: 450 Ekor)" style="flex:1.5; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:600;" required>
                                <button type="button" onclick="hapusItemBox(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; width:34px; height:34px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-weight:700;">✕</button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- SECTION 8: POSTER PERLOMBAAN & AGENDA INFORMASI PUBLIK -->
            <div class="setting-section" id="section-poster-agenda">
                <div class="section-header" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:8px;">
                    <span>8. Poster Perlombaan &amp; Agenda Informasi Publik</span>
                    <button type="button" onclick="tambahPosterCard()" class="btn btn-secondary" style="font-size:12px; padding:6px 14px; background:#FEF3C7; color:#B45309; border:1px solid #FDE68A; font-weight:700;">
                        + Tambah Poster / Agenda Baru
                    </button>
                </div>
                <p style="margin-top:0; margin-bottom:16px; font-size:12.5px; color:var(--teks-muted);">Unggah foto poster, tuliskan judul perlombaan, hari/tanggal, waktu, lokasi, cabang lomba, dan hadiah untuk ditampilkan di dalam pop-up Informasi Publik.</p>

                <div id="poster-cards-container" style="display:flex; flex-direction:column; gap:16px;">
                    @php $pIdx = 0; @endphp
                    @forelse($poster_agendas as $pKey => $poster)
                        @php 
                            $currKey = is_numeric($pKey) ? 'poster_' . $pKey : $pKey; 
                            $pIdx++;
                        @endphp
                        <div class="poster-item-card" style="background:#FFF; border:1.5px solid #CBD5E1; border-radius:12px; padding:20px; box-shadow:0 2px 10px rgba(0,0,0,0.04); position:relative;">
                            <input type="hidden" name="poster_keys[]" value="{{ $currKey }}">
                            
                            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; border-bottom:1px solid #E2E8F0; padding-bottom:10px;">
                                <h4 style="margin:0; font-size:15px; color:var(--biru-tua); font-weight:800;">
                                    📌 Poster #{{ $pIdx }}
                                </h4>
                                <button type="button" onclick="hapusPosterCard(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; padding:5px 12px; font-size:12px; font-weight:700; cursor:pointer;">
                                    🗑️ Hapus Poster
                                </button>
                            </div>

                            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:16px; margin-bottom:14px;">
                                <!-- Upload Foto Poster -->
                                <div>
                                    <label style="font-size:12.5px; font-weight:700; display:block; margin-bottom:6px;">Foto / Gambar Poster</label>
                                    @if(!empty($poster['foto']))
                                        <div style="margin-bottom:8px;">
                                            <img src="{{ $poster['foto'] }}" alt="Poster Preview" style="max-height:160px; max-width:100%; border-radius:8px; border:1px solid #CBD5E1; object-fit:cover;">
                                        </div>
                                    @endif
                                    <input type="file" name="poster_foto_{{ $currKey }}" accept="image/*" style="font-size:12px;">
                                    <small style="display:block; color:#64748B; margin-top:4px; font-size:11px;">Format JPG, PNG, atau WEBP. Gambar otomatis dioptimalkan.</small>
                                </div>

                                <!-- Judul & Kategori -->
                                <div>
                                    <div class="form-group" style="margin-bottom:12px;">
                                        <label style="font-size:12.5px; font-weight:700;">Judul Perlombaan / Agenda</label>
                                        <input type="text" name="poster_judul[]" value="{{ $poster['judul'] ?? '' }}" placeholder="Contoh: Semarak Lomba Kemerdekaan RI Ke-81" required style="font-size:13px; font-weight:700;">
                                    </div>
                                    <div class="form-group" style="margin-bottom:0;">
                                        <label style="font-size:12.5px; font-weight:700;">Badge Kategori</label>
                                        <input type="text" name="poster_kategori[]" value="{{ $poster['kategori'] ?? '🏆 Perlombaan Desa' }}" placeholder="Contoh: 🏆 Perlombaan Desa / 🩺 Layanan Kesehatan / 📢 Pengumuman" required style="font-size:12.5px;">
                                    </div>
                                </div>
                            </div>

                            <!-- Waktu, Hari/Tanggal, Lokasi -->
                            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:12px; margin-bottom:14px; background:#F8FAFC; padding:12px; border-radius:8px; border:1px solid #E2E8F0;">
                                <div class="form-group" style="margin-bottom:0;">
                                    <label style="font-size:12px; font-weight:700;">📅 Hari / Tanggal</label>
                                    <input type="text" name="poster_tanggal[]" value="{{ $poster['tanggal'] ?? '' }}" placeholder="Contoh: Sabtu – Minggu, 22 – 23 Agustus 2026" style="font-size:12.5px;">
                                </div>
                                <div class="form-group" style="margin-bottom:0;">
                                    <label style="font-size:12px; font-weight:700;">⏰ Waktu / Jam</label>
                                    <input type="text" name="poster_waktu[]" value="{{ $poster['waktu'] ?? '' }}" placeholder="Contoh: 08.00 WIB s/d Selesai" style="font-size:12.5px;">
                                </div>
                                <div class="form-group" style="margin-bottom:0;">
                                    <label style="font-size:12px; font-weight:700;">📍 Lokasi Pelaksanaan</label>
                                    <input type="text" name="poster_lokasi[]" value="{{ $poster['lokasi'] ?? '' }}" placeholder="Contoh: Lapangan & Balai Desa Munungkerep" style="font-size:12.5px;">
                                </div>
                            </div>

                            <!-- Rincian Acara & Hadiah -->
                            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:14px;">
                                <div class="form-group" style="margin-bottom:0;">
                                    <label style="font-size:12px; font-weight:700;">🎯 Cabang Lomba / Rincian Acara (Teks Detail)</label>
                                    <textarea name="poster_rincian[]" rows="3" placeholder="Contoh:&#10;• Gerak Jalan Kreasi Antar RT&#10;• Lomba Tarik Tambang Antar Dusun&#10;• Balap Karung Helm & Mewarnai Anak" style="font-size:12.5px; line-height:1.5;">{{ $poster['rincian'] ?? '' }}</textarea>
                                </div>
                                <div class="form-group" style="margin-bottom:0;">
                                    <label style="font-size:12px; font-weight:700;">🎁 Hadiah / Biaya / Syarat (Keterangan Footer)</label>
                                    <textarea name="poster_hadiah[]" rows="3" placeholder="Contoh: Total Hadiah: Piala Bergilir & Uang Pembinaan (Gratis Terbuka untuk Seluruh Warga)" style="font-size:12.5px; line-height:1.5;">{{ $poster['hadiah'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div id="poster-empty-state" style="text-align:center; padding:30px 20px; background:#F8FAFC; border:2px dashed #CBD5E1; border-radius:10px; color:#64748B;">
                            <div style="font-size:32px; margin-bottom:8px;">📢</div>
                            <div style="font-weight:700; font-size:14px; margin-bottom:4px; color:var(--biru-tua);">Belum Ada Poster Perlombaan / Agenda</div>
                            <div style="font-size:12.5px; margin-bottom:14px;">Klik tombol "+ Tambah Poster / Agenda Baru" di atas untuk menambahkan poster lomba atau kegiatan desa pertama Anda.</div>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Form Actions -->
            <div style="display:flex; justify-content:flex-end; gap:10px; margin-bottom:40px;">
                <a href="/admin/dashboard" class="btn btn-secondary">Batal</a>
                <button type="submit" id="btn-simpan" class="btn btn-primary" style="padding:12px 28px; font-size:15px; font-weight:700;">Simpan Pengaturan</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <!-- Script Dinamis untuk Tambah & Hapus Kotak APBDes dan Demografi -->
    <script>
        // Helper Hapus Baris Item Kotak A & B
        function hapusItemBox(btn) {
            const row = btn.closest('.dynamic-item-row');
            const container = row.parentElement;
            if (container.children.length <= 1) {
                alert('Minimal harus ada 1 baris data di bagian ini.');
                return;
            }
            row.remove();
        }

        // Helper Tambah Baris Kotak Pos APBDes (Pendapatan / Belanja / Pembiayaan)
        function tambahItemBox(kategori, yearIdx) {
            const container = document.getElementById(`container-${kategori}-${yearIdx}`);
            if (!container) return;

            let placeholderA = "Nama Pos Utama (Tulisan Besar)";
            let placeholderB = "Nominal (misal: Rp 0,00)";
            let placeholderSub = "Tulisan kecil di bawah judul (opsional / boleh dikosongkan)";
            
            if (kategori === 'pendapatan') {
                placeholderA = "Nama Pos Pendapatan (Tulisan Besar)";
            } else if (kategori === 'belanja') {
                placeholderA = "Nama Pos Belanja (Tulisan Besar)";
            } else if (kategori === 'pembiayaan') {
                placeholderA = "Nama Pos Pembiayaan (Tulisan Besar)";
            }

            const row = document.createElement('div');
            row.className = 'dynamic-item-row';
            row.style.cssText = 'background:#FFF; border:1px solid #E2E8F0; border-radius:8px; padding:10px 12px;';
            row.innerHTML = `
                <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px;">
                    <input type="text" name="apbdes_${kategori}_label_${yearIdx}[]" value="" placeholder="${placeholderA}" style="flex:2; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:600;" required>
                    <input type="text" name="apbdes_${kategori}_nilai_${yearIdx}[]" value="Rp 0,00" placeholder="${placeholderB}" style="flex:1.5; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:700;" required>
                    <button type="button" onclick="hapusItemBox(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; width:34px; height:34px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-weight:700;">✕</button>
                </div>
                <div style="display:flex; align-items:center; gap:6px;">
                    <span style="font-size:11px; color:#64748B; font-weight:700; white-space:nowrap;">↳ Sub-keterangan (opsional):</span>
                    <input type="text" name="apbdes_${kategori}_sub_${yearIdx}[]" value="" placeholder="${placeholderSub}" style="flex:1; font-size:11.5px; padding:5px 8px; border:1px dashed #CBD5E1; border-radius:4px; color:#475569; background:#FAFAFA;">
                </div>
            `;
            container.appendChild(row);
        }

        // Helper Tambah Baris Kotak Demografi (Pokok / Usia / Pekerjaan / Kesejahteraan / Pendidikan Ternak)
        function tambahDemoRow(kategori) {
            const container = document.getElementById(`container-demo-${kategori}`);
            if (!container) return;

            let placeholderA = "Kotak A: Nama Kategori";
            let placeholderB = "Kotak B: Jumlah / Nilai";

            if (kategori === 'pokok') {
                placeholderA = "Kotak A: Nama Indikator Pokok";
                placeholderB = "Kotak B: Jumlah Jiwa/KK (misal: 1.000)";
            } else if (kategori === 'usia') {
                placeholderA = "Kotak A: Rentang Usia (misal: Usia Remaja 15 - 24 Thn)";
                placeholderB = "Kotak B: Jumlah Jiwa (misal: 250 Orang)";
            } else if (kategori === 'pekerjaan') {
                placeholderA = "Kotak A: Kategori Pekerjaan";
                placeholderB = "Kotak B: Jumlah Jiwa (misal: 100 Orang)";
            } else if (kategori === 'kesejahteraan') {
                placeholderA = "Kotak A: Kategori Kesejahteraan KK";
                placeholderB = "Kotak B: Jumlah KK (misal: 50 KK)";
            } else if (kategori === 'pendidikan_ternak') {
                placeholderA = "Kotak A: Fasilitas / Jenis Hewan Ternak";
                placeholderB = "Kotak B: Jumlah / Populasi (misal: 80 Ekor)";
            }

            const row = document.createElement('div');
            row.className = 'dynamic-item-row';
            row.style.cssText = 'display:flex; align-items:center; gap:8px;';
            row.innerHTML = `
                <input type="text" name="demo_${kategori}_label[]" value="" placeholder="${placeholderA}" style="flex:2; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px;" required>
                <input type="text" name="demo_${kategori}_nilai[]" value="" placeholder="${placeholderB}" style="flex:1.5; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:600;" required>
                <button type="button" onclick="hapusItemBox(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; width:34px; height:34px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-weight:700;">✕</button>
            `;
            container.appendChild(row);
        }

        // Helper Tambah Tahun APBDes Baru
        function tambahTahunApbdes() {
            const container = document.getElementById('apbdes-years-container');
            const currentYear = new Date().getFullYear();
            const yearCards = document.querySelectorAll('.apbdes-year-card');
            const newYearIdx = yearCards.length;

            const yearCard = document.createElement('div');
            yearCard.className = 'apbdes-year-card';
            yearCard.setAttribute('data-year-idx', newYearIdx);
            yearCard.style.cssText = 'border: 1.5px solid #CBD5E1; border-radius: 12px; padding: 20px; background: #F8FAFC; position: relative;';
            yearCard.innerHTML = `
                <!-- Header Tahun -->
                <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px; margin-bottom:16px; border-bottom:1px solid #E2E8F0; padding-bottom:12px;">
                    <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                        <span style="background:var(--biru-tua); color:#fff; font-size:12px; font-weight:800; padding:4px 10px; border-radius:6px; letter-spacing:0.5px;">TAHUN ANGGARAN</span>
                        <input type="text" name="apbdes_tahun[]" value="${currentYear}" style="width:100px; font-weight:800; font-size:15px; text-align:center; padding:5px 8px; border:1.5px solid #94A3B8; border-radius:6px; background:#FFF;" required placeholder="Contoh: ${currentYear}">
                        
                        <select name="apbdes_status[]" style="font-size:12.5px; padding:6px 10px; border-radius:6px; border:1px solid #CBD5E1; font-weight:600; background:#FFF; color:#334155;">
                            <option value="Murni (Tahun Berjalan)">🟢 Murni (Tahun Berjalan)</option>
                            <option value="Laporan Realisasi / LPJ">🔵 Laporan Realisasi / LPJ</option>
                            <option value="Perubahan (P-APBDes)">🟠 Perubahan (P-APBDes)</option>
                        </select>
                    </div>
                    <button type="button" onclick="hapusTahunApbdes(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; padding:6px 12px; font-size:12px; font-weight:700; cursor:pointer;">
                        Hapus Tahun Ini
                    </button>
                </div>

                <!-- 1. PENDAPATAN DESA -->
                <div style="background:#FFF; border:1px solid #BAE6FD; border-left:4px solid #0284C7; border-radius:8px; padding:16px; margin-bottom:16px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; flex-wrap:wrap; gap:8px;">
                        <h4 style="margin:0; font-size:14px; color:#0369A1;">1. Pendapatan Desa &amp; Sumber Dana</h4>
                        <button type="button" onclick="tambahItemBox('pendapatan', ${newYearIdx})" style="font-size:11.5px; padding:4px 10px; background:#E0F2FE; color:#0369A1; border:1px solid #BAE6FD; border-radius:6px; font-weight:700; cursor:pointer;">
                            + Tambah Pos Pendapatan
                        </button>
                    </div>

                    <div class="form-group" style="margin-bottom:12px;">
                        <label style="font-size:12px; font-weight:700; color:#0369A1;">Total Pendapatan Desa (Header Total)</label>
                        <input type="text" name="apbdes_pendapatan_total[]" value="Rp 0,00" required>
                    </div>

                    <div class="item-boxes-container" id="container-pendapatan-${newYearIdx}" style="display:flex; flex-direction:column; gap:8px; margin-bottom:12px;">
                        <div class="dynamic-item-row" style="background:#FFF; border:1px solid #E2E8F0; border-radius:8px; padding:10px 12px;">
                            <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px;">
                                <input type="text" name="apbdes_pendapatan_label_${newYearIdx}[]" value="Pendapatan Asli Desa (PAD)" placeholder="Nama Pos Pendapatan" style="flex:2; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:600;" required>
                                <input type="text" name="apbdes_pendapatan_nilai_${newYearIdx}[]" value="Rp 0,00" placeholder="Nominal" style="flex:1.5; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:700;" required>
                                <button type="button" onclick="hapusItemBox(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; width:34px; height:34px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-weight:700;">✕</button>
                            </div>
                            <div style="display:flex; align-items:center; gap:6px;">
                                <span style="font-size:11px; color:#64748B; font-weight:700; white-space:nowrap;">↳ Sub-keterangan (opsional):</span>
                                <input type="text" name="apbdes_pendapatan_sub_${newYearIdx}[]" value="Hasil Usaha Desa, Tanah Kas Desa, dan Swadaya Masyarakat" placeholder="Tulisan kecil di bawah judul (opsional)" style="flex:1; font-size:11.5px; padding:5px 8px; border:1px dashed #CBD5E1; border-radius:4px; color:#475569; background:#FAFAFA;">
                            </div>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label style="font-size:12px;">Catatan Keterangan Sumber Dana Pendapatan</label>
                        <textarea name="apbdes_keterangan_pendapatan[]" rows="2" required placeholder="Jelaskan dari mana saja dana pendapatan desa berasal..."></textarea>
                    </div>
                </div>

                <!-- 2. BELANJA DESA -->
                <div style="background:#FFF; border:1px solid #FECACA; border-left:4px solid #EF4444; border-radius:8px; padding:16px; margin-bottom:16px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; flex-wrap:wrap; gap:8px;">
                        <h4 style="margin:0; font-size:14px; color:#B91C1C;">2. Belanja Desa &amp; Alokasi Bidang</h4>
                        <button type="button" onclick="tambahItemBox('belanja', ${newYearIdx})" style="font-size:11.5px; padding:4px 10px; background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; font-weight:700; cursor:pointer;">
                            + Tambah Pos Belanja
                        </button>
                    </div>

                    <div class="form-group" style="margin-bottom:12px;">
                        <label style="font-size:12px; font-weight:700; color:#B91C1C;">Total Belanja Desa (Header Total)</label>
                        <input type="text" name="apbdes_belanja_total[]" value="Rp 0,00" required>
                    </div>

                    <div class="item-boxes-container" id="container-belanja-${newYearIdx}" style="display:flex; flex-direction:column; gap:8px; margin-bottom:12px;">
                        <div class="dynamic-item-row" style="background:#FFF; border:1px solid #E2E8F0; border-radius:8px; padding:10px 12px;">
                            <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px;">
                                <input type="text" name="apbdes_belanja_label_${newYearIdx}[]" value="Penyelenggaraan Pemerintahan Desa" placeholder="Nama Pos Belanja" style="flex:2; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:600;" required>
                                <input type="text" name="apbdes_belanja_nilai_${newYearIdx}[]" value="Rp 0,00" placeholder="Nominal" style="flex:1.5; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:700;" required>
                                <button type="button" onclick="hapusItemBox(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; width:34px; height:34px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-weight:700;">✕</button>
                            </div>
                            <div style="display:flex; align-items:center; gap:6px;">
                                <span style="font-size:11px; color:#64748B; font-weight:700; white-space:nowrap;">↳ Sub-keterangan (opsional):</span>
                                <input type="text" name="apbdes_belanja_sub_${newYearIdx}[]" value="Penghasilan tetap, operasional kantor desa, dan BPD" placeholder="Tulisan kecil di bawah judul (opsional)" style="flex:1; font-size:11.5px; padding:5px 8px; border:1px dashed #CBD5E1; border-radius:4px; color:#475569; background:#FAFAFA;">
                            </div>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label style="font-size:12px;">Catatan Keterangan Alokasi Belanja</label>
                        <textarea name="apbdes_keterangan_belanja[]" rows="2" required placeholder="Jelaskan untuk apa saja alokasi belanja diprioritaskan..."></textarea>
                    </div>
                </div>

                <!-- 3. PEMBIAYAAN DESA -->
                <div style="background:#FFF; border:1px solid #A7F3D0; border-left:4px solid #10B981; border-radius:8px; padding:16px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; flex-wrap:wrap; gap:8px;">
                        <h4 style="margin:0; font-size:14px; color:#047857;">3. Pembiayaan Desa (Netto &amp; SiLPA)</h4>
                        <button type="button" onclick="tambahItemBox('pembiayaan', ${newYearIdx})" style="font-size:11.5px; padding:4px 10px; background:#D1FAE5; color:#047857; border:1px solid #A7F3D0; border-radius:6px; font-weight:700; cursor:pointer;">
                            + Tambah Pos Pembiayaan
                        </button>
                    </div>

                    <div class="form-group" style="margin-bottom:12px;">
                        <label style="font-size:12px; font-weight:700; color:#047857;">Total Pembiayaan Netto (Header Total)</label>
                        <input type="text" name="apbdes_pembiayaan_total[]" value="Rp 0,00" required>
                    </div>

                    <div class="item-boxes-container" id="container-pembiayaan-${newYearIdx}" style="display:flex; flex-direction:column; gap:8px; margin-bottom:12px;">
                        <div class="dynamic-item-row" style="background:#FFF; border:1px solid #E2E8F0; border-radius:8px; padding:10px 12px;">
                            <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px;">
                                <input type="text" name="apbdes_pembiayaan_label_${newYearIdx}[]" value="Penerimaan Pembiayaan (SiLPA)" placeholder="Pos Pembiayaan" style="flex:2; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:600;" required>
                                <input type="text" name="apbdes_pembiayaan_nilai_${newYearIdx}[]" value="Rp 0,00" placeholder="Nominal" style="flex:1.5; font-size:12.5px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; font-weight:700;" required>
                                <button type="button" onclick="hapusItemBox(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; width:34px; height:34px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-weight:700;">✕</button>
                            </div>
                            <div style="display:flex; align-items:center; gap:6px;">
                                <span style="font-size:11px; color:#64748B; font-weight:700; white-space:nowrap;">↳ Sub-keterangan (opsional):</span>
                                <input type="text" name="apbdes_pembiayaan_sub_${newYearIdx}[]" value="Sisa Lebih Perhitungan Anggaran tahun anggaran sebelumnya" placeholder="Tulisan kecil di bawah judul (opsional)" style="flex:1; font-size:11.5px; padding:5px 8px; border:1px dashed #CBD5E1; border-radius:4px; color:#475569; background:#FAFAFA;">
                            </div>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label style="font-size:12px;">Catatan Keterangan Pembiayaan</label>
                        <textarea name="apbdes_keterangan_pembiayaan[]" rows="2" required placeholder="Jelaskan asal usul penerimaan pembiayaan..."></textarea>
                    </div>
                </div>
            `;
            container.insertBefore(yearCard, container.firstChild);
        }

        function hapusTahunApbdes(btn) {
            const container = document.getElementById('apbdes-years-container');
            if (container.children.length <= 1) {
                alert('Minimal harus ada 1 data tahun anggaran APBDes.');
                return;
            }
            if (confirm('Apakah Anda yakin ingin menghapus data tahun anggaran ini?')) {
                btn.closest('.apbdes-year-card').remove();
            }
        }

        let posterCounter = {{ count($poster_agendas) + 1 }};
        function tambahPosterCard() {
            const container = document.getElementById('poster-cards-container');
            const emptyState = document.getElementById('poster-empty-state');
            if (emptyState) emptyState.remove();

            const uniqueKey = 'poster_' + Date.now();
            const currentIdx = container.querySelectorAll('.poster-item-card').length + 1;

            const card = document.createElement('div');
            card.className = 'poster-item-card';
            card.style.cssText = 'background:#FFF; border:1.5px solid #CBD5E1; border-radius:12px; padding:20px; box-shadow:0 2px 10px rgba(0,0,0,0.04); position:relative;';
            card.innerHTML = `
                <input type="hidden" name="poster_keys[]" value="${uniqueKey}">
                
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; border-bottom:1px solid #E2E8F0; padding-bottom:10px;">
                    <h4 style="margin:0; font-size:15px; color:var(--biru-tua); font-weight:800;">
                        📌 Poster Baru (#${currentIdx})
                    </h4>
                    <button type="button" onclick="hapusPosterCard(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; padding:5px 12px; font-size:12px; font-weight:700; cursor:pointer;">
                        🗑️ Hapus Poster
                    </button>
                </div>

                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:16px; margin-bottom:14px;">
                    <!-- Upload Foto Poster -->
                    <div>
                        <label style="font-size:12.5px; font-weight:700; display:block; margin-bottom:6px;">Foto / Gambar Poster</label>
                        <input type="file" name="poster_foto_${uniqueKey}" accept="image/*" style="font-size:12px;">
                        <small style="display:block; color:#64748B; margin-top:4px; font-size:11px;">Format JPG, PNG, atau WEBP. Gambar otomatis dioptimalkan.</small>
                    </div>

                    <!-- Judul & Kategori -->
                    <div>
                        <div class="form-group" style="margin-bottom:12px;">
                            <label style="font-size:12.5px; font-weight:700;">Judul Perlombaan / Agenda</label>
                            <input type="text" name="poster_judul[]" placeholder="Contoh: Semarak Lomba Kemerdekaan RI Ke-81" required style="font-size:13px; font-weight:700;">
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label style="font-size:12.5px; font-weight:700;">Badge Kategori</label>
                            <input type="text" name="poster_kategori[]" value="🏆 Perlombaan Desa" placeholder="Contoh: 🏆 Perlombaan Desa / 🩺 Layanan Kesehatan / 📢 Pengumuman" required style="font-size:12.5px;">
                        </div>
                    </div>
                </div>

                <!-- Waktu, Hari/Tanggal, Lokasi -->
                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:12px; margin-bottom:14px; background:#F8FAFC; padding:12px; border-radius:8px; border:1px solid #E2E8F0;">
                    <div class="form-group" style="margin-bottom:0;">
                        <label style="font-size:12px; font-weight:700;">📅 Hari / Tanggal</label>
                        <input type="text" name="poster_tanggal[]" placeholder="Contoh: Sabtu – Minggu, 22 – 23 Agustus 2026" style="font-size:12.5px;">
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label style="font-size:12px; font-weight:700;">⏰ Waktu / Jam</label>
                        <input type="text" name="poster_waktu[]" placeholder="Contoh: 08.00 WIB s/d Selesai" style="font-size:12.5px;">
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label style="font-size:12px; font-weight:700;">📍 Lokasi Pelaksanaan</label>
                        <input type="text" name="poster_lokasi[]" placeholder="Contoh: Lapangan & Balai Desa Munungkerep" style="font-size:12.5px;">
                    </div>
                </div>

                <!-- Rincian Acara & Hadiah -->
                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:14px;">
                    <div class="form-group" style="margin-bottom:0;">
                        <label style="font-size:12px; font-weight:700;">🎯 Cabang Lomba / Rincian Acara (Teks Detail)</label>
                        <textarea name="poster_rincian[]" rows="3" placeholder="Contoh:&#10;• Gerak Jalan Kreasi Antar RT&#10;• Lomba Tarik Tambang Antar Dusun&#10;• Balap Karung Helm & Mewarnai Anak" style="font-size:12.5px; line-height:1.5;"></textarea>
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label style="font-size:12px; font-weight:700;">🎁 Hadiah / Biaya / Syarat (Keterangan Footer)</label>
                        <textarea name="poster_hadiah[]" rows="3" placeholder="Contoh: Total Hadiah: Piala Bergilir & Uang Pembinaan (Gratis Terbuka untuk Seluruh Warga)" style="font-size:12.5px; line-height:1.5;"></textarea>
                    </div>
                </div>
            `;
            container.appendChild(card);
        }

        function hapusPosterCard(btn) {
            if (confirm('Apakah Anda yakin ingin menghapus poster agenda ini?')) {
                const card = btn.closest('.poster-item-card');
                if (card) card.remove();
            }
        }

        // Script Prevent Double Submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const clickedBtn = document.activeElement;
            if (clickedBtn && clickedBtn.value === 'reset_cards') {
                return;
            }

            const submitBtn = document.getElementById('btn-simpan');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'Menyimpan Pengaturan...';
                submitBtn.style.opacity = '0.7';
                submitBtn.style.cursor = 'not-allowed';
            }
        });
    </script>
@endsection
