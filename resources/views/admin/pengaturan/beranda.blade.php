@extends('layouts.admin', ['activePage' => 'pengaturan-beranda'])

@section('title', 'Pengaturan Beranda & Slider')

@php
$presetIcons = [
    'dokumen' => [
        'name' => 'Dokumen / Surat',
        'svg' => '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M7 3h8l4 4v14a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z"/><path d="M15 3v4h4"/><path d="M9 12h6M9 16h6M9 8h3"/></svg>'
    ],
    'keuangan' => [
        'name' => 'APBDes / Anggaran',
        'svg' => '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 21V7l8-4 8 4v14"/><path d="M9 21v-6h6v6M4 21h16"/></svg>'
    ],
    'pemerintahan' => [
        'name' => 'Pemerintahan / Aparatur',
        'svg' => '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="7" r="3"/><path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6"/><circle cx="18" cy="8" r="2.2"/><path d="M15.5 20c.3-2.5 2-4.5 4.3-5"/></svg>'
    ],
    'kelembagaan' => [
        'name' => 'Kelembagaan / Organisasi Warga',
        'svg' => '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>'
    ],
    'demografi' => [
        'name' => 'Statistik / Kependudukan',
        'svg' => '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="8" r="3.2"/><path d="M2.5 20c0-3.6 2.5-6.5 5.5-6.5s5.5 2.9 5.5 6.5"/><path d="M16 21c0-3 2-5.5 4.5-5.5"/><circle cx="18.5" cy="9" r="2.3"/></svg>'
    ],
    'kegiatan' => [
        'name' => 'Kalender / Kegiatan',
        'svg' => '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18M8 3v4M16 3v4"/></svg>'
    ],
    'produk' => [
        'name' => 'Produk UMKM / Pasar',
        'svg' => '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>'
    ],
    'peta' => [
        'name' => 'Peta Wilayah / Lokasi',
        'svg' => '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/><line x1="8" y1="2" x2="8" y2="18"/><line x1="16" y1="6" x2="16" y2="22"/></svg>'
    ],
    'kesehatan' => [
        'name' => 'Posyandu / Kesehatan',
        'svg' => '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>'
    ],
    'pertanian' => [
        'name' => 'Pertanian & Komoditas',
        'svg' => '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22V8"/><path d="M5 12H2a10 10 0 0 1 10-10v0a10 10 0 0 1 10 10h-3"/><path d="M7 16c1.5-2 3.5-3 5-3s3.5 1 5 3"/></svg>'
    ],
    'pengumuman' => [
        'name' => 'Pengumuman / Woro-woro',
        'svg' => '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m3 11 18-5v12L3 14v-3z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/></svg>'
    ],
    'kontak' => [
        'name' => 'Kontak / WhatsApp',
        'svg' => '<svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>'
    ]
];

$actionOptions = [
    '#modal-layanan' => '📄 Buka Pop-up: Syarat Layanan Surat Desa',
    '#modal-informasi' => '💰 Buka Pop-up: Transparansi Anggaran (APBDes)',
    '/profil-desa#pemerintahan' => '🏛️ Buka Halaman: Struktur Pemerintahan Desa',
    '#modal-kelembagaan' => '👥 Buka Pop-up: Kelembagaan Desa (BPD, PKK, Posyandu)',
    '#modal-demografi' => '📊 Buka Pop-up: Statistik Data Kependudukan',
    '/kegiatan' => '📸 Buka Halaman: Galeri & Kegiatan Desa',
    '/produk' => '🛍️ Buka Halaman: Katalog Produk UMKM',
    '/peta' => '🗺️ Buka Halaman: Peta Wilayah & Potensi Desa',
    'custom' => '🔗 Tautan Kustom / Link Luar Website...'
];
@endphp

@section('styles')
    <style>
        .setting-section {
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            padding: 24px;
            background: #FFF;
            margin-bottom: 28px;
        }
        .section-header {
            font-size: 15px;
            font-weight: 800;
            color: var(--biru-tua);
            margin-top: 0;
            margin-bottom: 18px;
            border-bottom: 2px solid var(--border);
            padding-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .slide-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }
        .slide-card {
            border: 1.5px solid #E2E8F0;
            border-radius: 10px;
            padding: 16px;
            background: #F8FAFC;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .slide-img-preview {
            width: 100%;
            height: 130px;
            object-fit: cover;
            border-radius: 6px;
            margin-bottom: 12px;
            background: #CBD5E1;
            border: 1px solid #DDE3E8;
        }
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 22px;
        }
        .portal-edit-card {
            border: 1.5px solid #E2E8F0;
            border-radius: 12px;
            padding: 20px;
            background: #F8FAFC;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .icon-pick-btn:hover {
            background: #E2E8F0 !important;
            border-color: var(--biru) !important;
            transform: scale(1.05);
        }
        .icon-pick-btn.active {
            background: #DBEAFE !important;
            border-color: #2563EB !important;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.2);
        }
    </style>
