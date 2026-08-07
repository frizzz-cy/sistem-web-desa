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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
  @media (min-width: 768px) {
    .grid-demografi-wrapper {
      grid-template-columns: repeat(2, 1fr) !important;
    }
  }
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

  .main-layout{display:grid; grid-template-columns:1fr; background:var(--paper-2); border-radius:12px; overflow:hidden; box-shadow:0 16px 40px rgba(11,59,96,0.15);}
  @media (min-width:640px){ .main-layout{grid-template-columns:3fr 1.1fr;} }

  .stats-strip{
    display:grid; grid-template-columns:repeat(5,1fr); gap:1px;
    margin:24px 0 0;
    background:var(--line); border:1px solid var(--line); border-radius:12px; overflow:hidden;
    box-shadow:0 10px 24px rgba(11,59,96,0.10);
  }
  .stat-item{
    background:var(--paper-2); padding:12px 4px; text-align:center;
  }
  .stat-num{
    font-family:'Plus Jakarta Sans',sans-serif; font-size:30px; font-weight:800; color:var(--ground); line-height:1.1;
  }
  .stat-label{
    font-size:9px; color:var(--ink-soft); text-transform:uppercase; letter-spacing:.02em;
    margin-top:3px; font-weight:600; line-height:1.2;
  }

  .map-wrap{position:relative; border-top:4px solid var(--gold);}
  #map{height:52vh; min-height:320px; width:100%; background:var(--line);}
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
    background:var(--paper-2); border-top:1px solid var(--line); padding:20px;
  }
  @media (min-width:640px){
    .legenda-panel{border-left:1px solid var(--line); border-top:none; overflow-y:auto;}
  }
  .legenda-panel h2{
    display:block; font-family:'Plus Jakarta Sans',sans-serif; font-size:12px; font-weight:800;
    text-transform:uppercase; letter-spacing:.08em; margin-bottom:16px; color:var(--ground);
  }

  .filter-chip{
    display:flex; align-items:center; gap:10px; width:100%; white-space:normal; flex-shrink:0;
    background:var(--paper); border:1px solid transparent; border-radius:8px; cursor:pointer;
    font-family:'Plus Jakarta Sans',sans-serif; font-weight:600; font-size:13px;
    color:var(--ground); padding:10px 12px; text-align:left;
    margin-bottom:6px; -webkit-appearance:none; appearance:none;
    transition:background .15s ease, border-color .15s ease;
  }
  .filter-chip.off{opacity:0.35;}
  .filter-chip:hover{background:var(--line); border-color:var(--ground);}
  .filter-chip:focus-visible{outline:2px solid var(--clay); outline-offset:-2px;}
  .dot{width:10px; height:10px; border-radius:50%; flex-shrink:0;}
  .dot.area{border-radius:2px; background:rgba(234,67,53,0.12); border:2px dashed #EA4335;}

  .leaflet-popup-content-wrapper{border-radius:6px; font-family:'Plus Jakarta Sans',sans-serif;}

  /* ============ DEMOGRAFI + PETA SATELIT MINI ============ */
  .demografi-section{
    max-width:1200px; margin:0 auto; padding:44px 20px 56px;
    display:grid; grid-template-columns:1fr; gap:32px;
  }
  @media (min-width:900px){ .demografi-section{grid-template-columns:1fr 1.5fr; align-items:start;} }
  .demografi-text{
    max-width:520px; padding:0; text-align:left;
  }
  .demografi-text .eyebrow-2{
    font-family:'Plus Jakarta Sans',sans-serif; font-size:12px; font-weight:700;
    letter-spacing:.1em; text-transform:uppercase; color:var(--clay); margin-bottom:10px;
  }
  .demografi-text h2{
    font-size:clamp(30px,5.5vw,42px); font-weight:800; color:var(--ground); line-height:1.15;
    margin-bottom:18px;
  }
  .demografi-text p{font-size:16px; color:var(--ink-soft); line-height:1.8; margin-bottom:14px;}
  .demografi-mini-stat{
    display:grid; grid-template-columns:repeat(4,1fr); gap:1px; margin-top:20px;
    background:var(--line); border-top:1px solid var(--line); border-bottom:1px solid var(--line);
  }
  .demografi-mini-stat div{
    text-align:left; padding:10px 10px; background:var(--paper);
  }
  .demografi-mini-stat .d-val{font-size:30px; font-weight:800; color:var(--ground); line-height:1.1;}
  .demografi-mini-stat .d-lbl{font-size:11px; color:var(--ink-soft); text-transform:uppercase; letter-spacing:.05em; font-weight:600; margin-top:2px;}

  .leaflet-popup-content b{font-family:'Plus Jakarta Sans',sans-serif; font-weight:800; font-size:15px; color:var(--ground);}
  .leaflet-popup-content .kategori-label{
    display:inline-block; font-family:'Plus Jakarta Sans',sans-serif; font-size:10px; font-weight:600;
    text-transform:uppercase; letter-spacing:.05em; color:#fff; padding:2px 8px; border-radius:3px; margin:5px 0;
  }

  .potensi-section{max-width:700px; margin:0 auto; padding:56px 20px;}
  .potensi-header{text-align:center; margin-bottom:34px;}
  .potensi-header .eyebrow-2{
    font-family:'Plus Jakarta Sans',sans-serif; font-size:12px; font-weight:700;
    letter-spacing:.1em; text-transform:uppercase; color:var(--clay); margin-bottom:10px;
  }
  .potensi-header h2{font-size:clamp(24px,4.5vw,32px); font-weight:800; color:var(--ground);}
  .potensi-header p{color:var(--ink-soft); font-size:13.5px; margin-top:8px;}

  .potensi-carousel-wrap{ position:relative; overflow:hidden; }
  .potensi-track{
    display:flex; gap:20px;
    transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    cursor: grab;
    padding: 24px 0 32px;
  }
  .potensi-track.no-transition{ transition:none; }
  .potensi-track:active { cursor: grabbing; }
  .potensi-card-wrap{
    flex:0 0 calc(100% - 40px);
    position:relative;
  }
  @media (min-width:600px){
    .potensi-card-wrap{
      flex:0 0 calc(50% - 30px);
    }
  }

  .carousel-panah {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    background: var(--ground, #0B3B60);
    color: #fff;
    border: none;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    transition: opacity 0.2s, background 0.2s;
  }
  .carousel-panah:hover {
    background: var(--moss, #52633B);
  }
  .carousel-panah.kiri {
    left: 4px;
  }
  .carousel-panah.kanan {
    right: 4px;
  }
  @media (max-width: 768px) {
    .carousel-panah { display: none; }
  }
  
  .potensi-dots {
    display: flex;
    justify-content: center;
    gap: 6px;
    margin-top: 14px;
  }
  .potensi-dots .dot-nav {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--border, #DDE3E8);
    cursor: pointer;
    transition: background 0.2s, transform 0.2s;
  }
  .potensi-dots .dot-nav.aktif {
    background: var(--ground, #0B3B60);
    transform: scale(1.2);
  }

  .potensi-card{
    background:var(--paper-2); border:1px solid var(--line); border-radius:12px; overflow:hidden;
    text-align:left; cursor:pointer; width:100%; padding:0;
    font-family:'Plus Jakarta Sans',sans-serif; transition:transform .18s ease, box-shadow .18s ease, border-color .18s ease;
    -webkit-appearance:none; appearance:none; position:relative;
    box-shadow:0 6px 16px rgba(11,59,96,0.06);
  }
  .potensi-card:hover{transform:translateY(-3px); box-shadow:0 14px 28px rgba(11,59,96,0.12); border-color:var(--moss);}
  .potensi-card:focus-visible{outline:2px solid var(--clay); outline-offset:2px;}
  .potensi-card .foto{
    width:100%; aspect-ratio:16/10; background:var(--paper); position:relative;
    display:flex; align-items:center; justify-content:center;
    color:var(--ink-soft); font-family:'Plus Jakarta Sans',sans-serif; font-size:11px; font-weight:500;
  }
  .potensi-card .foto img{width:100%; height:100%; object-fit:cover;}
  .potensi-card .info{padding:18px 20px 20px;}
  .potensi-card .info .tag{
    font-family:'Plus Jakarta Sans',sans-serif; font-size:10.5px; font-weight:700;
    letter-spacing:.08em; text-transform:uppercase; color:var(--moss); display:block; margin-bottom:8px;
  }
  .potensi-card .info h3{font-size:19px; font-weight:800; color:var(--ground); margin-bottom:8px;}
  .klik-hint{color:var(--clay); font-weight:700; font-size:12.5px; display:flex; align-items:center; gap:5px;}
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

  /* ================= PRODUK TURUNAN (di dalam modal) ================= */
  .modal-produk{
    margin:14px 22px 0; padding:14px; background:var(--paper);
    border:1px solid var(--line); border-radius:8px;
  }
  .modal-produk .judul-kecil{
    font-family:'Plus Jakarta Sans',sans-serif; font-size:9px; font-weight:700;
    letter-spacing:.06em; text-transform:uppercase; color:var(--moss); display:block; margin-bottom:8px;
  }
  .modal-produk .daftar-chip{display:flex; flex-wrap:wrap; gap:6px;}
  .modal-produk .chip-produk{
    background:var(--paper-2); border:1px solid var(--line); border-radius:20px;
    padding:5px 12px; font-size:11px; font-weight:600; color:var(--ground);
  }

  .modal-overlay{
    position:fixed; inset:0; z-index:2000;
    background:rgba(46,42,31,0.78);
    display:flex; align-items:center; justify-content:center; padding:20px;
    opacity:0; pointer-events:none; transition:opacity .3s ease;
  }
  .modal-overlay.show{opacity:1; pointer-events:auto;}
  .modal-box{
    background:var(--paper-2); border-radius:5px; max-width:440px; width:100%;
    padding:0 0 22px; position:relative; max-height:85vh; overflow-y:auto;
    transform:scale(0.9) translateY(20px); transition:transform .3s cubic-bezier(0.34, 1.56, 0.64, 1);
  }
  .modal-overlay.show .modal-box{
    transform:scale(1) translateY(0);
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


</style>
</head>
<body>

@include('partials.navbar', ['active' => 'peta'])

<section class="demografi-section">
  <div class="demografi-text">
    <div class="eyebrow-2">Demografi &amp; Geografis</div>
    <h2>Demografi Penduduk</h2>
    <p>Desa Munungkerep dihuni oleh <strong>2.113 Jiwa</strong> (1.042 Laki-laki, 1.071 Perempuan) yang tersebar di 7 dusun dengan total <strong>761 Kepala Keluarga (KK)</strong>, serta memiliki luas wilayah <strong>209,909 Hektar</strong>. Mayoritas warga berprofesi di sektor pertanian (<strong>986 Petani</strong> &amp; <strong>457 Buruh Tani</strong>) dengan iklim kemarau dan penghujan yang berpengaruh langsung terhadap pola tanam warga.</p>
    <p>Ditinjau dari golongan umur, kelompok angkatan kerja usia produktif <strong>41–55 tahun (602 jiwa)</strong> dan <strong>26–40 tahun (505 jiwa)</strong> merupakan jumlah terbanyak (total angkatan kerja 1.169 orang), disusul usia 16–25 tahun (280 jiwa), 6–15 tahun (274 jiwa), 56–70 tahun (243 jiwa), serta balita 0–5 tahun (209 jiwa). Dari segi keagamaan, 100% masyarakat Desa Munungkerep beragama <strong>Islam</strong>.</p>
    <p>Di bidang pendidikan dan kesehatan, desa ini ditunjang oleh 1 Gedung TK, 2 Gedung SD, Polindes, 7 Posyandu, 7 Posyandu Lansia, dan Pos Jubastik. Tingkat pendidikan warga mencakup 40 Sarjana (S-1), 23 Diploma, 160 SLTA, 309 SLTP, dan 467 tamatan SD. Populasi ternak warga meliputi 450 ayam/itik, 170 kambing, dan 76 ekor sapi.</p>
    <p>Peta di bawah memuat sarana desa, titik ibadah, dan potensi ekonomi warga, dihimpun langsung dari survei lapangan Tim KKN 2026. Ketuk titik pada peta untuk detail lengkap.</p>
  </div>
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
</section>

<!-- Section A (Stats Strip) dipindahkan ke atas potensi ekonomi bawah peta -->
<div style="max-width:700px; margin:24px auto; padding:0 20px;">
  <div class="stats-strip" id="stats-strip">
    <div class="stat-item"><div class="stat-num" id="stat-total">–</div><div class="stat-label">Titik Terdata</div></div>
    <div class="stat-item"><div class="stat-num" id="stat-dusun">–</div><div class="stat-label">Dusun</div></div>
    <div class="stat-item"><div class="stat-num" id="stat-ibadah">–</div><div class="stat-label">Sarana Ibadah</div></div>
    <div class="stat-item"><div class="stat-num" id="stat-pendidikan">–</div><div class="stat-label">Pendidikan</div></div>
    <div class="stat-item"><div class="stat-num" id="stat-ekonomi">–</div><div class="stat-label">Potensi Ekonomi</div></div>
  </div>
</div>

<section class="potensi-section" style="padding-top: 10px;">
  <div class="potensi-header">
    <div class="eyebrow-2">Hasil Bumi</div>
    <h2>Potensi Ekonomi Desa</h2>
    <p>Tiga komoditas utama yang menopang warga Munungkerep</p>
  </div>

  <div class="potensi-carousel-wrap" id="potensi-carousel-wrap">
    <!-- Panah navigasi geser -->
    <button class="carousel-panah kiri" id="panah-kiri">‹</button>
    
    <div class="potensi-track" id="potensi-track">
      @foreach($data_potensi as $key => $item)
        <div class="potensi-card-wrap" data-terkait="{{ $key }}">
          <div class="hover-preview">{{ Str::limit($item['isi'], 90) }} Ketuk untuk detail lengkap.</div>
          <button class="potensi-card" onclick="bukaPopupPotensi('{{ $key }}')">
            <div class="foto">
              <img src="{{ !empty($item['foto'][0]) ? $item['foto'][0] : 'https://placehold.co/600x400?text=Gambar+Potensi' }}" alt="{{ $item['judul'] }}">
            </div>
            <div class="info">
              <span class="tag">{{ $item['tag'] }}</span>
              <h3>{{ $item['judul'] }}</h3>
              <p class="klik-hint">Lihat detail <svg viewBox="0 0 12 12" fill="none"><path d="M4 2L9 6L4 10" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></p>
            </div>
          </button>
        </div>
      @endforeach
    </div>

    <button class="carousel-panah kanan" id="panah-kanan">›</button>
  </div>

  <!-- Indikator dots -->
  <div class="potensi-dots" id="potensi-dots"></div>
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
    <div class="modal-produk" id="modal-produk">
      <span class="judul-kecil">Bisa Diolah Jadi</span>
      <div class="daftar-chip" id="modal-produk-chip"></div>
    </div>
    <p class="isi-nanti" id="modal-catatan"></p>
  </div>
</div>


@include('partials.footer')

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

      const totalTitik = Object.values(hitungKategori).reduce((a,b) => a+b, 0);
      document.getElementById('stat-total').textContent = totalTitik;
      document.getElementById('stat-dusun').textContent = hitungKategori['Dusun'] || 0;
      document.getElementById('stat-ibadah').textContent = hitungKategori['Sarana Ibadah'] || 0;
      document.getElementById('stat-pendidikan').textContent = hitungKategori['Pendidikan'] || 0;
      document.getElementById('stat-ekonomi').textContent = hitungKategori['Potensi Ekonomi'] || 0;

      if (batasDariData){
        map.fitBounds(batasDariData.pad(0.08));
        map.setMaxBounds(batasDariData.pad(0.15));
        // Jaga biar gak ke-zoom out kejauhan cuma buat ngejar 1-2 titik terpencil di pinggir
        if (map.getZoom() < 15) map.setZoom(15);
      }


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

  const DATA_POTENSI = {!! json_encode($data_potensi) !!};


  // Carousel Potensi Ekonomi — Sabuk kontinu (infinite loop) dengan snap tengah
  (function(){
    const wrap = document.getElementById('potensi-carousel-wrap');
    const track = document.getElementById('potensi-track');
    if (!track || !wrap) return;

    const origCards = Array.from(track.querySelectorAll('.potensi-card-wrap'));
    const totalOri = origCards.length;
    if (totalOri <= 1) return;

    // Kloning kartu untuk efek sabuk kontinu
    origCards.forEach(c => {
      const clone = c.cloneNode(true);
      clone.setAttribute('data-clone', 'true');
      track.appendChild(clone);
    });
    origCards.forEach(c => {
      const clone = c.cloneNode(true);
      clone.setAttribute('data-clone', 'true');
      track.insertBefore(clone, track.firstChild);
    });

    // Semua kartu termasuk kloning
    let allCards = Array.from(track.querySelectorAll('.potensi-card-wrap'));
    let currentIndex = totalOri; // mulai dari kartu asli pertama (setelah klon awal)
    let timer = null;
    let userInteracting = false;
    const interval = 4000;
    const gap = 20;

    function getCardWidth() {
      return allCards[0].offsetWidth + gap;
    }

    function getOffset(idx) {
      const cardW = getCardWidth();
      const wrapW = wrap.offsetWidth;
      // Posisikan kartu idx di tengah container
      return -(idx * cardW) + (wrapW / 2) - (cardW / 2);
    }

    function goTo(idx, animate) {
      if (animate) {
        track.classList.remove('no-transition');
      } else {
        track.classList.add('no-transition');
      }
      currentIndex = idx;
      track.style.transform = `translateX(${getOffset(idx)}px)`;
      updateDots();
    }

    // Setelah transisi selesai, cek apakah perlu teleport
    track.addEventListener('transitionend', () => {
      // Jika sudah melewati set asli di kanan → teleport ke set asli
      if (currentIndex >= totalOri * 2) {
        goTo(currentIndex - totalOri, false);
      }
      // Jika sudah melewati set asli di kiri → teleport ke set asli
      if (currentIndex < totalOri) {
        goTo(currentIndex + totalOri, false);
      }
    });

    // Dot indikator
    const dotsWrap = document.getElementById('potensi-dots');
    function buildDots() {
      if (!dotsWrap) return;
      dotsWrap.innerHTML = '';
      for (let i = 0; i < totalOri; i++) {
        const dot = document.createElement('div');
        dot.className = 'dot-nav';
        dot.onclick = () => {
          userInteracting = true;
          stopAutoPlay();
          goTo(totalOri + i, true);
          setTimeout(() => { userInteracting = false; startAutoPlay(); }, 3000);
        };
        dotsWrap.appendChild(dot);
      }
    }
    buildDots();

    function updateDots() {
      if (!dotsWrap) return;
      const dots = dotsWrap.querySelectorAll('.dot-nav');
      const realIdx = currentIndex % totalOri;
      dots.forEach((d, i) => d.classList.toggle('aktif', i === realIdx));
    }

    // Inisialisasi posisi awal tanpa animasi
    goTo(currentIndex, false);
    // Force reflow lalu aktifkan transisi
    track.offsetHeight;
    track.classList.remove('no-transition');

    function checkBounds() {
      if (currentIndex >= totalOri * 2) {
        goTo(currentIndex - totalOri, false);
        track.offsetHeight; // Force reflow
      } else if (currentIndex < totalOri) {
        goTo(currentIndex + totalOri, false);
        track.offsetHeight; // Force reflow
      }
    }

    function nextSlide() {
      if (userInteracting) return;
      checkBounds();
      goTo(currentIndex + 1, true);
    }

    function startAutoPlay() {
      stopAutoPlay();
      timer = setInterval(nextSlide, interval);
    }

    function stopAutoPlay() {
      if (timer) { clearInterval(timer); timer = null; }
    }

    startAutoPlay();

    // Pencegah Bug Slider Putih Saat Ditinggal Tab Lain
    document.addEventListener('visibilitychange', () => {
      if (document.hidden) {
        stopAutoPlay();
      } else {
        checkBounds();
        startAutoPlay();
      }
    });

    window.addEventListener('focus', () => {
      checkBounds();
      startAutoPlay();
    });

    window.addEventListener('blur', () => {
      stopAutoPlay();
    });

    window.addEventListener('resize', () => {
      checkBounds();
      goTo(currentIndex, false);
    });

    // Tombol panah
    document.getElementById('panah-kiri').addEventListener('click', () => {
      userInteracting = true;
      stopAutoPlay();
      goTo(currentIndex - 1, true);
      setTimeout(() => { userInteracting = false; startAutoPlay(); }, 3000);
    });
    document.getElementById('panah-kanan').addEventListener('click', () => {
      userInteracting = true;
      stopAutoPlay();
      goTo(currentIndex + 1, true);
      setTimeout(() => { userInteracting = false; startAutoPlay(); }, 3000);
    });

    // Touch support (mobile swipe)
    let touchStartX = 0;
    let touchDelta = 0;

    track.addEventListener('touchstart', (e) => {
      userInteracting = true;
      stopAutoPlay();
      touchStartX = e.touches[0].clientX;
      track.classList.add('no-transition');
    }, { passive: true });

    track.addEventListener('touchmove', (e) => {
      touchDelta = e.touches[0].clientX - touchStartX;
      const base = getOffset(currentIndex);
      track.style.transform = `translateX(${base + touchDelta}px)`;
    }, { passive: true });

    track.addEventListener('touchend', () => {
      track.classList.remove('no-transition');
      const threshold = getCardWidth() * 0.25;
      if (touchDelta < -threshold) {
        goTo(currentIndex + 1, true);
      } else if (touchDelta > threshold) {
        goTo(currentIndex - 1, true);
      } else {
        goTo(currentIndex, true);
      }
      touchDelta = 0;
      setTimeout(() => { userInteracting = false; startAutoPlay(); }, 2000);
    }, { passive: true });

    // Mouse drag (desktop)
    let isDown = false;
    let dragStartX = 0;
    let dragDelta = 0;

    track.addEventListener('mousedown', (e) => {
      isDown = true;
      userInteracting = true;
      stopAutoPlay();
      dragStartX = e.pageX;
      dragDelta = 0;
      track.classList.add('no-transition');
      e.preventDefault();
    });

    window.addEventListener('mousemove', (e) => {
      if (!isDown) return;
      dragDelta = e.pageX - dragStartX;
      const base = getOffset(currentIndex);
      track.style.transform = `translateX(${base + dragDelta}px)`;
    });

    window.addEventListener('mouseup', () => {
      if (!isDown) return;
      isDown = false;
      track.classList.remove('no-transition');
      const threshold = getCardWidth() * 0.2;
      if (dragDelta < -threshold) {
        goTo(currentIndex + 1, true);
      } else if (dragDelta > threshold) {
        goTo(currentIndex - 1, true);
      } else {
        goTo(currentIndex, true);
      }
      dragDelta = 0;
      setTimeout(() => { userInteracting = false; startAutoPlay(); }, 2000);
    });

    // Resize: recalculate
    window.addEventListener('resize', () => goTo(currentIndex, false));
  })();

  function bukaPopupPotensi(kunci){
    const data = DATA_POTENSI[kunci];
    document.getElementById('modal-tag').textContent = data.tag;
    document.getElementById('modal-judul').textContent = data.judul;
    document.getElementById('modal-isi').textContent = data.isi;
    document.getElementById('modal-catatan').textContent = data.catatan;

    // Isi daftar chip "bisa diolah jadi" (kalau ada datanya)
    const wadahProduk = document.getElementById('modal-produk');
    const daftarChip = document.getElementById('modal-produk-chip');
    if (data.produk && data.produk.length){
      daftarChip.innerHTML = '';
      data.produk.forEach(nama => {
        const chip = document.createElement('span');
        chip.className = 'chip-produk';
        chip.textContent = nama;
        daftarChip.appendChild(chip);
      });
      wadahProduk.style.display = 'block';
    } else {
      wadahProduk.style.display = 'none';
    }

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