@extends('layouts.admin', ['activePage' => 'pengaturan-poster'])

@section('title', 'Kelola Poster Perlombaan & Agenda Desa')

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
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
        }
        .poster-item-card {
            background: #FFF;
            border: 1.5px solid #CBD5E1;
            border-radius: 12px;
            padding: 22px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.04);
            position: relative;
            transition: all 0.2s ease;
        }
        .poster-item-card:hover {
            border-color: #94A3B8;
            box-shadow: 0 6px 18px rgba(0,0,0,0.06);
        }
    </style>
@endsection

@section('content')
    <div class="admin-box">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
            <div>
                <h1 style="margin: 0; font-size: 24px; color: var(--biru-tua); font-weight: 800;">
                    📢 Poster Perlombaan &amp; Agenda Desa
                </h1>
                <p style="margin: 4px 0 0; font-size: 13.5px; color: var(--teks-muted);">
                    Kelola pamflet lomba, poster kegiatan, dan agenda penting yang tampil di pop-up Informasi Publik.
                </p>
            </div>
            <div style="display:flex; gap:10px;">
                <a href="/#modal-informasi" class="btn btn-secondary" target="_blank">Lihat di Web Publik</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="/admin/pengaturan/poster" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="setting-section">
                <div class="section-header">
                    <span>Daftar Poster Kegiatan &amp; Perlombaan</span>
                    <button type="button" onclick="tambahPosterCard()" class="btn btn-secondary" style="font-size:12.5px; padding:7px 16px; background:#FEF3C7; color:#B45309; border:1px solid #FDE68A; font-weight:700;">
                        + Tambah Poster / Agenda Baru
                    </button>
                </div>

                <div id="poster-cards-container" style="display:flex; flex-direction:column; gap:18px;">
                    @php $pIdx = 0; @endphp
                    @forelse($poster_agendas ?? [] as $pKey => $poster)
                        @php 
                            $currKey = is_numeric($pKey) ? 'poster_' . $pKey : $pKey; 
                            $pIdx++;
                        @endphp
                        <div class="poster-item-card">
                            <input type="hidden" name="poster_keys[]" value="{{ $currKey }}">
                            
                            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; border-bottom:1px solid #E2E8F0; padding-bottom:12px;">
                                <h4 style="margin:0; font-size:15.5px; color:var(--biru-tua); font-weight:800; display:flex; align-items:center; gap:8px;">
                                    <span>📌 Poster #{{ $pIdx }}</span>
                                    <span style="font-size:11px; font-weight:700; background:#E0F2FE; color:#0369A1; padding:2px 8px; border-radius:10px;">{{ $poster['kategori'] ?? '🏆 Perlombaan Desa' }}</span>
                                </h4>
                                <button type="button" onclick="hapusPosterCard(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; padding:6px 14px; font-size:12px; font-weight:700; cursor:pointer;">
                                    🗑️ Hapus Poster
                                </button>
                            </div>

                            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:18px; margin-bottom:16px;">
                                <!-- Upload Foto Poster -->
                                <div>
                                    <label style="font-size:12.5px; font-weight:700; display:block; margin-bottom:6px;">Foto / Gambar Pamflet Poster</label>
                                    @if(!empty($poster['foto']))
                                        <div style="margin-bottom:8px;">
                                            <img src="{{ $poster['foto'] }}" class="poster-preview-img" alt="Poster Preview" style="max-height:180px; max-width:100%; border-radius:8px; border:1px solid #CBD5E1; object-fit:cover;">
                                        </div>
                                    @endif
                                    <div style="display:flex; gap:6px; align-items:center;">
                                        <input type="file" name="poster_foto_{{ $currKey }}" accept="image/*" style="font-size:12px; flex:1;">
                                    </div>
                                    <small style="display:block; color:#64748B; margin-top:4px; font-size:11px;">Format JPG, PNG, atau WEBP. Gambar otomatis dikompresi ke format optimal.</small>
                                </div>

                                <!-- Judul & Kategori -->
                                <div>
                                    <div class="form-group" style="margin-bottom:12px;">
                                        <label style="font-size:12.5px; font-weight:700;">Judul Perlombaan / Agenda</label>
                                        <input type="text" name="poster_judul[]" value="{{ $poster['judul'] ?? '' }}" placeholder="Contoh: Semarak Lomba Kemerdekaan RI Ke-81" required style="font-size:13.5px; font-weight:700;">
                                    </div>
                                    <div class="form-group" style="margin-bottom:0;">
                                        <label style="font-size:12.5px; font-weight:700;">Badge Kategori</label>
                                        <input type="text" name="poster_kategori[]" value="{{ $poster['kategori'] ?? '🏆 Perlombaan Desa' }}" placeholder="Contoh: 🏆 Perlombaan Desa / 🩺 Layanan Kesehatan / 📢 Pengumuman" required style="font-size:12.5px;">
                                    </div>
                                </div>
                            </div>

                            <!-- Waktu, Hari/Tanggal, Lokasi -->
                            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:12px; margin-bottom:16px; background:#F8FAFC; padding:14px; border-radius:8px; border:1px solid #E2E8F0;">
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
                            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:16px;">
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
                        <div id="poster-empty-state" style="text-align:center; padding:36px 20px; background:#F8FAFC; border:2px dashed #CBD5E1; border-radius:12px; color:#64748B;">
                            <div style="font-size:36px; margin-bottom:8px;">📢</div>
                            <div style="font-weight:800; font-size:15px; margin-bottom:4px; color:var(--biru-tua);">Belum Ada Poster Perlombaan / Agenda</div>
                            <div style="font-size:13px; margin-bottom:16px;">Klik tombol "+ Tambah Poster / Agenda Baru" di atas untuk menambahkan poster lomba atau kegiatan desa pertama Anda.</div>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Submit Floating Bar / Bottom Action -->
            <div style="background: #F8FAFC; border: 1.5px solid var(--border); padding: 18px 24px; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-top: 10px;">
                <span style="font-size: 13px; color: var(--teks-muted);">Periksa kembali formulir di atas sebelum menyimpan.</span>
                <button type="submit" class="btn btn-primary" style="padding: 12px 28px; font-size: 14.5px;">
                    Simpan Poster &amp; Agenda
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function tambahPosterCard() {
            const container = document.getElementById('poster-cards-container');
            const emptyState = document.getElementById('poster-empty-state');
            if (emptyState) emptyState.remove();

            const uniqueKey = 'poster_' + Date.now();
            const currentIdx = container.querySelectorAll('.poster-item-card').length + 1;

            const card = document.createElement('div');
            card.className = 'poster-item-card';
            card.innerHTML = `
                <input type="hidden" name="poster_keys[]" value="${uniqueKey}">
                
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; border-bottom:1px solid #E2E8F0; padding-bottom:12px;">
                    <h4 style="margin:0; font-size:15.5px; color:var(--biru-tua); font-weight:800; display:flex; align-items:center; gap:8px;">
                        <span>📌 Poster Baru (#${currentIdx})</span>
                        <span style="font-size:11px; font-weight:700; background:#FEF3C7; color:#B45309; padding:2px 8px; border-radius:10px;">Draft</span>
                    </h4>
                    <button type="button" onclick="hapusPosterCard(this)" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA; border-radius:6px; padding:6px 14px; font-size:12px; font-weight:700; cursor:pointer;">
                        🗑️ Hapus Poster
                    </button>
                </div>

                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:18px; margin-bottom:16px;">
                    <!-- Upload Foto Poster -->
                    <div>
                        <label style="font-size:12.5px; font-weight:700; display:block; margin-bottom:6px;">Foto / Gambar Pamflet Poster</label>
                        <div style="display:flex; gap:6px; align-items:center;">
                            <input type="file" name="poster_foto_${uniqueKey}" accept="image/*" style="font-size:12px; flex:1;">
                        </div>
                        <small style="display:block; color:#64748B; margin-top:4px; font-size:11px;">Format JPG, PNG, atau WEBP. Gambar otomatis dikompresi.</small>
                    </div>

                    <!-- Judul & Kategori -->
                    <div>
                        <div class="form-group" style="margin-bottom:12px;">
                            <label style="font-size:12.5px; font-weight:700;">Judul Perlombaan / Agenda</label>
                            <input type="text" name="poster_judul[]" placeholder="Contoh: Semarak Lomba Kemerdekaan RI Ke-81" required style="font-size:13.5px; font-weight:700;">
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label style="font-size:12.5px; font-weight:700;">Badge Kategori</label>
                            <input type="text" name="poster_kategori[]" value="🏆 Perlombaan Desa" placeholder="Contoh: 🏆 Perlombaan Desa / 🩺 Layanan Kesehatan / 📢 Pengumuman" required style="font-size:12.5px;">
                        </div>
                    </div>
                </div>

                <!-- Waktu, Hari/Tanggal, Lokasi -->
                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:12px; margin-bottom:16px; background:#F8FAFC; padding:14px; border-radius:8px; border:1px solid #E2E8F0;">
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
                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:16px;">
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
    </script>
@endsection
