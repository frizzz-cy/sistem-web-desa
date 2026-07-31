<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita - Admin Desa</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #F4F6F8; margin: 0; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .header h1 { margin: 0; color: #0B3B60; font-size: 24px; }
        .btn { padding: 10px 16px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 14px; border: none; cursor: pointer; display: inline-block;}
        .btn-primary { background: #1668A3; color: white; }
        .btn-danger { background: #DC2626; color: white; }
        .btn-warning { background: #F59E0B; color: white; }
        .btn-secondary { background: #E2E8F0; color: #1A2833; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #DDE3E8; font-size: 14px; }
        th { background: #F4F6F8; color: #5B6B7A; font-weight: 700; }
        .alert-success { background: #D1FAE5; color: #065F46; padding: 12px; border-radius: 6px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Kelola Berita Desa</h1>
            <div>
                <a href="/" class="btn btn-secondary">Lihat Web</a>
                <a href="/admin/berita/create" class="btn btn-primary">+ Tambah Berita</a>
            </div>
        </div>

        <div class="admin-nav" style="display: flex; gap: 8px; border-bottom: 2px solid #E2E8F0; margin-bottom: 24px; padding-bottom: 1px;">
            <a href="/admin/produk" class="admin-nav-item" style="padding: 10px 16px; font-weight: 700; text-decoration: none; color: #64748B; border-bottom: 2px solid transparent; margin-bottom: -2px; font-size: 14px; transition: all 0.15s ease;">Produk UMKM</a>
            <a href="/admin/berita" class="admin-nav-item" style="padding: 10px 16px; font-weight: 700; text-decoration: none; color: #1668A3; border-bottom: 2px solid #1668A3; margin-bottom: -2px; font-size: 14px;">Berita Desa</a>
            <a href="/admin/kegiatan" class="admin-nav-item" style="padding: 10px 16px; font-weight: 700; text-decoration: none; color: #64748B; border-bottom: 2px solid transparent; margin-bottom: -2px; font-size: 14px; transition: all 0.15s ease;">Galeri & Kegiatan</a>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div style="overflow-x: auto; -webkit-overflow-scrolling: touch; width: 100%; margin-top: 10px;">
            <table>
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Judul Berita</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Dilihat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($beritas as $item)
                    <tr>
                        <td>
                            <img src="{{ $item->foto ? asset('storage/'.$item->foto) : 'https://placehold.co/100?text=Berita' }}" width="60" style="border-radius: 6px; object-fit: cover; aspect-ratio: 1/1;">
                        </td>
                        <td><b>{{ $item->judul }}</b></td>
                        <td><span style="background: #E8F5E9; color: #2E7D32; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 700; text-transform: uppercase;">{{ $item->kategori }}</span></td>
                        <td>{{ date('d M Y', strtotime($item->tanggal)) }}</td>
                        <td>{{ $item->views }}x</td>
                        <td>
                            <a href="/admin/berita/{{ $item->id }}/edit" class="btn btn-warning" style="padding: 6px 12px;">Edit</a>
                            <form action="/admin/berita/{{ $item->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 6px 12px;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: #64748B; padding: 30px;">Belum ada berita yang ditulis.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
