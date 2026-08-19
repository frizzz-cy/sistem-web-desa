@extends('layouts.admin', ['activePage' => 'berita'])

@section('title', 'Edit Berita')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.snow.css" rel="stylesheet" />
    <style>
        textarea { height: 160px; resize: vertical; }
        .current-img { margin-top: 10px; border-radius: 6px; border: 1px solid #DDE3E8; max-width: 200px; display: block; }
    </style>
@endsection

@section('content')
    <div class="admin-box" style="max-width: 700px; margin: 0 auto;">
        <h2 style="margin-top:0; margin-bottom: 20px; color: var(--biru-tua); font-weight: 800;">Edit Berita Desa</h2>

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
                <label for="foto">Foto Banner Berita (Biarkan kosong jika tidak ingin mengubah, Maksimal 15MB)</label>
                <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                    <input type="file" name="foto" id="foto" accept="image/*" style="flex: 1; min-width: 220px;" onchange="onLocalFileChosen(this)">
                    <button type="button" class="btn btn-secondary" onclick="pilihBannerDariMedia()" style="font-size: 13px; padding: 9px 14px; white-space: nowrap; display: inline-flex; align-items: center; gap: 6px;">
                        <span>📁 Pilih dari Pustaka Media</span>
                    </button>
                </div>
                <input type="hidden" name="foto_media" id="foto_media_input">

                <div id="media-banner-preview" style="display: none; margin-top: 12px; position: relative; width: fit-content;">
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

                @if($berita->foto)
                    <div style="position: relative; display: inline-block; margin-top: 10px;" id="banner-preview-container">
                        <img src="{{ asset('storage/' . $berita->foto) }}" alt="Foto Saat Ini" class="current-img" style="margin-top:0;">
                        <button type="button" onclick="removeBannerImage()" style="position: absolute; top: 8px; right: 8px; background: #DC2626; color: white; border: none; border-radius: 50%; width: 24px; height: 24px; font-weight: bold; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 6px rgba(0,0,0,0.2); transition: background 0.2s;" title="Hapus foto banner">✕</button>
                        <input type="hidden" name="remove_foto" id="remove_foto" value="0">
                    </div>
                @endif
                <small style="color: #64748B; display: block; margin-top: 6px;">Format yang diizinkan: JPG, JPEG, PNG, WebP (Maksimal 15MB, akan dikompresi otomatis)</small>
                @error('foto') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px; flex-wrap: wrap; gap: 8px;">
                    <label for="isi" style="margin-bottom: 0;">Isi Berita Lengkap</label>
                    <button type="button" class="btn btn-secondary" onclick="sisipkanGambarKeQuillDariMedia()" style="font-size: 12px; padding: 5px 10px; display: inline-flex; align-items: center; gap: 4px;">
                        <span>🖼️ Sisipkan Gambar dari Pustaka Media</span>
                    </button>
                </div>
                <input type="hidden" name="isi" id="isi-input" value="{{ old('isi', $berita->isi) }}">
                <div id="editor" style="height: 280px; background: white; border: 1px solid #DDE3E8; border-radius: 6px;">
                    {!! old('isi', $berita->isi) !!}
                </div>
                @error('isi') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-actions" style="margin-top: 28px; display: flex; gap: 10px; justify-content: flex-end;">
                <a href="/admin/berita" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
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

        // Auto convert pasted image URLs from Media Library into actual image embeds
        const Delta = Quill.import('delta');
        quill.clipboard.addMatcher(Node.TEXT_NODE, (node, delta) => {
            const text = node.data.trim();
            if (text.match(/^https?:\/\/.*\.(jpg|jpeg|png|gif|webp|svg)(\?.*)?$/i)) {
                return new Delta().insert({ image: text });
            }
            return delta;
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

        function pilihBannerDariMedia() {
            window.openMediaPicker({
                onSelect: function(item) {
                    document.getElementById('foto_media_input').value = item.path;
                    document.getElementById('media-preview-img').src = item.url;
                    document.getElementById('media-preview-name').textContent = item.name;
                    document.getElementById('media-banner-preview').style.display = 'block';
                    // Reset local file input & remove_foto flag
                    document.getElementById('foto').value = '';
                    const removeFotoInput = document.getElementById('remove_foto');
                    if (removeFotoInput) removeFotoInput.value = '0';
                    const oldPreview = document.getElementById('banner-preview-container');
                    if (oldPreview) oldPreview.style.display = 'none';
                }
            });
        }

        function onLocalFileChosen(input) {
            if (input.files && input.files[0]) {
                // Sembunyikan media preview jika memilih file lokal baru
                document.getElementById('foto_media_input').value = '';
                document.getElementById('media-banner-preview').style.display = 'none';
                const removeFotoInput = document.getElementById('remove_foto');
                if (removeFotoInput) removeFotoInput.value = '0';
            }
        }

        function batalPilihMedia() {
            document.getElementById('foto_media_input').value = '';
            document.getElementById('media-banner-preview').style.display = 'none';
            const oldPreview = document.getElementById('banner-preview-container');
            if (oldPreview) oldPreview.style.display = 'inline-block';
        }

        function sisipkanGambarKeQuillDariMedia() {
            window.openMediaPicker({
                onSelect: function(item) {
                    const range = quill.getSelection(true) || { index: quill.getLength(), length: 0 };
                    quill.insertEmbed(range.index, 'image', item.url);
                }
            });
        }

        function removeBannerImage() {
            if (confirm('Yakin ingin menghapus foto banner berita ini?')) {
                document.getElementById('remove_foto').value = "1";
                document.getElementById('banner-preview-container').style.display = 'none';
                document.getElementById('foto').value = '';
                document.getElementById('foto_media_input').value = '';
                document.getElementById('media-banner-preview').style.display = 'none';
            }
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
@endsection
