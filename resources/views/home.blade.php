<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Peta interaktif dan potensi ekonomi Desa Munungkerep, Kecamatan Kabuh, Kabupaten Jombang — disusun oleh Tim KKN 2026.">
<title>Peta & Potensi Desa Munungkerep</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<style>
  :root{
    --ground:#0B3B60;
    --paper:#F4F6F8;
    --paper-2:#FFFFFF;
    --moss:#52633B;
    --moss-dark:#3E4A2C;
    --clay:#C62828;
    --gold:#D4A017;
    --ink-soft:#5B6B7A;
    --line:#DDE3E8;
  }
  *{box-sizing:border-box; margin:0; padding:0;}
  html{ scroll-behavior:smooth; }
  body{font-family:'Plus Jakarta Sans',sans-serif; background:var(--paper); color:var(--ground); animation:fadeInPage .35s ease;}
  @keyframes fadeInPage{ from{opacity:0; transform:translateY(6px);} to{opacity:1; transform:translateY(0);} }
  h1,h2,h3{font-family:'Plus Jakarta Sans',sans-serif; font-weight:800;}
  .mono{font-family:'Plus Jakarta Sans',sans-serif;}

  header{
    position:relative; overflow:hidden;
    background:var(--ground); color:var(--paper);
    padding:34px 20px 28px;
  }
  header::before{
    content:"";
    position:absolute; inset:0;
    opacity:0.16;
    background-image:
      repeating-radial-gradient(ellipse 140% 90% at 15% 120%,
        transparent 0, transparent 22px,
        var(--gold) 22px, var(--gold) 23px,
        transparent 23px, transparent 46px);
    pointer-events:none;
  }
  .header-inner{position:relative; z-index:1; max-width:920px; margin:0 auto; text-align:center;}
  .eyebrow{
    display:inline-flex; align-items:center; gap:8px;
    font-family:'Plus Jakarta Sans',sans-serif; font-size:11px; font-weight:600;
    letter-spacing:.14em; text-transform:uppercase; color:var(--gold);
    margin-bottom:14px;
  }
  .eyebrow::before, .eyebrow::after{content:"—"; opacity:.6;}
  header h1{
    font-size:clamp(24px, 5vw, 38px); font-weight:600; line-height:1.15;
    letter-spacing:-.01em;
  }
  header .lokasi{
    font-size:13.5px; color:#C9C2AC; margin-top:10px;
    font-style:italic; font-family:'Plus Jakarta Sans',sans-serif; font-weight:800;
  }
  header .intro{
    font-size:13.5px; color:#D9D3BF; max-width:520px; margin:16px auto 0;
    line-height:1.6;
  }

  .stats-strip{
    display:flex; flex-wrap:wrap; justify-content:center; gap:0;
    max-width:920px; margin:26px auto 0;
    border-top:1px solid rgba(246,242,231,0.15);
  }
  .stat-item{
    flex:1; min-width:110px; text-align:center;
    padding:16px 12px 4px;
    border-right:1px solid rgba(246,242,231,0.15);
  }
  .stat-item:last-child{border-right:none;}
  .stat-num{
    font-family:'Plus Jakarta Sans',sans-serif; font-size:22px; font-weight:600; color:var(--gold);
  }
  .stat-label{
    font-size:10.5px; color:#B8B098; text-transform:uppercase; letter-spacing:.07em;
    margin-top:3px;
  }

  .main-layout{display:grid; grid-template-columns:1fr; background:var(--paper-2);}
  @media (min-width:900px){ .main-layout{grid-template-columns:3fr 1fr;} }

  .map-wrap{position:relative; border-top:4px solid var(--gold);}
  #map{height:58vh; min-height:360px; width:100%; background:var(--line);}
  @media (min-width:900px){ #map{height:76vh; min-height:520px;} }

  .map-loading{
    position:absolute; top:14px; left:14px; z-index:950;
    background:var(--ground); color:var(--paper);
    font-family:'Plus Jakarta Sans',sans-serif; font-size:11.5px; font-weight:500;
    padding:8px 14px; border-radius:3px; max-width:calc(100% - 28px);
    transition:opacity .3s ease;
  }
  .map-loading.hidden{opacity:0; pointer-events:none;}
  .map-loading.error{background:#7A2E20;}

  .basemap-switcher{
    position:absolute; top:14px; right:14px; z-index:950;
    display:flex; background:var(--paper-2);
    border-radius:8px; overflow:hidden;
    box-shadow:0 6px 18px rgba(46,42,31,0.22);
  }
  .basemap-btn{
    border:none; background:none; cursor:pointer;
    font-family:'Plus Jakarta Sans',sans-serif; font-size:11px; font-weight:600;
    letter-spacing:.03em; color:var(--ink-soft);
    padding:9px 13px; -webkit-appearance:none; appearance:none;
    border-right:1px solid var(--line);
    transition:background .15s ease, color .15s ease;
  }
  .basemap-btn:last-child{border-right:none;}
  .basemap-btn:hover{background:var(--paper);}
  .basemap-btn.active{background:var(--ground); color:var(--gold);}
  .basemap-btn:focus-visible{outline:2px solid var(--clay); outline-offset:-2px;}

  .legenda-panel{
    background:var(--paper-2); border-left:1px solid var(--line); padding:18px;
  }
  .legenda-panel h2{
    font-family:'Plus Jakarta Sans',sans-serif; font-size:11px; font-weight:600;
    text-transform:uppercase; letter-spacing:.1em; margin-bottom:14px; color:var(--ink-soft);
  }

  .filter-chip{
    display:flex; align-items:center; gap:10px; width:100%;
    background:none; border:none; cursor:pointer;
    font-family:'Plus Jakarta Sans',sans-serif; font-weight:600; font-size:13.5px;
    color:var(--ground); padding:10px 8px; text-align:left;
    margin-bottom:1px; -webkit-appearance:none; appearance:none;
    border-bottom:1px solid var(--line);
  }
  .filter-chip:last-child{border-bottom:none;}
  .filter-chip.off{opacity:0.3;}
  .filter-chip:hover{background:var(--paper);}
  .filter-chip:focus-visible{outline:2px solid var(--clay); outline-offset:-2px;}
  .dot{width:10px; height:10px; border-radius:50%; flex-shrink:0;}
  .dot.area{border-radius:2px; background:rgba(234,67,53,0.12); border:2px dashed #EA4335;}

  @media (max-width:899px){
    .legenda-panel{
      border-left:none; border-top:1px solid var(--line);
      display:flex; overflow-x:auto; gap:2px; padding:12px;
    }
    .legenda-panel h2{display:none;}
    .filter-chip{width:auto; white-space:nowrap; flex-shrink:0; border-bottom:none; border-right:1px solid var(--line);}
  }

  .leaflet-popup-content-wrapper{border-radius:6px; font-family:'Plus Jakarta Sans',sans-serif;}
  .leaflet-popup-content b{font-family:'Plus Jakarta Sans',sans-serif; font-weight:800; font-size:15px; color:var(--ground);}
  .leaflet-popup-content .kategori-label{
    display:inline-block; font-family:'Plus Jakarta Sans',sans-serif; font-size:10px; font-weight:600;
    text-transform:uppercase; letter-spacing:.05em; color:#fff; padding:2px 8px; border-radius:3px; margin:5px 0;
  }

  .potensi-section{max-width:640px; margin:0 auto; padding:52px 20px 60px;}
  .potensi-header{text-align:center; margin-bottom:30px;}
  .potensi-header .eyebrow-2{
    font-family:'Plus Jakarta Sans',sans-serif; font-size:11px; font-weight:600;
    letter-spacing:.12em; text-transform:uppercase; color:var(--clay); margin-bottom:8px;
  }
  .potensi-header h2{font-size:clamp(20px,4vw,26px); font-weight:600;}
  .potensi-header p{color:var(--ink-soft); font-size:13.5px; margin-top:8px;}

  .potensi-grid{display:grid; grid-template-columns:1fr; gap:18px;}
  @media (min-width:520px){ .potensi-grid{grid-template-columns:1fr 1fr;} }

  .potensi-card-wrap{ position:relative; }

  .potensi-card{
    background:var(--paper-2); border:1px solid var(--line); overflow:hidden;
    border:none; text-align:left; cursor:pointer; width:100%; padding:0;
    font-family:'Plus Jakarta Sans',sans-serif; transition:transform .18s ease, box-shadow .18s ease;
    -webkit-appearance:none; appearance:none; position:relative;
  }
  .potensi-card::before{
    content:""; position:absolute; top:0; left:0; width:4px; height:100%;
    background:var(--moss); transform:scaleY(0); transform-origin:top;
    transition:transform .2s ease;
  }
  .potensi-card:hover{box-shadow:0 4px 12px rgba(46,42,31,0.08);}
  .potensi-card:hover::before{transform:scaleY(1);}
  .potensi-card:focus-visible{outline:2px solid var(--clay); outline-offset:2px;}
  .potensi-card .foto{
    width:100%; aspect-ratio:16/10; background:var(--line); position:relative;
    display:flex; align-items:center; justify-content:center;
    color:var(--ink-soft); font-family:'Plus Jakarta Sans',sans-serif; font-size:11px; font-weight:500;
  }
  .potensi-card .foto img{width:100%; height:100%; object-fit:cover;}
  .potensi-card .info{padding:16px 18px 18px;}
  .potensi-card .info .tag{
    font-family:'Plus Jakarta Sans',sans-serif; font-size:10px; font-weight:600;
    letter-spacing:.08em; text-transform:uppercase; color:var(--moss); display:block; margin-bottom:6px;
  }
  .potensi-card .info h3{font-size:17px; font-weight:600; margin-bottom:6px;}
  .klik-hint{color:var(--clay); font-weight:600; font-size:12px; display:flex; align-items:center; gap:5px;}
  .klik-hint svg{width:12px; height:12px; transition:transform .15s ease;}
  .potensi-card:hover .klik-hint svg{transform:translateX(3px);}

  .hover-preview{
    position:absolute;
    bottom:calc(100% + 12px);
    left:50%;
    transform:translateX(-50%) translateY(6px);
    width:240px;
    background:var(--ground);
    color:var(--paper);
    padding:13px 15px;
    border-radius:6px;
    font-size:12.5px; line-height:1.55; font-weight:500;
    box-shadow:0 14px 28px rgba(0,0,0,0.25);
    opacity:0; pointer-events:none;
    transition:opacity .18s ease, transform .18s ease;
    z-index:50;
  }
  .hover-preview::after{
    content:"";
    position:absolute; top:100%; left:50%; transform:translateX(-50%);
    border:7px solid transparent;
    border-top-color:var(--ground);
  }
  @media (hover:hover){
    .potensi-card-wrap:hover .hover-preview{ opacity:1; transform:translateX(-50%) translateY(0); }
  }

  .modal-overlay{
    display:none; position:fixed; inset:0; z-index:2000;
    background:rgba(46,42,31,0.78);
    align-items:center; justify-content:center; padding:20px;
  }
  .modal-overlay.show{display:flex;}
  .modal-box{
    background:var(--paper-2); border-radius:5px; max-width:440px; width:100%;
    padding:0 0 22px; position:relative; max-height:85vh; overflow-y:auto;
  }
  .modal-close{
    position:absolute; top:14px; right:14px; z-index:10;
    background:var(--ground); color:var(--paper); border:none;
    width:30px; height:30px; border-radius:50%; cursor:pointer; font-size:14px;
  }
  .modal-galeri{
    width:100%; aspect-ratio:16/9; background:var(--line);
    display:flex; overflow-x:auto; scroll-snap-type:x mandatory;
    -webkit-overflow-scrolling:touch; scrollbar-width:none;
  }
  .modal-galeri::-webkit-scrollbar{display:none;}
  .modal-galeri .slide{
    flex:0 0 100%; scroll-snap-align:start; position:relative;
    display:flex; align-items:center; justify-content:center;
  }
  .modal-galeri .slide img{width:100%; height:100%; object-fit:cover;}
  .modal-galeri .slide.kosong{
    color:var(--ink-soft); font-family:'Plus Jakarta Sans',sans-serif; font-size:12px;
  }
  .galeri-wrap{position:relative;}
  .galeri-dots{
    position:absolute; bottom:10px; left:0; right:0; z-index:5;
    display:flex; justify-content:center; gap:6px;
  }
  .galeri-dots .dot-nav{
    width:6px; height:6px; border-radius:50%; background:rgba(255,255,255,0.55);
    transition:background .15s ease, transform .15s ease; cursor:pointer;
  }
  .galeri-dots .dot-nav.aktif{background:#fff; transform:scale(1.3);}
  .galeri-panah{
    position:absolute; top:50%; transform:translateY(-50%); z-index:5;
    background:rgba(46,42,31,0.55); color:#fff; border:none; width:30px; height:30px;
    border-radius:50%; cursor:pointer; font-size:14px; display:flex; align-items:center; justify-content:center;
  }
  .galeri-panah.kiri{left:8px;}
  .galeri-panah.kanan{right:8px;}
  .modal-box .tag{
    display:block; font-family:'Plus Jakarta Sans',sans-serif; font-size:10.5px; font-weight:600;
    letter-spacing:.08em; text-transform:uppercase; color:var(--moss);
    padding:18px 22px 0;
  }
  .modal-box h3{padding:5px 22px 0; font-size:20px; font-weight:600;}
  .modal-box p{padding:10px 22px 0; font-size:13.5px; color:#4A4638; line-height:1.65;}
  .modal-box p.isi-nanti{color:var(--clay); font-style:italic; font-size:11.5px; font-family:'Plus Jakarta Sans',sans-serif;}

  /* ================= SEJARAH SINGKAT ================= */
  .sejarah-section{
    max-width:680px; margin:0 auto; padding:8px 20px 56px;
    border-top:1px solid var(--line);
  }
  .sejarah-header{text-align:center; margin:44px 0 26px;}
  .sejarah-header .eyebrow-2{
    font-family:'Plus Jakarta Sans',sans-serif; font-size:11px; font-weight:600;
    letter-spacing:.12em; text-transform:uppercase; color:var(--clay); margin-bottom:8px;
  }
  .sejarah-header h2{font-size:clamp(20px,4vw,26px); font-weight:600;}
  .sejarah-body p{
    font-size:14px; line-height:1.75; color:#4A4638; margin-bottom:16px;
  }
  .sejarah-body p:first-of-type{
    font-family:'Plus Jakarta Sans',sans-serif; font-weight:800; font-size:15.5px; font-style:italic; color:var(--ground);
  }
  .sejarah-sumber{
    margin-top:22px; padding-top:16px; border-top:1px dashed var(--line);
    font-size:12px; color:var(--ink-soft); font-style:italic;
  }

  footer{
    text-align:center; padding:22px; font-size:11.5px; color:var(--ink-soft);
    border-top:1px solid var(--line); background:var(--paper);
  }
  footer .sumber{display:block; margin-top:4px; color:#9C9480; font-family:'Plus Jakarta Sans',sans-serif; font-size:10.5px;}

  .topbar{
    background:#08283F; color:#C9DCEA; font-size:11px;
    padding:6px 20px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:6px;
  }
  .topbar .breadcrumb span{opacity:.75;}

  .navbar{
    background:var(--paper-2); border-bottom:1px solid var(--line);
    position:sticky; top:0; z-index:960; box-shadow:0 1px 3px rgba(11,59,96,0.06);
  }
  .navbar-inner{
    max-width:1200px; margin:0 auto; padding:10px 20px;
    display:flex; align-items:center; justify-content:space-between; gap:16px;
  }
  .brand{display:flex; align-items:center; gap:10px; text-decoration:none; color:inherit;}
  .brand-logo{
    width:38px; height:38px; border-radius:50%; background:var(--ground);
    display:flex; align-items:center; justify-content:center; flex-shrink:0;
    color:var(--gold); font-size:16px; font-weight:800; border:2px solid var(--gold);
  }
  .brand-text .b-title{font-size:13.5px; font-weight:800; color:var(--ground); line-height:1.2;}
  .brand-text .b-sub{font-size:9.5px; color:var(--ink-soft); text-transform:uppercase; letter-spacing:.04em; margin-top:2px;}

  .menu{display:flex; gap:4px; align-items:center;}
  .menu a{
    font-size:13px; font-weight:600; color:var(--ground); padding:9px 14px;
    border-radius:6px; text-decoration:none; transition:background .15s ease, color .15s ease;
  }
  .menu a:hover{background:#E8F1F8; color:var(--ground);}
  .menu a.active{background:var(--ground); color:#fff;}
  .menu-toggle{display:none; background:none; border:none; cursor:pointer; padding:6px; flex-direction:column; gap:4px;}
  .menu-toggle span{width:20px; height:2.5px; background:var(--ground); border-radius:2px;}
  @media (max-width:860px){
    .menu{
      display:none; position:absolute; top:100%; left:0; right:0; background:var(--paper-2);
      flex-direction:column; padding:8px 20px 14px; border-bottom:1px solid var(--line);
      box-shadow:0 8px 16px rgba(11,59,96,0.08);
    }
    .menu.buka{display:flex;}
    .menu a{width:100%; padding:11px 12px;}
    .menu-toggle{display:flex;}
  }
</style>
</head>
<body>

<div class="topbar">
  <div class="breadcrumb"><span>Kabupaten Jombang</span> › <span>Kecamatan Kabuh</span> › <strong>Desa Munungkerep</strong></div>
</div>

<nav class="navbar">
  <div class="navbar-inner">
    <a href="/" class="brand" onclick="return pindahHalus(event, '/')">
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
      <a href="/" onclick="return pindahHalus(event, '/')">Beranda</a>
      <a href="/peta" class="active">Peta &amp; Potensi</a>
      <a href="/profil-desa" onclick="return pindahHalus(event, '/profil-desa')">Profil Desa</a>
    </div>
  </div>
</nav>

<header>
  <div class="header-inner">
    <div class="eyebrow">Peta Administrasi &amp; Potensi Desa</div>
    <h1>Desa Munungkerep</h1>
    <p class="lokasi">Kecamatan Kabuh, Kabupaten Jombang — dataran tinggi Jawa Timur</p>
    <p class="intro">Peta ini memuat sarana desa, titik ibadah, dan potensi ekonomi warga, dihimpun langsung dari survei lapangan Tim KKN 2026. Ketuk titik pada peta atau kartu di bawah untuk detail lengkap.</p>
  </div>
  <div class="stats-strip" id="stats-strip">
    <div class="stat-item"><div class="stat-num" id="stat-total">–</div><div class="stat-label">Titik Terdata</div></div>
    <div class="stat-item"><div class="stat-num" id="stat-dusun">–</div><div class="stat-label">Dusun</div></div>
    <div class="stat-item"><div class="stat-num" id="stat-ibadah">–</div><div class="stat-label">Sarana Ibadah</div></div>
    <div class="stat-item"><div class="stat-num" id="stat-pendidikan">–</div><div class="stat-label">Pendidikan</div></div>
    <div class="stat-item"><div class="stat-num" id="stat-ekonomi">–</div><div class="stat-label">Potensi Ekonomi</div></div>
  </div>
</header>

<div class="main-layout">
  <div class="map-wrap">
    <div id="map"></div>
    <div class="map-loading" id="map-loading">Memuat data lapangan…</div>
    <div class="basemap-switcher">
      <button class="basemap-btn active" data-layer="jalan">Peta</button>
      <button class="basemap-btn" data-layer="satelit">Satelit</button>
      <button class="basemap-btn" data-layer="kontur">Kontur</button>
    </div>
  </div>
  <div class="legenda-panel">
    <h2>Legenda</h2>
    <button class="filter-chip" data-kategori="Sarana Ibadah"><span class="dot" style="background:#C79A3D"></span> Sarana Ibadah</button>
    <button class="filter-chip" data-kategori="Pendidikan"><span class="dot" style="background:#52633B"></span> Pendidikan</button>
    <button class="filter-chip" data-kategori="Potensi Ekonomi"><span class="dot" style="background:#A63D2C"></span> Potensi Ekonomi</button>
    <button class="filter-chip" data-kategori="Pemerintahan"><span class="dot" style="background:#6B6355"></span> Pemerintahan</button>
    <button class="filter-chip" data-kategori="Dusun"><span class="dot" style="background:#3D6B8C"></span> Dusun</button>
    <button class="filter-chip" data-kategori="UMKM Lokal"><span class="dot" style="background:#7A5C8E"></span> UMKM Lokal</button>
    <button class="filter-chip" data-kategori="Lainnya"><span class="dot" style="background:#9C9480"></span> Lainnya</button>
    <button class="filter-chip" data-kategori="__wilayah_dusun__"><span class="dot area"></span> Wilayah Dusun</button>
    <button class="filter-chip" data-kategori="__batas_desa__"><span class="dot" style="border-radius:2px; background:rgba(234,67,53,0.15); border:2px dashed #EA4335;"></span> Batas Desa</button>
    <button class="filter-chip" data-kategori="__lahan_potensi__"><span class="dot" style="border-radius:2px; background:rgba(166,124,61,0.35); border:2px dashed #A67C3D;"></span> Lahan Tembakau/Pandan</button>
  </div>
</div>

<section class="potensi-section">
  <div class="potensi-header">
    <div class="eyebrow-2">Hasil Bumi</div>
    <h2>Potensi Ekonomi Desa</h2>
    <p>Dua komoditas utama yang menopang warga Munungkerep</p>
  </div>

  <div class="potensi-grid">
    <div class="potensi-card-wrap">
      <div class="hover-preview">Komoditas unggulan warga, ditanam di lahan kering saat kemarau. Ketuk untuk detail lengkap.</div>
      <button class="potensi-card" onclick="bukaPopupPotensi('tembakau')">
        <div class="foto"><img src="/images/tembakau.jpg" alt="Tembakau"></div>
        <div class="info">
          <span class="tag">Komoditas Utama</span>
          <h3>Tembakau</h3>
          <p class="klik-hint">Lihat detail <svg viewBox="0 0 12 12" fill="none"><path d="M4 2L9 6L4 10" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></p>
        </div>
      </button>
    </div>
    <div class="potensi-card-wrap">
      <div class="hover-preview">Komoditas yang ditanam merata di seluruh desa, produksi skala rumahan. Ketuk untuk detail lengkap.</div>
      <button class="potensi-card" onclick="bukaPopupPotensi('pandan')">
        <div class="foto"><img src="/images/pandan.jpg" alt="Pandan"></div>
        <div class="info">
          <span class="tag">Komoditas Pendukung</span>
          <h3>Pandan</h3>
          <p class="klik-hint">Lihat detail <svg viewBox="0 0 12 12" fill="none"><path d="M4 2L9 6L4 10" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></p>
        </div>
      </button>
    </div>
  </div>
</section>

<div class="modal-overlay" id="modal-overlay" onclick="tutupPopupPotensi(event)">
  <div class="modal-box">
    <button class="modal-close" onclick="tutupPopupPotensi()">✕</button>
    <div class="galeri-wrap">
      <div class="modal-galeri" id="modal-galeri"></div>
      <div class="galeri-dots" id="galeri-dots"></div>
      <button class="galeri-panah kiri" onclick="geserGaleri(-1)">‹</button>
      <button class="galeri-panah kanan" onclick="geserGaleri(1)">›</button>
    </div>
    <span class="tag" id="modal-tag">Komoditas</span>
    <h3 id="modal-judul">Judul</h3>
    <p id="modal-isi">Isi</p>
    <div id="modal-manfaat-wrap" style="padding:14px 22px 0;">
      <p style="font-family:'Plus Jakarta Sans',sans-serif; font-size:10px; font-weight:600; text-transform:uppercase; letter-spacing:.06em; color:var(--moss); margin-bottom:8px;">Manfaat</p>
      <ul id="modal-manfaat" style="padding-left:18px; display:flex; flex-direction:column; gap:6px;"></ul>
    </div>
    <div style="padding:6px 22px 0;">
      <details id="modal-cara-wrap" style="margin-top:6px;">
        <summary style="cursor:pointer; list-style:none; font-family:'Plus Jakarta Sans',sans-serif; font-size:10px; font-weight:600; text-transform:uppercase; letter-spacing:.06em; color:var(--clay); padding:6px 0;">▸ Cara Pengolahan (Panduan Umum)</summary>
        <ol id="modal-cara" style="padding-left:18px; display:flex; flex-direction:column; gap:6px; margin-top:6px;"></ol>
      </details>
    </div>
    <p class="isi-nanti" id="modal-catatan"></p>
  </div>
</div>

<section class="sejarah-section">
  <div class="sejarah-header">
    <div class="eyebrow-2">Sejarah</div>
    <h2>Asal Usul Penduduk Desa Munungkerep</h2>
  </div>
  <div class="sejarah-body">
    <p>Asal usul nama Desa Munungkerep diambil dari kata "Munung" dan "Kerep". Munung pada zaman dahulu adalah nama sebuah pohon, yaitu pohon Sriwikutil, sedangkan "Kerep" adalah bahasa Jawa yang dalam bahasa Indonesia berarti rapat atau banyak. Sehingga Munungkerep adalah suatu desa yang dahulu banyak berjajar-jajar pohon Sriwikutil.</p>

    <p>Pada tahun 1721, ada seorang bernama Ki Suroyudo yang bersama istrinya hijrah ke hutan utara yang biasa disebut Hutan Guwo. Ki Suroyudo membuat sebuah pondok di Sendang Guwo tersebut, hingga akhirnya dikaruniai dua orang anak — satu laki-laki dan satu perempuan. Yang laki-laki diberi nama Singokerto, dan yang perempuan diberi nama Tumirah.</p>

    <p>Ki Suroyudo memiliki seorang sahabat di Sendang Jambian bernama Kartojoyo. Pada masa itu, perjodohan dalam keluarga masih erat kaitannya dengan tradisi, sehingga anak Kartojoyo yang bernama Sumojoyo dijodohkan dengan Tumirah, sementara Singokerto dijodohkan dengan Dewi Asih. Dari pernikahan Singokerto dan Dewi Asih, lahirlah seorang anak bernama Wongsojoyo.</p>

    <p>Warga akhirnya berkumpul di Alas Munung atas permintaan pemerintah Belanda, yang memerintahkan pegawai alas (mantri) untuk membuka sebuah desa di kawasan itu. Sebanyak 14 warga yang dipimpin oleh Ki Godek dan Bapak Mundu pun setuju untuk mulai membersihkan Alas Munung.</p>

    <p>Selama masa pembersihan hutan, terjadi serangan ular. Karena Ki Godek juga dikenal sebagai orang sakti, ia mampu mengatasi gangguan tersebut. Namun, akibat serangan itu, Ki Suroyudo sempat menghentikan proses pembersihan Alas Munung. Ia kemudian bertapa bersama ketiga anaknya selama tujuh hari di Sendang Sumberan, di sebelah timur Dusun Munungkerep. Di sanalah mereka bertemu dengan Mbah Jenggot Surowijoyo, penguasa Sendang Sumberan.</p>

    <p>Dari pertemuan tersebut, Mbah Jenggot Surowijoyo mengizinkan Ki Suroyudo bersama warga untuk melanjutkan pembersihan Alas Munung, dengan satu permintaan: setiap hari Jumat Pahing bulan Selo, warga harus membawa tumpengan ke Sendang Sumberan — berupa tumpeng, panggang ayam, jenang abang, jenang menir, dan jenang sengkolo — sebagai penanda telah berdirinya Desa Munungkerep.</p>
  </div>
  <div class="sejarah-sumber">📖 Dituturkan oleh Bapak Supriyadi, Budayawan Desa Munungkerep (Dusun Munungkerep).</div>
</section>

<footer>
  Disusun oleh Tim KKN
  <span class="sumber">DATA DIHIMPUN DARI SURVEI LAPANGAN · JULI 2026</span>
</footer>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
  const WARNA_KATEGORI = {
    'Sarana Ibadah':   '#C79A3D',
    'Pendidikan':      '#52633B',
    'Potensi Ekonomi': '#A63D2C',
    'Pemerintahan':    '#6B6355',
    'Dusun':           '#3D6B8C',
    'UMKM Lokal':      '#7A5C8E',
  };
  const WARNA_DEFAULT = '#9C9480';

  const batasSementara = L.latLngBounds(
    [-7.4315722, 112.2317168],
    [-7.3615722, 112.3017168]
  );

  const map = L.map('map', {
    zoomControl: false,
    minZoom: 13
  }).fitBounds(batasSementara);

  L.control.zoom({ position: 'bottomright' }).addTo(map);

  const layerJalan = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors', maxZoom: 19
  });
  const layerSatelit = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: 'Tiles &copy; Esri', maxZoom: 19
  });
  const layerKontur = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data: &copy; OpenStreetMap contributors, SRTM | Map style: &copy; OpenTopoMap', maxZoom: 17
  });

  layerJalan.addTo(map);

  document.querySelectorAll('.basemap-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      [layerJalan, layerSatelit, layerKontur].forEach(l => map.removeLayer(l));
      const pilihan = { jalan: layerJalan, satelit: layerSatelit, kontur: layerKontur };
      pilihan[btn.dataset.layer].addTo(map);
      document.querySelectorAll('.basemap-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
    });
  });

  const layerPerKategori = {};
  const hitungKategori = {};
  let batasDariData = null;

  const IKON_KATEGORI = {
    'Sarana Ibadah': '🕌',
    'Pendidikan': '🏫',
    'Potensi Ekonomi': '💰',
    'Pemerintahan': '🏛️',
    'Dusun': '🏘️',
    'UMKM Lokal': '🏪',
    'Lainnya': '📍',
  };

  fetch('/data/titik-lokasi.geojson')
    .then(res => {
      if (!res.ok) throw new Error(`File gak ketemu di server (status ${res.status})`);
      return res.json();
    })
    .then(data => {
      if (!data || !Array.isArray(data.features)) {
        throw new Error('Format GeoJSON gak sesuai — "features" harus berupa array');
      }

      data.features.forEach((feature, idx) => {
        try {
          const p = feature.properties || {};
          const tipe = feature.geometry && feature.geometry.type;

          if (!tipe) {
            console.warn(`Fitur ke-${idx} dilewati: geometry.type kosong`, feature);
            return;
          }

          if (tipe === 'Polygon' || tipe === 'MultiPolygon'){
            let styleLayer, kunciLayer;

            if (p.kategori === 'Batas Desa'){
              styleLayer = { color:'#EA4335', weight:3.5, opacity:1, dashArray:'10, 8', fillColor:'#EA4335', fillOpacity:0.05 };
              kunciLayer = '__batas_desa__';
            } else if (p.kategori === 'Potensi Ekonomi'){
              styleLayer = { color: p.warna_stroke || '#A67C3D', weight:2, opacity:1, fillColor: p.warna_fill || '#A67C3D', fillOpacity:0.35, dashArray:'4, 3' };
              kunciLayer = '__lahan_potensi__';
              hitungKategori['Potensi Ekonomi'] = (hitungKategori['Potensi Ekonomi'] || 0) + 1; // ikut kehitung di statistik atas
            } else {
              styleLayer = { color: p.warna_stroke || '#3D6B8C', weight:2, opacity:1, fillColor: p.warna_fill || '#3D6B8C', fillOpacity:0.4 };
              kunciLayer = '__wilayah_dusun__';
            }

            const batasLayer = L.geoJSON(feature, { style: styleLayer });
            batasLayer.bindPopup(`<b>${p.nama_lokasi ?? 'Wilayah'}</b>${p.keterangan ? '<br>' + p.keterangan : ''}`);

            if (!layerPerKategori[kunciLayer]) layerPerKategori[kunciLayer] = L.featureGroup();
            batasLayer.addTo(layerPerKategori[kunciLayer]);

            batasDariData = batasDariData
              ? batasDariData.extend(batasLayer.getBounds())
              : batasLayer.getBounds();
            return;
          }

          if (tipe !== 'Point') {
            console.warn(`Fitur ke-${idx} dilewati: tipe geometry "${tipe}" belum didukung`, feature);
            return;
          }

          if (!feature.geometry.coordinates || feature.geometry.coordinates.length < 2) {
            console.warn(`Fitur ke-${idx} dilewati: koordinat kosong/tidak lengkap`, feature);
            return;
          }

          const kategori = p.kategori || 'Lainnya';
          const warna = WARNA_KATEGORI[kategori] || WARNA_DEFAULT;
          const [lng, lat] = feature.geometry.coordinates;

          hitungKategori[kategori] = (hitungKategori[kategori] || 0) + 1;

          const ikon = p.ikon_khusus || IKON_KATEGORI[kategori] || '📍';

          const marker = L.marker([lat, lng], {
            icon: L.divIcon({
              className: '',
              html: `<div style="
                background:${warna}; width:30px; height:30px; border-radius:50% 50% 50% 0;
                transform:rotate(-45deg); border:2px solid #2E2A1F;
                box-shadow:0 3px 8px rgba(0,0,0,0.35); display:flex; align-items:center; justify-content:center;
              "><span style="transform:rotate(45deg); font-size:15px; line-height:1;">${ikon}</span></div>`,
              iconSize: [30, 30],
              iconAnchor: [15, 30],
              popupAnchor: [0, -28]
            })
          });

          marker.bindPopup(`
            <b>${p.nama_lokasi ?? 'Tanpa nama'}</b><br>
            <span class="kategori-label" style="background:${warna}">${kategori}</span><br>
            ${p.keterangan ?? ''}
          `);

          if (!layerPerKategori[kategori]) layerPerKategori[kategori] = L.featureGroup();
          marker.addTo(layerPerKategori[kategori]);

        } catch (errFitur) {
          // Kalau satu fitur bermasalah, jangan gagalkan semuanya — lewati, catat, lanjut ke fitur berikutnya
          console.error(`Fitur ke-${idx} gagal diproses:`, errFitur, feature);
        }
      });

      Object.values(layerPerKategori).forEach(group => group.addTo(map));

      // Wilayah dusun harus bisa diklik duluan (di atas garis batas desa yang menutupinya)
      if (layerPerKategori['__wilayah_dusun__']) layerPerKategori['__wilayah_dusun__'].bringToFront();

      document.getElementById('map-loading').classList.add('hidden');

      if (batasDariData){
        map.fitBounds(batasDariData.pad(0.08));
        map.setMaxBounds(batasDariData.pad(0.15));
      }

      const totalTitik = Object.values(hitungKategori).reduce((a,b) => a+b, 0);
      document.getElementById('stat-total').textContent = totalTitik;
      document.getElementById('stat-dusun').textContent = hitungKategori['Dusun'] || 0;
      document.getElementById('stat-ibadah').textContent = hitungKategori['Sarana Ibadah'] || 0;
      document.getElementById('stat-pendidikan').textContent = hitungKategori['Pendidikan'] || 0;
      document.getElementById('stat-ekonomi').textContent = hitungKategori['Potensi Ekonomi'] || 0;
    })
    .catch((err) => {
      // Sekarang pesan errornya spesifik, dan tercatat lengkap di Console buat didiagnosis
      console.error('GAGAL MEMUAT PETA:', err);
      const el = document.getElementById('map-loading');
      el.textContent = 'Gagal memuat: ' + err.message;
      el.classList.add('error');
    });

  document.querySelectorAll('.filter-chip[data-kategori]').forEach(btn => {
    btn.addEventListener('click', () => {
      const group = layerPerKategori[btn.dataset.kategori];
      if (!group) return;
      if (map.hasLayer(group)){ map.removeLayer(group); btn.classList.add('off'); }
      else { map.addLayer(group); btn.classList.remove('off'); }
    });
  });

  const DATA_POTENSI = {
    tembakau: {
      tag: 'Komoditas Utama',
      judul: 'Tembakau',
      foto: ['/images/tembakau-1.jpg', '/images/tembakau-2.jpg', '/images/tembakau-3.jpg'],
      isi: 'Komoditas unggulan Desa Munungkerep, ditanam di lahan tegalan/kering pada musim kemarau karena tidak membutuhkan banyak air dibanding tanaman lain, sehingga cocok dengan kondisi tanah desa yang berada di dataran tinggi Kecamatan Kabuh. Masa panen berlangsung antara bulan Juli hingga November.',
      manfaat: [
        'Diolah menjadi tembakau rajangan sebagai bahan baku rokok kretek — produk utama yang dijual ke pengepul',
        'Bisa diolah lebih lanjut jadi cerutu atau tembakau lintingan, produk olahan bernilai jual lebih tinggi',
        'Sisa/ampas tembakau dimanfaatkan sebagai pestisida alami — kandungan nikotinnya efektif mengusir hama tanaman',
        'Batang dan daun sisa panen bisa diolah jadi pupuk kompos organik',
        'Jadi sumber penghasilan utama petani saat musim kemarau, ketika tanaman lain sulit tumbuh di lahan kering'
      ],
      catatan: '📝 Masih perlu: luas lahan, jumlah petani/dusun penghasil, titik lokasi lahan',
      cara: [
        'Daun dipetik saat sudah matang, biasanya pagi hari setelah embun mengering',
        'Daun diperam (curing) dulu sampai warnanya berubah dan agak lentur, tidak mudah hancur',
        'Dirajang tipis-tipis pakai pisau tajam atau alat rajang tradisional',
        'Hasil rajangan dijemur langsung di bawah matahari selama beberapa hari sampai kering merata',
        'Setelah kering, difermentasi agar aroma dan rasanya lebih matang sebelum dikemas dan dijual'
      ]
    },
    pandan: {
      tag: 'Komoditas Pendukung',
      judul: 'Pandan',
      foto: ['/images/pandan-1.jpg', '/images/pandan-2.jpg', '/images/pandan-3.jpg'],
      isi: 'Komoditas pendukung yang ditanam merata di seluruh wilayah Desa Munungkerep, bukan terpusat di dusun tertentu. Produksi dilakukan dalam skala rumahan oleh warga.',
      manfaat: [
        'Bahan pewangi & pewarna hijau alami untuk masakan dan kue tradisional',
        'Bahan baku anyaman — tikar, tas, dan kerajinan tangan warga',
        'Pembungkus alami untuk makanan tradisional',
        'Diolah menjadi dupa atau pengharum ruangan alami',
        'Akarnya kadang dimanfaatkan warga dalam ramuan tradisional rumahan',
        'Ditanam di lahan miring juga membantu menahan erosi tanah, selain nilai ekonominya'
      ],
      catatan: '📝 Masih perlu: dijual ke mana/pembeli utama, titik lokasi lahan (kalau ada yang representatif)',
      cara: [
        'Daun pandan dipetik, lalu duri di tepinya dibersihkan pakai pisau atau senar',
        'Daun dipotong/dibelah jadi ukuran seragam, biasanya sekitar 0,5–0,7 cm lebar',
        'Direbus sebentar untuk menghilangkan getah dan melunakkan seratnya',
        'Dijemur sampai benar-benar kering, lalu diluruskan dan dihaluskan',
        'Setelah siap, baru dianyam sesuai motif dan bentuk yang diinginkan — tikar, tas, dompet, dan lainnya'
      ]
    }
  };

  function bukaPopupPotensi(kunci){
    const data = DATA_POTENSI[kunci];
    document.getElementById('modal-tag').textContent = data.tag;
    document.getElementById('modal-judul').textContent = data.judul;
    document.getElementById('modal-isi').textContent = data.isi;
    document.getElementById('modal-catatan').textContent = data.catatan;

    // Bangun galeri dari daftar foto — kalau ada yang belum ada filenya, dilewati diam-diam
    const galeri = document.getElementById('modal-galeri');
    const dotsWrap = document.getElementById('galeri-dots');
    galeri.innerHTML = '';
    dotsWrap.innerHTML = '';

    let jumlahFotoValid = 0;
    (data.foto || []).forEach((src, i) => {
      const slide = document.createElement('div');
      slide.className = 'slide';
      const img = document.createElement('img');
      img.src = src;
      img.alt = `${data.judul} ${i + 1}`;
      img.onerror = () => { slide.remove(); perbaruiDots(); };
      slide.appendChild(img);
      galeri.appendChild(slide);
      jumlahFotoValid++;

      const dot = document.createElement('div');
      dot.className = 'dot-nav' + (i === 0 ? ' aktif' : '');
      dot.onclick = () => { galeri.scrollTo({ left: slide.offsetLeft, behavior: 'smooth' }); };
      dotsWrap.appendChild(dot);
    });

    if (jumlahFotoValid === 0){
      galeri.innerHTML = '<div class="slide kosong">Foto menyusul</div>';
    }

    function perbaruiDots(){
      const sisaSlide = galeri.querySelectorAll('.slide').length;
      dotsWrap.style.display = sisaSlide > 1 ? 'flex' : 'none';
    }
    perbaruiDots();

    // Update dot aktif saat digeser manual
    galeri.onscroll = () => {
      const dots = dotsWrap.querySelectorAll('.dot-nav');
      const posisi = Math.round(galeri.scrollLeft / galeri.clientWidth);
      dots.forEach((d, i) => d.classList.toggle('aktif', i === posisi));
    };

    const daftarManfaat = document.getElementById('modal-manfaat');
    daftarManfaat.innerHTML = '';
    (data.manfaat || []).forEach(poin => {
      const li = document.createElement('li');
      li.textContent = poin;
      li.style.cssText = 'font-size:13px; color:#4A4638; line-height:1.55;';
      daftarManfaat.appendChild(li);
    });

    const daftarCara = document.getElementById('modal-cara');
    daftarCara.innerHTML = '';
    (data.cara || []).forEach(langkah => {
      const li = document.createElement('li');
      li.textContent = langkah;
      li.style.cssText = 'font-size:13px; color:#4A4638; line-height:1.55;';
      daftarCara.appendChild(li);
    });
    document.getElementById('modal-cara-wrap').open = false; // selalu tertutup dulu saat popup baru dibuka

    document.getElementById('modal-overlay').classList.add('show');
  }

  function geserGaleri(arah){
    const galeri = document.getElementById('modal-galeri');
    galeri.scrollBy({ left: arah * galeri.clientWidth, behavior: 'smooth' });
  }

  function tutupPopupPotensi(event){
    if (event && event.target !== event.currentTarget && !event.target.classList.contains('modal-close')) return;
    document.getElementById('modal-overlay').classList.remove('show');
  }
</script>
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