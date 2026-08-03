@extends('layouts.admin', ['activePage' => 'dashboard'])

@section('title', 'Dashboard')

@section('styles')
    <style>
        /* Stats Cards */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { padding: 20px; border-radius: 12px; color: #fff; display: flex; flex-direction: column; justify-content: space-between; min-height: 100px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); position: relative; overflow: hidden; }
        .stat-card::after { content: ""; position: absolute; right: -20px; bottom: -20px; width: 80px; height: 80px; background: rgba(255,255,255,0.08); border-radius: 50%; }
        .stat-card.blue { background: linear-gradient(135deg, #1e3c72, #2a5298); }
        .stat-card.purple { background: linear-gradient(135deg, #654ea3, #eaafc8); }
        .stat-card.green { background: linear-gradient(135deg, #11998e, #38ef7d); }
        .stat-card.orange { background: linear-gradient(135deg, #f12711, #f5af19); }
        .stat-card.teal { background: linear-gradient(135deg, #0f2027, #203a43); }
        .stat-val { font-size: 32px; font-weight: 800; margin: 5px 0; }
        .stat-lbl { font-size: 13px; font-weight: 600; opacity: 0.9; text-transform: uppercase; letter-spacing: 0.5px; }

        /* Layout Columns */
        .dashboard-layout { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
        .dashboard-section { background: #fff; border: 1px solid var(--border); border-radius: 12px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.02); }
        .section-title { font-size: 16px; font-weight: 700; color: var(--biru-tua); margin-top: 0; margin-bottom: 16px; border-bottom: 2px solid var(--border); padding-bottom: 8px; display: flex; justify-content: space-between; align-items: center; }
        .section-title a { font-size: 12px; color: var(--biru-muda); text-decoration: none; }
        .section-title a:hover { text-decoration: underline; }

        /* List Items */
        .item-list { list-style: none; padding: 0; margin: 0; }
        .item-row { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #F1F5F9; }
        .item-row:last-child { border-bottom: none; }
        .item-info { display: flex; flex-direction: column; gap: 4px; }
        .item-name { font-size: 14px; font-weight: 600; color: var(--teks); }
        .item-meta { font-size: 11px; color: var(--teks-muted); }
        .badge { padding: 3px 8px; border-radius: 12px; font-size: 11px; font-weight: 700; text-transform: uppercase; }
        .badge.blue { background: #DBEAFE; color: #1D4ED8; }
        .badge.green { background: #D1FAE5; color: #065F46; }
        .badge.orange { background: #FFE4E6; color: #9F1239; }

        /* Quick Actions */
        .quick-actions { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 24px; }
        .action-card { background: #F8FAFC; border: 1px solid var(--border); border-radius: 8px; padding: 12px 16px; text-decoration: none; color: var(--teks); font-weight: 600; font-size: 13px; display: flex; align-items: center; gap: 8px; transition: all 0.2s; }
        .action-card:hover { background: #E2E8F0; border-color: #CBD5E1; color: var(--biru-tua); }
        .action-card svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 2.2; }

        @media (max-width: 768px) {
            .dashboard-layout { grid-template-columns: 1fr; }
        }
    </style>
@endsection

@section('content')
    <div class="admin-box">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
            <h1 style="margin: 0; font-size: 24px; color: var(--biru-tua); font-weight: 800;">Dashboard Ringkasan</h1>
            <a href="/" class="btn btn-secondary" target="_blank">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="width:14px; height:14px;"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                Lihat Web Publik
            </a>
        </div>

        <!-- Quick Actions -->
        <h4 style="margin-top:0; margin-bottom:12px; font-size:13px; color:var(--teks-muted); text-transform: uppercase; letter-spacing: 0.5px;">Pintasan Cepat</h4>
        <div class="quick-actions">
            <a href="/admin/produk/create" class="action-card">
                <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                + Produk UMKM
            </a>
            <a href="/admin/berita/create" class="action-card">
                <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><path d="M22 6l-10 7L2 6"></path></svg>
                + Tulis Berita
            </a>
            <a href="/admin/kegiatan/create" class="action-card">
                <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                + Dokumentasi Kegiatan
            </a>
            <a href="/admin/media" class="action-card">
                <svg viewBox="0 0 24 24"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                Upload Foto Umum
            </a>
        </div>

        <!-- Stats Cards Grid -->
        <div class="stats-grid">
            <div class="stat-card blue">
                <div class="stat-lbl">Produk UMKM</div>
                <div class="stat-val">{{ $stats['total_produk'] }}</div>
                <div style="font-size: 11px; opacity: 0.85;">Daftar dagangan warga</div>
            </div>
            <div class="stat-card purple">
                <div class="stat-lbl">Berita Desa</div>
                <div class="stat-val">{{ $stats['total_berita'] }}</div>
                <div style="font-size: 11px; opacity: 0.85;">Informasi terpublikasi</div>
            </div>
            <div class="stat-card green">
                <div class="stat-lbl">Galeri & Kegiatan</div>
                <div class="stat-val">{{ $stats['total_kegiatan'] }}</div>
                <div style="font-size: 11px; opacity: 0.85;">Dokumentasi kegiatan</div>
            </div>
            <div class="stat-card orange">
                <div class="stat-lbl">Dilihat (Pembaca)</div>
                <div class="stat-val">{{ $stats['total_views'] }}x</div>
                <div style="font-size: 11px; opacity: 0.85;">Total baca berita warga</div>
            </div>
            <div class="stat-card teal">
                <div class="stat-lbl">User Pengelola</div>
                <div class="stat-val">{{ $stats['total_user'] }}</div>
                <div style="font-size: 11px; opacity: 0.85;">Administrator terdaftar</div>
            </div>
        </div>

        <!-- Layout Row Columns -->
        <div class="dashboard-layout">
            
            <!-- Berita & Kepopuleran -->
            <div style="display: flex; flex-direction: column; gap: 24px;">
                
                <div class="dashboard-section">
                    <h3 class="section-title">
                        <span>Berita Terpopuler</span>
                        <a href="/admin/berita">Kelola Berita</a>
                    </h3>
                    <ul class="item-list">
                        @forelse($popular_beritas as $item)
                        <li class="item-row">
                            <div class="item-info">
                                <span class="item-name">{{ $item->judul }}</span>
                                <span class="item-meta">{{ date('d M Y', strtotime($item->tanggal)) }} &bull; Kategori: {{ $item->kategori }}</span>
                            </div>
                            <span class="badge blue">{{ $item->views }}x dibaca</span>
                        </li>
                        @empty
                        <li style="color:var(--teks-muted); font-size:13px; padding:10px 0;">Belum ada berita.</li>
                        @endforelse
                    </ul>
                </div>

                <div class="dashboard-section">
                    <h3 class="section-title">
                        <span>Berita Terbaru</span>
                        <a href="/admin/berita">Lihat Semua</a>
                    </h3>
                    <ul class="item-list">
                        @forelse($recent_beritas as $item)
                        <li class="item-row">
                            <div class="item-info">
                                <span class="item-name">{{ $item->judul }}</span>
                                <span class="item-meta">Diunggah: {{ date('d M Y', strtotime($item->created_at)) }}</span>
                            </div>
                            <span class="badge green">{{ $item->kategori }}</span>
                        </li>
                        @empty
                        <li style="color:var(--teks-muted); font-size:13px; padding:10px 0;">Belum ada berita baru.</li>
                        @endforelse
                    </ul>
                </div>

            </div>

            <!-- Produk & Kegiatan -->
            <div style="display: flex; flex-direction: column; gap: 24px;">

                <div class="dashboard-section">
                    <h3 class="section-title">
                        <span>Produk UMKM Baru</span>
                        <a href="/admin/produk">Kelola Produk</a>
                    </h3>
                    <ul class="item-list">
                        @forelse($recent_produks as $item)
                        <li class="item-row">
                            <div class="item-info">
                                <span class="item-name">{{ $item->nama_produk }}</span>
                                <span class="item-meta">Penjual: {{ $item->nama_penjual }} &bull; Harga: {{ $item->harga }}</span>
                            </div>
                            <span class="badge blue">{{ $item->status_stok }}</span>
                        </li>
                        @empty
                        <li style="color:var(--teks-muted); font-size:13px; padding:10px 0;">Belum ada produk terdaftar.</li>
                        @endforelse
                    </ul>
                </div>

                <div class="dashboard-section">
                    <h3 class="section-title">
                        <span>Galeri Kegiatan Terbaru</span>
                        <a href="/admin/kegiatan">Kelola Kegiatan</a>
                    </h3>
                    <ul class="item-list">
                        @forelse($recent_kegiatans as $item)
                        <li class="item-row">
                            <div class="item-info">
                                <span class="item-name">{{ $item->judul }}</span>
                                <span class="item-meta">Lokasi: {{ $item->lokasi }} &bull; {{ date('d M Y', strtotime($item->tanggal)) }}</span>
                            </div>
                            <span class="badge blue">{{ $item->kategori }}</span>
                        </li>
                        @empty
                        <li style="color:var(--teks-muted); font-size:13px; padding:10px 0;">Belum ada dokumentasi kegiatan.</li>
                        @endforelse
                    </ul>
                </div>

            </div>

        </div>
    </div>
@endsection
