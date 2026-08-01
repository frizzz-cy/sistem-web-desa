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
                <label>Foto Produk (Maksimal 15MB)</label>
                @if($produk->foto_produk)
                    <img src="{{ asset('storage/'.$produk->foto_produk) }}" width="120" style="display:block; margin-bottom:10px; border-radius:6px; object-fit: cover; aspect-ratio: 4/3;">
                @endif
                <input type="file" name="foto_produk" accept="image/*">
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