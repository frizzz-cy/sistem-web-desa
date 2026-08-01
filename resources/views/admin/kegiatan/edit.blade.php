@extends('layouts.admin', ['activePage' => 'kegiatan'])

@section('title', 'Edit Kegiatan')

@section('styles')
    <style>
        textarea { height: 160px; resize: vertical; }
        .current-img { margin-top: 10px; border-radius: 6px; border: 1px solid #DDE3E8; max-width: 200px; display: block; }
    </style>
@endsection

@section('content')
    <div class="admin-box" style="max-width: 700px; margin: 0 auto;">
        <h2 style="margin-top:0; margin-bottom: 20px; color: var(--biru-tua); font-weight: 800;">Edit Kegiatan & Galeri</h2>

        <form action="/admin/kegiatan/{{ $kegiatan->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="judul">Judul Kegiatan</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $kegiatan->judul) }}" required placeholder="Masukkan judul kegiatan/dokumentasi">
                @error('judul') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" required>
                    <option value="Pembangunan" {{ old('kategori', $kegiatan->kategori) == 'Pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                    <option value="Pemberdayaan" {{ old('kategori', $kegiatan->kategori) == 'Pemberdayaan' ? 'selected' : '' }}>Pemberdayaan</option>
                    <option value="Sosial" {{ old('kategori', $kegiatan->kategori) == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                    <option value="Keagamaan" {{ old('kategori', $kegiatan->kategori) == 'Keagamaan' ? 'selected' : '' }}>Keagamaan</option>
                    <option value="Kesehatan" {{ old('kategori', $kegiatan->kategori) == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                </select>
                @error('kategori') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal Pelaksanaan</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $kegiatan->tanggal) }}" required>
                @error('tanggal') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="lokasi">Lokasi Kegiatan</label>
                <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $kegiatan->lokasi) }}" required placeholder="Contoh: Balai Desa, Dusun Kalipang">
                @error('lokasi') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="nama_pembuat">Nama Pembuat / Dokumentator</label>
                <input type="text" name="nama_pembuat" id="nama_pembuat" value="{{ old('nama_pembuat', $kegiatan->nama_pembuat) }}" required placeholder="Contoh: Tim KKN 5">
                @error('nama_pembuat') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="foto">Foto Kegiatan (Biarkan kosong jika tidak ingin mengubah, Maksimal 15MB)</label>
                <input type="file" name="foto" id="foto" accept="image/*">
                @if($kegiatan->foto)
                    <img src="{{ asset('storage/' . $kegiatan->foto) }}" alt="Foto Saat Ini" class="current-img">
                @endif
                <small style="color: #64748B; display: block; margin-top: 6px;">Format yang diizinkan: JPG, JPEG, PNG (Maksimal 15MB, akan dikompresi otomatis)</small>
                @error('foto') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi Lengkap Kegiatan</label>
                <textarea name="deskripsi" id="deskripsi" required placeholder="Tulis deskripsi atau jalannya kegiatan selengkapnya disini...">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                @error('deskripsi') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-actions" style="margin-top: 28px; display: flex; gap: 10px; justify-content: flex-end;">
                <a href="/admin/kegiatan" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <!-- Script Prevent Double Submit -->
    <script>
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
