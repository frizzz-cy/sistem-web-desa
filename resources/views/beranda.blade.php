<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Sistem Informasi Desa Munungkerep, Kecamatan Kabuh, Kabupaten Jombang — portal resmi pemerintah desa.">
<title>Beranda — Sistem Informasi Desa Munungkerep</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root{
    --biru-tua:#0B3B60;
    --biru:#1668A3;
    --biru-muda:#E8F1F8;
    --merah:#C62828;
    --emas:#D4A017;
    --bg:#F4F6F8;
    --putih:#FFFFFF;
    --teks:#1A2833;
    --teks-muted:#5B6B7A;
    --border:#DDE3E8;
    
    /* Warna Khusus Berita */
    --hijau-tua: #1B4D2E;
    --hijau-muda: #E8F5E9;
    --hijau-teks: #2E7D32;
  }
  *{box-sizing:border-box; margin:0; padding:0;}
  html{scroll-behavior:smooth;}
  body{font-family:'Plus Jakarta Sans',sans-serif; background:var(--bg); color:var(--teks); line-height:1.5;}
  img{max-width:100%; display:block;}
  a{color:inherit; text-decoration:none;}

  /* ============ HERO ============ */
  .hero{
    position:relative; background:linear-gradient(135deg, var(--biru-tua) 0%, #08283F 100%);
    color:#fff; padding:64px 20px 90px; text-align:center; overflow:hidden;
  }
  .hero::after{
    content:''; position:absolute; bottom:0; left:0; right:0; height:260px; z-index:1;
    background:linear-gradient(to bottom, transparent 0%, transparent 55%, var(--biru-tua) 72%, var(--biru-tua) 80%, var(--bg) 100%);
    pointer-events:none;
  }
  .hero-inner{position:relative; z-index:2; max-width:760px; margin:0 auto;}
  .hero h1{font-size:clamp(28px,5.5vw,44px); font-weight:800; line-height:1.2;}
  .hero p{font-size:clamp(13.5px,2vw,15px); color:#C9DCEA; margin-top:14px; max-width:540px; margin-left:auto; margin-right:auto; line-height:1.65;}

  .hero{ min-height:100vh; display:flex; align-items:center; padding:90px 20px 70px; }
  .hero-slides{ position:absolute; inset:0; z-index:0; }
  .hero-slide{
    position:absolute; inset:0; opacity:0; transition:opacity 1.2s ease;
    background-size:cover; background-position:center;
  }
  .hero-slide.aktif{ opacity:1; }
  .hero-slide::after{
    content:''; position:absolute; inset:0;
    background:linear-gradient(135deg, rgba(11,59,96,0.88) 0%, rgba(8,40,63,0.92) 100%);
  }
  .hero-partikel{ position:absolute; inset:0; z-index:1; overflow:hidden; pointer-events:none; }
  .partikel{
    position:absolute; top:-40px; border-radius:0% 100% 0% 100%;
    background:linear-gradient(135deg, rgba(140,190,120,0.55), rgba(90,140,80,0.35));
    animation:jatuh linear infinite;
  }
  @keyframes jatuh{
    0%{ transform:translateY(0) translateX(0) rotate(0deg); opacity:0; }
    10%{ opacity:0.65; }
    90%{ opacity:0.45; }
    100%{ transform:translateY(110vh) translateX(var(--geser, 30px)) rotate(var(--putar, 220deg)); opacity:0; }
  }

  /* ============ SECTION UMUM ============ */
  main{max-width:1180px; margin:0 auto; padding:70px 20px 20px; transition: opacity 0.3s ease;}
  .sect-head{text-align:center; margin-bottom:34px;}
  .reveal{opacity:0; transform:translateY(24px); transition:opacity .7s ease, transform .7s ease;}
  .reveal.tampak{opacity:1; transform:translateY(0);}

  .tentang{max-width:820px; margin:0 auto 64px; text-align:center;}
  .tentang p{font-size:14px; color:var(--teks-muted); line-height:1.75; margin-bottom:14px;}
  .tentang p:first-of-type{font-size:15.5px; color:var(--teks); font-weight:500;}

  .sect-head .eyebrow{
    font-size:16px; font-weight:700; letter-spacing:.08em; text-transform:uppercase; color:var(--merah);
    margin-bottom:8px;
  }
  .sect-head h2{font-size:clamp(21px,4vw,28px); font-weight:800; color:var(--biru-tua);}

  /* ============ PORTAL CARDS ============ */
  .portal-grid{display:grid; grid-template-columns:1fr; gap:18px; margin-bottom:64px;}
  @media (min-width:640px){ .portal-grid{grid-template-columns:repeat(2,1fr);} }
  @media (min-width:960px){ .portal-grid{grid-template-columns:repeat(3,1fr);} }
  .portal-card{
    background:var(--putih); border:1px solid var(--border); border-radius:12px;
    padding:34px 24px; text-align:center; cursor:pointer;
    transition:transform .2s ease, box-shadow .2s ease, border-color .2s ease; display:block; width:100%; font-family:'Plus Jakarta Sans',sans-serif;
  }
  .portal-card:hover{transform:translateY(-3px); box-shadow:0 12px 24px rgba(11,59,96,0.12); border-color:var(--biru);}
  .portal-card .p-badge{
    width:84px; height:84px; border-radius:50%; margin:0 auto 20px;
    background:linear-gradient(135deg, var(--biru) 0%, var(--biru-tua) 100%);
    box-shadow:0 8px 18px rgba(22,104,163,0.3); display:flex; align-items:center; justify-content:center; font-size:34px;
  }
  .portal-card h3{font-size:17px; font-weight:800; color:var(--teks); margin-bottom:10px;}
  .portal-card p{font-size:13px; color:var(--teks-muted); line-height:1.65; margin-bottom:20px;}
  .portal-card .p-link{
    display:inline-flex; align-items:center; gap:6px; background:linear-gradient(90deg, var(--biru-tua) 0%, var(--biru) 100%);
    color:#fff; font-size:13px; font-weight:700; padding:11px 22px; border-radius:30px; box-shadow:0 4px 10px rgba(22,104,163,0.25);
  }
  .portal-card .p-link svg{width:11px; height:11px; transition:transform .15s ease;}
  .portal-card:hover .p-link svg{transform:translateX(3px);}

  /* ============ TEMPLATE KARTU BERITA ============ */
  .berita-section { padding-top: 20px; margin-bottom: 60px; }
  .berita-head { text-align: center; margin-bottom: 30px; }
  .berita-head h2 { font-size: clamp(24px, 4vw, 30px); font-weight: 800; color: var(--hijau-tua); }
  .berita-grid { display: grid; grid-template-columns: 1fr; gap: 24px; }
  @media (min-width: 768px) { .berita-grid { grid-template-columns: repeat(2, 1fr); } }
  @media (min-width: 1024px) { .berita-grid { grid-template-columns: repeat(3, 1fr); } }

  .berita-card {
    background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    display: flex; flex-direction: column; border: 1px solid #e2e8f0; transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .berita-card:hover { transform: translateY(-4px); box-shadow: 0 10px 24px rgba(0,0,0,0.1); }
  .berita-img { width: 100%; height: 220px; background: #e2e8f0; object-fit: cover; }
  .berita-content { padding: 24px; display: flex; flex-direction: column; flex-grow: 1; }
  .berita-badge {
    align-self: flex-start; background: var(--hijau-muda); color: var(--hijau-teks); font-size: 11px;
    font-weight: 700; padding: 6px 14px; border-radius: 20px; margin-bottom: 16px; text-transform: uppercase;
  }
  .berita-title { font-size: 18px; font-weight: 800; color: #111; margin-bottom: 8px; line-height: 1.4; }
  .berita-date { font-size: 12px; color: #888; margin-bottom: 16px; }
  .berita-excerpt { font-size: 14px; color: #555; line-height: 1.6; margin-bottom: 24px; flex-grow: 1; }
  .berita-link {
    font-size: 14px; font-weight: 800; color: var(--hijau-tua); text-decoration: none;
    display: inline-flex; align-items: center; gap: 6px; transition: opacity 0.2s ease; cursor: pointer;
  }
  .berita-link:hover { opacity: 0.7; }

  /* ============ HALAMAN DETAIL BERITA (MUNCUL SAAT DIKLIK) ============ */
  #berita-detail-container {
    display: none; /* Disembunyikan secara default */
    max-width: 900px;
    margin: 40px auto;
    padding: 20px;
    animation: fadeInPage .4s ease;
  }
  
  .btn-kembali {
    display: inline-flex; align-items: center; gap: 6px; color: var(--hijau-tua);
    font-weight: 700; font-size: 14px; text-decoration: none; margin-bottom: 24px; cursor: pointer;
  }
  .btn-kembali:hover { opacity: 0.8; }
  .btn-kembali svg { width: 18px; height: 18px; }

  .berita-detail-card {
    background: #fff; border-radius: 12px; padding: 30px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.04); border: 1px solid #e2e8f0;
  }
  @media (min-width: 768px) { .berita-detail-card { padding: 48px; } }

  .bd-badge {
    display: inline-block; background: var(--hijau-muda); color: var(--hijau-teks);
    font-size: 11px; font-weight: 700; padding: 6px 14px; border-radius: 20px;
    margin-bottom: 16px; text-transform: uppercase; letter-spacing: .05em;
  }
  .bd-title {
    font-size: clamp(22px, 4vw, 32px); font-weight: 800; color: #111; line-height: 1.3; margin-bottom: 12px;
  }
  .bd-meta {
    font-size: 13px; color: #888; margin-bottom: 30px; display: flex; gap: 12px; align-items: center;
  }
  .bd-img {
    width: 100%; border-radius: 12px; margin-bottom: 30px; object-fit: cover; max-height: 480px; background: #e2e8f0;
  }
  .bd-content { font-size: 15px; color: #333; line-height: 1.75; }
  .bd-content p { margin-bottom: 16px; }
  .bd-content strong { color: #111; font-weight: 700; }

  /* ============ MODAL LAYANAN ADMINISTRASI ============ */
  .modal-layanan-overlay{ display:none; position:fixed; inset:0; z-index:3000; background:rgba(11,40,63,0.75); align-items:center; justify-content:center; padding:20px; }
  .modal-layanan-overlay.show{display:flex;}
  .modal-layanan-box{ background:#fff; border-radius:12px; max-width:600px; width:100%; max-height:85vh; overflow-y:auto; position:relative; padding:28px 26px; }
  .modal-layanan-close{ position:absolute; top:16px; right:16px; background:var(--biru-tua); color:#fff; border:none; width:32px; height:32px; border-radius:50%; cursor:pointer; font-size:15px; }
  .modal-layanan-box h3{font-size:20px; font-weight:800; color:var(--biru-tua); margin-bottom:6px;}
  .modal-layanan-box .sub{font-size:12.5px; color:var(--teks-muted); margin-bottom:20px;}
  .surat-item{border:1px solid var(--border); border-radius:8px; margin-bottom:10px; overflow:hidden;}
  .surat-item summary{ cursor:pointer; list-style:none; padding:14px 16px; font-weight:700; font-size:14px; color:var(--teks); display:flex; align-items:center; justify-content:space-between; background:var(--bg); }
  .surat-item summary::-webkit-details-marker{display:none;}
  .surat-item summary::after{content:'+'; font-size:18px; color:var(--biru); font-weight:400;}
  .surat-item[open] summary::after{content:'–';}
  .surat-item .isi-surat{padding:14px 16px 16px;}
  .surat-item .label-kecil{ font-size:10.5px; font-weight:700; text-transform:uppercase; letter-spacing:.05em; color:var(--merah); margin-bottom:8px; display:block; }
  .surat-item ul{padding-left:18px; margin-bottom:12px;}
  .surat-item li{font-size:13px; color:var(--teks-muted); line-height:1.7;}
  .surat-item .ket{ font-size:12.5px; color:var(--biru-tua); background:var(--biru-muda); padding:8px 12px; border-radius:6px; font-weight:600; }
</style>
</head>
<body>

@include('partials.navbar', ['active' => 'beranda'])

<!-- HERO HEADER -->
<header class="hero" id="hero-header">
  <div class="hero-slides" id="hero-slides">
    <div class="hero-slide aktif" style="background-color:#0B3B60;" data-src="/images/slider/sdn2.jpeg"></div>
    <div class="hero-slide" style="background-color:#0B3B60;" data-src="/images/slider/tknusa.jpeg"></div>
    <div class="hero-slide" style="background-color:#0B3B60;" data-src="/images/slider/sentra.jpg"></div>
    <div class="hero-slide" style="background-color:#0B3B60;" data-src="/images/carousel/slide-4.jpg"></div>
  </div>
  <div class="hero-partikel" id="hero-partikel"></div>
  <div class="hero-inner">
    <h1>Selamat Datang di Desa Munungkerep</h1>
    <p>Kecamatan Kabuh, Kabupaten Jombang, Jawa Timur melayani informasi profil, peta wilayah, dan potensi desa secara terbuka untuk seluruh warga dan masyarakat umum.</p>
  </div>
</header>

<!-- MAIN KONTEN (HALAMAN DEPAN) -->
<main id="main-content">
  <div class="sect-head">
    <div class="eyebrow">TENTANG</div>
    <h2>Mengenal Desa Munungkerep</h2>
  </div>
  <div class="tentang reveal">
    <p>Desa Munungkerep merupakan salah satu desa di Kecamatan Kabuh, Kabupaten Jombang, Jawa Timur, yang berada di kawasan dataran tinggi dengan kondisi tanah kering pada musim kemarau.</p>
    <p>Desa ini terdiri dari 7 dusun Munungkerep, Karanggebang, Duren, Slumbung, Kalipang, Kadenan, dan Jatirubuh dengan mayoritas warga berprofesi sebagai petani. Tembakau menjadi komoditas unggulan yang ditanam warga saat musim kemarau, didampingi pandan sebagai komoditas pendukung yang tumbuh merata di seluruh wilayah desa.</p>
    <p>Melalui portal ini, kami berupaya menghadirkan informasi desa secara terbuka — mulai dari peta wilayah, potensi ekonomi, struktur pemerintahan, hingga data profil desa agar mudah diakses oleh warga dan masyarakat umum.</p>
  </div>

  <div class="sect-head">
    <h2>Layanan & Informasi</h2>
  </div>

  <div class="portal-grid reveal">
    <button class="portal-card" onclick="bukaModalLayanan()">
      <div class="p-badge">
        <svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M7 3h8l4 4v14a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z"/><path d="M15 3v4h4"/><path d="M9 12h6M9 16h6M9 8h3"/></svg>
      </div>
      <h3>Layanan Administrasi</h3>
      <p>Persyaratan lengkap surat-menyurat desa — domisili, usaha, KTP, KK, hingga surat tidak mampu.</p>
      <div class="p-link">Lihat Persyaratan <svg viewBox="0 0 12 12" fill="none"><path d="M4 2L9 6L4 10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
    </button>
    <a href="/profil-desa" class="portal-card">
      <div class="p-badge">
        <svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 21V7l8-4 8 4v14"/><path d="M9 21v-6h6v6M4 21h16"/></svg>
      </div>
      <h3>Informasi Publik</h3>
      <p>Struktur organisasi pemerintah desa, anggaran APBDes, kondisi geografis, data demografis, hingga visi &amp; misi.</p>
      <div class="p-link">Lihat Profil <svg viewBox="0 0 12 12" fill="none"><path d="M4 2L9 6L4 10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
    </a>
    <a href="/profil-desa#pemerintahan" class="portal-card">
      <div class="p-badge">
        <svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="7" r="3"/><path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6"/><circle cx="18" cy="8" r="2.2"/><path d="M15.5 20c.3-2.5 2-4.5 4.3-5"/></svg>
      </div>
      <h3>Struktur Pemerintahan</h3>
      <p>Kenali Kepala Desa, perangkat desa, dan Kepala Dusun yang melayani warga Munungkerep.</p>
      <div class="p-link">Lihat Struktur <svg viewBox="0 0 12 12" fill="none"><path d="M4 2L9 6L4 10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
    </a>
    <a href="/profil-desa#anggaran" class="portal-card">
      <div class="p-badge">
        <svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20.5s-7.5-4.6-9.8-9.2C.6 7.8 2.4 4.5 5.6 4c2-.3 3.9.7 4.9 2.4 1-1.7 2.9-2.7 4.9-2.4 3.2.5 5 3.8 3.4 7.3-2.3 4.6-9.8 9.2-9.8 9.2Z"/></svg>
      </div>
      <h3>Bantuan Sosial</h3>
      <p>Lihat rincian APBDes — realisasi tahun berjalan dan rencana anggaran tahun berikutnya, terbuka untuk warga.</p>
      <div class="p-link">Lihat Anggaran <svg viewBox="0 0 12 12" fill="none"><path d="M4 2L9 6L4 10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
    </a>
    <a href="/profil-desa#demografis" class="portal-card">
      <div class="p-badge">
        <svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="8" r="3.2"/><path d="M2.5 20c0-3.6 2.5-6.5 5.5-6.5s5.5 2.9 5.5 6.5"/><path d="M16 21c0-3 2-5.5 4.5-5.5"/><circle cx="18.5" cy="9" r="2.3"/></svg>
      </div>
      <h3>Data Kependudukan</h3>
      <p>Statistik jumlah penduduk, KK, usia, dan sarana-prasarana desa berdasarkan data monografi.</p>
      <div class="p-link">Lihat Data <svg viewBox="0 0 12 12" fill="none"><path d="M4 2L9 6L4 10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
    </a>
    <a href="/kegiatan" class="portal-card" onclick="return pindahHalus(event, '/kegiatan')">
      <div class="p-badge">
        <svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18M8 3v4M16 3v4"/></svg>
      </div>
      <h3>Event &amp; Kegiatan</h3>
      <p>Dokumentasi dan informasi kegiatan warga — gotong royong, posyandu, dan agenda desa lainnya.</p>
      <div class="p-link">Lihat Kegiatan <svg viewBox="0 0 12 12" fill="none"><path d="M4 2L9 6L4 10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
    </a>
  </div>

  <!-- ==================== TEMPLATE KARTU BERITA ==================== -->
  <div class="berita-section reveal">
    <div class="berita-head">
      <h2>Berita Desa Terkini</h2>
    </div>
    
    <div class="berita-grid">
      @forelse($beritas as $item)
      <div class="berita-card">
        <img src="{{ $item->foto ? asset('storage/'.$item->foto) : 'https://placehold.co/600x400/e2e8f0/94a3b8?text=Gambar+Berita' }}" alt="{{ $item->judul }}" class="berita-img" loading="lazy">
        <div class="berita-content">
          <span class="berita-badge">{{ $item->kategori }}</span>
          <h3 class="berita-title">{{ $item->judul }}</h3>
          <div class="berita-date">{{ date('d M Y', strtotime($item->tanggal)) }}</div>
          <p class="berita-excerpt">{{ Str::limit(strip_tags($item->isi), 120) }}</p>
          <a class="berita-link" onclick="bukaBerita(this)" 
             data-id="{{ $item->id }}"
             data-judul="{{ $item->judul }}"
             data-kategori="{{ $item->kategori }}"
             data-tanggal="{{ date('d M Y', strtotime($item->tanggal)) }}"
             data-foto="{{ $item->foto ? asset('storage/'.$item->foto) : 'https://placehold.co/900x480/e2e8f0/94a3b8?text=Gambar+Berita' }}"
             data-views="{{ $item->views }}">
            Baca Selengkapnya 
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
            <span class="berita-isi-full" style="display:none;">{{ $item->isi }}</span>
          </a>
        </div>
      </div>
      @empty
      <div class="empty-state" style="text-align: center; padding: 40px 20px; color: var(--teks-muted); font-size: 14px; background: #fff; border-radius: 12px; border: 1px dashed var(--border); grid-column: 1 / -1;">
        Belum ada berita desa terbaru yang dipublikasikan.
      </div>
      @endforelse
    </div>
  </div>

</main>

<!-- ==================== HALAMAN DETAIL BERITA ==================== -->
<div id="berita-detail-container">
  <!-- Tombol Kembali -->
  <a class="btn-kembali" onclick="tutupBerita()">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"></path><path d="M12 19l-7-7 7-7"></path></svg>
    Kembali ke Berita
  </a>

  <!-- Kartu Artikel Pembungkus -->
  <div class="berita-detail-card">
    <div class="bd-badge" id="detail-bd-badge">UMUM</div>
    
    <h1 class="bd-title" id="detail-bd-title">Judul Berita</h1>
    
    <div class="bd-meta">
      <span id="detail-bd-date">Dipublikasikan: -</span>
      <span>&bull;</span>
      <span id="detail-bd-views">Dilihat: 0x</span>
    </div>

    <!-- Gambar Artikel -->
    <img src="" alt="Gambar Detail Berita" class="bd-img" id="detail-bd-img">

    <!-- Isi Artikel -->
    <div class="bd-content" id="detail-bd-content">
      <!-- Paragraf isi berita dimasukkan secara dinamis -->
    </div>
  </div>
</div>

<!-- Modal Layanan (Tetap Sama) -->
<div class="modal-layanan-overlay" id="modal-layanan-overlay" onclick="tutupModalLayanan(event)">
  <div class="modal-layanan-box">
    <button class="modal-layanan-close" onclick="tutupModalLayanan()">✕</button>
    <h3>Layanan Administrasi Desa</h3>
    <div class="sub">Ketuk tiap jenis surat untuk lihat persyaratan lengkap</div>
    <div id="daftar-surat"></div>
  </div>
</div>

@include('partials.footer')

<script>
  // ================= LOGIKA BUKA/TUTUP HALAMAN BERITA =================
  function bukaBerita(link) {
    const id = link.getAttribute('data-id');
    const judul = link.getAttribute('data-judul');
    const kategori = link.getAttribute('data-kategori');
    const tanggal = link.getAttribute('data-tanggal');
    const foto = link.getAttribute('data-foto');
    const views = link.getAttribute('data-views');
    const isi = link.querySelector('.berita-isi-full').textContent;
    
    document.getElementById('detail-bd-badge').textContent = kategori;
    document.getElementById('detail-bd-title').textContent = judul;
    document.getElementById('detail-bd-date').textContent = `Dipublikasikan: ${tanggal}`;
    document.getElementById('detail-bd-views').textContent = `Dilihat: ${views}x`;
    document.getElementById('detail-bd-img').src = foto;
    document.getElementById('detail-bd-img').alt = judul;
    
    const contentDiv = document.getElementById('detail-bd-content');
    contentDiv.innerHTML = isi;
    
    // Kirim request AJAX (fetch) untuk menambah jumlah tayang secara asinkronus
    if (id) {
      fetch(`/berita/${id}/view`)
        .then(response => response.json())
        .then(data => {
          // Perbarui teks tayangan di halaman detail
          document.getElementById('detail-bd-views').textContent = `Dilihat: ${data.views}x`;
          // Perbarui nilai data-views pada kartu berita agar jika diklik ulang datanya sinkron
          link.setAttribute('data-views', data.views);
        })
        .catch(err => console.error('Gagal memperbarui jumlah tayangan:', err));
    }
    
    // Sembunyikan Halaman Utama (Hero + Main Konten)
    document.getElementById('hero-header').style.display = 'none';
    document.getElementById('main-content').style.display = 'none';
    
    // Munculkan Halaman Detail Berita
    document.getElementById('berita-detail-container').style.display = 'block';
    
    // Scroll otomatis ke posisi paling atas layar
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  function tutupBerita() {
    // Sembunyikan Halaman Detail Berita
    document.getElementById('berita-detail-container').style.display = 'none';
    
    // Munculkan kembali Halaman Utama
    document.getElementById('hero-header').style.display = 'block';
    document.getElementById('main-content').style.display = 'block';
    
    // Scroll sedikit ke bagian seksi berita agar user tahu mereka kembali
    document.querySelector('.berita-section').scrollIntoView({ behavior: 'smooth' });
  }

  // ================= MODAL LAYANAN (TETAP SAMA) =================
  const DATA_SURAT = [
    { nama: 'Surat Keterangan Domisili', syarat: ['Fotocopy KTP', 'Fotocopy KK', 'Pas foto 3x4 (2 lembar)', 'Surat pengantar RT/RW'], keterangan: 'Berlaku selama 6 bulan' },
    { nama: 'Surat Keterangan Usaha', syarat: ['Fotocopy KTP', 'Fotocopy KK', 'Pas foto 3x4 (2 lembar)', 'Surat keterangan usaha dari RT/RW'], keterangan: 'Untuk keperluan kredit atau izin usaha' },
    { nama: 'Surat Pengantar KTP', syarat: ['Fotocopy KK', 'Pas foto 4x6 (2 lembar)', 'Formulir permohonan'], keterangan: 'Untuk pembuatan KTP baru atau perpanjangan' },
    { nama: 'Surat Pengantar Kartu Keluarga', syarat: ['Fotocopy KTP kepala keluarga', 'Fotocopy KK lama (jika ada)', 'Akta kelahiran/nikah/cerai', 'Formulir permohonan'], keterangan: 'Untuk pembuatan KK baru atau perubahan' },
    { nama: 'Surat Keterangan Tidak Mampu', syarat: ['Fotocopy KK', 'Data sekolah'], keterangan: 'Untuk keringanan biaya sekolah & beasiswa' }
  ];

  function bukaModalLayanan(){
    const wadah = document.getElementById('daftar-surat');
    wadah.innerHTML = '';
    DATA_SURAT.forEach(surat => {
      const detail = document.createElement('details'); detail.className = 'surat-item';
      const summary = document.createElement('summary'); summary.textContent = surat.nama; detail.appendChild(summary);
      const isi = document.createElement('div'); isi.className = 'isi-surat';
      const labelSyarat = document.createElement('span'); labelSyarat.className = 'label-kecil'; labelSyarat.textContent = 'Persyaratan'; isi.appendChild(labelSyarat);
      const ul = document.createElement('ul');
      surat.syarat.forEach(s => { const li = document.createElement('li'); li.textContent = s; ul.appendChild(li); });
      isi.appendChild(ul);
      const ket = document.createElement('div'); ket.className = 'ket'; ket.textContent = '📌 ' + surat.keterangan; isi.appendChild(ket);
      detail.appendChild(isi); wadah.appendChild(detail);
    });
    document.getElementById('modal-layanan-overlay').classList.add('show');
  }

  function tutupModalLayanan(event){
    if (event && event.target !== event.currentTarget && !event.target.classList.contains('modal-layanan-close')) return;
    document.getElementById('modal-layanan-overlay').classList.remove('show');
  }

  // ================= SLIDER & ANIMASI (TETAP SAMA) =================
  (function(){
    const container = document.getElementById('hero-slides');
    if (!container) return;
    const slides = Array.from(container.querySelectorAll('.hero-slide'));
    let indexAktif = 0;
    slides.forEach(slide => {
      const src = slide.dataset.src; if (!src) return;
      const img = new Image(); img.onload = () => { slide.style.backgroundImage = `url('${src}')`; }; img.src = src;
    });
    function tampilkanSlide(i){ slides[indexAktif].classList.remove('aktif'); indexAktif = i; slides[indexAktif].classList.add('aktif'); }
    if (slides.length > 1) { setInterval(() => { tampilkanSlide((indexAktif + 1) % slides.length); }, 5000); }
  })();

  (function(){
    const elemenReveal = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting){ entry.target.classList.add('tampak'); observer.unobserve(entry.target); }
      });
    }, { threshold: 0.15 });
    elemenReveal.forEach(el => observer.observe(el));
  })();

  (function(){
    const wadah = document.getElementById('hero-partikel');
    if (!wadah) return;
    for (let i = 0; i < 14; i++){
      const p = document.createElement('div'); p.className = 'partikel';
      const ukuran = Math.random() * 10 + 10;
      p.style.width = ukuran + 'px'; p.style.height = (ukuran * 0.7) + 'px';
      p.style.left = Math.random() * 100 + '%';
      p.style.setProperty('--geser', (Math.random() * 80 - 40) + 'px');
      p.style.setProperty('--putar', (Math.random() * 360 + 180) + 'deg');
      p.style.animationDuration = (Math.random() * 8 + 12) + 's'; p.style.animationDelay = (Math.random() * 12) + 's';
      wadah.appendChild(p);
    }
  })();

  function pindahHalus(event, url){
    event.preventDefault(); document.body.style.transition = 'opacity .25s ease, transform .25s ease';
    document.body.style.opacity = '0'; document.body.style.transform = 'translateY(-6px)';
    setTimeout(() => { window.location.href = url; }, 220); return false;
  }
</script>
</body>
</html>