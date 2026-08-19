@extends('layouts.admin', ['activePage' => 'produk'])

@section('title', 'Edit Produk')

@section('content')
    <div class="admin-box" style="max-width: 600px; margin: 0 auto;">
        <h2 style="margin-top:0; margin-bottom: 20px; color: var(--biru-tua); font-weight: 800;">Edit Produk</h2>
        
        <form action="/admin/produk/{{ $produk->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                @error('nama_produk') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <input type="text" name="kategori" value="{{ old('kategori', $produk->kategori) }}" required>
                @error('kategori') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Harga</label>
                <input type="text" name="harga" id="harga" value="{{ old('harga', $produk->harga) }}" required>
                @error('harga') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Status Stok</label>
                <select name="status_stok" required>
                    <option value="Tersedia" {{ old('status_stok', $produk->status_stok) == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Pre-Order (PO)" {{ old('status_stok', $produk->status_stok) == 'Pre-Order (PO)' ? 'selected' : '' }}>Pre-Order (PO)</option>
                    <option value="Habis" {{ old('status_stok', $produk->status_stok) == 'Habis' ? 'selected' : '' }}>Habis</option>
                </select>
                @error('status_stok') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Nama Penjual</label>
                <input type="text" name="nama_penjual" value="{{ old('nama_penjual', $produk->nama_penjual) }}" required>
                @error('nama_penjual') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>No. WhatsApp</label>
                <input type="text" name="no_whatsapp" value="{{ old('no_whatsapp', $produk->no_whatsapp) }}" required>
                @error('no_whatsapp') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Deskripsi Singkat</label>
                <textarea name="deskripsi" rows="3" required>{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                @error('deskripsi') <span class="error-msg">{{ $message }}</span> @enderror
            </div>
            
            <div class="form-group">
                <label>Foto Produk (Biarkan kosong jika tidak ingin mengubah, Maksimal 15MB)</label>
                <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                    <input type="file" name="foto_produk" id="foto_produk" accept="image/*" style="flex: 1; min-width: 220px;" onchange="onLocalFileChosen(this)">
                    <button type="button" class="btn btn-secondary" onclick="pilihFotoProdukDariMedia()" style="font-size: 13px; padding: 9px 14px; white-space: nowrap; display: inline-flex; align-items: center; gap: 6px;">
                        <span>📁 Pilih dari Pustaka Media</span>
                    </button>
                </div>
                <input type="hidden" name="foto_produk_media" id="foto_produk_media_input">

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

                @if($produk->foto_produk)
                    <div id="old-photo-preview" style="margin-top:10px;">
                        <img src="{{ asset('storage/'.$produk->foto_produk) }}" width="120" style="display:block; border-radius:6px; object-fit: cover; aspect-ratio: 4/3;">
                    </div>
                @endif
                <small style="color: #64748B; display: block; margin-top: 6px;">Format yang diizinkan: JPG, JPEG, PNG, WebP (Maksimal 15MB, akan dikompresi otomatis)</small>
                @error('foto_produk') <span class="error-msg">{{ $message }}</span> @enderror
            </div>
            
            <div style="margin-top: 28px; display: flex; gap: 10px;">
                <a href="/admin/produk" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update Produk</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        const hargaInput = document.getElementById('harga');
        if (hargaInput) {
            hargaInput.value = formatRupiah(hargaInput.value);

            hargaInput.addEventListener('input', function(e) {
                this.value = formatRupiah(this.value);
            });
        }

        function formatRupiah(angka) {
            return angka.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function pilihFotoProdukDariMedia() {
            window.openMediaPicker({
                onSelect: function(item) {
                    document.getElementById('foto_produk_media_input').value = item.path;
                    document.getElementById('media-preview-img').src = item.url;
                    document.getElementById('media-preview-name').textContent = item.name;
                    document.getElementById('media-preview-box').style.display = 'block';
                    document.getElementById('foto_produk').value = '';
                    const oldPreview = document.getElementById('old-photo-preview');
                    if (oldPreview) oldPreview.style.display = 'none';
                }
            });
        }

        function onLocalFileChosen(input) {
            if (input.files && input.files[0]) {
                document.getElementById('foto_produk_media_input').value = '';
                document.getElementById('media-preview-box').style.display = 'none';
            }
        }

        function batalPilihMedia() {
            document.getElementById('foto_produk_media_input').value = '';
            document.getElementById('media-preview-box').style.display = 'none';
            const oldPreview = document.getElementById('old-photo-preview');
            if (oldPreview) oldPreview.style.display = 'block';
        }

        // Mencegah double submit saat loading lag
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