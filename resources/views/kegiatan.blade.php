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

</style>
</head>
<body>

@include('partials.navbar', ['active' => 'kegiatan'])

<main>
  <h2 class="section-title">Dokumentasi Kegiatan</h2>
  
  <!-- GRID KEGIATAN -->
  <div class="kegiatan-grid">
    
    <!-- Template Card 1 -->
    <div class="kegiatan-card">
      <div class="kegiatan-img-wrap">
        <span class="kegiatan-badge">[Kategori]</span>
        <img src="https://placehold.co/600x400/e2e8f0/94a3b8?text=Foto+Kegiatan" alt="Thumbnail Kegiatan" class="kegiatan-img">
      </div>
      <div class="kegiatan-content">
        <h3 class="kegiatan-title">[Judul Kegiatan Akan Ditampilkan Di Sini]</h3>
        
        <div class="kegiatan-meta">
          <span class="kegiatan-meta-item">
            <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            [Tanggal]
          </span>
          <span class="kegiatan-meta-dot">&bull;</span>
          <span class="kegiatan-meta-item">
            <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
            [Lokasi]
          </span>
        </div>
        
        <hr class="kegiatan-divider">
        
        <div class="kegiatan-footer">
          <div class="kegiatan-author">
            <div class="kegiatan-avatar">AB</div>
            <span class="kegiatan-author-name">[Nama Pembuat]</span>
          </div>
          <a href="#" class="kegiatan-link">View Details</a>
        </div>
      </div>
    </div>

    <!-- Template Card 2 -->
    <div class="kegiatan-card">
      <div class="kegiatan-img-wrap">
        <span class="kegiatan-badge">[Kategori]</span>
        <img src="https://placehold.co/600x400/e2e8f0/94a3b8?text=Foto+Kegiatan" alt="Thumbnail Kegiatan" class="kegiatan-img">
      </div>
      <div class="kegiatan-content">
        <h3 class="kegiatan-title">[Judul Kegiatan Akan Ditampilkan Di Sini]</h3>
        
        <div class="kegiatan-meta">
          <span class="kegiatan-meta-item">
            <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            [Tanggal]
          </span>
          <span class="kegiatan-meta-dot">&bull;</span>
          <span class="kegiatan-meta-item">
            <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
            [Lokasi]
          </span>
        </div>
        
        <hr class="kegiatan-divider">
        
        <div class="kegiatan-footer">
          <div class="kegiatan-author">
            <div class="kegiatan-avatar">AB</div>
            <span class="kegiatan-author-name">[Nama Pembuat]</span>
          </div>
          <a href="#" class="kegiatan-link">View Details</a>
        </div>
      </div>
    </div>

    <!-- Template Card 3 -->
    <div class="kegiatan-card">
      <div class="kegiatan-img-wrap">
        <span class="kegiatan-badge">[Kategori]</span>
        <img src="https://placehold.co/600x400/e2e8f0/94a3b8?text=Foto+Kegiatan" alt="Thumbnail Kegiatan" class="kegiatan-img">
      </div>
      <div class="kegiatan-content">
        <h3 class="kegiatan-title">[Judul Kegiatan Akan Ditampilkan Di Sini]</h3>
        
        <div class="kegiatan-meta">
          <span class="kegiatan-meta-item">
            <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            [Tanggal]
          </span>
          <span class="kegiatan-meta-dot">&bull;</span>
          <span class="kegiatan-meta-item">
            <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
            [Lokasi]
          </span>
        </div>
        
        <hr class="kegiatan-divider">
        
        <div class="kegiatan-footer">
          <div class="kegiatan-author">
            <div class="kegiatan-avatar">AB</div>
            <span class="kegiatan-author-name">[Nama Pembuat]</span>
          </div>
          <a href="#" class="kegiatan-link">View Details</a>
        </div>
      </div>
    </div>

  </div>

</main>

@include('partials.footer')

<script>
  // Transisi halaman mulus
  document.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', function(e) {
      if (this.hostname === window.location.hostname && !this.hasAttribute('target')) {
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