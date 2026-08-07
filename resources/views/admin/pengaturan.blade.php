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
            <!-- SECTION 4: PERANGKAT DESA & ORGANOGRAM -->
            <div class="setting-section">
                <div class="section-header">4. Perangkat Desa &amp; Bagan Organogram</div>
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
