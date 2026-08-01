<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Desa Munungkerep</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    @yield('styles')
    <style>
        :root {
            --biru-tua: #0B3B60;
            --biru-muda: #1668A3;
            --border: #E2E8F0;
            --teks: #1A2833;
            --teks-muted: #64748B;
            --bg: #F4F6F8;
            --sidebar-width: 260px;
            --sidebar-bg: #0B283F;
            --card-shadow: 0 4px 12px rgba(11, 59, 96, 0.05);
        }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            margin: 0;
            padding: 0;
            color: var(--teks);
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styling */
        .admin-sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            color: #fff;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1000;
            transition: transform 0.3s ease;
        }
        
        .sidebar-brand {
            padding: 24px;
            font-size: 18px;
            font-weight: 800;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex;
            flex-direction: column;
            gap: 4px;
            background: rgba(0,0,0,0.15);
        }
        
        .sidebar-brand .sub {
            font-size: 11px;
            font-weight: 500;
            opacity: 0.7;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 20px 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex-grow: 1;
            overflow-y: auto;
        }
        
        .sidebar-item a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: #A3B3C2;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s;
        }
        
        .sidebar-item a:hover, .sidebar-item.active a {
            color: #fff;
            background: rgba(255,255,255,0.05);
        }
        
        .sidebar-item.active a {
            border-left: 4px solid var(--biru-muda);
            background: rgba(255,255,255,0.08);
            padding-left: 20px;
            color: #fff;
        }
        
        .sidebar-item svg {
            width: 18px;
            height: 18px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2.2;
        }

        /* Main Content Styling */
        .admin-main {
            flex-grow: 1;
            margin-left: var(--sidebar-width);
            display: flex;
            flex-direction: column;
            min-width: 0;
        }
        
        /* Mobile Topbar */
        .admin-topbar {
            display: none;
            background: #fff;
            border-bottom: 1px solid var(--border);
            padding: 12px 20px;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 900;
        }
        
        .toggle-btn {
            background: var(--biru-muda);
            color: #fff;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            font-family: inherit;
        }
        
        .admin-content-wrap {
            padding: 30px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
        }
        
        .admin-box {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            flex-grow: 1;
            box-sizing: border-box;
        }
        
        /* Overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 950;
        }

        /* Global Button Styles */
        .btn { padding: 10px 16px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 14px; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s; box-sizing: border-box; font-family: inherit; }
        .btn-primary { background: var(--biru-muda); color: white; }
        .btn-primary:hover { background: var(--biru-tua); }
        .btn-secondary { background: #E2E8F0; color: #1A2833; }
        .btn-secondary:hover { background: #CBD5E1; }
        .btn-warning { background: #F59E0B; color: white; text-decoration: none; }
        .btn-warning:hover { background: #D97706; }
        .btn-danger { background: #EF4444; color: white; }
        .btn-danger:hover { background: #DC2626; }

        /* Global Table Styles */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 14px; }
        th, td { padding: 14px 16px; text-align: left; border-bottom: 1px solid #E2E8F0; }
        th { background: #F8FAFC; color: #475569; font-weight: 700; }
        tr:hover { background: #F8FAFC; }

        /* Global Form Styles */
        .form-group { margin-bottom: 16px; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 6px; font-size: 14px; color: #1A2833; }
        .form-group input[type="text"], .form-group input[type="email"], .form-group input[type="password"], .form-group input[type="date"], .form-group input[type="file"], .form-group select, .form-group textarea { width: 100%; padding: 10px 12px; border: 1px solid #DDE3E8; border-radius: 6px; font-family: inherit; font-size: 14px; box-sizing: border-box; }
        
        /* Global Alert Styles */
        .alert-success { background: #D1FAE5; color: #065F46; padding: 12px; border-radius: 6px; margin-bottom: 20px; font-size: 14px; font-weight: 600; }
        .alert-danger { background: #FEE2E2; color: #991B1B; padding: 12px; border-radius: 6px; margin-bottom: 20px; font-size: 14px; font-weight: 600; }
        .error-msg { color: #DC2626; font-size: 12px; font-weight: 600; margin-top: 4px; display: block; }

        @media (max-width: 960px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            .admin-sidebar.open {
                transform: translateX(0);
            }
            .admin-main {
                margin-left: 0;
            }
            .admin-topbar {
                display: flex;
            }
            .sidebar-overlay.open {
                display: block;
            }
            .admin-content-wrap {
                padding: 16px;
            }
            .admin-box {
                padding: 20px 16px;
            }
        }
    </style>
</head>
<body>
    
    <!-- Sidebar Overlay for mobile -->
    <div class="sidebar-overlay" id="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar Panel -->
    <aside class="admin-sidebar" id="admin-sidebar">
        <div class="sidebar-brand">
            <span>MUNUNGKEREP</span>
            <span class="sub">Halaman Kelola CMS</span>
        </div>
        <ul class="sidebar-menu">
            <li class="sidebar-item @if(($activePage ?? '') == 'dashboard') active @endif">
                <a href="/admin/dashboard">
                    <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item @if(($activePage ?? '') == 'pengaturan') active @endif">
                <a href="/admin/pengaturan">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                    <span>Pengaturan Beranda</span>
                </a>
            </li>
            <li class="sidebar-item @if(($activePage ?? '') == 'produk') active @endif">
                <a href="/admin/produk">
                    <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                    <span>Produk UMKM</span>
                </a>
            </li>
            <li class="sidebar-item @if(($activePage ?? '') == 'berita') active @endif">
                <a href="/admin/berita">
                    <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    <span>Berita Desa</span>
                </a>
            </li>
            <li class="sidebar-item @if(($activePage ?? '') == 'kegiatan') active @endif">
                <a href="/admin/kegiatan">
                    <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                    <span>Galeri & Kegiatan</span>
                </a>
            </li>
            <li class="sidebar-item @if(($activePage ?? '') == 'media') active @endif">
                <a href="/admin/media">
                    <svg viewBox="0 0 24 24"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                    <span>Pustaka Media</span>
                </a>
            </li>
            <li class="sidebar-item @if(($activePage ?? '') == 'user') active @endif">
                <a href="/admin/user">
                    <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    <span>Kelola User</span>
                </a>
            </li>
        </ul>
        <div style="padding: 20px; border-top: 1px solid rgba(255,255,255,0.08);">
            <form action="/logout" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn btn-danger" style="width: 100%; justify-content: center; font-size: 13px;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="width: 14px; height: 14px;"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="admin-main">
        
        <!-- Mobile Topbar -->
        <header class="admin-topbar">
            <button class="toggle-btn" onclick="toggleSidebar()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width: 16px; height: 16px;"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                Menu
            </button>
            <span style="font-weight: 700; font-size: 14px; color: var(--biru-tua);">CMS Munungkerep</span>
        </header>

        <!-- Content Content Wrap -->
        <main class="admin-content-wrap">
            @yield('content')
        </main>

    </div>

    <!-- Toggle Script -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('open');
        }
    </script>
    
    @yield('scripts')
</body>
</html>
