<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita - Admin Desa</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.snow.css" rel="stylesheet" />
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
        .current-img { margin-top: 10px; border-radius: 6px; border: 1px solid #DDE3E8; max-width: 200px; display: block; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Berita Desa</h1>

        <form action="/admin/berita/{{ $berita->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="judul">Judul Berita</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $berita->judul) }}" required placeholder="Masukkan judul berita">
                @error('judul') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" required>
                    <option value="Umum" {{ old('kategori', $berita->kategori) == 'Umum' ? 'selected' : '' }}>Umum</option>
                    <option value="Pengumuman" {{ old('kategori', $berita->kategori) == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                    <option value="Pembangunan" {{ old('kategori', $berita->kategori) == 'Pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                    <option value="Kegiatan" {{ old('kategori', $berita->kategori) == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                </select>
                @error('kategori') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal Publikasi</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $berita->tanggal) }}" required>
                @error('tanggal') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="foto">Foto Banner Berita (Biarkan kosong jika tidak ingin mengubah)</label>
                <input type="file" name="foto" id="foto" accept="image/*">
                @if($berita->foto)
                    <img src="{{ asset('storage/' . $berita->foto) }}" alt="Foto Saat Ini" class="current-img">
                @endif
                <small style="color: #64748B; display: block; margin-top: 6px;">Format yang diizinkan: JPG, JPEG, PNG (Maksimal 2MB)</small>
                @error('foto') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="isi">Isi Berita Lengkap</label>
                <input type="hidden" name="isi" id="isi-input" value="{{ old('isi', $berita->isi) }}">
                <div id="editor" style="height: 250px; background: white; border: 1px solid #DDE3E8; border-radius: 6px;">
                    {!! old('isi', $berita->isi) !!}
                </div>
                @error('isi') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-actions">
                <a href="/admin/berita" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <!-- Quill Editor Script -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.js"></script>
    <script>
        const quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Tulis isi berita selengkapnya disini...',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['clean']
                ]
            }
        });

        // Sync Quill content to hidden input on form submit
        document.querySelector('form').onsubmit = function() {
            document.getElementById('isi-input').value = quill.root.innerHTML;
        };
    </script>
</body>
</html>
