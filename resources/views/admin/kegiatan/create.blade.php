<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kegiatan - Admin Desa</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #F4F6F8; margin: 0; padding: 20px; }
        .container { max-width: 700px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        h1 { margin-top: 0; color: #0B3B60; font-size: 24px; margin-bottom: 24px; }
        .form-group { margin-bottom: 20px; display: flex; flex-direction: column; gap: 8px; }
        label { font-weight: 700; color: #1A2833; font-size: 14px; }
        input[type="text"], input[type="date"], select, textarea { 
            padding: 10px 14px; border: 1px solid #DDE3E8; border-radius: 6px; 
            font-size: 14px; font-family: inherit; width: 100%; box-sizing: border-box;
        }
        textarea { height: 160px; resize: vertical; }
        .btn { padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 14px; border: none; cursor: pointer; display: inline-block; }
        .btn-primary { background: #1668A3; color: white; }
        .btn-secondary { background: #E2E8F0; color: #1A2833; }
        .form-actions { display: flex; gap: 10px; justify-content: flex-end; margin-top: 30px; }
        .error-msg { color: #DC2626; font-size: 12px; font-weight: 600; margin-top: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Kegiatan & Galeri</h1>

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
                <label for="foto">Foto Kegiatan</label>
                <input type="file" name="foto" id="foto" accept="image/*">
                <small style="color: #64748B;">Format yang diizinkan: JPG, JPEG, PNG (Maksimal 15MB, akan dikompresi otomatis)</small>
                @error('foto') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi Lengkap Kegiatan</label>
                <textarea name="deskripsi" id="deskripsi" required placeholder="Tulis deskripsi atau jalannya kegiatan selengkapnya disini...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-actions">
                <a href="/admin/kegiatan" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Kegiatan</button>
            </div>
        </form>
    </div>

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
</body>
</html>
