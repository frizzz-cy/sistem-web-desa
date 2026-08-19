<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Desa Munungkerep</title>
    <link rel="icon" type="image/png" href="{{ asset('images/kabupaten.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/kabupaten.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
        
        .sidebar-category {
            padding: 16px 24px 6px;
            font-size: 10.5px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: rgba(255, 255, 255, 0.38);
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

            <div class="sidebar-category">Konten & Monografi</div>
            <li class="sidebar-item @if(($activePage ?? '') == 'pengaturan-beranda') active @endif">
                <a href="/admin/pengaturan/beranda">
                    <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                    <span>Beranda & Slider</span>
                </a>
            </li>
            <li class="sidebar-item @if(($activePage ?? '') == 'pengaturan-apbdes') active @endif">
                <a href="/admin/pengaturan/apbdes">
                    <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    <span>Transparansi APBDes</span>
                </a>
            </li>
            <li class="sidebar-item @if(($activePage ?? '') == 'pengaturan-demografi') active @endif">
                <a href="/admin/pengaturan/demografi">
                    <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    <span>Data Demografi</span>
                </a>
            </li>
            <li class="sidebar-item @if(($activePage ?? '') == 'pengaturan-potensi') active @endif">
                <a href="/admin/pengaturan/potensi">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><polygon points="12 8 8 12 12 16 16 12 12 8"></polygon></svg>
                    <span>Potensi Ekonomi</span>
                </a>
            </li>
            <li class="sidebar-item @if(($activePage ?? '') == 'pengaturan-perangkat') active @endif">
                <a href="/admin/pengaturan/perangkat">
                    <svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                    <span>Struktur Perangkat</span>
                </a>
            </li>

            <div class="sidebar-category">Informasi & Publikasi</div>
            <li class="sidebar-item @if(($activePage ?? '') == 'berita') active @endif">
                <a href="/admin/berita">
                    <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    <span>Berita Desa</span>
                </a>
            </li>
            <li class="sidebar-item @if(($activePage ?? '') == 'kegiatan') active @endif">
                <a href="/admin/kegiatan">
                    <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    <span>Galeri & Kegiatan</span>
                </a>
            </li>
            <li class="sidebar-item @if(($activePage ?? '') == 'produk') active @endif">
                <a href="/admin/produk">
                    <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                    <span>Produk UMKM</span>
                </a>
            </li>

            <div class="sidebar-category">Sistem & Akun</div>
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
            @if(session('success'))
                <div class="alert-success" style="margin-bottom: 20px;">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert-danger" style="margin-bottom: 20px;">{{ session('error') }}</div>
            @endif
            @yield('content')
        </main>

    </div>

    <!-- HEIC/HEIF Decoder Library -->
    <script src="https://cdn.jsdelivr.net/npm/heic2any@0.0.4/dist/heic2any.min.js"></script>

    <!-- Toggle Script & Client-side Image Compressor -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('open');
        }

        // Global Client-side Image Compressor & HEIC Converter
        document.addEventListener('submit', function(e) {
            const form = e.target;
            
            // Sinkronisasi konten Quill Editor secara global ke hidden input jika ada di halaman
            const hiddenIsi = form.querySelector('#isi-input');
            if (hiddenIsi && typeof quill !== 'undefined') {
                hiddenIsi.value = quill.root.innerHTML;
            }

            const fileInputs = Array.from(form.querySelectorAll('input[type="file"]'));
            
            // Cari input file yang berisi berkas gambar
            const imageInputs = fileInputs.filter(input => {
                return input.files && input.files.length > 0;
            });

            if (imageInputs.length === 0) return;

            // Hindari looping tak terbatas setelah kompresi selesai
            if (form.dataset.compressed === "true") return;

            // Cek apakah ada file gambar yang perlu dikompres (ukuran > 1.5MB atau format HEIC)
            let needsCompression = false;
            for (const input of imageInputs) {
                for (const file of input.files) {
                    const ext = file.name.split('.').pop().toLowerCase();
                    if (file.size > 1.5 * 1024 * 1024 || ['heic', 'heif'].includes(ext)) {
                        needsCompression = true;
                        break;
                    }
                }
                if (needsCompression) break;
            }

            if (!needsCompression) return;

            // Hentikan submit form untuk memproses gambar terlebih dahulu
            e.preventDefault();

            // Tampilkan Overlay Loading Kompresi Premium
            const overlayDiv = document.createElement('div');
            overlayDiv.id = 'compressing-overlay';
            overlayDiv.style.cssText = 'position:fixed; inset:0; background:rgba(11,59,96,0.75); backdrop-filter:blur(4px); z-index:99999; display:flex; flex-direction:column; align-items:center; justify-content:center; color:#fff; font-family:"Plus Jakarta Sans",sans-serif; transition:opacity 0.25s ease;';
            overlayDiv.innerHTML = `
                <div style="background:#fff; padding:30px; border-radius:12px; text-align:center; color:#1A2833; box-shadow:0 10px 30px rgba(0,0,0,0.15); max-width:340px; width:90%;">
                    <div style="width:40px; height:40px; border:3px solid #E2E8F0; border-top-color:#1668A3; border-radius:50%; animation:spin-compress 0.8s linear infinite; margin:0 auto 16px;"></div>
                    <h4 style="margin:0 0 8px; font-weight:800; font-size:16px; color:#0B3B60;">Mengoptimalkan Gambar</h4>
                    <p style="margin:0; font-size:12.5px; color:#64748B; line-height:1.5;">Sedang mengompresi gambar berukuran besar secara otomatis ke format optimal agar muat di server...</p>
                </div>
                <style>
                    @keyframes spin-compress { to { transform: rotate(360deg); } }
                </style>
            `;
            document.body.appendChild(overlayDiv);

            // Fungsi pembantu kompresi canvas
            function resizeAndCompress(file) {
                return new Promise((resolve) => {
                    const ext = file.name.split('.').pop().toLowerCase();
                    
                    // Lewati kompresi jika ukuran sudah kecil (< 1.5MB) dan bukan HEIC
                    if (file.size <= 1.5 * 1024 * 1024 && !['heic', 'heif'].includes(ext)) {
                        return resolve(file);
                    }

                    const reader = new FileReader();
                    reader.onload = function(event) {
                        const img = new Image();
                        img.onload = function() {
                            const canvas = document.createElement('canvas');
                            let width = img.width;
                            let height = img.height;

                            // Batasi dimensi maksimal gambar ke 1600px
                            const maxDim = 1600;
                            if (width > maxDim || height > maxDim) {
                                if (width > height) {
                                    height = Math.round((height * maxDim) / width);
                                    width = maxDim;
                                } else {
                                    width = Math.round((width * maxDim) / height);
                                    height = maxDim;
                                }
                            }

                            canvas.width = width;
                            canvas.height = height;

                            const ctx = canvas.getContext('2d');
                            ctx.drawImage(img, 0, 0, width, height);

                            // Kompresi ke JPEG dengan kualitas 75%
                            canvas.toBlob((blob) => {
                                if (!blob) {
                                    return resolve(file);
                                }
                                const newName = file.name.substring(0, file.name.lastIndexOf('.')) + '.jpg';
                                const compressedFile = new File([blob], newName, {
                                    type: 'image/jpeg',
                                    lastModified: Date.now()
                                });
                                resolve(compressedFile);
                            }, 'image/jpeg', 0.75);
                        };
                        img.onerror = () => resolve(file);
                        img.src = event.target.result;
                    };
                    reader.onerror = () => resolve(file);
                    reader.readAsDataURL(file);
                });
            }

            // Jalankan proses kompresi untuk seluruh input file
            const compressionPromises = imageInputs.map(input => {
                const files = Array.from(input.files);
                const dataTransfer = new DataTransfer();

                const filePromises = files.map(file => {
                    const ext = file.name.split('.').pop().toLowerCase();
                    
                    // Cek jika butuh decode HEIC via heic2any
                    if ((file.type === 'image/heic' || ext === 'heic' || ext === 'heif') && typeof heic2any !== 'undefined') {
                        return heic2any({
                            blob: file,
                            toType: 'image/jpeg',
                            quality: 0.8
                        }).then(convertedBlob => {
                            const convertedFile = new File([convertedBlob], file.name.replace(/\.(heic|heif)$/i, '.jpg'), {
                                type: 'image/jpeg',
                                lastModified: Date.now()
                            });
                            return resizeAndCompress(convertedFile).then(compressedFile => {
                                dataTransfer.items.add(compressedFile);
                            });
                        }).catch(err => {
                            console.error('HEIC conversion failed, uploading raw:', err);
                            dataTransfer.items.add(file);
                        });
                    } else {
                        // Proses kompresi PNG/JPG biasa
                        return resizeAndCompress(file).then(compressedFile => {
                            dataTransfer.items.add(compressedFile);
                        });
                    }
                });

                return Promise.all(filePromises).then(() => {
                    input.files = dataTransfer.files;
                });
            });

            Promise.all(compressionPromises).then(() => {
                form.dataset.compressed = "true";
                form.submit();
            }).catch(err => {
                console.error('Compression pipeline failed:', err);
                form.submit();
            });
        });
    </script>

    <!-- ========================================================================= -->
    <!-- GLOBAL UNIVERSAL MEDIA PICKER MODAL -->
    <!-- ========================================================================= -->
    <style>
        .gmp-modal-overlay {
            position: fixed; inset: 0; background: rgba(11, 40, 63, 0.65);
            backdrop-filter: blur(4px); z-index: 99999;
            display: flex; align-items: center; justify-content: center; padding: 20px;
            animation: gmpFadeIn 0.2s ease;
        }
        @keyframes gmpFadeIn { from { opacity: 0; } to { opacity: 1; } }
        .gmp-modal-box {
            background: #FFFFFF; border-radius: 14px; width: 100%; max-width: 900px;
            max-height: 88vh; display: flex; flex-direction: column;
            box-shadow: 0 20px 40px rgba(0,0,0,0.25); overflow: hidden;
            animation: gmpScaleUp 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes gmpScaleUp { from { transform: scale(0.95) translateY(10px); } to { transform: scale(1) translateY(0); } }
        .gmp-modal-header {
            padding: 16px 24px; border-bottom: 1px solid #E2E8F0;
            display: flex; justify-content: space-between; align-items: center; background: #F8FAFC;
        }
        .gmp-close-btn {
            background: none; border: none; font-size: 24px; line-height: 1;
            color: #64748B; cursor: pointer; padding: 4px 8px; border-radius: 6px;
        }
        .gmp-close-btn:hover { background: #E2E8F0; color: #0F172A; }
        .gmp-modal-toolbar {
            padding: 12px 24px; border-bottom: 1px solid #E2E8F0; background: #FFFFFF;
            display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;
        }
        .gmp-filter-tabs {
            display: flex; gap: 6px; overflow-x: auto; scrollbar-width: none;
        }
        .gmp-filter-tabs::-webkit-scrollbar { display: none; }
        .gmp-tab {
            padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;
            color: #64748B; background: #F1F5F9; border: none; cursor: pointer;
            white-space: nowrap; transition: all 0.15s;
        }
        .gmp-tab:hover { background: #E2E8F0; color: #1E293B; }
        .gmp-tab.aktif { background: var(--biru-muda, #1668A3); color: #FFFFFF; }
        .gmp-search-input {
            padding: 7px 12px; border: 1.5px solid #CBD5E1; border-radius: 6px;
            font-size: 12.5px; width: 180px; outline: none; font-family: inherit;
        }
        .gmp-search-input:focus { border-color: var(--biru-muda, #1668A3); }
        .gmp-modal-body {
            padding: 20px 24px; flex-grow: 1; overflow-y: auto; background: #F8FAFC;
            min-height: 280px; max-height: 480px;
        }
        .gmp-grid {
            display: grid; grid-template-columns: repeat(auto-fill, minmax(135px, 1fr)); gap: 14px;
        }
        .gmp-item {
            background: #FFFFFF; border: 2px solid #E2E8F0; border-radius: 8px;
            overflow: hidden; cursor: pointer; transition: all 0.15s; position: relative;
            display: flex; flex-direction: column;
        }
        .gmp-item:hover {
            border-color: #93C5FD; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0,0,0,0.06);
        }
        .gmp-item.selected {
            border-color: #2563EB; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.25);
        }
        .gmp-item.selected::after {
            content: '✓'; position: absolute; top: 6px; right: 6px;
            background: #2563EB; color: #fff; width: 20px; height: 20px;
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 900;
        }
        .gmp-img-wrap {
            width: 100%; aspect-ratio: 1/1; background: #E2E8F0;
            display: flex; align-items: center; justify-content: center; overflow: hidden;
        }
        .gmp-img-wrap img { width: 100%; height: 100%; object-fit: cover; }
        .gmp-item-info {
            padding: 6px 8px; font-size: 11px;
        }
        .gmp-item-title {
            font-weight: 700; color: #1E293B; overflow: hidden;
            text-overflow: ellipsis; white-space: nowrap; display: block;
        }
        .gmp-item-sub { color: #64748B; font-size: 10px; margin-top: 2px; }
        .gmp-modal-footer {
            padding: 14px 24px; border-top: 1px solid #E2E8F0; background: #FFFFFF;
            display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;
        }
    </style>

    <div id="global-media-picker-modal" class="gmp-modal-overlay" style="display:none;" onclick="if(event.target===this) closeMediaPicker();">
        <div class="gmp-modal-box">
            <div class="gmp-modal-header">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 22px;">🖼️</span>
                    <div>
                        <h3 style="margin: 0; font-size: 16px; font-weight: 800; color: var(--biru-tua);">Pustaka Media Server</h3>
                        <div style="font-size: 11.5px; color: var(--teks-muted);">Pilih gambar yang tersimpan di server atau unggah baru</div>
                    </div>
                </div>
                <button type="button" class="gmp-close-btn" onclick="closeMediaPicker()">&times;</button>
            </div>

            <div class="gmp-modal-toolbar">
                <div class="gmp-filter-tabs">
                    <button type="button" class="gmp-tab aktif" onclick="filterGmpTab('all', this)">Semua (<span id="gmp-total-count">0</span>)</button>
                    <button type="button" class="gmp-tab" onclick="filterGmpTab('uploads', this)">Umum</button>
                    <button type="button" class="gmp-tab" onclick="filterGmpTab('berita_images', this)">Banner Berita</button>
                    <button type="button" class="gmp-tab" onclick="filterGmpTab('berita_content', this)">Gambar Berita</button>
                    <button type="button" class="gmp-tab" onclick="filterGmpTab('produk_images', this)">Produk</button>
                    <button type="button" class="gmp-tab" onclick="filterGmpTab('kegiatan_images', this)">Kegiatan</button>
                    <button type="button" class="gmp-tab" onclick="filterGmpTab('slider', this)">Slider</button>
                </div>
                <div style="display: flex; gap: 8px; align-items: center;">
                    <input type="text" id="gmp-search-input" placeholder="Cari nama..." oninput="filterGmpSearch(this.value)" class="gmp-search-input">
                    <label class="btn btn-primary" style="font-size: 11.5px; padding: 6px 12px; cursor: pointer; white-space: nowrap; margin: 0; display: inline-flex; align-items: center; gap: 5px;" id="gmp-upload-btn-label">
                        <span>+ Unggah Baru</span>
                        <input type="file" id="gmp-quick-upload-input" accept="image/*" style="display: none;" onchange="handleGmpQuickUpload(this)">
                    </label>
                </div>
            </div>

            <div class="gmp-modal-body" id="gmp-modal-body-container">
                <div id="gmp-media-grid" class="gmp-grid">
                    <div style="grid-column: 1/-1; text-align: center; color: var(--teks-muted); padding: 40px 0;">Memuat daftar gambar...</div>
                </div>
            </div>

            <div class="gmp-modal-footer">
                <div id="gmp-selected-info" style="font-size: 12.5px; color: var(--teks-muted); display: flex; align-items: center; gap: 8px;">
                    <span>Belum ada gambar yang dipilih.</span>
                </div>
                <div style="display: flex; gap: 8px;">
                    <button type="button" class="btn btn-secondary" onclick="closeMediaPicker()" style="font-size: 13px; padding: 8px 16px;">Batal</button>
                    <button type="button" class="btn btn-primary" id="gmp-confirm-btn" onclick="confirmMediaSelection()" disabled style="font-size: 13px; padding: 8px 20px;">
                        Gunakan Gambar Ini
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let gmpMediaList = [];
        let gmpSelectedMedia = null;
        let gmpActiveCallback = null;
        let gmpCurrentFilter = 'all';
        let gmpSearchQuery = '';

        window.openMediaPicker = function(options) {
            if (typeof options === 'function') {
                gmpActiveCallback = options;
            } else if (options && typeof options.onSelect === 'function') {
                gmpActiveCallback = options.onSelect;
            } else {
                gmpActiveCallback = null;
            }

            gmpSelectedMedia = null;
            updateGmpFooterInfo();

            const modal = document.getElementById('global-media-picker-modal');
            if (modal) modal.style.display = 'flex';

            loadGmpMediaList();
        };

        window.closeMediaPicker = function() {
            const modal = document.getElementById('global-media-picker-modal');
            if (modal) modal.style.display = 'none';
        };

        async function loadGmpMediaList() {
            const grid = document.getElementById('gmp-media-grid');
            if (!grid) return;

            try {
                const response = await fetch('/admin/media/api', {
                    headers: { 'Accept': 'application/json' }
                });
                const res = await response.json();
                if (res.status === 'success') {
                    gmpMediaList = res.data || [];
                    document.getElementById('gmp-total-count').textContent = gmpMediaList.length;
                    renderGmpGrid();
                }
            } catch (err) {
                console.error('Failed to load media list:', err);
                grid.innerHTML = '<div style="grid-column: 1/-1; text-align: center; color: #EF4444; padding: 30px 0;">Gagal memuat media. Pastikan Anda telah login.</div>';
            }
        }

        function renderGmpGrid() {
            const grid = document.getElementById('gmp-media-grid');
            if (!grid) return;

            const filtered = gmpMediaList.filter(item => {
                const matchFolder = (gmpCurrentFilter === 'all' || item.folder === gmpCurrentFilter);
                const matchSearch = (!gmpSearchQuery || item.name.toLowerCase().includes(gmpSearchQuery.toLowerCase()));
                return matchFolder && matchSearch;
            });

            if (filtered.length === 0) {
                grid.innerHTML = '<div style="grid-column: 1/-1; text-align: center; color: var(--teks-muted); padding: 40px 0;">Tidak ada gambar yang sesuai.</div>';
                return;
            }

            grid.innerHTML = filtered.map(item => {
                const isSel = (gmpSelectedMedia && gmpSelectedMedia.path === item.path);
                return `
                    <div class="gmp-item ${isSel ? 'selected' : ''}" onclick="selectGmpItem('${encodeURIComponent(JSON.stringify(item))}')" ondblclick="quickSelectGmpItem('${encodeURIComponent(JSON.stringify(item))}')">
                        <div class="gmp-img-wrap">
                            <img src="${item.url}" alt="${item.name}" loading="lazy">
                        </div>
                        <div class="gmp-item-info">
                            <span class="gmp-item-title" title="${item.name}">${item.name}</span>
                            <div class="gmp-item-sub">${item.size} &bull; ${item.folder}</div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        function filterGmpTab(folder, btn) {
            gmpCurrentFilter = folder;
            document.querySelectorAll('.gmp-tab').forEach(t => t.classList.remove('aktif'));
            if (btn) btn.classList.add('aktif');
            renderGmpGrid();
        }

        function filterGmpSearch(val) {
            gmpSearchQuery = val;
            renderGmpGrid();
        }

        function selectGmpItem(encodedJson) {
            const item = JSON.parse(decodeURIComponent(encodedJson));
            gmpSelectedMedia = item;
            updateGmpFooterInfo();
            renderGmpGrid();
        }

        function quickSelectGmpItem(encodedJson) {
            selectGmpItem(encodedJson);
            confirmMediaSelection();
        }

        function updateGmpFooterInfo() {
            const infoEl = document.getElementById('gmp-selected-info');
            const confirmBtn = document.getElementById('gmp-confirm-btn');

            if (gmpSelectedMedia) {
                infoEl.innerHTML = `
                    <img src="${gmpSelectedMedia.url}" style="width: 28px; height: 28px; border-radius: 4px; object-fit: cover; border: 1px solid #CBD5E1;">
                    <span style="color: var(--biru-tua); font-weight: 700;">${gmpSelectedMedia.name}</span>
                    <span style="color: #64748B;">(${gmpSelectedMedia.size})</span>
                `;
                confirmBtn.removeAttribute('disabled');
            } else {
                infoEl.innerHTML = '<span>Belum ada gambar yang dipilih.</span>';
                confirmBtn.setAttribute('disabled', 'true');
            }
        }

        function confirmMediaSelection() {
            if (!gmpSelectedMedia) return;
            if (typeof gmpActiveCallback === 'function') {
                gmpActiveCallback(gmpSelectedMedia);
            }
            closeMediaPicker();
        }

        async function handleGmpQuickUpload(fileInput) {
            if (!fileInput.files || !fileInput.files[0]) return;
            const file = fileInput.files[0];
            const label = document.getElementById('gmp-upload-btn-label');
            const originalLabelHtml = label.innerHTML;

            label.innerHTML = '<span>Mengunggah...</span>';
            label.style.opacity = '0.7';

            const formData = new FormData();
            formData.append('file', file);
            formData.append('_token', '{{ csrf_token() }}');

            try {
                const response = await fetch('/admin/media', {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
                });
                const res = await response.json();
                if (res.status === 'success') {
                    await loadGmpMediaList();
                    gmpSelectedMedia = res.data;
                    updateGmpFooterInfo();
                    renderGmpGrid();
                } else {
                    alert(res.message || 'Gagal mengunggah file.');
                }
            } catch (err) {
                console.error('Upload failed:', err);
                alert('Gagal mengunggah file ke server.');
            } finally {
                label.innerHTML = originalLabelHtml;
                label.style.opacity = '1';
                fileInput.value = '';
            }
        }
    </script>
    
    @yield('scripts')
</body>
</html>
