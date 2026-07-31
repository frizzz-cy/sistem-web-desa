<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Produk</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #F4F6F8; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 12px; }
        .form-group { margin-bottom: 16px; }
        label { display: block; font-weight: 600; margin-bottom: 6px; font-size: 14px; }
        input, select, textarea { width: 100%; padding: 10px; border: 1px solid #DDE3E8; border-radius: 6px; font-family: inherit; }
        .btn { padding: 10px 16px; border-radius: 6px; text-decoration: none; font-weight: 600; cursor: pointer; border: none; }
        .btn-primary { background: #1668A3; color: white; }
        .btn-secondary { background: #E2E8F0; color: #1A2833; margin-right: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="margin-top:0;">Tambah Produk Baru</h2>
        <form action="/admin/produk" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group"><label>Nama Produk</label><input type="text" name="nama_produk" required></div>
            <div class="form-group"><label>Kategori</label><input type="text" name="kategori" placeholder="Cth: Pertanian, Kerajinan" required></div>
            <div class="form-group"><label>Harga (Teks)</label><input type="text" name="harga" placeholder="Cth: Rp 45.000 atau Harga Pasar" required></div>
            <div class="form-group">
                <label>Status Stok</label>
                <select name="status_stok" required>
                    <option value="Tersedia">Tersedia</option>
                    <option value="Pre-Order (PO)">Pre-Order (PO)</option>
                    <option value="Habis">Habis</option>
                </select>
            </div>
            <div class="form-group"><label>Nama Penjual</label><input type="text" name="nama_penjual" required></div>
            <div class="form-group"><label>No. WhatsApp (Gunakan 62)</label><input type="text" name="no_whatsapp" placeholder="6281234567890" required></div>
            <div class="form-group"><label>Deskripsi Singkat</label><textarea name="deskripsi" rows="3" required></textarea></div>
            <div class="form-group"><label>Upload Foto (Opsional)</label><input type="file" name="foto_produk" accept="image/*"></div>
            
            <div style="margin-top: 24px;">
                <a href="/admin/produk" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Produk</button>
            </div>
        </form>
    </div>
</body>
</html>