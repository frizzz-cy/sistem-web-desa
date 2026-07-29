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
  }
  *{box-sizing:border-box; margin:0; padding:0;}
  html{scroll-behavior:smooth;}
  body{font-family:'Plus Jakarta Sans',sans-serif; background:var(--bg); color:var(--teks); line-height:1.5;}
  img{max-width:100%; display:block;}
  a{color:inherit; text-decoration:none;}

  /* ============ TOP BAR ============ */
  .topbar{
    background:var(--biru-tua); color:#C9DCEA; font-size:11.5px;
    padding:7px 20px; display:flex; justify-content:space-between; align-items:center;
    flex-wrap:wrap; gap:6px;
  }
  .topbar .breadcrumb span{opacity:.75;}
  .topbar .kontak{display:flex; gap:16px;}
  .topbar .kontak span{display:flex; align-items:center; gap:5px;}

  /* ============ NAVBAR ============ */
  .navbar{
    background:var(--putih); border-bottom:1px solid var(--border);
    position:sticky; top:0; z-index:100; box-shadow:0 1px 3px rgba(11,59,96,0.06);
  }
  .navbar-inner{
    max-width:1200px; margin:0 auto; padding:12px 20px;
    display:flex; align-items:center; justify-content:space-between; gap:16px;
  }
  .brand{display:flex; align-items:center; gap:12px;}
  .brand-logo{
    width:46px; height:46px; border-radius:50%; background:var(--biru-tua);
    display:flex; align-items:center; justify-content:center; flex-shrink:0;
    color:var(--emas); font-size:20px; font-weight:800; border:2px solid var(--emas);
  }
  .brand-text .b-title{font-size:15px; font-weight:800; color:var(--biru-tua); line-height:1.2;}
  .brand-text .b-sub{font-size:10.5px; color:var(--teks-muted); text-transform:uppercase; letter-spacing:.04em; margin-top:2px;}

  .menu{display:flex; gap:4px; align-items:center;}
  .menu a{
    font-size:13.5px; font-weight:600; color:var(--teks); padding:10px 16px;
    border-radius:6px; transition:background .15s ease, color .15s ease;
  }
  .menu a:hover{background:var(--biru-muda); color:var(--biru-tua);}
  .menu a.active{background:var(--biru-tua); color:#fff;}

  .menu-toggle{
    display:none; background:none; border:none; cursor:pointer; padding:6px;
    flex-direction:column; gap:4px;
  }
  .menu-toggle span{width:22px; height:2.5px; background:var(--biru-tua); border-radius:2px;}

  @media (max-width:860px){
    .menu{
      display:none; position:absolute; top:100%; left:0; right:0; background:var(--putih);
      flex-direction:column; padding:10px 20px 16px; border-bottom:1px solid var(--border);
      box-shadow:0 8px 16px rgba(11,59,96,0.08);
    }
    .menu.buka{display:flex;}
    .menu a{width:100%; padding:12px 14px;}
    .menu-toggle{display:flex;}
  }

  /* ============ HERO ============ */
  .hero{
    position:relative; background:linear-gradient(135deg, var(--biru-tua) 0%, #08283F 100%);
    color:#fff; padding:64px 20px 90px; text-align:center; overflow:hidden;
  }
  .hero::before{
    content:''; position:absolute; inset:0; opacity:.08;
    background-image:
      linear-gradient(90deg, #fff 1px, transparent 1px),
      linear-gradient(0deg, #fff 1px, transparent 1px);
    background-size:44px 44px;
  }
  .hero-inner{position:relative; z-index:1; max-width:760px; margin:0 auto;}
  .hero-badge{
    display:inline-block; background:rgba(212,160,23,0.18); border:1px solid rgba(212,160,23,0.5);
    color:var(--emas); font-size:11.5px; font-weight:700; letter-spacing:.06em; text-transform:uppercase;
    padding:6px 16px; border-radius:20px; margin-bottom:20px;
  }
  .hero h1{font-size:clamp(28px,5.5vw,44px); font-weight:800; line-height:1.2;}
  .hero p{font-size:clamp(13.5px,2vw,15px); color:#C9DCEA; margin-top:14px; max-width:540px; margin-left:auto; margin-right:auto; line-height:1.65;}
  .hero-cta{display:flex; gap:12px; justify-content:center; flex-wrap:wrap; margin-top:30px;}
  .hero-cta a{
    font-size:13.5px; font-weight:700; padding:13px 26px; border-radius:8px;
    transition:transform .15s ease, box-shadow .15s ease;
  }
  .hero-cta a:hover{transform:translateY(-2px);}
  .btn-utama{background:var(--emas); color:var(--biru-tua); box-shadow:0 6px 16px rgba(212,160,23,0.35);}
  .btn-luar{background:rgba(255,255,255,0.08); color:#fff; border:1.5px solid rgba(255,255,255,0.35);}

  /* ============ STAT CARDS ============ */
  .stat-strip{
    max-width:980px; margin:-52px auto 0; position:relative; z-index:2;
    display:grid; grid-template-columns:repeat(2,1fr); gap:14px; padding:0 20px;
  }
  @media (min-width:700px){ .stat-strip{grid-template-columns:repeat(4,1fr);} }
  .stat-card{
    background:var(--putih); border-radius:12px; padding:22px 16px; text-align:center;
    box-shadow:0 10px 28px rgba(11,59,96,0.12); border:1px solid var(--border);
  }
  .stat-card .s-icon{font-size:22px; margin-bottom:8px;}
  .stat-card .s-val{font-size:20px; font-weight:800; color:var(--biru-tua);}
  .stat-card .s-lbl{font-size:10.5px; color:var(--teks-muted); text-transform:uppercase; letter-spacing:.05em; margin-top:3px; font-weight:600;}

  /* ============ SECTION UMUM ============ */
  main{max-width:1180px; margin:0 auto; padding:70px 20px 20px;}
  .sect-head{text-align:center; margin-bottom:34px;}
  .sect-head .eyebrow{
    font-size:12px; font-weight:700; letter-spacing:.08em; text-transform:uppercase; color:var(--merah);
    margin-bottom:8px;
  }
  .sect-head h2{font-size:clamp(21px,4vw,28px); font-weight:800; color:var(--biru-tua);}
  .sect-head .desc{font-size:13.5px; color:var(--teks-muted); margin-top:8px; max-width:480px; margin-left:auto; margin-right:auto;}

  /* ============ PORTAL CARDS ============ */
  .portal-grid{display:grid; grid-template-columns:1fr; gap:18px; margin-bottom:64px;}
  @media (min-width:640px){ .portal-grid{grid-template-columns:repeat(2,1fr);} }
  @media (min-width:960px){ .portal-grid{grid-template-columns:repeat(3,1fr);} }
  .portal-card{
    background:var(--putih); border:1px solid var(--border); border-radius:12px;
    padding:26px 22px; transition:transform .2s ease, box-shadow .2s ease, border-color .2s ease;
  }
  .portal-card:hover{transform:translateY(-4px); box-shadow:0 16px 32px rgba(11,59,96,0.12); border-color:var(--biru);}
  .portal-card .p-badge{
    width:52px; height:52px; border-radius:10px; background:var(--biru-muda);
    display:flex; align-items:center; justify-content:center; font-size:24px; margin-bottom:16px;
  }
  .portal-card h3{font-size:16.5px; font-weight:800; color:var(--biru-tua); margin-bottom:8px;}
  .portal-card p{font-size:12.5px; color:var(--teks-muted); line-height:1.6;}
  .portal-card .p-link{
    margin-top:16px; font-size:12px; font-weight:700; color:var(--merah);
    display:flex; align-items:center; gap:5px;
  }
  .portal-card .p-link svg{width:11px; height:11px; transition:transform .15s ease;}
  .portal-card:hover .p-link svg{transform:translateX(3px);}

  /* ============ BERITA ============ */
  .berita-grid{display:grid; grid-template-columns:1fr; gap:18px;}
  @media (min-width:640px){ .berita-grid{grid-template-columns:repeat(3,1fr);} }
  .berita-card{background:var(--putih); border:1px solid var(--border); border-radius:12px; overflow:hidden;}
  .berita-thumb{
    aspect-ratio:16/10; background:var(--biru-muda); display:flex; align-items:center; justify-content:center;
    color:var(--biru); font-size:11px; font-weight:600;
  }
  .berita-body{padding:16px 18px 18px;}
  .berita-tag{font-size:10px; font-weight:700; color:var(--merah); text-transform:uppercase; letter-spacing:.05em;}
  .berita-body h4{font-size:14px; font-weight:700; margin-top:6px; line-height:1.4; color:var(--teks);}
  .berita-body p{font-size:12px; color:var(--teks-muted); margin-top:6px; line-height:1.5;}
  .berita-note{
    text-align:center; font-size:12.5px; color:var(--teks-muted); font-style:italic;
    margin-top:22px; padding:14px; background:var(--biru-muda); border-radius:8px;
  }

  /* ============ FOOTER ============ */
  footer{background:var(--biru-tua); color:#C9DCEA; margin-top:60px;}
  .footer-inner{
    max-width:1180px; margin:0 auto; padding:48px 20px 24px;
    display:grid; grid-template-columns:1fr; gap:32px;
  }
  @media (min-width:700px){ .footer-inner{grid-template-columns:1.4fr 1fr 1fr;} }
  .footer-col h4{color:#fff; font-size:14px; font-weight:700; margin-bottom:14px;}
  .footer-col p, .footer-col a{font-size:12.5px; color:#A8C0D6; line-height:1.8; display:block;}
  .footer-col a:hover{color:#fff;}
  .footer-bottom{
    border-top:1px solid rgba(255,255,255,0.12); text-align:center; padding:18px 20px;
    font-size:11.5px; color:#8FAAC2;
  }
</style>
</head>
<body>

<div class="topbar">
  <div class="breadcrumb"><span>Kabupaten Jombang</span> › <span>Kecamatan Kabuh</span> › <strong>Desa Munungkerep</strong></div>
  <div class="kontak"><span>📍 Jombang, Jawa Timur</span></div>
</div>

<nav class="navbar">
  <div class="navbar-inner">
    <a href="/" class="brand">
      <div class="brand-logo">M</div>
      <div class="brand-text">
        <div class="b-title">Desa Munungkerep</div>
        <div class="b-sub">Sistem Informasi Desa</div>
      </div>
    </a>
    <button class="menu-toggle" onclick="document.getElementById('menu').classList.toggle('buka')">
      <span></span><span></span><span></span>
    </button>
    <div class="menu" id="menu">
      <a href="/" class="active">Beranda</a>
      <a href="/peta">Peta &amp; Potensi</a>
      <a href="/profil-desa" onclick="return pindahHalus(event, '/profil-desa')">Profil Desa</a>
    </div>
  </div>
</nav>

<header class="hero">
  <div class="hero-inner">
    <div class="hero-badge">Portal Resmi Pemerintah Desa</div>
    <h1>Desa Munungkerep</h1>
    <p>Kecamatan Kabuh, Kabupaten Jombang, Jawa Timur — melayani informasi profil, peta wilayah, dan potensi desa secara terbuka untuk seluruh warga dan masyarakat umum.</p>
    <div class="hero-cta">
      <a href="/peta" class="btn-utama">Lihat Peta Desa</a>
      <a href="/profil-desa" class="btn-luar">Profil Desa</a>
    </div>
  </div>
</header>

<div class="stat-strip">
  <div class="stat-card"><div class="s-icon">👥</div><div class="s-val">2.120</div><div class="s-lbl">Penduduk</div></div>
  <div class="stat-card"><div class="s-icon">🏘️</div><div class="s-val">7</div><div class="s-lbl">Dusun</div></div>
  <div class="stat-card"><div class="s-icon">👔</div><div class="s-val">Sutrismi</div><div class="s-lbl">Kepala Desa</div></div>
  <div class="stat-card"><div class="s-icon">💰</div><div class="s-val">Rp 1,66 M</div><div class="s-lbl">APBDes 2026</div></div>
</div>

<main>

  <div class="sect-head">
    <div class="eyebrow">Layanan Informasi</div>
    <h2>Jelajahi Desa Munungkerep</h2>
    <p class="desc">Akses cepat ke seluruh informasi resmi Desa Munungkerep</p>
  </div>

  <div class="portal-grid">
    <a href="/peta" class="portal-card">
      <div class="p-badge">🗺️</div>
      <h3>Peta &amp; Potensi Desa</h3>
      <p>Peta interaktif wilayah dusun, sarana desa, dan lokasi potensi ekonomi — tembakau, pandan, dan UMKM lokal.</p>
      <div class="p-link">Buka Peta <svg viewBox="0 0 12 12" fill="none"><path d="M4 2L9 6L4 10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
    </a>
    <a href="/profil-desa" class="portal-card">
      <div class="p-badge">🏛️</div>
      <h3>Profil Desa</h3>
      <p>Struktur organisasi pemerintah desa, anggaran APBDes, kondisi geografis, data demografis, hingga visi &amp; misi.</p>
      <div class="p-link">Lihat Profil <svg viewBox="0 0 12 12" fill="none"><path d="M4 2L9 6L4 10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
    </a>
    <a href="/profil-desa#pemerintahan" class="portal-card">
      <div class="p-badge">👥</div>
      <h3>Struktur Pemerintahan</h3>
      <p>Kenali Kepala Desa, perangkat desa, dan Kepala Dusun yang melayani warga Munungkerep.</p>
      <div class="p-link">Lihat Struktur <svg viewBox="0 0 12 12" fill="none"><path d="M4 2L9 6L4 10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
    </a>
  </div>

  <div class="sect-head">
    <div class="eyebrow">Kabar Desa</div>
    <h2>Berita &amp; Kegiatan Terbaru</h2>
  </div>

  <div class="berita-grid">
    <div class="berita-card">
      <div class="berita-thumb">Foto menyusul</div>
      <div class="berita-body">
        <div class="berita-tag">Segera Hadir</div>
        <h4>Kegiatan &amp; berita desa akan tampil di sini</h4>
        <p>Bagian ini menyusul diisi oleh perangkat desa atau Tim KKN.</p>
      </div>
    </div>
    <div class="berita-card">
      <div class="berita-thumb">Foto menyusul</div>
      <div class="berita-body">
        <div class="berita-tag">Segera Hadir</div>
        <h4>Dokumentasi kegiatan warga</h4>
        <p>Update kegiatan gotong royong, posyandu, dan agenda desa lainnya.</p>
      </div>
    </div>
    <div class="berita-card">
      <div class="berita-thumb">Foto menyusul</div>
      <div class="berita-body">
        <div class="berita-tag">Segera Hadir</div>
        <h4>Pengumuman resmi desa</h4>
        <p>Informasi resmi dari kantor desa akan diperbarui secara berkala.</p>
      </div>
    </div>
  </div>
  <div class="berita-note">📝 Bagian berita ini masih placeholder — siap diisi begitu ada foto/teks kegiatan dari perangkat desa.</div>

</main>

<footer>
  <div class="footer-inner">
    <div class="footer-col">
      <h4>Desa Munungkerep</h4>
      <p>Kecamatan Kabuh, Kabupaten Jombang, Jawa Timur 61455. Portal resmi Sistem Informasi Desa untuk transparansi dan pelayanan publik.</p>
    </div>
    <div class="footer-col">
      <h4>Tautan Cepat</h4>
      <a href="/">Beranda</a>
      <a href="/peta">Peta &amp; Potensi</a>
      <a href="/profil-desa">Profil Desa</a>
    </div>
    <div class="footer-col">
      <h4>Kontak</h4>
      <p>Kantor Desa Munungkerep<br>Kec. Kabuh, Kab. Jombang</p>
    </div>
  </div>
  <div class="footer-bottom">© 2026 Pemerintah Desa Munungkerep — Disusun oleh Tim KKN 2026</div>
</footer>

<script>
  function pindahHalus(event, url){
    event.preventDefault();
    document.body.style.transition = 'opacity .25s ease, transform .25s ease';
    document.body.style.opacity = '0';
    document.body.style.transform = 'translateY(-6px)';
    setTimeout(() => { window.location.href = url; }, 220);
    return false;
  }
</script>
</body>
</html>