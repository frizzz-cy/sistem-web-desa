@extends('layouts.admin', ['activePage' => 'pengaturan-beranda'])

@section('title', 'Pengaturan Beranda & Slider')

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

            <!-- SECTION 3: LAYANAN & INFORMASI CARDS -->
            <div class="setting-section">
                <div class="section-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                    <span>3. Kartu Layanan &amp; Informasi (6 Kotak Portal)</span>
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
    </script>
@endsection
