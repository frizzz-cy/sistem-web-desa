<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita - Admin Desa</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Berita Desa</h1>

        <form action="/admin/berita" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="judul">Judul Berita</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required placeholder="Masukkan judul berita">
                @error('judul') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" required>
                    <option value="Umum" {{ old('kategori') == 'Umum' ? 'selected' : '' }}>Umum</option>
                    <option value="Pengumuman" {{ old('kategori') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                    <option value="Pembangunan" {{ old('kategori') == 'Pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                    <option value="Kegiatan" {{ old('kategori') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                </select>
                @error('kategori') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal Publikasi</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                @error('tanggal') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="foto">Foto Banner Berita</label>
                <input type="file" name="foto" id="foto" accept="image/*">
                <small style="color: #64748B;">Format yang diizinkan: JPG, JPEG, PNG (Maksimal 15MB, akan dikompresi otomatis)</small>
                @error('foto') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="isi">Isi Berita Lengkap</label>
                <input type="hidden" name="isi" id="isi-input" value="{{ old('isi') }}">
                <div id="editor" style="height: 250px; background: white; border: 1px solid #DDE3E8; border-radius: 6px;">
                    {!! old('isi') !!}
                </div>
                @error('isi') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-actions">
                <a href="/admin/berita" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Berita</button>
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
                toolbar: {
                    container: [
                        ['bold', 'italic', 'underline', 'strike'],
                        ['image'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['clean']
                    ],
                    handlers: {
                        image: imageHandler
                    }
                }
            }
        });

        function imageHandler() {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.click();

            input.onchange = async () => {
                const file = input.files[0];
                if (!file) return;

                const formData = new FormData();
                formData.append('image', file);
                formData.append('_token', '{{ csrf_token() }}');

                try {
                    const response = await fetch('/admin/berita/upload-image', {
                        method: 'POST',
                        body: formData
                    });

                    if (response.ok) {
                        const result = await response.json();
                        const range = quill.getSelection();
                        quill.insertEmbed(range.index, 'image', result.url);
                    } else {
                        alert('Gagal mengunggah gambar. Pastikan format gambar sesuai dan ukuran file di bawah 15MB.');
                    }
                } catch (error) {
                    console.error('Error uploading image:', error);
                    alert('Terjadi kesalahan saat mengunggah gambar.');
                }
            };
        }

        // Sync Quill content and prevent double submit on form submit
        document.querySelector('form').addEventListener('submit', function() {
            document.getElementById('isi-input').value = quill.root.innerHTML;
            
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
