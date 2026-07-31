<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Dokumentasi Kegiatan - Sistem Informasi Desa Munungkerep">
<title>Dokumentasi Kegiatan — Desa Munungkerep</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root {
    --biru-tua: #0B3B60;
    --biru: #1668A3;
    --bg: #F4F6F8;
    --teks: #1A2833;
    --teks-muted: #64748B;
    --border: #E2E8F0;
    --biru-aksen: #1D4ED8; /* Warna biru mirip referensi */
  }
  
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg); color: var(--teks); line-height: 1.5; }
  img { max-width: 100%; display: block; }
  a { color: inherit; text-decoration: none; }

  /* ============ LAYOUT UTAMA ============ */
  main {
    max-width: 1100px; margin: 40px auto 80px; padding: 20px;
    animation: fadeInPage .4s ease;
  }
  @keyframes fadeInPage { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

  .section-title { 
    font-size: 24px; font-weight: 800; color: var(--biru-tua); 
    margin-bottom: 28px; padding-bottom: 12px; border-bottom: 2px solid var(--border); 
  }

  /* ============ GRID KEGIATAN (SESUAI GAMBAR) ============ */
  .kegiatan-grid { 
    display: grid; grid-template-columns: 1fr; gap: 24px; margin-bottom: 60px; 
  }
  @media (min-width: 768px) { .kegiatan-grid { grid-template-columns: repeat(2, 1fr); } }
  @media (min-width: 1024px) { .kegiatan-grid { grid-template-columns: repeat(3, 1fr); } }

  .kegiatan-card {
    background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.04);
    display: flex; flex-direction: column; border: 1px solid var(--border); 
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .kegiatan-card:hover { transform: translateY(-4px); box-shadow: 0 10px 24px rgba(0,0,0,0.08); }
  
  /* Area Gambar & Badge */
  .kegiatan-img-wrap { position: relative; width: 100%; height: 210px; background: #e2e8f0; }
  .kegiatan-img { width: 100%; height: 100%; object-fit: cover; }
  .kegiatan-badge {
    position: absolute; top: 16px; left: 16px; background: var(--biru-aksen); color: #fff;
    font-size: 11px; font-weight: 700; padding: 6px 14px; border-radius: 20px; letter-spacing: 0.03em;
  }

  /* Area Konten */
  .kegiatan-content { padding: 20px 20px 24px; display: flex; flex-direction: column; flex-grow: 1; }
  .kegiatan-title { font-size: 17px; font-weight: 800; color: #0F172A; margin-bottom: 12px; line-height: 1.4; }
  
  /* Meta Tanggal & Lokasi */
  .kegiatan-meta { display: flex; align-items: center; flex-wrap: wrap; gap: 8px; font-size: 12.5px; color: var(--teks-muted); margin-bottom: 20px; font-weight: 500; }
  .kegiatan-meta-item { display: inline-flex; align-items: center; gap: 6px; }
  .kegiatan-meta-item svg { width: 14px; height: 14px; stroke: currentColor; stroke-width: 2.2; }
  .kegiatan-meta-dot { font-size: 18px; line-height: 0; color: #CBD5E1; }

  /* Garis Pembatas */
  .kegiatan-divider { border: none; border-top: 1px solid var(--border); margin: auto 0 16px; }

  /* Footer Kartu (Profil & Link) */
  .kegiatan-footer { display: flex; align-items: center; justify-content: space-between; }
  .kegiatan-author { display: flex; align-items: center; gap: 10px; }
  .kegiatan-avatar {
    width: 32px; height: 32px; border-radius: 50%; background: #DBEAFE; color: var(--biru-aksen);
    display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 800; letter-spacing: 0.05em;
  }
  .kegiatan-author-name { font-size: 13px; font-weight: 700; color: #334155; }
  .kegiatan-link { font-size: 13px; font-weight: 700; color: var(--biru-aksen); text-decoration: none; transition: opacity 0.2s ease; }
  .kegiatan-link:hover { opacity: 0.7; }

  /* ============ POPUP / MODAL DETAIL KEGIATAN (ANIMASI NAIK) ============ */
  .keg-modal-overlay {
    display: none; position: fixed; inset: 0; z-index: 2100;
    background: rgba(11, 59, 96, 0.45);
    backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
    align-items: center; justify-content: center; padding: 20px;
    opacity: 0; transition: opacity 0.3s ease;
  }
  .keg-modal-overlay.active {
    display: flex; opacity: 1;
  }
  
  .keg-modal-box {
    background: #fff; border-radius: 16px; max-width: 600px; width: 100%;
    position: relative; overflow: hidden; box-shadow: 0 20px 50px rgba(11, 59, 96, 0.25);
    border: 1px solid var(--border);
    transform: translateY(100px); opacity: 0;
    transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.4s ease;
  }
  .keg-modal-overlay.active .keg-modal-box {
    transform: translateY(0); opacity: 1;
  }
  
  .keg-modal-close {
    position: absolute; top: 12px; right: 12px; z-index: 10;
    background: rgba(255, 255, 255, 0.9); color: var(--biru-tua); border: 1px solid var(--border);
    width: 32px; height: 32px; border-radius: 50%; cursor: pointer; font-size: 20px;
    display: flex; align-items: center; justify-content: center; line-height: 1;
    transition: background 0.2s ease, transform 0.2s ease;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
  }
  .keg-modal-close:hover { background: #fff; transform: scale(1.05); color: #C62828; }
  
  .prod-modal-body, .keg-modal-body {
    display: flex; flex-direction: column; max-height: 85vh;
  }
  
  .keg-modal-img-wrap {
    position: relative; width: 100%; height: 260px; background: #f1f5f9; flex-shrink: 0;
  }
  .keg-modal-img-wrap img { width: 100%; height: 100%; object-fit: cover; }
  .keg-modal-img-wrap .keg-badge {
    position: absolute; top: 12px; left: 12px; background: var(--biru-aksen); color: #fff;
    font-size: 11px; font-weight: 700; padding: 6px 14px; border-radius: 20px; letter-spacing: 0.03em;
    text-transform: uppercase;
  }
  
  .keg-modal-info {
    padding: 24px; overflow-y: auto; display: flex; flex-direction: column; gap: 16px;
  }
  .keg-modal-info h2 { font-size: 22px; font-weight: 800; color: var(--biru-tua); line-height: 1.25; }
  
  .keg-modal-desc-wrap h4 {
    font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em;
    color: var(--teks-muted); margin-bottom: 6px;
  }
  .keg-modal-desc-wrap p {
    font-size: 14px; color: var(--teks); line-height: 1.65; white-space: pre-line;
  }
</style>
</head>
<body>

@include('partials.navbar', ['active' => 'kegiatan'])

<main>
  <h2 class="section-title">Dokumentasi Kegiatan</h2>
  
  <!-- GRID KEGIATAN -->
  <div class="kegiatan-grid">
    @forelse($kegiatans as $item)
    <div class="kegiatan-card" onclick="openKegiatanModal(this)" style="cursor: pointer;"
         data-judul="{{ $item->judul }}"
         data-kategori="{{ $item->kategori }}"
         data-tanggal="{{ date('d M Y', strtotime($item->tanggal)) }}"
         data-lokasi="{{ $item->lokasi }}"
         data-pembuat="{{ $item->nama_pembuat }}"
         data-avatar="{{ substr($item->nama_pembuat, 0, 2) }}">
      <div class="kegiatan-img-wrap">
        <span class="kegiatan-badge">{{ $item->kategori }}</span>
        <img src="{{ $item->foto ? asset('storage/'.$item->foto) : 'https://placehold.co/600x400/e2e8f0/94a3b8?text=Foto+Kegiatan' }}" alt="{{ $item->judul }}" class="kegiatan-img">
      </div>
      <div class="kegiatan-content">
        <h3 class="kegiatan-title">{{ $item->judul }}</h3>
        
        <div class="kegiatan-meta">
          <span class="kegiatan-meta-item">
            <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            {{ date('d M Y', strtotime($item->tanggal)) }}
          </span>
          <span class="kegiatan-meta-dot">&bull;</span>
          <span class="kegiatan-meta-item">
            <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
            {{ $item->lokasi }}
          </span>
        </div>
        
        <!-- Menyimpan deskripsi lengkap secara tersembunyi -->
        <div class="kegiatan-desc-full" style="display: none;">{{ $item->deskripsi }}</div>
        
        <hr class="kegiatan-divider">
        
        <div class="kegiatan-footer">
          <div class="kegiatan-author">
            <div class="kegiatan-avatar">{{ substr($item->nama_pembuat, 0, 2) }}</div>
            <span class="kegiatan-author-name">{{ $item->nama_pembuat }}</span>
          </div>
          <span class="kegiatan-link">Lihat Detail</span>
        </div>
      </div>
    </div>
    @empty
    <div class="empty-state" style="text-align: center; padding: 60px 20px; color: var(--teks-muted); font-size: 15px; background: #fff; border-radius: 12px; border: 1px dashed var(--border); grid-column: 1 / -1;">
      Belum ada dokumentasi kegiatan yang diunggah.
    </div>
    @endforelse
  </div>

</main>

<!-- Modal / Popup Detail Kegiatan -->
<div class="keg-modal-overlay" id="keg-modal-overlay" onclick="closeKegiatanModal(event)">
  <div class="keg-modal-box">
    <button class="keg-modal-close" onclick="closeKegiatanModal()">&times;</button>
    <div class="keg-modal-body">
      <div class="keg-modal-img-wrap">
        <img id="modal-keg-img" src="" alt="Detail Kegiatan">
        <span class="keg-badge" id="modal-keg-badge">Kategori</span>
      </div>
      <div class="keg-modal-info">
        <h2 id="modal-keg-title">Judul Kegiatan</h2>
        
        <div class="kegiatan-meta" style="margin-bottom: 0;">
          <span class="kegiatan-meta-item" id="modal-keg-tanggal">
            <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round" style="width: 14px; height: 14px; stroke: currentColor; stroke-width: 2.2;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            Tanggal
          </span>
          <span class="kegiatan-meta-dot">&bull;</span>
          <span class="kegiatan-meta-item" id="modal-keg-lokasi">
            <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round" style="width: 14px; height: 14px; stroke: currentColor; stroke-width: 2.2;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
            Lokasi
          </span>
        </div>
        
        <div class="keg-modal-desc-wrap">
          <h4>Detail Dokumentasi</h4>
          <p id="modal-keg-desc">Detail lengkap jalannya kegiatan...</p>
        </div>
        
        <hr class="kegiatan-divider">
        
        <div class="kegiatan-footer">
          <div class="kegiatan-author">
            <div class="kegiatan-avatar" id="modal-keg-avatar">AB</div>
            <div>
              <span style="font-size: 11px; color: var(--teks-muted); display: block; font-weight: 500; text-align: left;">Dokumentator</span>
              <span class="kegiatan-author-name" id="modal-keg-pembuat">Nama Pembuat</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@include('partials.footer')

<script>
  // Fungsi membuka modal kegiatan
  function openKegiatanModal(card) {
    const judul = card.getAttribute('data-judul');
    const kategori = card.getAttribute('data-kategori');
    const tanggal = card.getAttribute('data-tanggal');
    const lokasi = card.getAttribute('data-lokasi');
    const pembuat = card.getAttribute('data-pembuat');
    const avatar = card.getAttribute('data-avatar');
    
    const imgUrl = card.querySelector('.kegiatan-img').src;
    const fullDesc = card.querySelector('.kegiatan-desc-full').textContent;
    
    document.getElementById('modal-keg-img').src = imgUrl;
    document.getElementById('modal-keg-img').alt = judul;
    document.getElementById('modal-keg-badge').textContent = kategori;
    document.getElementById('modal-keg-title').textContent = judul;
    document.getElementById('modal-keg-tanggal').innerHTML = `
      <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round" style="width: 14px; height: 14px; stroke: currentColor; stroke-width: 2.2;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
      ${tanggal}
    `;
    document.getElementById('modal-keg-lokasi').innerHTML = `
      <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round" style="width: 14px; height: 14px; stroke: currentColor; stroke-width: 2.2;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
      ${lokasi}
    `;
    document.getElementById('modal-keg-desc').textContent = fullDesc;
    document.getElementById('modal-keg-avatar').textContent = avatar;
    document.getElementById('modal-keg-pembuat').textContent = pembuat;
    
    const overlay = document.getElementById('keg-modal-overlay');
    overlay.style.display = 'flex';
    setTimeout(() => {
      overlay.classList.add('active');
    }, 10);
    
    document.body.style.overflow = 'hidden';
  }
  
  // Fungsi menutup modal kegiatan
  function closeKegiatanModal(event) {
    if (event && event.target !== event.currentTarget && !event.target.classList.contains('keg-modal-close')) {
      return;
    }
    const overlay = document.getElementById('keg-modal-overlay');
    overlay.classList.remove('active');
    
    setTimeout(() => {
      overlay.style.display = 'none';
    }, 300);
    
    document.body.style.overflow = '';
  }

  // Transisi halaman mulus
  document.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', function(e) {
      if (this.hostname === window.location.hostname && !this.hasAttribute('target') && !this.classList.contains('keg-modal-close')) {
        e.preventDefault();
        const url = this.href;
        document.body.style.transition = 'opacity .25s ease, transform .25s ease';
        document.body.style.opacity = '0';
        document.body.style.transform = 'translateY(-6px)';
        setTimeout(() => { window.location.href = url; }, 220);
      }
    });
  });
</script>
</body>
</html>