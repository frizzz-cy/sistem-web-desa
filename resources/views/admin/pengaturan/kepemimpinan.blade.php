@extends('layouts.admin', ['activePage' => 'pengaturan-kepemimpinan'])

@section('title', 'Timeline Kepemimpinan Desa')

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
        .kades-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
        }
        .kades-card {
            border: 1.5px solid #E2E8F0;
            border-radius: 12px;
            padding: 20px;
            background: #F8FAFC;
            position: relative;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .kades-card.aktif {
            border-color: #F59E0B;
            background: #FFFBEB;
            box-shadow: 0 4px 14px rgba(245, 158, 11, 0.15);
        }
        .kades-card.aktif::before {
            content: "👑 PETAHANA / AKTIF";
            position: absolute;
            top: 12px;
            right: 14px;
            background: #F59E0B;
            color: #FFF;
            font-size: 10px;
            font-weight: 800;
            padding: 2px 8px;
            border-radius: 20px;
            letter-spacing: 0.5px;
        }
        .photo-preview-box {
            width: 80px;
            height: 96px;
            border-radius: 8px;
            background: #E2E8F0;
            border: 2px solid #CBD5E1;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
            position: relative;
        }
        .photo-preview-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .photo-preview-box svg {
            width: 44px;
            height: 44px;
            fill: #94A3B8;
        }
        .btn-delete-card {
            background: transparent;
            border: none;
            color: #EF4444;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 4px;
            transition: background 0.2s;
        }
        .btn-delete-card:hover {
            background: #FEE2E2;
        }
    </style>
@endsection

@section('content')
    <div class="admin-box">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
            <div>
                <h1 style="margin: 0; font-size: 22px; color: var(--biru-tua); font-weight: 800;">🎖️ Timeline Kepemimpinan Desa</h1>
                <p style="margin: 4px 0 0; font-size: 13px; color: var(--teks-muted);">Kelola urutan masa jabatan, nama Kepala Desa, serta <b>tambah dan hapus foto pigora</b> kepemimpinan desa dari masa ke masa.</p>
            </div>
            <div style="display:flex; gap:10px;">
                <a href="/profil-desa#kepemimpinan" class="btn btn-secondary" target="_blank">Lihat di Web ↗</a>
                <button type="button" class="btn btn-primary" onclick="tambahKadesBaru()">+ Tambah Periode Baru</button>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="/admin/pengaturan/kepemimpinan" method="POST" enctype="multipart/form-data" id="form-kepemimpinan">
            @csrf

            <div class="setting-section">
                <div class="section-header">Daftar Kepala Desa dari Masa ke Masa (Slider Pigora)</div>
                <p style="margin-top:0; margin-bottom:20px; font-size:12.5px; color:var(--teks-muted);">
                    Setiap periode ditampilkan dalam bingkai pigora estetik di halaman Profil Desa. Anda dapat menambahkan foto jika tersedia, atau mengosongkannya (menampilkan siluet resmi).
                </p>

                <div class="kades-grid" id="kades-container">
                    @foreach($data_kepemimpinan as $item)
                        @php
                            $id = $item['id'] ?? $loop->iteration;
                            $hasFoto = !empty($item['foto']);
                            $isAktif = !empty($item['aktif']);
                        @endphp
                        <div class="kades-card {{ $isAktif ? 'aktif' : '' }}" id="card-kades-{{ $id }}">
                            <input type="hidden" name="kades_id[]" value="{{ $id }}">
                            <input type="hidden" name="delete_foto_{{ $id }}" id="delete_foto_{{ $id }}" value="0">
                            <input type="hidden" name="kades_foto_media_{{ $id }}" id="kades_media_{{ $id }}" value="">

                            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:14px;">
                                <span style="font-size:11px; font-weight:800; background:#E0F2FE; color:#0369A1; padding:3px 8px; border-radius:4px;">
                                    URUTAN #{{ $loop->iteration }}
                                </span>
                                <button type="button" class="btn-delete-card" onclick="hapusCardKades('card-kades-{{ $id }}')" title="Hapus periode kepemimpinan ini">
                                    🗑️ Hapus Periode
                                </button>
                            </div>

                            <!-- Baris Foto & Aksi Foto -->
                            <div style="display:flex; gap:16px; align-items:flex-start; margin-bottom:16px; background:#FFF; border:1px solid #E2E8F0; border-radius:10px; padding:12px;">
                                <div class="photo-preview-box" id="preview-box-{{ $id }}">
                                    @if($hasFoto)
                                        <img src="{{ $item['foto'] }}" alt="Foto {{ $item['nama'] }}" id="preview-img-{{ $id }}">
                                    @else
                                        <svg viewBox="0 0 24 24" id="placeholder-svg-{{ $id }}"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.5c-3.3 0-9.8 1.6-9.8 4.9v2.4h19.6v-2.4c0-3.3-6.5-4.9-9.8-4.9z"/></svg>
                                    @endif
                                </div>

                                <div style="flex:1; min-width:0;">
                                    <label style="font-size:11.5px; font-weight:700; color:#475569; display:block; margin-bottom:6px;">Foto Kepala Desa</label>
                                    <div style="display:flex; flex-wrap:wrap; gap:8px; margin-bottom:8px;">
                                        <label class="btn btn-secondary" style="font-size:11.5px; padding:6px 12px; cursor:pointer; margin-bottom:0; display:inline-flex; align-items:center; gap:4px;">
                                            📸 Unggah Foto
                                            <input type="file" name="kades_foto_{{ $id }}" accept="image/*" style="display:none;" onchange="previewFotoKadesLocal(this, '{{ $id }}')">
                                        </label>
                                        <button type="button" class="btn btn-secondary" style="font-size:11.5px; padding:6px 12px;" onclick="pilihFotoKadesDariMedia('{{ $id }}')">
                                            📁 Dari Media
                                        </button>
                                        <button type="button" class="btn btn-danger" id="btn-hapus-foto-{{ $id }}" style="font-size:11.5px; padding:6px 10px; {{ $hasFoto ? '' : 'display:none;' }}" onclick="hapusFotoKades('{{ $id }}')" title="Hapus foto Kepala Desa ini dan kembali ke siluet default">
                                            🗑️ Hapus Foto
                                        </button>
                                    </div>
                                    <small style="font-size:11px; color:#64748B; display:block;" id="foto-status-{{ $id }}">
                                        {{ $hasFoto ? '✓ Foto terpasang' : 'Foto belum ada (siluet avatar)' }}
                                    </small>
                                </div>
                            </div>

                            <!-- Input Formulir -->
                            <div class="form-group" style="margin-bottom:12px;">
                                <label style="font-size:12px;">Nama Kepala Desa</label>
                                <input type="text" name="kades_nama[]" value="{{ $item['nama'] }}" required placeholder="Contoh: Sutrismi">
                            </div>

                            <div class="form-group" style="margin-bottom:12px;">
                                <label style="font-size:12px;">Jabatan</label>
                                <input type="text" name="kades_jabatan[]" value="{{ $item['jabatan'] ?? 'Kepala Desa Munungkerep' }}" required placeholder="Kepala Desa Munungkerep">
                            </div>

                            <div class="form-group" style="margin-bottom:14px;">
                                <label style="font-size:12px;">Periode Tahun Jabatan</label>
                                <input type="text" name="kades_periode[]" value="{{ $item['periode'] }}" required placeholder="Contoh: Periode Tahun 2003 - 2013">
                            </div>

                            <!-- Status Aktif / Petahana -->
                            <div style="background:#FFF; border:1px solid #E2E8F0; padding:10px 12px; border-radius:8px; display:flex; align-items:center; gap:8px;">
                                <input type="radio" name="kades_aktif" id="radio_aktif_{{ $id }}" value="{{ $id }}" {{ $isAktif ? 'checked' : '' }} onchange="updateAktifClass()">
                                <label for="radio_aktif_{{ $id }}" style="font-size:12.5px; font-weight:700; color:#1E293B; margin-bottom:0; cursor:pointer;">
                                    Tandai sebagai Kepala Desa Aktif / Petahana
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Submit Floating Bar / Bottom Action -->
            <div style="background: #F8FAFC; border: 1.5px solid var(--border); padding: 18px 24px; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-top: 10px;">
                <span style="font-size: 13px; color: var(--teks-muted);">Periksa kembali perubahan foto dan nama sebelum menyimpan.</span>
                <button type="submit" class="btn btn-primary" style="padding: 12px 28px; font-size: 14.5px;">
                    Simpan Perubahan Timeline
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        // 1. Preview Foto Lokal Saat File Dipilih
        function previewFotoKadesLocal(input, id) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const box = document.getElementById('preview-box-' + id);
                    box.innerHTML = `<img src="${e.target.result}" id="preview-img-${id}" alt="Foto Baru">`;
                    
                    // Reset hidden delete flag
                    document.getElementById('delete_foto_' + id).value = '0';
                    document.getElementById('kades_media_' + id).value = '';
                    
                    // Tampilkan tombol hapus foto
                    const btnHapus = document.getElementById('btn-hapus-foto-' + id);
                    if (btnHapus) btnHapus.style.display = 'inline-block';

                    const statusTxt = document.getElementById('foto-status-' + id);
                    if (statusTxt) statusTxt.textContent = '✓ Foto baru dipilih (siap disimpan)';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // 2. Pilih Foto dari Pustaka Media
        function pilihFotoKadesDariMedia(id) {
            window.openMediaPicker({
                onSelect: function(item) {
                    const box = document.getElementById('preview-box-' + id);
                    box.innerHTML = `<img src="${item.url}" id="preview-img-${id}" alt="Foto Media">`;

                    document.getElementById('kades_media_' + id).value = item.url;
                    document.getElementById('delete_foto_' + id).value = '0';

                    const btnHapus = document.getElementById('btn-hapus-foto-' + id);
                    if (btnHapus) btnHapus.style.display = 'inline-block';

                    const statusTxt = document.getElementById('foto-status-' + id);
                    if (statusTxt) statusTxt.textContent = '✓ Foto dipilih dari pustaka media';
                }
            });
        }

        // 3. Hapus Foto (Kembalikan ke Siluet Avatar Default)
        function hapusFotoKades(id) {
            if (!confirm('Yakin ingin menghapus foto Kepala Desa ini dan mengembalikannya ke siluet avatar default?')) {
                return;
            }

            const box = document.getElementById('preview-box-' + id);
            box.innerHTML = `<svg viewBox="0 0 24 24" id="placeholder-svg-${id}"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.5c-3.3 0-9.8 1.6-9.8 4.9v2.4h19.6v-2.4c0-3.3-6.5-4.9-9.8-4.9z"/></svg>`;

            // Tandai bahwa foto dihapus
            document.getElementById('delete_foto_' + id).value = '1';
            document.getElementById('kades_media_' + id).value = '';

            // Sembunyikan tombol hapus foto
            const btnHapus = document.getElementById('btn-hapus-foto-' + id);
            if (btnHapus) btnHapus.style.display = 'none';

            const statusTxt = document.getElementById('foto-status-' + id);
            if (statusTxt) statusTxt.textContent = 'Foto dihapus (akan menggunakan siluet avatar)';
        }

        // 4. Hapus Card Periode
        function hapusCardKades(cardId) {
            if (confirm('Yakin ingin menghapus periode kepemimpinan ini?')) {
                const card = document.getElementById(cardId);
                if (card) {
                    card.remove();
                    updateUrutanNomor();
                }
            }
        }

        // 5. Update Urutan Nomor & Class Aktif
        function updateUrutanNomor() {
            const cards = document.querySelectorAll('.kades-card');
            cards.forEach((card, idx) => {
                const badge = card.querySelector('span');
                if (badge) badge.textContent = 'URUTAN #' + (idx + 1);
            });
        }

        function updateAktifClass() {
            const cards = document.querySelectorAll('.kades-card');
            cards.forEach(card => {
                const radio = card.querySelector('input[type="radio"]');
                if (radio && radio.checked) {
                    card.classList.add('aktif');
                } else {
                    card.classList.remove('aktif');
                }
            });
        }

        // 6. Tambah Periode Kades Baru Secara Dinamis
        function tambahKadesBaru() {
            const container = document.getElementById('kades-container');
            const newId = 'new_' + Date.now();
            const count = container.querySelectorAll('.kades-card').length + 1;

            const cardHtml = `
                <div class="kades-card" id="card-kades-${newId}">
                    <input type="hidden" name="kades_id[]" value="${newId}">
                    <input type="hidden" name="delete_foto_${newId}" id="delete_foto_${newId}" value="0">
                    <input type="hidden" name="kades_foto_media_${newId}" id="kades_media_${newId}" value="">

                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:14px;">
                        <span style="font-size:11px; font-weight:800; background:#E0F2FE; color:#0369A1; padding:3px 8px; border-radius:4px;">
                            URUTAN #${count}
                        </span>
                        <button type="button" class="btn-delete-card" onclick="hapusCardKades('card-kades-${newId}')" title="Hapus periode kepemimpinan ini">
                            🗑️ Hapus Periode
                        </button>
                    </div>

                    <div style="display:flex; gap:16px; align-items:flex-start; margin-bottom:16px; background:#FFF; border:1px solid #E2E8F0; border-radius:10px; padding:12px;">
                        <div class="photo-preview-box" id="preview-box-${newId}">
                            <svg viewBox="0 0 24 24" id="placeholder-svg-${newId}"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.5c-3.3 0-9.8 1.6-9.8 4.9v2.4h19.6v-2.4c0-3.3-6.5-4.9-9.8-4.9z"/></svg>
                        </div>

                        <div style="flex:1; min-width:0;">
                            <label style="font-size:11.5px; font-weight:700; color:#475569; display:block; margin-bottom:6px;">Foto Kepala Desa</label>
                            <div style="display:flex; flex-wrap:wrap; gap:8px; margin-bottom:8px;">
                                <label class="btn btn-secondary" style="font-size:11.5px; padding:6px 12px; cursor:pointer; margin-bottom:0; display:inline-flex; align-items:center; gap:4px;">
                                    📸 Unggah Foto
                                    <input type="file" name="kades_foto_${newId}" accept="image/*" style="display:none;" onchange="previewFotoKadesLocal(this, '${newId}')">
                                </label>
                                <button type="button" class="btn btn-secondary" style="font-size:11.5px; padding:6px 12px;" onclick="pilihFotoKadesDariMedia('${newId}')">
                                    📁 Dari Media
                                </button>
                                <button type="button" class="btn btn-danger" id="btn-hapus-foto-${newId}" style="font-size:11.5px; padding:6px 10px; display:none;" onclick="hapusFotoKades('${newId}')">
                                    🗑️ Hapus Foto
                                </button>
                            </div>
                            <small style="font-size:11px; color:#64748B; display:block;" id="foto-status-${newId}">
                                Foto belum ada (siluet avatar)
                            </small>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom:12px;">
                        <label style="font-size:12px;">Nama Kepala Desa</label>
                        <input type="text" name="kades_nama[]" value="" required placeholder="Contoh: Nama Kepala Desa">
                    </div>

                    <div class="form-group" style="margin-bottom:12px;">
                        <label style="font-size:12px;">Jabatan</label>
                        <input type="text" name="kades_jabatan[]" value="Kepala Desa Munungkerep" required placeholder="Kepala Desa Munungkerep">
                    </div>

                    <div class="form-group" style="margin-bottom:14px;">
                        <label style="font-size:12px;">Periode Tahun Jabatan</label>
                        <input type="text" name="kades_periode[]" value="" required placeholder="Contoh: Periode Tahun 2026 - 2031">
                    </div>

                    <div style="background:#FFF; border:1px solid #E2E8F0; padding:10px 12px; border-radius:8px; display:flex; align-items:center; gap:8px;">
                        <input type="radio" name="kades_aktif" id="radio_aktif_${newId}" value="${newId}" onchange="updateAktifClass()">
                        <label for="radio_aktif_${newId}" style="font-size:12.5px; font-weight:700; color:#1E293B; margin-bottom:0; cursor:pointer;">
                            Tandai sebagai Kepala Desa Aktif / Petahana
                        </label>
                    </div>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', cardHtml);
            const newCard = document.getElementById('card-kades-' + newId);
            newCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    </script>
@endsection
