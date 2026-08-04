@php
    $active = $active ?? 'produk';
@endphp
<div class="admin-nav" style="display: flex; gap: 8px; border-bottom: 2px solid #E2E8F0; margin-bottom: 24px; padding-bottom: 1px; overflow-x: auto; -webkit-overflow-scrolling: touch; white-space: nowrap; scrollbar-width: none;">
    <style>
        .admin-nav::-webkit-scrollbar { display: none; }
        .admin-nav-item {
            padding: 10px 16px; 
            font-weight: 700; 
            text-decoration: none; 
            margin-bottom: -2px; 
            font-size: 14px; 
            transition: all 0.15s ease;
            display: inline-block;
        }
        .admin-nav-item.aktif {
            color: #1668A3 !important; 
            border-bottom: 2px solid #1668A3 !important;
        }
        .admin-nav-item.biasa {
            color: #64748B !important; 
            border-bottom: 2px solid transparent !important;
        }
        .admin-nav-item.biasa:hover {
            color: #0B3B60 !important;
            border-bottom-color: #CBD5E1 !important;
        }
    </style>
    <a href="/admin/dashboard" class="admin-nav-item {{ $active == 'dashboard' ? 'aktif' : 'biasa' }}">Dashboard</a>
    <a href="/admin/produk" class="admin-nav-item {{ $active == 'produk' ? 'aktif' : 'biasa' }}">Produk UMKM</a>
    <a href="/admin/berita" class="admin-nav-item {{ $active == 'berita' ? 'aktif' : 'biasa' }}">Berita Desa</a>
    <a href="/admin/kegiatan" class="admin-nav-item {{ $active == 'kegiatan' ? 'aktif' : 'biasa' }}">Galeri & Kegiatan</a>
    <a href="/admin/media" class="admin-nav-item {{ $active == 'media' ? 'aktif' : 'biasa' }}">Pustaka Media</a>
    <a href="/admin/user" class="admin-nav-item {{ $active == 'user' ? 'aktif' : 'biasa' }}">Kelola User</a>
</div>
