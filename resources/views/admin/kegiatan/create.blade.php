@extends('layouts.admin', ['activePage' => 'kegiatan'])

@section('title', 'Tambah Kegiatan')

@section('styles')
    <style>
        textarea { height: 160px; resize: vertical; }
    </style>
@endsection

@section('content')
    <div class="admin-box" style="max-width: 700px; margin: 0 auto;">
        <h2 style="margin-top:0; margin-bottom: 20px; color: var(--biru-tua); font-weight: 800;">Tambah Kegiatan & Galeri</h2>

        <form action="/admin/kegiatan" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="judul">Judul Kegiatan</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required placeholder="Masukkan judul kegiatan/dokumentasi">
                @error('judul') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" required>
                    <option value="Pembangunan" {{ old('kategori') == 'Pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                    <option value="Pemberdayaan" {{ old('kategori') == 'Pemberdayaan' ? 'selected' : '' }}>Pemberdayaan</option>
                    <option value="Sosial" {{ old('kategori') == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                    <option value="Keagamaan" {{ old('kategori') == 'Keagamaan' ? 'selected' : '' }}>Keagamaan</option>
                    <option value="Kesehatan" {{ old('kategori') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                </select>
                @error('kategori') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal Pelaksanaan</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                @error('tanggal') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="lokasi">Lokasi Kegiatan</label>
                <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}" required placeholder="Contoh: Balai Desa, Dusun Kalipang">
                @error('lokasi') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="nama_pembuat">Nama Pembuat / Dokumentator</label>
                <input type="text" name="nama_pembuat" id="nama_pembuat" value="{{ old('nama_pembuat') }}" required placeholder="Contoh: Tim KKN 5">
                @error('nama_pembuat') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="foto">Foto Kegiatan (Maksimal 15MB)</label>
                <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                    <input type="file" name="foto" id="foto" accept="image/*" style="flex: 1; min-width: 220px;" onchange="onLocalFileChosen(this)">
                    <button type="button" class="btn btn-secondary" onclick="pilihFotoDariMedia()" style="font-size: 13px; padding: 9px 14px; white-space: nowrap; display: inline-flex; align-items: center; gap: 6px;">
                        <span>📁 Pilih dari Pustaka Media</span>
                    </button>
                </div>
                <input type="hidden" name="foto_media" id="foto_media_input">

                <div id="media-preview-box" style="display: none; margin-top: 12px; position: relative; width: fit-content;">
                    <div style="background: #F1F5F9; border: 1.5px solid #CBD5E1; border-radius: 8px; padding: 8px; display: flex; align-items: center; gap: 10px;">
                        <img id="media-preview-img" src="" alt="Preview Media" style="width: 70px; height: 50px; object-fit: cover; border-radius: 4px;">
                        <div>
                            <span style="font-size: 12px; font-weight: 700; color: var(--biru-tua); display: block;" id="media-preview-name">file.webp</span>
                            <span style="font-size: 11px; color: #16A34A; font-weight: 600;">✓ Terpilih dari Pustaka Server</span>
                        </div>
                        <button type="button" onclick="batalPilihMedia()" style="background: #FEE2E2; color: #DC2626; border: 1px solid #FECACA; border-radius: 4px; padding: 4px 8px; font-size: 11px; font-weight: 700; cursor: pointer; margin-left: 8px;" title="Batalkan pilihan ini">
                            ✕ Batal
                        </button>
                    </div>
                </div>

                <small style="color: #64748B; display: block; margin-top: 6px;">Format yang diizinkan: JPG, JPEG, PNG, WebP (Maksimal 15MB, akan dikompresi otomatis)</small>
                @error('foto') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi Lengkap Kegiatan</label>
                <textarea name="deskripsi" id="deskripsi" required placeholder="Tulis deskripsi atau jalannya kegiatan selengkapnya disini...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-actions" style="margin-top: 28px; display: flex; gap: 10px; justify-content: flex-end;">
                <a href="/admin/kegiatan" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Kegiatan</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function pilihFotoDariMedia() {
            window.openMediaPicker({
                onSelect: function(item) {
                    document.getElementById('foto_media_input').value = item.path;
                    document.getElementById('media-preview-img').src = item.url;
                    document.getElementById('media-preview-name').textContent = item.name;
                    document.getElementById('media-preview-box').style.display = 'block';
                    document.getElementById('foto').value = '';
                }
            });
        }

        function onLocalFileChosen(input) {
            if (input.files && input.files[0]) {
                document.getElementById('foto_media_input').value = '';
                document.getElementById('media-preview-box').style.display = 'none';
            }
        }

        function batalPilihMedia() {
            document.getElementById('foto_media_input').value = '';
            document.getElementById('media-preview-box').style.display = 'none';
        }

        document.querySelector('form').addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'Menyimpan...';
                submitBtn.style.opacity = '0.7';
                submitBtn.style.cursor = 'not-allowed';
            }
        });
    </script>
@endsection