@endsection

@section('content')
    <div class="admin-box">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
            <div>
                <h1 style="margin: 0; font-size: 22px; color: var(--biru-tua); font-weight: 800;">🖼️ Pengaturan Beranda &amp; Slider</h1>
                <p style="margin: 4px 0 0; font-size: 13px; color: var(--teks-muted);">Kelola jumlah slide banner hero, narasi tentang desa, dan 6 kartu portal layanan utama.</p>
            </div>
            <a href="/" class="btn btn-secondary" target="_blank">Lihat Web Publik ↗</a>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="/admin/pengaturan/beranda" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- SECTION 1: HERO SLIDER BACKGROUND (DYNAMIC) -->
            <div class="setting-section">
                <div class="section-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                    <span>1. Background Banner Slide Hero Header</span>
                    <button type="button" class="btn btn-secondary" onclick="tambahSlideCard()" style="font-size: 12px; padding: 6px 14px; background: #E0F2FE; color: #0369A1; border: 1px solid #BAE6FD; font-weight: 700;">
                        + Tambah Slide Baru
                    </button>
                </div>
                <p style="margin-top:0; margin-bottom:16px; font-size:12.5px; color:var(--teks-muted);">
                    Anda dapat bebas menambah atau mengurangi jumlah slide banner. Setiap gambar yang diunggah akan otomatis dikompresi ke WebP agar halaman beranda tetap ringan dan cepat dimuat.
                </p>

                <div class="slide-grid" id="slide-grid-container">
                    @foreach($slides as $index => $slideUrl)
                        <div class="slide-card" data-slide-index="{{ $index }}">
                            <div>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                    <span class="slide-label" style="font-weight:800; font-size:12px; color:var(--biru-tua); background:#E2E8F0; padding:3px 8px; border-radius:4px;">
                                        SLIDE KE-{{ $loop->iteration }}
                                    </span>
                                    <button type="button" onclick="hapusSlideCard(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:4px; padding:3px 8px; font-size:11px; font-weight:700; cursor:pointer;" title="Hapus slide ini">
                                        ✕ Hapus
                                    </button>
                                </div>

                                <img src="{{ $slideUrl }}" class="slide-img-preview" alt="Preview Slide {{ $loop->iteration }}">

                                <input type="hidden" name="slide_keys[]" value="{{ $index }}">
                                <input type="hidden" name="slide_existing[]" value="{{ $slideUrl }}">
                            </div>

                            <div style="margin-top: 8px;">
                                <label style="font-size: 11.5px; font-weight: 600; color: var(--teks-muted); display: block; margin-bottom: 4px;">Ganti Foto Slide:</label>
                                <input type="file" name="slide_file_{{ $index }}" accept="image/*" style="font-size:12px; width: 100%;" onchange="previewSlideImage(this)">
                            </div>
                        </div>
                    @endforeach
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
                    <label>Paragraf Kedua (Kondisi Dusun &amp; Komoditas)</label>
                    <textarea name="tentang_p2" rows="3" required placeholder="Tulis paragraf kedua...">{{ old('tentang_p2', $tentang['tentang_p2']) }}</textarea>
                </div>

                <div class="form-group">
                    <label>Paragraf Ketiga (Ajakan / Penutup)</label>
                    <textarea name="tentang_p3" rows="3" required placeholder="Tulis paragraf ketiga...">{{ old('tentang_p3', $tentang['tentang_p3']) }}</textarea>
                </div>
            </div>

            <!-- SECTION 3: LAYANAN & INFORMASI CARDS (VISUAL ICON PICKER & ACTION DROPDOWN) -->
            <div class="setting-section">
                <div class="section-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                    <span>3. Kartu Layanan &amp; Informasi (6 Kotak Portal)</span>
                    <button type="submit" name="action" value="reset_cards" class="btn btn-secondary" style="font-size: 11.5px; padding: 6px 12px; background: #FFE4E6; color: #9F1239; border: 1px solid #FECDD3;" onclick="return confirm('Apakah Anda yakin ingin mengembalikan seluruh 6 kartu layanan ke pengaturan bawaan (default)? Semua perubahan pada kartu saat ini akan ditimpa.');">
                        Kembalikan Kartu ke Default
                    </button>
                </div>
                <p style="margin-top:0; margin-bottom:16px; font-size:12.5px; color:var(--teks-muted);">
                    Atur judul, penjelasan, tujuan aksi saat diklik, dan pilih ikon visual dengan mudah untuk masing-masing 6 kotak layanan publik.
                </p>
                
                <div class="card-grid">
                    @foreach($layanan_cards as $index => $card)
                        @php 
                            $isCustom = !array_key_exists($card['link'], $actionOptions); 
                        @endphp
                        <div class="portal-edit-card" data-card-idx="{{ $index }}">
                            <div>
                                <!-- Header & Visual Icon Preview -->
                                <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 16px; border-bottom: 1px solid #E2E8F0; padding-bottom: 14px;">
                                    <div class="card-icon-preview" style="width: 52px; height: 52px; border-radius: 50%; background: linear-gradient(135deg, var(--biru) 0%, var(--biru-tua) 100%); display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(22,104,163,0.3); flex-shrink: 0;">
                                        {!! $card['icon'] !!}
                                    </div>
                                    <div>
                                        <span style="background:var(--biru-tua); color:#fff; font-size:11px; font-weight:800; padding:3px 8px; border-radius:4px; display:inline-block; margin-bottom:4px;">KOTAK KE-{{ $index + 1 }}</span>
                                        <div style="font-size:12px; color:var(--teks-muted);">Klik ikon di bawah untuk mengganti</div>
                                    </div>
                                </div>
                                
                                <div class="form-group" style="margin-bottom:12px;">
                                    <label style="font-size:12.5px;">Judul Kotak Portal</label>
                                    <input type="text" name="card_title[]" value="{{ $card['title'] }}" required placeholder="Contoh: Layanan Administrasi">
                                </div>

                                <div class="form-group" style="margin-bottom:12px;">
                                    <label style="font-size:12.5px;">Deskripsi Singkat</label>
                                    <textarea name="card_desc[]" rows="2" required placeholder="Tulis ringkasan info..." style="width:100%; padding:10px; border:1px solid #DDE3E8; border-radius:6px; font-family:inherit; font-size:13.5px; box-sizing:border-box;">{{ $card['desc'] }}</textarea>
                                </div>

                                <!-- Action Dropdown Selector -->
                                <div class="form-group" style="margin-bottom:14px;">
                                    <label style="font-size:12.5px; font-weight:700; color:var(--biru-tua);">Aksi Tujuan saat Diklik:</label>
                                    <select class="card-action-select" onchange="handleActionChange(this)" style="width:100%; padding:9px 12px; border:1.5px solid #CBD5E1; border-radius:6px; font-weight:600; font-size:12.5px; background:#FFF; color:#1E293B;">
                                        @foreach($actionOptions as $optVal => $optLabel)
                                            <option value="{{ $optVal }}" {{ ($card['link'] === $optVal || ($optVal === 'custom' && $isCustom)) ? 'selected' : '' }}>
                                                {{ $optLabel }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="card_link[]" value="{{ $card['link'] }}" class="card-link-hidden">
                                    
                                    <div class="custom-url-box" style="margin-top:8px; display: {{ $isCustom ? 'block' : 'none' }};">
                                        <label style="font-size:11.5px; color:var(--teks-muted); display:block; margin-bottom:3px;">Alamat Tautan Bebas:</label>
                                        <input type="text" value="{{ $card['link'] }}" placeholder="https://wa.me/... atau /halaman-lain" oninput="updateCustomLink(this)" style="font-size:12px; padding:7px 10px; border:1px solid #CBD5E1; border-radius:6px; width:100%; box-sizing:border-box;">
                                    </div>
                                </div>
                            </div>

                            <!-- Visual Icon Picker Grid -->
                            <div class="form-group" style="margin-bottom:0; background:#FFF; border:1px solid #E2E8F0; padding:12px; border-radius:8px;">
                                <label style="font-size:12px; font-weight:700; color:var(--biru-tua); display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                                    <span>Pilih Ikon Visual:</span>
                                    <span style="font-size:11px; font-weight:normal; color:#64748B;">Klik 1 ikon</span>
                                </label>
                                <div class="icon-picker-grid" style="display:grid; grid-template-columns: repeat(6, 1fr); gap:6px;">
                                    @foreach($presetIcons as $pKey => $pIcon)
                                        <button type="button" class="icon-pick-btn" onclick="selectPresetIcon(this)" data-svg="{{ base64_encode($pIcon['svg']) }}" title="{{ $pIcon['name'] }}" style="padding:6px; border:1.5px solid #E2E8F0; border-radius:6px; background:#F8FAFC; cursor:pointer; display:flex; align-items:center; justify-content:center; height:38px; transition:all 0.15s;">
                                            <div style="width:24px; height:24px; display:flex; align-items:center; justify-content:center; filter:invert(23%) sepia(87%) saturate(1638%) hue-rotate(186deg) brightness(91%) contrast(92%);">
                                                {!! $pIcon['svg'] !!}
                                            </div>
                                        </button>
                                    @endforeach
                                </div>
                                <input type="hidden" name="card_icon[]" value="{{ $card['icon'] }}" class="card-icon-hidden">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Submit Floating Bar / Bottom Action -->
            <div style="background: #F8FAFC; border: 1.5px solid var(--border); padding: 18px 24px; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-top: 10px;">
                <span style="font-size: 13px; color: var(--teks-muted);">Periksa kembali formulir di atas sebelum menyimpan.</span>
                <button type="submit" class="btn btn-primary" style="padding: 12px 28px; font-size: 14.5px;">
                    Simpan Pengaturan Beranda
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        // ================= SLIDE BANNER FUNCTIONS =================
        function updateSlideNumbering() {
            const container = document.getElementById('slide-grid-container');
            const cards = container.querySelectorAll('.slide-card');
            cards.forEach((card, idx) => {
                const label = card.querySelector('.slide-label');
                if (label) {
                    label.textContent = `SLIDE KE-${idx + 1}`;
                }
            });
        }

        function previewSlideImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                const card = input.closest('.slide-card');
                const previewImg = card.querySelector('.slide-img-preview');
                reader.onload = function(e) {
                    if (previewImg) {
                        previewImg.src = e.target.result;
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function hapusSlideCard(btn) {
            const container = document.getElementById('slide-grid-container');
            const cards = container.querySelectorAll('.slide-card');
            
            if (cards.length <= 1) {
                alert('Setidaknya harus tersisa minimal 1 slide banner pada halaman beranda!');
                return;
            }

            if (confirm('Apakah Anda yakin ingin menghapus slide ini?')) {
                const card = btn.closest('.slide-card');
                if (card) {
                    card.remove();
                    updateSlideNumbering();
                }
            }
        }

        function tambahSlideCard() {
            const container = document.getElementById('slide-grid-container');
            const uniqueId = 'new_' + Date.now();
            const currentTotal = container.querySelectorAll('.slide-card').length;

            const card = document.createElement('div');
            card.className = 'slide-card';
            card.dataset.slideIndex = uniqueId;
            card.innerHTML = `
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <span class="slide-label" style="font-weight:800; font-size:12px; color:var(--biru-tua); background:#E2E8F0; padding:3px 8px; border-radius:4px;">
                            SLIDE KE-${currentTotal + 1}
                        </span>
                        <button type="button" onclick="hapusSlideCard(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:4px; padding:3px 8px; font-size:11px; font-weight:700; cursor:pointer;" title="Hapus slide ini">
                            ✕ Hapus
                        </button>
                    </div>

                    <img src="/images/slider/sdn2.jpeg" class="slide-img-preview" alt="Preview Slide Baru">

                    <input type="hidden" name="slide_keys[]" value="${uniqueId}">
                    <input type="hidden" name="slide_existing[]" value="/images/slider/sdn2.jpeg">
                </div>

                <div style="margin-top: 8px;">
                    <label style="font-size: 11.5px; font-weight: 600; color: #0284C7; display: block; margin-bottom: 4px;">Pilih Gambar Baru:</label>
                    <input type="file" name="slide_file_${uniqueId}" accept="image/*" style="font-size:12px; width: 100%;" onchange="previewSlideImage(this)" required>
                </div>
            `;

            container.appendChild(card);
            updateSlideNumbering();
        }

        // ================= PORTAL CARDS ICON & ACTION HANDLERS =================
        function handleActionChange(selectEl) {
            const card = selectEl.closest('.portal-edit-card');
            const hiddenLinkInput = card.querySelector('.card-link-hidden');
            const customUrlBox = card.querySelector('.custom-url-box');
            const customInput = customUrlBox.querySelector('input');

            if (selectEl.value === 'custom') {
                customUrlBox.style.display = 'block';
                hiddenLinkInput.value = customInput.value || '';
            } else {
                customUrlBox.style.display = 'none';
                hiddenLinkInput.value = selectEl.value;
            }
        }

        function updateCustomLink(inputEl) {
            const card = inputEl.closest('.portal-edit-card');
            const hiddenLinkInput = card.querySelector('.card-link-hidden');
            hiddenLinkInput.value = inputEl.value;
        }

        function selectPresetIcon(btnEl) {
            const card = btnEl.closest('.portal-edit-card');
            const rawSvgB64 = btnEl.dataset.svg;
            const decodedSvg = atob(rawSvgB64);

            // Update preview circle
            const previewContainer = card.querySelector('.card-icon-preview');
            if (previewContainer) {
                previewContainer.innerHTML = decodedSvg;
            }

            // Update hidden input
            const hiddenIconInput = card.querySelector('.card-icon-hidden');
            if (hiddenIconInput) {
                hiddenIconInput.value = decodedSvg;
            }

            // Update active state in grid
            const allBtns = card.querySelectorAll('.icon-pick-btn');
            allBtns.forEach(b => b.classList.remove('active'));
            btnEl.classList.add('active');
        }
    </script>
@endsection
