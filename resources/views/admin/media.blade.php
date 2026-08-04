@extends('layouts.admin', ['activePage' => 'media'])

@section('title', 'Pustaka Media')

@section('styles')
    <style>
        /* Media Upload Form */
        .upload-section { background: #F8FAFC; border: 2px dashed #CBD5E1; border-radius: 12px; padding: 24px; margin-bottom: 30px; text-align: center; transition: all 0.2s; }
        .upload-section:hover { border-color: var(--biru-muda); }
        .upload-section label { display: inline-block; cursor: pointer; font-weight: 600; font-size: 15px; }

        /* Folder Filter Tabs */
        .filter-nav { display: flex; gap: 8px; margin-bottom: 20px; overflow-x: auto; padding-bottom: 6px; border-bottom: 1px solid var(--border); scrollbar-width: none; }
        .filter-nav::-webkit-scrollbar { display: none; }
        .filter-tab { padding: 6px 14px; border-radius: 20px; font-size: 13px; font-weight: 600; color: var(--teks-muted); background: #F1F5F9; cursor: pointer; border: none; transition: all 0.15s; white-space: nowrap; }
        .filter-tab.aktif { background: var(--biru-muda); color: #fff; }
        .filter-tab:hover:not(.aktif) { background: #E2E8F0; color: var(--teks); }

        /* Media Grid */
        .media-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; }
        .media-card { background: #fff; border: 1px solid var(--border); border-radius: 10px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.02); display: flex; flex-direction: column; transition: transform 0.2s, box-shadow 0.2s; }
        .media-card:hover { transform: translateY(-3px); box-shadow: 0 8px 16px rgba(0,0,0,0.06); }
        
        .media-img-wrap { position: relative; width: 100%; aspect-ratio: 4/3; background: #f1f5f9; overflow: hidden; display: flex; align-items: center; justify-content: center; border-bottom: 1px solid var(--border); }
        .media-img { width: 100%; height: 100%; object-fit: cover; }
        .media-badge { position: absolute; top: 8px; left: 8px; background: rgba(11, 59, 96, 0.85); color: white; padding: 2px 8px; border-radius: 20px; font-size: 10px; font-weight: 700; text-transform: uppercase; }

        .media-details { padding: 12px; flex-grow: 1; display: flex; flex-direction: column; gap: 4px; }
        .media-title { font-size: 12.5px; font-weight: 700; color: var(--teks); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .media-info { font-size: 11px; color: var(--teks-muted); }

        .media-actions { padding: 8px 12px 12px; display: flex; gap: 6px; }
        .media-actions .btn { flex-grow: 1; font-size: 11.5px; padding: 6px 10px; justify-content: center; }

        /* Empty State */
        .empty-state { text-align: center; color: var(--teks-muted); padding: 40px; border: 1px dashed var(--border); border-radius: 12px; font-size: 14px; grid-column: 1 / -1; }
    </style>
@endsection

@section('content')
    <div class="admin-box">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
            <h1 style="margin: 0; font-size: 24px; color: var(--biru-tua); font-weight: 800;">Pustaka Media Desa</h1>
            <a href="/" class="btn btn-secondary" target="_blank">Lihat Web</a>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Form Upload Cepat -->
        <div class="upload-section">
            <h3 style="margin-top:0; margin-bottom:8px; font-size:16px; color:var(--biru-tua);">Unggah Gambar ke Pustaka Umum</h3>
            <p style="margin-top:0; margin-bottom:16px; font-size:12.5px; color:var(--teks-muted);">Unggah file gambar disini agar dapat disalin URL-nya dan disisipkan di dalam artikel berita atau halaman lainnya.</p>
            <form action="/admin/media" method="POST" enctype="multipart/form-data" id="upload-form">
                @csrf
                <label for="media-file" class="btn btn-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width:16px; height:16px;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                    Pilih File Gambar
                </label>
                <input type="file" name="file" id="media-file" accept="image/*" style="display:none;" onchange="submitUploadForm()">
                <small style="color:var(--teks-muted); display:block; margin-top:8px;">Format diizinkan: JPG, JPEG, PNG, GIF, WebP (Maksimal 15MB, akan dikompresi otomatis)</small>
                @error('file') <span style="color:#EF4444; font-size:12px; font-weight:600; display:block; margin-top:4px;">{{ $message }}</span> @enderror
            </form>
        </div>

        <!-- Filter Navigasi Folder -->
        <div class="filter-nav">
            <button class="filter-tab aktif" onclick="filterMedia('all')">Semua Berkas ({{ count($images) }})</button>
            <button class="filter-tab" onclick="filterMedia('uploads')">Unggahan Umum</button>
            <button class="filter-tab" onclick="filterMedia('berita_images')">Banner Berita</button>
            <button class="filter-tab" onclick="filterMedia('berita_content')">Gambar di Berita</button>
            <button class="filter-tab" onclick="filterMedia('produk_images')">Foto Produk</button>
            <button class="filter-tab" onclick="filterMedia('kegiatan_images')">Foto Kegiatan</button>
        </div>

        <!-- Grid Gambar -->
        <div class="media-grid">
            @forelse($images as $img)
            <div class="media-card" data-folder="{{ $img['folder'] }}">
                <div class="media-img-wrap">
                    <span class="media-badge">{{ $img['folder'] }}</span>
                    <img src="{{ $img['url'] }}" alt="{{ $img['name'] }}" class="media-img" loading="lazy">
                </div>
                <div class="media-details">
                    <span class="media-title" title="{{ $img['name'] }}">{{ $img['name'] }}</span>
                    <span class="media-info">Ukuran: <b>{{ $img['size'] }}</b></span>
                </div>
                <div class="media-actions">
                    <button class="btn btn-secondary" onclick="copyLink(this, '{{ $img['url'] }}')">
                        Salin URL
                    </button>
                    <form action="/admin/media" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus gambar ini secara permanen dari disk server?');" style="display:inline; flex-grow:1;">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="path" value="{{ $img['path'] }}">
                        <button type="submit" class="btn btn-danger" style="width:100%;">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="empty-state">
                Belum ada file media yang tersimpan di server.
            </div>
            @endforelse
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Scripts -->
    <script>
        // Jalankan submit otomatis saat file gambar dipilih
        function submitUploadForm() {
            const form = document.getElementById('upload-form');
            const submitBtn = form.querySelector('label');
            if (submitBtn) {
                submitBtn.style.opacity = '0.7';
                submitBtn.style.cursor = 'not-allowed';
                submitBtn.innerHTML = 'Mengunggah...';
            }
            form.submit();
        }

        // Tapis gambar berdasarkan folder asal
        function filterMedia(folder) {
            // Perbarui class aktif pada filter tabs
            document.querySelectorAll('.filter-tab').forEach(tab => {
                tab.classList.remove('aktif');
            });
            event.currentTarget.classList.add('aktif');

            // Sembunyikan atau tampilkan media cards
            document.querySelectorAll('.media-card').forEach(card => {
                const cardFolder = card.getAttribute('data-folder');
                if (folder === 'all' || cardFolder === folder) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Fungsi bantu untuk menyalin teks yang aman di HTTP (IP Lokal) dan HTTPS
        function copyTextToClipboard(text) {
            if (navigator.clipboard && window.isSecureContext) {
                return navigator.clipboard.writeText(text);
            } else {
                return new Promise((resolve, reject) => {
                    const textArea = document.createElement("textarea");
                    textArea.value = text;
                    textArea.style.top = "0";
                    textArea.style.left = "0";
                    textArea.style.position = "fixed";
                    textArea.style.opacity = "0";
                    
                    document.body.appendChild(textArea);
                    textArea.focus();
                    textArea.select();
                    
                    try {
                        const successful = document.execCommand('copy');
                        document.body.removeChild(textArea);
                        if (successful) {
                            resolve();
                        } else {
                            reject();
                        }
                    } catch (err) {
                        document.body.removeChild(textArea);
                        reject(err);
                    }
                });
            }
        }

        // Salin tautan gambar ke clipboard
        async function copyLink(btn, url) {
            try {
                await copyTextToClipboard(url);
                const originalText = btn.innerHTML;
                btn.innerHTML = 'Disalin!';
                btn.style.background = '#D1FAE5';
                btn.style.color = '#065F46';
                btn.style.borderColor = '#A7F3D0';
                
                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.style.background = '';
                    btn.style.color = '';
                    btn.style.borderColor = '';
                }, 1500);
            } catch (err) {
                console.error('Gagal menyalin link:', err);
                alert('Tautan gagal disalin otomatis, silakan salin manual: ' + url);
            }
        }
    </script>
@endsection
