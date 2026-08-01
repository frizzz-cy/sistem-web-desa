<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Admin Desa</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #F4F6F8; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .form-group { margin-bottom: 16px; }
        label { display: block; font-weight: 600; margin-bottom: 6px; font-size: 14px; color: #1A2833; }
        input, select, textarea { width: 100%; padding: 10px 12px; border: 1px solid #DDE3E8; border-radius: 6px; font-family: inherit; font-size: 14px; box-sizing: border-box; }
        .btn { padding: 10px 16px; border-radius: 6px; text-decoration: none; font-weight: 600; cursor: pointer; border: none; font-size: 14px; display: inline-block; }
        .btn-primary { background: #1668A3; color: white; }
        .btn-secondary { background: #E2E8F0; color: #1A2833; margin-right: 10px; }
        .error-msg { color: #DC2626; font-size: 12px; font-weight: 600; margin-top: 4px; display: block; }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="margin-top:0; margin-bottom: 20px; color: #0B3B60;">Tambah Produk Baru</h2>
        <form action="/admin/produk" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" required placeholder="Masukkan nama produk">
                @error('nama_produk') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <input type="text" name="kategori" value="{{ old('kategori') }}" placeholder="Cth: Pertanian, Kerajinan" required>
                @error('kategori') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Harga</label>
                <input type="text" name="harga" id="harga" value="{{ old('harga') }}" placeholder="Masukkan harga produk (Cth: 15.000)" required>
                @error('harga') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Status Stok</label>
                <select name="status_stok" required>
                    <option value="Tersedia" {{ old('status_stok') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Pre-Order (PO)" {{ old('status_stok') == 'Pre-Order (PO)' ? 'selected' : '' }}>Pre-Order (PO)</option>
                    <option value="Habis" {{ old('status_stok') == 'Habis' ? 'selected' : '' }}>Habis</option>
                </select>
                @error('status_stok') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Nama Penjual</label>
                <input type="text" name="nama_penjual" value="{{ old('nama_penjual') }}" required placeholder="Masukkan nama pemilik UMKM">
                @error('nama_penjual') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>No. WhatsApp (Gunakan 62)</label>
                <input type="text" name="no_whatsapp" value="{{ old('no_whatsapp') }}" placeholder="6281234567890" required>
                @error('no_whatsapp') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Deskripsi Singkat</label>
                <textarea name="deskripsi" rows="3" required placeholder="Tuliskan spesifikasi produk...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Upload Foto (Opsional)</label>
                <input type="file" name="foto_produk" accept="image/*">
                @error('foto_produk') <span class="error-msg">{{ $message }}</span> @enderror
            </div>
            
            <div style="margin-top: 24px;">
                <a href="/admin/produk" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Produk</button>
            </div>
        </form>
    </div>

    <!-- Script Formatter Rupiah & Prevent Double Submit -->
    <script>
        const hargaInput = document.getElementById('harga');
        if (hargaInput) {
            hargaInput.addEventListener('input', function(e) {
                this.value = formatRupiah(this.value);
            });
        }

        function formatRupiah(angka) {
            return angka.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
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
</body>
</html>