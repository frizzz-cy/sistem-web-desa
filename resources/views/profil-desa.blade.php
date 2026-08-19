<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Profil pemerintahan, geografis, dan demografis Desa Munungkerep, Kecamatan Kabuh, Kabupaten Jombang.">
<title>Profil Desa Munungkerep</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root{
    --ink:#0B3B60;
    --ink-2:#0B3B60;
    --amber:#D4A017;
    --moss:#52633B;
    --clay:#C62828;
    --biru:#1668A3;
    --paper:#F4F6F8;
    --paper-2:#FFFFFF;
    --border:#DDE3E8;
    --ink-soft:#5B6B7A;
  }
  *{box-sizing:border-box; margin:0; padding:0;}
  html{ scroll-behavior:smooth; -webkit-text-size-adjust:100%; }
  body{
    font-family:'Plus Jakarta Sans',sans-serif;
    background:var(--paper);
    color:var(--ink);
    line-height:1.55;
    -webkit-font-smoothing:antialiased;
    -moz-osx-font-smoothing:grayscale;
    text-rendering:optimizeLegibility;
    animation:fadeInPage .35s ease;
  }
  @keyframes fadeInPage{ from{opacity:0; transform:translateY(6px);} to{opacity:1; transform:translateY(0);} }
  a{ transition:opacity .15s ease; }
  h1,h2,h3{font-family:'Plus Jakarta Sans',sans-serif; font-weight:800;}
  .mono{font-family:'Plus Jakarta Sans',sans-serif;}

  main{max-width:1160px; margin:0 auto; padding:40px 20px 60px;}
  .narrow{max-width:800px; margin-left:auto; margin-right:auto;}

  .section{margin-bottom:26px;}
  .section-head{margin-bottom:18px; text-align:center;}
  .section-head .eyebrow-2{
    font-family:'Plus Jakarta Sans',sans-serif; font-size:11px; font-weight:600; letter-spacing:.1em;
    text-transform:uppercase; color:var(--clay); margin-bottom:6px;
  }
  .section-head h2{font-size:clamp(19px,4vw,24px); font-weight:600;}

  .card{
    background:var(--paper-2); border:1px solid var(--border); border-radius:5px;
    padding:22px 24px;
  }

  .kv-list{list-style:none;}
  .kv-list li{
    display:flex; justify-content:space-between; gap:16px; padding:11px 0;
    border-bottom:1px solid var(--border); font-size:14px;
  }
  .kv-list li:last-child{border-bottom:none;}
  .kv-list .label{color:var(--ink-soft); font-weight:600;}
  .kv-list .value{font-weight:600; text-align:right;}

  .stat-grid{display:grid; grid-template-columns:repeat(2,1fr); gap:14px;}
  @media (min-width:520px){ .stat-grid{grid-template-columns:repeat(4,1fr);} }
  .stat-box{background:var(--paper-2); border:1px solid var(--border); border-radius:5px; padding:18px 12px; text-align:center;}
  .stat-box .num{font-family:'Plus Jakarta Sans',sans-serif; font-size:22px; font-weight:800; color:var(--amber);}
  .stat-box .lbl{font-size:11px; color:var(--ink-soft); margin-top:4px; text-transform:uppercase; letter-spacing:.04em; font-weight:600;}

  .note{
    background:rgba(166,61,44,0.07); border-left:3px solid var(--clay); padding:12px 16px;
    font-size:12.5px; color:var(--clay); font-style:italic; border-radius:0 6px 6px 0; margin-top:14px;
  }

  /* ============ LAYOUT SEJARAH ============ */
  .sejarah-title-left { text-align: left; margin-bottom: 20px; }
  .sejarah-title-left h2 { font-size: clamp(22px, 4vw, 26px); font-weight: 800; color: var(--ink-2); }
  .sejarah-wrapper { text-align: justify; line-height: 1.8; }
  .sejarah-wrapper::after { content: ""; display: table; clear: both; }
  .sejarah-img {
    float: left; width: 100%; max-width: 320px; margin: 6px 24px 16px 0;
    border-radius: 6px; border: 1px solid var(--border);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08); object-fit: cover;
  }
  /* ============ SLIDER PIGORA KEPEMIMPINAN ============ */
  .pigora-slider-wrapper {
    position: relative;
    margin-top: 14px;
    padding: 0 40px;
  }
  .pigora-track {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    overflow-x: auto;
    scroll-behavior: smooth;
    scroll-snap-type: x mandatory;
    padding: 16px 4px 16px;
    scrollbar-width: none;
    -ms-overflow-style: none;
    cursor: grab;
  }
  .pigora-track:active { cursor: grabbing; }
  .pigora-track::-webkit-scrollbar { display: none; }

  .pigora-slider-item {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-shrink: 0;
    scroll-snap-align: start;
  }

  .pigora-card-frame {
    width: 190px;
    background: #FFFFFF;
    border-radius: 8px;
    text-align: center;
    flex-shrink: 0;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    user-select: none;
  }
  .pigora-card-frame:hover {
    transform: translateY(-5px);
  }

  /* Bingkai Pigora Luar Presisi Sesuai Gambar */
  .pigora-box-outer {
    border: 4px solid var(--biru-tua);
    border-radius: 4px;
    padding: 6px;
    background: #FFFFFF;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    position: relative;
  }
  .pigora-slider-item.aktif .pigora-box-outer {
    border: 4px solid var(--amber);
    box-shadow: 0 8px 24px rgba(212,160,23,0.25);
  }

  .pigora-box-inner {
    border: 2px solid var(--biru-tua);
    padding: 6px 6px 8px;
    background: #FAFAFA;
    border-radius: 2px;
  }
  .pigora-slider-item.aktif .pigora-box-inner {
    border: 2px solid var(--amber);
    background: #FFFDF7;
  }

  .pigora-photo-area {
    width: 100%;
    height: 160px;
    background: linear-gradient(135deg, #0B3B60 0%, #1668A3 100%);
    border: 1px solid #DDE3E8;
    position: relative;
    overflow: hidden;
    margin-bottom: 6px;
  }
  .pigora-photo-area svg { width: 44px; height: 44px; fill: rgba(255,255,255,0.85); position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); }
  .pigora-photo-area img { width: 100%; height: 100%; object-fit: cover; position: absolute; inset: 0; }

  .pigora-inner-label {
    border-top: 1px solid #E2E8F0;
    padding-top: 5px;
  }
  .pigora-inner-nama {
    font-size: 10.5px;
    font-weight: 800;
    color: var(--ink);
    text-transform: uppercase;
    letter-spacing: 0.02em;
    line-height: 1.2;
  }
  .pigora-inner-sub {
    font-size: 8.5px;
    color: var(--ink-soft);
    text-transform: uppercase;
    margin-top: 2px;
  }
  .pigora-inner-periode {
    font-size: 9px;
    font-weight: 700;
    color: var(--biru);
    margin-top: 2px;
  }

  /* Keterangan Di Luar / Di Bawah Pigora */
  .pigora-outer-label {
    margin-top: 10px;
    padding: 0 4px;
  }
  .pigora-outer-nama {
    font-size: 14px;
    font-weight: 800;
    color: var(--ink);
    line-height: 1.3;
  }
  .pigora-outer-periode {
    font-size: 12px;
    font-weight: 700;
    color: #2E7D32;
    margin-top: 3px;
  }

  /* Panah Ke Kanan antar pigora */
  .pigora-nav-arrow {
    font-size: 20px;
    color: #94A3B8;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  /* Animation & Hover Organogram modern */
  .org-node-kades {
    transition: transform .2s ease, box-shadow .2s ease;
  }
  .org-node-kades:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 24px rgba(11,59,96,0.28) !important;
  }
  .org-subcard {
    transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
  }
  .org-subcard:hover {
    transform: translateY(-3px);
    border-color: #1668A3 !important;
    box-shadow: 0 8px 18px rgba(22,104,163,0.14) !important;
  }

  /* RESPONSIVE ORGANOGRAM KHUSUS TAMPILAN MOBILE HP (< 640px) */
  @media (max-width: 640px) {
    .bagan-l2-wrap {
      flex-direction: column !important;
      gap: 20px !important;
    }
    .bagan-l2-col {
      width: 100% !important;
    }
    .bagan-center-line {
      display: none !important;
    }
    .bagan-top-bar {
      width: 80% !important;
    }
    .bagan-l3-wrap {
      display: grid !important;
      grid-template-columns: repeat(2, 1fr) !important;
      gap: 8px !important;
    }
    .bagan-sub-grid {
      gap: 6px !important;
    }
    .bagan-sub-card {
      padding: 8px 4px !important;
    }
    .bagan-sub-card div {
      white-space: normal !important;
      overflow: visible !important;
      text-overflow: clip !important;
      word-break: break-word !important;
    }
  }

  /* Tombol Geser Slider */
  .btn-pigora-nav {
    position: absolute;
    top: 45%;
    transform: translateY(-50%);
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: var(--biru-tua);
    color: #fff;
    border: none;
    cursor: pointer;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    transition: background 0.2s ease, transform 0.2s ease;
  }
  .btn-pigora-nav:hover { background: var(--biru); transform: translateY(-50%) scale(1.08); }
  .btn-pigora-nav.prev { left: 0; }
  .btn-pigora-nav.next { right: 0; }

  @media (max-width: 600px) {
    .pigora-slider-wrapper { padding: 0 20px; }
    .pigora-card-frame { width: 160px; }
    .pigora-photo-area { height: 140px; }
  }

  /* ============ PROFIL KADES & VISI MISI ============ */
  .sambutan-wrapper { display: flex; flex-direction: column; align-items: center; gap: 24px; padding: 10px 0; }
  @media (min-width: 768px) { .sambutan-wrapper { flex-direction: row; align-items: flex-start; gap: 36px; } }
  .kades-profile { display: flex; flex-direction: column; align-items: center; text-align: center; flex-shrink: 0; width: 240px; }
  .kades-photo-frame {
    width: 160px; height: 160px; border-radius: 50%; overflow: hidden; background: #e2e8f0;
    margin-bottom: 16px; border: 3px solid var(--paper); box-shadow: 0 4px 14px rgba(0,0,0,0.1);
  }
  .kades-photo-frame img { width: 100%; height: 100%; object-fit: cover; }
  .kades-name { font-size: 16px; font-weight: 800; color: var(--ink); margin-bottom: 4px; }
  .kades-title { font-size: 12px; font-weight: 600; color: var(--moss); margin-bottom: 16px; }
  .btn-biografi {
    display: inline-flex; align-items: center; gap: 8px; background: var(--moss); color: #fff;
    padding: 10px 20px; border-radius: 20px; font-size: 12.5px; font-weight: 600; text-decoration: none;
    box-shadow: 0 4px 10px rgba(30,70,32,0.25); transition: transform 0.2s ease, opacity 0.2s ease;
  }
  .btn-biografi:hover { transform: translateY(-1px); opacity: 0.95; color: #fff; }
  .sambutan-content { flex: 1; text-align: left; }
  .sambutan-title { font-size: 20px; font-weight: 800; color: var(--moss); margin-bottom: 16px; display: flex; align-items: flex-start; gap: 4px; }
  .sambutan-title::before { content: "\201C"; font-size: 36px; line-height: 18px; color: var(--moss); font-family: serif; }

  /* ============ STRUKTUR ORGANISASI (VERTIKAL FLOW) ============ */
  .bpd-badge{
    display:inline-flex; align-items:center; justify-content:center; gap:8px;
    margin:0 auto 8px; padding:9px 18px;
    background:linear-gradient(90deg, var(--clay), #A63D2C); color:#fff;
    border-radius:30px; box-shadow:0 6px 16px rgba(198,40,40,0.25);
    font-size:11px; font-weight:700; text-align:center; letter-spacing:.02em;
  }
  .bpd-arrow{
    text-align:center; color:var(--border); font-size:14px; margin-bottom:14px;
    font-family:'Plus Jakarta Sans',sans-serif; line-height:1;
  }

  .org-wrap{ display:flex; flex-direction:column; align-items:center; gap:0px; padding-top: 10px; }

  .org-kades{
    display:flex; flex-direction:column; align-items:center; gap:8px;
    background:linear-gradient(180deg, #fff 0%, #FFF9EB 100%);
    border:2px solid var(--amber); border-radius:14px; padding:0 0 12px;
    box-shadow:0 10px 24px rgba(212,160,23,0.20); cursor:pointer;
    transition:transform .2s ease, box-shadow .2s ease; margin-bottom:6px;
    width: 170px;
  }
  .org-kades:hover{ transform:translateY(-3px); box-shadow:0 14px 30px rgba(212,160,23,0.28); }

  /* CSS Panah Abu-Abu Elegan Sesuai Screenshot */
  .org-panah{
    display:flex; flex-direction:column; align-items:center; justify-content:center;
    margin: 16px 0 20px; gap:6px;
  }
  .org-panah svg{ width:18px; height:18px; stroke: #D1D5DB; stroke-width: 2.5; }
  .org-panah .ket{
    font-family:'Plus Jakarta Sans',sans-serif; font-size:10px; font-weight:700; color:var(--ink-soft);
    text-transform:uppercase; letter-spacing:.03em; margin-bottom: 4px;
  }
  
  .org-card{ position:relative; }
  .org-badge-bawahan{
    position:absolute; top:-5px; right:-5px; width:16px; height:16px; border-radius:50%;
    background:var(--moss); color:#fff; display:flex; align-items:center; justify-content:center;
    font-size:9px; font-weight:800; border:2px solid var(--paper-2); z-index:2;
  }

  .org-level{ width:100%; margin-bottom:6px; }
  .org-level-label{
    text-align:center; font-family:'Plus Jakarta Sans',sans-serif; font-size:11px; font-weight:700;
    text-transform:uppercase; letter-spacing:.06em; color:var(--ink-soft); margin-bottom:16px;
  }
  .org-grid{
    display:grid; grid-template-columns:repeat(auto-fit, minmax(130px, 1fr));
    gap:14px; max-width:680px; margin:0 auto; justify-content: center;
  }
  .org-grid.org-grid-sempit{ max-width:480px; }

  .org-card{
    display:flex; flex-direction:column; align-items:center; background:var(--paper-2);
    border:1px solid var(--border); border-radius:10px; overflow:hidden;
    box-shadow:0 3px 10px rgba(11,59,96,0.05); cursor:pointer;
    transition:transform .18s ease, box-shadow .18s ease, border-color .18s ease;
    width: 100%; height: 100%;
  }
  .org-card:hover{ transform:translateY(-3px); box-shadow:0 10px 20px rgba(11,59,96,0.13); border-color:var(--amber); }

  .org-avatar{
    width:34px; height:34px; border-radius:50%; background:linear-gradient(135deg, var(--biru), var(--ink));
    display:flex; align-items:center; justify-content:center; flex-shrink:0; position:relative; overflow:hidden;
    border:2px solid var(--paper-2); box-shadow:0 0 0 1.5px var(--border);
    margin:12px 0 8px;
  }
  .org-kades .org-avatar{ width:64px; height:64px; box-shadow:0 0 0 3px var(--amber); margin:16px 0 12px; }
  .org-avatar svg{ width:16px; height:16px; fill:#fff; }
  .org-kades .org-avatar svg{ width:28px; height:28px; }
  .org-avatar img{ position:absolute; inset:0; width:100%; height:100%; object-fit:cover; }

  .org-jabatan{
    width:100%; background:linear-gradient(90deg, var(--clay), #A63D2C); color:#fff;
    font-family:'Plus Jakarta Sans',sans-serif; font-size:8px; font-weight:700; text-transform:uppercase;
    letter-spacing:.03em; text-align:center; line-height:1.3; padding:8px 6px;
  }
  .org-kades .org-jabatan{
    background:linear-gradient(90deg, var(--amber), #B8890F); font-size:10px; padding:8px 10px;
    border-radius:0; margin-bottom:0;
  }
  .org-nama{ font-size:12px; font-weight:800; text-align:center; line-height:1.2; color:var(--ink); padding:4px 8px 16px; }
  .org-kades .org-nama{ font-size:16px; padding:4px 12px 16px; }

  @media (min-width:520px){
    .org-card{ padding:0; }
    .org-avatar{ width:48px; height:48px; margin:16px 0 10px;}
    .org-jabatan{ font-size:9px; }
    .org-nama{ font-size:13px; }
  }

  /* ============ POPUP & NAVIGASI ============ */
  .popup-overlay{
    display:none; position:fixed; inset:0; z-index:2000;
    background:rgba(46,42,31,0.78); align-items:center; justify-content:center; padding:20px;
  }
  .popup-overlay.show{display:flex;}
  .popup-box{
    background:var(--paper-2); border-radius:6px; max-width:320px; width:100%;
    padding:32px 24px 26px; text-align:center; position:relative;
  }
  .popup-close{
    position:absolute; top:12px; right:12px; background:var(--ink); color:var(--paper);
    border:none; width:28px; height:28px; border-radius:50%; cursor:pointer; font-size:13px;
  }
  .popup-avatar{
    width:72px; height:72px; border-radius:50%; background:var(--moss);
    display:flex; align-items:center; justify-content:center; margin:0 auto 14px;
    position:relative; overflow:hidden;
  }
  .popup-avatar svg{width:38px; height:38px; fill:var(--paper);}
  .popup-avatar img{ position:absolute; inset:0; width:100%; height:100%; object-fit:cover; border-radius:50%; }
  .popup-jabatan{
    font-family:'Plus Jakarta Sans',sans-serif; font-size:11px; font-weight:600; text-transform:uppercase;
    letter-spacing:.06em; color:var(--clay);
  }
  .popup-nama{font-family:'Plus Jakarta Sans',sans-serif; font-weight:800; font-size:20px; margin-top:6px;}
  .popup-note{font-size:12px; color:var(--ink-soft); margin-top:14px; font-style:italic;}
</style>
</head>
<body>

@include('partials.navbar', ['active' => 'profil'])

<main>

  <section class="section narrow" id="sejarah" style="margin-bottom:32px;">
    <div class="sejarah-title-left">
      <h2>Sejarah Desa Munungkerep</h2>
    </div>
    <div class="sejarah-wrapper">
      <img src="/images/sejarah.png" alt="Foto Sejarah Desa Munungkerep" class="sejarah-img" onerror="this.style.display='none'">
      <p style="font-size:14px; color:var(--ink); margin-bottom:16px;">Asal usul nama Desa Munungkerep diambil dari kata "Munung" dan "Kerep". Munung pada zaman dahulu adalah nama sebuah pohon, yaitu pohon Sriwikutil, sedangkan "Kerep" adalah bahasa Jawa yang dalam bahasa Indonesia berarti rapat atau banyak. Sehingga Munungkerep adalah suatu desa yang dahulu banyak berjajar-jajar pohon Sriwikutil.</p>
      <p style="font-size:14px; color:#4A4638; margin-bottom:16px;">Pada tahun 1721, ada seorang bernama Ki Suroyudo yang bersama istrinya hijrah ke hutan utara yang biasa disebut Hutan Guwo. Ki Suroyudo membuat sebuah pondok di Sendang Guwo tersebut, hingga akhirnya dikaruniai dua orang anak — satu laki-laki dan satu perempuan. Yang laki-laki diberi nama Singokerto, dan yang perempuan diberi nama Tumirah.</p>
      <p style="font-size:14px; color:#4A4638; margin-bottom:16px;">Ki Suroyudo memiliki seorang sahabat di Sendang Jambian bernama Kartojoyo. Pada masa itu, perjodohan dalam keluarga masih erat kaitannya dengan tradisi, sehingga anak Kartojoyo yang bernama Sumojoyo dijodohkan dengan Tumirah, sementara Singokerto dijodohkan dengan Dewi Asih. Dari pernikahan Singokerto dan Dewi Asih, lahirlah seorang anak bernama Wongsojoyo.</p>
      <p style="font-size:14px; color:#4A4638; margin-bottom:16px;">Warga akhirnya berkumpul di Alas Munung atas permintaan pemerintah Belanda, yang memerintahkan pegawai alas (mantri) untuk membuka sebuah desa di kawasan itu. Sebanyak 14 warga yang dipimpin oleh Ki Godek dan Bapak Mundu pun setuju untuk mulai membersihkan Alas Munung.</p>
      <p style="font-size:14px; color:#4A4638; margin-bottom:16px;">Selama masa pembersihan hutan, terjadi serangan ular. Karena Ki Godek juga dikenal sebagai orang sakti, ia mampu mengatasi gangguan tersebut. Namun, akibat serangan itu, Ki Suroyudo sempat menghentikan proses pembersihan Alas Munung. Ia kemudian bertapa bersama ketiga anaknya selama tujuh hari di Sendang Sumberan, di sebelah timur Dusun Munungkerep. Di sanalah mereka bertemu dengan Mbah Jenggot Surowijoyo, penguasa Sendang Sumberan.</p>
      <p style="font-size:14px; color:#4A4638; margin-bottom:16px;">Dari pertemuan tersebut, Mbah Jenggot Surowijoyo mengizinkan Ki Suroyudo bersama warga untuk melanjutkan pembersihan Alas Munung, dengan satu permintaan: setiap hari Jumat Pahing bulan Selo, warga harus membawa tumpengan ke Sendang Sumberan — berupa tumpeng, panggang ayam, jenang abang, jenang menir, dan jenang sengkolo — sebagai penanda telah berdirinya Desa Munungkerep.</p>
      <div class="note" style="font-style:italic; clear:both; margin-top:20px;">📖 Dituturkan oleh Bapak Supriyadi, Budayawan Desa Munungkerep (Dusun Munungkerep).</div>
    </div>
  </section>

  <!-- TIMELINE KEPEMIMPINAN DESA (SLIDER PIGORA CAROUSEL) -->
  <section class="section narrow" id="kepemimpinan" style="margin-bottom:32px;">
    <div class="card">
      <div class="section-head" style="margin-bottom: 12px; text-align: center;">
        <h2 style="font-size: clamp(22px, 4vw, 26px); font-weight: 800; color: var(--ink-2); display: inline-block; padding-bottom: 8px; border-bottom: 2px solid var(--biru-tua);">Timeline Kepemimpinan</h2>
      </div>

      <div class="pigora-slider-wrapper">
        <button class="btn-pigora-nav prev" onclick="geserPigora('kiri')" title="Geser Kiri"><i class="fas fa-chevron-left"></i></button>
        <button class="btn-pigora-nav next" onclick="geserPigora('kanan')" title="Geser Kanan"><i class="fas fa-chevron-right"></i></button>

        <div class="pigora-track" id="pigora-track">

          <!-- KADES 1 -->
          <div class="pigora-slider-item">
            <div class="pigora-card-frame">
              <div class="pigora-box-outer">
                <div class="pigora-box-inner">
                  <div class="pigora-photo-area">
                    <svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.5c-3.3 0-9.8 1.6-9.8 4.9v2.4h19.6v-2.4c0-3.3-6.5-4.9-9.8-4.9z"/></svg>
                  </div>
                  <div class="pigora-inner-label">
                    <div class="pigora-inner-nama">Jari</div>
                    <div class="pigora-inner-sub">Kepala Desa Munungkerep</div>
                    <div class="pigora-inner-periode">Periode Tahun 1927 - 1937</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="pigora-nav-arrow"><i class="fas fa-arrow-right"></i></div>
          </div>

          <!-- KADES 2 -->
          <div class="pigora-slider-item">
            <div class="pigora-card-frame">
              <div class="pigora-box-outer">
                <div class="pigora-box-inner">
                  <div class="pigora-photo-area">
                    <svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.5c-3.3 0-9.8 1.6-9.8 4.9v2.4h19.6v-2.4c0-3.3-6.5-4.9-9.8-4.9z"/></svg>
                  </div>
                  <div class="pigora-inner-label">
                    <div class="pigora-inner-nama">Joyo Soeparto</div>
                    <div class="pigora-inner-sub">Kepala Desa Munungkerep</div>
                    <div class="pigora-inner-periode">Periode Tahun 1938 - 1945</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="pigora-nav-arrow"><i class="fas fa-arrow-right"></i></div>
          </div>

          <!-- KADES 3 -->
          <div class="pigora-slider-item">
            <div class="pigora-card-frame">
              <div class="pigora-box-outer">
                <div class="pigora-box-inner">
                  <div class="pigora-photo-area">
                    <svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.5c-3.3 0-9.8 1.6-9.8 4.9v2.4h19.6v-2.4c0-3.3-6.5-4.9-9.8-4.9z"/></svg>
                  </div>
                  <div class="pigora-inner-label">
                    <div class="pigora-inner-nama">Kaseman</div>
                    <div class="pigora-inner-sub">Kepala Desa Munungkerep</div>
                    <div class="pigora-inner-periode">Periode Tahun 1945 - 1977</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="pigora-nav-arrow"><i class="fas fa-arrow-right"></i></div>
          </div>

          <!-- KADES 4 -->
          <div class="pigora-slider-item">
            <div class="pigora-card-frame">
              <div class="pigora-box-outer">
                <div class="pigora-box-inner">
                  <div class="pigora-photo-area">
                    <svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.5c-3.3 0-9.8 1.6-9.8 4.9v2.4h19.6v-2.4c0-3.3-6.5-4.9-9.8-4.9z"/></svg>
                  </div>
                  <div class="pigora-inner-label">
                    <div class="pigora-inner-nama">Sarto</div>
                    <div class="pigora-inner-sub">Kepala Desa Munungkerep</div>
                    <div class="pigora-inner-periode">Periode Tahun 1977 - 1985</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="pigora-nav-arrow"><i class="fas fa-arrow-right"></i></div>
          </div>

          <!-- KADES 5 -->
          <div class="pigora-slider-item">
            <div class="pigora-card-frame">
              <div class="pigora-box-outer">
                <div class="pigora-box-inner">
                  <div class="pigora-photo-area">
                    <svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.5c-3.3 0-9.8 1.6-9.8 4.9v2.4h19.6v-2.4c0-3.3-6.5-4.9-9.8-4.9z"/></svg>
                  </div>
                  <div class="pigora-inner-label">
                    <div class="pigora-inner-nama">Supriyatmo</div>
                    <div class="pigora-inner-sub">Kepala Desa Munungkerep</div>
                    <div class="pigora-inner-periode">Periode Tahun 1985 - 1993</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="pigora-nav-arrow"><i class="fas fa-arrow-right"></i></div>
          </div>

          <!-- KADES 6 -->
          <div class="pigora-slider-item">
            <div class="pigora-card-frame">
              <div class="pigora-box-outer">
                <div class="pigora-box-inner">
                  <div class="pigora-photo-area">
                    <svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.5c-3.3 0-9.8 1.6-9.8 4.9v2.4h19.6v-2.4c0-3.3-6.5-4.9-9.8-4.9z"/></svg>
                  </div>
                  <div class="pigora-inner-label">
                    <div class="pigora-inner-nama">Suwito</div>
                    <div class="pigora-inner-sub">Kepala Desa Munungkerep</div>
                    <div class="pigora-inner-periode">Periode Tahun 1993 - 2002</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="pigora-nav-arrow"><i class="fas fa-arrow-right"></i></div>
          </div>

          <!-- KADES 7 -->
          <div class="pigora-slider-item">
            <div class="pigora-card-frame">
              <div class="pigora-box-outer">
                <div class="pigora-box-inner">
                  <div class="pigora-photo-area">
                    <svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.5c-3.3 0-9.8 1.6-9.8 4.9v2.4h19.6v-2.4c0-3.3-6.5-4.9-9.8-4.9z"/></svg>
                    <img src="/images/perangkat/kepala desa.png" alt="Sutrismi" onerror="this.remove()">
                  </div>
                  <div class="pigora-inner-label">
                    <div class="pigora-inner-nama">Sutrismi</div>
                    <div class="pigora-inner-sub">Kepala Desa Munungkerep</div>
                    <div class="pigora-inner-periode">Periode Tahun 2003 - 2013</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="pigora-nav-arrow"><i class="fas fa-arrow-right"></i></div>
          </div>

          <!-- KADES 8 -->
          <div class="pigora-slider-item">
            <div class="pigora-card-frame">
              <div class="pigora-box-outer">
                <div class="pigora-box-inner">
                  <div class="pigora-photo-area">
                    <svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.5c-3.3 0-9.8 1.6-9.8 4.9v2.4h19.6v-2.4c0-3.3-6.5-4.9-9.8-4.9z"/></svg>
                  </div>
                  <div class="pigora-inner-label">
                    <div class="pigora-inner-nama">Suroso</div>
                    <div class="pigora-inner-sub">Kepala Desa Munungkerep</div>
                    <div class="pigora-inner-periode">Periode Tahun 2013 - 2019</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="pigora-nav-arrow"><i class="fas fa-arrow-right"></i></div>
          </div>

          <!-- KADES 9 (PETAHANA) -->
          <div class="pigora-slider-item aktif">
            <div class="pigora-card-frame">
              <div class="pigora-box-outer">
                <div class="pigora-box-inner">
                  <div class="pigora-photo-area">
                    <svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.5c-3.3 0-9.8 1.6-9.8 4.9v2.4h19.6v-2.4c0-3.3-6.5-4.9-9.8-4.9z"/></svg>
                    <img src="/images/perangkat/kepala desa.png" alt="Sutrismi" onerror="this.remove()">
                  </div>
                  <div class="pigora-inner-label">
                    <div class="pigora-inner-nama">Sutrismi</div>
                    <div class="pigora-inner-sub">Kepala Desa Munungkerep</div>
                    <div class="pigora-inner-periode" style="color:var(--amber);">Periode 2019 - Sekarang</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  <section class="section narrow" id="pemerintahan" style="margin-bottom:24px;">
    <div class="section-head">
      <h2>Pemerintahan Desa</h2>
    </div>

    @php
      $p = $perangkat ?? [];
      $kades = $p['kades'] ?? ['jabatan'=>'Kepala Desa','nama'=>'Sutrismi','foto'=>'/images/perangkat/kepala desa.png','note'=>'Kepala Desa Munungkerep memimpin dan bertanggung jawab atas seluruh penyelenggaraan pemerintahan desa.'];
      $sekdes = $p['sekdes'] ?? ['jabatan'=>'Sekretaris Desa','nama'=>'Siswanto','foto'=>'/images/perangkat/siswanto.jpg','note'=>'Sekretaris Desa memimpin Sekretariat Desa dan membantu Kepala Desa dalam administrasi dan pelayanan.'];
      $kasi_kesra = $p['kasi_kesra'] ?? ['jabatan'=>'Kasi Kesra','nama'=>'Rusdi','foto'=>'/images/perangkat/rusdi.jpg','note'=>'Kepala Seksi Kesejahteraan Rakyat memimpin kegiatan keagamaan, sosial, dan kesejahteraan warga desa.'];
      $kasi_pelayanan = $p['kasi_pelayanan'] ?? ['jabatan'=>'Kasi Pelayanan','nama'=>'Sugito','foto'=>'/images/perangkat/sugito.jpg','note'=>'Kepala Seksi Pelayanan mengelola dan melayani permohonan surat-menyurat serta administrasi kependudukan.'];
      $kasi_pemerintahan = $p['kasi_pemerintahan'] ?? ['jabatan'=>'Kasi Pemerintahan','nama'=>'Suyatemo','foto'=>'/images/perangkat/suyatemo.jpg','note'=>'Kepala Seksi Pemerintahan mengelola administrasi pertanahan, ketentraman, dan ketertiban umum.'];
      $kaur_tu = $p['kaur_tu'] ?? ['jabatan'=>'Kaur TU & Umum','nama'=>'Suntari','foto'=>'/images/perangkat/suntari.jpg','note'=>'Kepala Urusan Tata Usaha & Umum mengelola urusan persuratan, kearsipan, dan inventaris desa.'];
      $kaur_keuangan = $p['kaur_keuangan'] ?? ['jabatan'=>'Kaur Keuangan','nama'=>'Agus Sukisno','foto'=>'/images/perangkat/agus-sukisno.jpg','note'=>'Kepala Urusan Keuangan mengelola administrasi pembukuan dan keuangan APBDes Munungkerep.'];
      $kaur_perencanaan = $p['kaur_perencanaan'] ?? ['jabatan'=>'Kaur Perencanaan','nama'=>'Iskan','foto'=>'/images/perangkat/iskan.jpg','note'=>'Kepala Urusan Perencanaan mengelola penyusunan RKPDes dan laporan berkala.'];
      $kasun_1 = $p['kasun_1'] ?? ['jabatan'=>'Kadus Munungkerep','nama'=>'Juni Hadi','foto'=>'/images/perangkat/juni-hadi.jpg','note'=>'Kepala Dusun Munungkerep membina ketentraman dan pelayanan warga di wilayah Dusun Munungkerep.'];
      $kasun_2 = $p['kasun_2'] ?? ['jabatan'=>'Kadus Karanggebang & Slumbung','nama'=>'Heru Purnadi','foto'=>'/images/perangkat/heru-purnadi.jpg','note'=>'Kepala Dusun Karanggebang & Slumbung membina ketentraman dan pelayanan warga di Dusun Karanggebang & Slumbung.'];
      $kasun_3 = $p['kasun_3'] ?? ['jabatan'=>'Kadus Kadenan & Jatirubuh','nama'=>'Wagimin','foto'=>'/images/perangkat/wagimin.jpg','note'=>'Kepala Dusun Kadenan & Jatirubuh membina ketentraman dan pelayanan warga di Dusun Kadenan & Jatirubuh.'];
      $kasun_4 = $p['kasun_4'] ?? ['jabatan'=>'Kadus Kalipang & Duren','nama'=>'Hartatik','foto'=>'/images/perangkat/hartatik.jpg','note'=>'Kepala Dusun Kalipang & Duren membina ketentraman dan pelayanan warga di Dusun Kalipang & Duren.'];
    @endphp

    <div class="card" id="visimisi" style="margin-bottom:24px;">
      <div class="sambutan-wrapper">
        <div class="kades-profile">
          <div class="kades-photo-frame">
            <img src="{{ $kades['foto'] }}" alt="{{ $kades['nama'] }}" onerror="this.parentElement.style.display='none'">
          </div>
          <div class="kades-name">{{ $kades['nama'] }}</div>
          <div class="kades-title">{{ $kades['jabatan'] }} Munungkerep</div>
          <a href="javascript:void(0)" class="btn-biografi" onclick="bukaPopupOrang('{{ addslashes($kades['jabatan']) }}', '{{ addslashes($kades['nama']) }}', '{{ addslashes($kades['foto']) }}', '{{ addslashes($kades['note']) }}')">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            Profil Singkat
          </a>
        </div>
        <div class="sambutan-content">
          <h3 class="sambutan-title">Visi & Misi</h3>
          <p style="font-family:'Plus Jakarta Sans',sans-serif; font-size:10.5px; font-weight:700; text-transform:uppercase; letter-spacing:.08em; color:var(--clay); margin-bottom:8px;">Visi Desa</p>
          <p style="font-family:'Plus Jakarta Sans',sans-serif; font-weight:800; font-size:16px; line-height:1.5; color:var(--ink); margin-bottom:20px; font-style:italic;">
            "Mewujudkan Masyarakat Desa Munungkerep Sejahtera untuk Semua"
          </p>
          <p style="font-family:'Plus Jakarta Sans',sans-serif; font-size:10.5px; font-weight:700; text-transform:uppercase; letter-spacing:.08em; color:var(--clay); margin-bottom:12px;">Misi Desa</p>
          <ol style="padding-left:18px; display:flex; flex-direction:column; gap:10px;">
            <li style="font-size:13px; line-height:1.55; color:var(--ink-soft);">Menyelenggarakan Pemerintah Desa yang efisien, efektif, dan bersih dengan mengutamakan masyarakat.</li>
            <li style="font-size:13px; line-height:1.55; color:var(--ink-soft);">Meningkatkan pembangunan Desa Munungkerep di segala bidang dan aspek.</li>
            <li style="font-size:13px; line-height:1.55; color:var(--ink-soft);">Meningkatkan kualitas sumber daya manusia dalam pembangunan desa yang berkelanjutan.</li>
            <li style="font-size:13px; line-height:1.55; color:var(--ink-soft);">Mengembangkan pemberdayaan masyarakat dan kemitraan dalam pelaksanaan pembangunan desa.</li>
            <li style="font-size:13px; line-height:1.55; color:var(--ink-soft);">Menciptakan rasa aman dan tentram dari segala macam keadaan.</li>
          </ol>
        </div>
      </div>
    </div>

    <!-- BAGAN SUSUNAN ORGANISASI DAN TATA KERJA PEMERINTAHAN DESA MUNUNGKEREP -->
    <div class="card" style="padding:28px 12px; overflow: hidden;">
      <div style="text-align: center; margin-bottom: 24px;">
        <div style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.08em; color: var(--clay, #C62828); margin-bottom: 4px;">Bagan Struktur Organisasi</div>
        <h3 style="font-size: clamp(16px, 3.5vw, 20px); font-weight: 800; color: var(--ink); margin-bottom: 4px;">BAGAN SUSUNAN ORGANISASI DAN TATA KERJA PEMERINTAHAN DESA MUNUNGKEREP</h3>
        <p style="font-size: 12px; color: var(--ink-soft);">Bagan Resmi Hubungan Kerja, Garis Komando, dan Garis Koordinasi</p>
      </div>

      <!-- FLUID RESPONSIVE CONTAINER -->
      <div style="width: 100%; max-width: 100%; margin: 0 auto; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif;" class="bagan-official-wrap">

        <!-- LEVEL 1: BPD & KEPALA DESA -->
        <div style="display: flex; justify-content: center; align-items: center; gap: clamp(12px, 3vw, 36px); position: relative; margin-bottom: 0;">
          
          <!-- NODE BPD -->
          <div style="position: relative; flex: 0 1 190px;">
            <div style="border: 2px dashed #0B3B60; background: #F8FAFC; border-radius: 8px; padding: 8px 10px; text-align: center;">
              <div style="font-size: 13px; font-weight: 800; color: var(--ink);">BPD</div>
              <div style="font-size: 10px; color: var(--ink-soft); font-weight: 600;">(Badan Permusyawaratan Desa)</div>
            </div>
            <!-- Garis Putus-putus Koordinasi ke Kades -->
            <div style="position: absolute; top: 50%; right: calc(-1 * clamp(12px, 3vw, 36px)); width: clamp(12px, 3vw, 36px); height: 0; border-top: 2px dashed #0B3B60; transform: translateY(-50%);"></div>
          </div>

          <!-- NODE KEPALA DESA -->
          <div style="flex: 0 1 230px;" onclick="bukaPopupOrang('{{ addslashes($kades['jabatan']) }}', '{{ addslashes($kades['nama']) }}', '{{ addslashes($kades['foto']) }}', '{{ addslashes($kades['note']) }}')">
            <div style="background: var(--ink, #0B3B60); color: #fff; border: 2px solid var(--amber, #D4A017); border-radius: 8px; padding: 8px 12px; text-align: center; cursor: pointer; box-shadow: 0 4px 14px rgba(11,59,96,0.15);" class="org-subcard">
              <div style="font-size: 9.5px; font-weight: 800; text-transform: uppercase; color: var(--amber); letter-spacing: 0.05em; margin-bottom: 2px;">{{ $kades['jabatan'] }}</div>
              <div style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                <div style="width: 34px; height: 34px; border-radius: 50%; border: 2px solid var(--amber); overflow: hidden; background: #fff; flex-shrink: 0;">
                  <img src="{{ $kades['foto'] }}" alt="{{ $kades['nama'] }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.remove()">
                </div>
                <div style="text-align: left;">
                  <div style="font-size: 13.5px; font-weight: 800; color: #fff;">{{ $kades['nama'] }}</div>
                  <div style="font-size: 10.5px; color: rgba(255,255,255,0.85);">{{ $kades['jabatan'] }}</div>
                </div>
              </div>
            </div>
          </div>

        </div>

        <!-- GARIS VERTIKAL UTAMA TURUN DARI KEPALA DESA -->
        <div style="width: 2px; height: 26px; background: #0B3B60; margin: 0 auto;"></div>

        <!-- GARIS HORISONTAL PERCABANGAN -->
        <div style="position: relative; width: 50%; margin: 0 auto; height: 26px;" class="bagan-top-bar">
          <div style="height: 2px; background: #0B3B60; width: 100%;"></div>
          <div style="position: absolute; left: 0; top: 0; width: 2px; height: 26px; background: #0B3B60;"></div>
          <div style="position: absolute; right: 0; top: 0; width: 2px; height: 26px; background: #0B3B60;"></div>
        </div>

        <!-- LEVEL 2: PELAKSANA TEKNIS & SEKRETARIS DESA -->
        <div style="display: flex; justify-content: space-between; gap: 12px; width: 100%; margin: 0 auto; position: relative; z-index: 2;" class="bagan-l2-wrap">
          <div style="position: absolute; left: 50%; top: -26px; bottom: -40px; width: 2px; background: #0B3B60; transform: translateX(-50%); z-index: 1;" class="bagan-center-line"></div>
          
          <!-- BRANCH KIRI: PELAKSANA TEKNIS -->
          <div style="flex: 1; text-align: center; min-width: 0;" class="bagan-l2-col">
            <div style="width: 100%; max-width: 200px; margin: 0 auto; background: #1668A3; color: #fff; border-radius: 6px; padding: 6px 8px; font-weight: 800; font-size: 12px; text-transform: uppercase; box-shadow: 0 2px 8px rgba(22,104,163,0.15);">
              Pelaksana Teknis
            </div>

            <div style="width: 2px; height: 22px; background: #0B3B60; margin: 0 auto;"></div>

            <div style="position: relative; width: 66%; margin: 0 auto; height: 22px;">
              <div style="height: 2px; background: #0B3B60; width: 100%;"></div>
              <div style="position: absolute; left: 0; top: 0; width: 2px; height: 22px; background: #0B3B60;"></div>
              <div style="position: absolute; left: 50%; top: 0; width: 2px; height: 22px; background: #0B3B60; transform: translateX(-50%);"></div>
              <div style="position: absolute; right: 0; top: 0; width: 2px; height: 22px; background: #0B3B60;"></div>
            </div>

            <!-- 3 KASI CARDS -->
            <div style="display: flex; justify-content: space-between; gap: 4px; width: 100%;" class="bagan-sub-grid">
              <!-- Kasi Kesra -->
              <div style="flex: 1; min-width: 0; border: 1.5px solid #0B3B60; background: #fff; border-radius: 6px; padding: 6px 2px; text-align: center; cursor: pointer;" onclick="bukaPopupOrang('{{ addslashes($kasi_kesra['jabatan']) }}', '{{ addslashes($kasi_kesra['nama']) }}', '{{ addslashes($kasi_kesra['foto']) }}', '{{ addslashes($kasi_kesra['note']) }}')" class="org-subcard bagan-sub-card">
                <div style="width: 28px; height: 28px; border-radius: 50%; border: 1.5px solid #1668A3; overflow: hidden; margin: 0 auto 3px; background: #F4F6F8;">
                  <img src="{{ $kasi_kesra['foto'] }}" alt="{{ $kasi_kesra['nama'] }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.remove()">
                </div>
                <div style="font-size: 10px; font-weight: 800; color: #1668A3; line-height: 1.2;">{{ $kasi_kesra['jabatan'] }}</div>
                <div style="font-size: 10px; font-weight: 700; color: var(--ink);">{{ $kasi_kesra['nama'] }}</div>
              </div>

              <!-- Kasi Pelayanan -->
              <div style="flex: 1; min-width: 0; border: 1.5px solid #0B3B60; background: #fff; border-radius: 6px; padding: 6px 2px; text-align: center; cursor: pointer;" onclick="bukaPopupOrang('{{ addslashes($kasi_pelayanan['jabatan']) }}', '{{ addslashes($kasi_pelayanan['nama']) }}', '{{ addslashes($kasi_pelayanan['foto']) }}', '{{ addslashes($kasi_pelayanan['note']) }}')" class="org-subcard bagan-sub-card">
                <div style="width: 28px; height: 28px; border-radius: 50%; border: 1.5px solid #1668A3; overflow: hidden; margin: 0 auto 3px; background: #F4F6F8;">
                  <img src="{{ $kasi_pelayanan['foto'] }}" alt="{{ $kasi_pelayanan['nama'] }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.remove()">
                </div>
                <div style="font-size: 10px; font-weight: 800; color: #1668A3; line-height: 1.2;">{{ $kasi_pelayanan['jabatan'] }}</div>
                <div style="font-size: 10px; font-weight: 700; color: var(--ink);">{{ $kasi_pelayanan['nama'] }}</div>
              </div>

              <!-- Kasi Pemerintahan -->
              <div style="flex: 1; min-width: 0; border: 1.5px solid #0B3B60; background: #fff; border-radius: 6px; padding: 6px 2px; text-align: center; cursor: pointer;" onclick="bukaPopupOrang('{{ addslashes($kasi_pemerintahan['jabatan']) }}', '{{ addslashes($kasi_pemerintahan['nama']) }}', '{{ addslashes($kasi_pemerintahan['foto']) }}', '{{ addslashes($kasi_pemerintahan['note']) }}')" class="org-subcard bagan-sub-card">
                <div style="width: 28px; height: 28px; border-radius: 50%; border: 1.5px solid #1668A3; overflow: hidden; margin: 0 auto 3px; background: #F4F6F8;">
                  <img src="{{ $kasi_pemerintahan['foto'] }}" alt="{{ $kasi_pemerintahan['nama'] }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.remove()">
                </div>
                <div style="font-size: 10px; font-weight: 800; color: #1668A3; line-height: 1.2;">{{ $kasi_pemerintahan['jabatan'] }}</div>
                <div style="font-size: 10px; font-weight: 700; color: var(--ink);">{{ $kasi_pemerintahan['nama'] }}</div>
              </div>
            </div>
          </div>

          <!-- BRANCH KANAN: SEKRETARIS DESA -->
          <div style="flex: 1; text-align: center; min-width: 0;" class="bagan-l2-col">
            <!-- Sekdes Card -->
            <div style="width: 100%; max-width: 200px; margin: 0 auto; background: #fff; border: 2px solid #0B3B60; border-radius: 6px; padding: 5px 8px; font-weight: 800; cursor: pointer; box-shadow: 0 2px 8px rgba(0,0,0,0.04);" onclick="bukaPopupOrang('{{ addslashes($sekdes['jabatan']) }}', '{{ addslashes($sekdes['nama']) }}', '{{ addslashes($sekdes['foto']) }}', '{{ addslashes($sekdes['note']) }}')" class="org-subcard bagan-sub-card">
              <div style="display: flex; align-items: center; justify-content: center; gap: 6px;">
                <div style="width: 28px; height: 28px; border-radius: 50%; border: 1.5px solid #1668A3; overflow: hidden; background: #F4F6F8; flex-shrink: 0;">
                  <img src="{{ $sekdes['foto'] }}" alt="{{ $sekdes['nama'] }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.remove()">
                </div>
                <div style="text-align: left;">
                  <div style="font-size: 11px; font-weight: 800; color: var(--ink); line-height: 1.1;">{{ $sekdes['jabatan'] }}</div>
                  <div style="font-size: 10px; color: #1668A3; font-weight: 700;">{{ $sekdes['nama'] }}</div>
                </div>
              </div>
            </div>

            <div style="width: 2px; height: 22px; background: #0B3B60; margin: 0 auto;"></div>

            <div style="position: relative; width: 66%; margin: 0 auto; height: 22px;">
              <div style="height: 2px; background: #0B3B60; width: 100%;"></div>
              <div style="position: absolute; left: 0; top: 0; width: 2px; height: 22px; background: #0B3B60;"></div>
              <div style="position: absolute; left: 50%; top: 0; width: 2px; height: 22px; background: #0B3B60; transform: translateX(-50%);"></div>
              <div style="position: absolute; right: 0; top: 0; width: 2px; height: 22px; background: #0B3B60;"></div>
            </div>

            <!-- 3 KAUR CARDS -->
            <div style="display: flex; justify-content: space-between; gap: 4px; width: 100%;" class="bagan-sub-grid">
              <!-- Kaur TU & Umum -->
              <div style="flex: 1; min-width: 0; border: 1.5px solid #0B3B60; background: #fff; border-radius: 6px; padding: 6px 2px; text-align: center; cursor: pointer;" onclick="bukaPopupOrang('{{ addslashes($kaur_tu['jabatan']) }}', '{{ addslashes($kaur_tu['nama']) }}', '{{ addslashes($kaur_tu['foto']) }}', '{{ addslashes($kaur_tu['note']) }}')" class="org-subcard bagan-sub-card">
                <div style="width: 28px; height: 28px; border-radius: 50%; border: 1.5px solid #1668A3; overflow: hidden; margin: 0 auto 3px; background: #F4F6F8;">
                  <img src="{{ $kaur_tu['foto'] }}" alt="{{ $kaur_tu['nama'] }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.remove()">
                </div>
                <div style="font-size: 10px; font-weight: 800; color: var(--ink); line-height: 1.2;">{{ $kaur_tu['jabatan'] }}</div>
                <div style="font-size: 10px; font-weight: 700; color: var(--ink-soft);">{{ $kaur_tu['nama'] }}</div>
              </div>

              <!-- Kaur Keuangan -->
              <div style="flex: 1; min-width: 0; border: 1.5px solid #0B3B60; background: #fff; border-radius: 6px; padding: 6px 2px; text-align: center; cursor: pointer;" onclick="bukaPopupOrang('{{ addslashes($kaur_keuangan['jabatan']) }}', '{{ addslashes($kaur_keuangan['nama']) }}', '{{ addslashes($kaur_keuangan['foto']) }}', '{{ addslashes($kaur_keuangan['note']) }}')" class="org-subcard bagan-sub-card">
                <div style="width: 28px; height: 28px; border-radius: 50%; border: 1.5px solid #1668A3; overflow: hidden; margin: 0 auto 3px; background: #F4F6F8;">
                  <img src="{{ $kaur_keuangan['foto'] }}" alt="{{ $kaur_keuangan['nama'] }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.remove()">
                </div>
                <div style="font-size: 10px; font-weight: 800; color: var(--ink); line-height: 1.2;">{{ $kaur_keuangan['jabatan'] }}</div>
                <div style="font-size: 10px; font-weight: 700; color: var(--ink-soft);">{{ $kaur_keuangan['nama'] }}</div>
              </div>

              <!-- Kaur Perencanaan -->
              <div style="flex: 1; min-width: 0; border: 1.5px solid #0B3B60; background: #fff; border-radius: 6px; padding: 6px 2px; text-align: center; cursor: pointer;" onclick="bukaPopupOrang('{{ addslashes($kaur_perencanaan['jabatan']) }}', '{{ addslashes($kaur_perencanaan['nama']) }}', '{{ addslashes($kaur_perencanaan['foto']) }}', '{{ addslashes($kaur_perencanaan['note']) }}')" class="org-subcard bagan-sub-card">
                <div style="width: 28px; height: 28px; border-radius: 50%; border: 1.5px solid #1668A3; overflow: hidden; margin: 0 auto 3px; background: #F4F6F8;">
                  <img src="{{ $kaur_perencanaan['foto'] }}" alt="{{ $kaur_perencanaan['nama'] }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.remove()">
                </div>
                <div style="font-size: 10px; font-weight: 800; color: var(--ink); line-height: 1.2;">{{ $kaur_perencanaan['jabatan'] }}</div>
                <div style="font-size: 10px; font-weight: 700; color: var(--ink-soft);">{{ $kaur_perencanaan['nama'] }}</div>
              </div>
            </div>

          </div>

        </div>

        <!-- LEVEL 3: KASUN NODES -->
        <div style="margin-top: 40px; position: relative;">
          <div style="position: relative; width: 75%; margin: 0 auto; height: 22px;">
            <div style="height: 2px; background: #0B3B60; width: 100%;"></div>
            <div style="position: absolute; left: 0; top: 0; width: 2px; height: 22px; background: #0B3B60;"></div>
            <div style="position: absolute; left: 33.3%; top: 0; width: 2px; height: 22px; background: #0B3B60;"></div>
            <div style="position: absolute; left: 66.6%; top: 0; width: 2px; height: 22px; background: #0B3B60;"></div>
            <div style="position: absolute; right: 0; top: 0; width: 2px; height: 22px; background: #0B3B60;"></div>
          </div>

          <!-- 4 KASUN CARDS -->
          <div style="display: flex; justify-content: space-between; gap: 6px; width: 100%;" class="bagan-l3-wrap">
            <!-- Kasun 1 -->
            <div style="flex: 1; min-width: 0; border: 1.5px solid #0B3B60; background: #fff; border-radius: 6px; padding: 6px 2px; text-align: center; cursor: pointer;" onclick="bukaPopupOrang('{{ addslashes($kasun_1['jabatan']) }}', '{{ addslashes($kasun_1['nama']) }}', '{{ addslashes($kasun_1['foto']) }}', '{{ addslashes($kasun_1['note']) }}')" class="org-subcard bagan-sub-card">
              <div style="width: 28px; height: 28px; border-radius: 50%; border: 1.5px solid #52633B; overflow: hidden; margin: 0 auto 3px; background: #F4F6F8;">
                <img src="{{ $kasun_1['foto'] }}" alt="{{ $kasun_1['nama'] }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.remove()">
              </div>
              <div style="font-size: 10.5px; font-weight: 800; color: var(--ink);">KASUN</div>
              <div style="font-size: 10px; color: var(--ink-soft); font-weight: 600;">{{ $kasun_1['nama'] }}</div>
              <div style="font-size: 9px; color: #52633B; font-weight: 700;">{{ str_replace('Kadus ', '', $kasun_1['jabatan']) }}</div>
            </div>

            <!-- Kasun 2 -->
            <div style="flex: 1; min-width: 0; border: 1.5px solid #0B3B60; background: #fff; border-radius: 6px; padding: 6px 2px; text-align: center; cursor: pointer;" onclick="bukaPopupOrang('{{ addslashes($kasun_2['jabatan']) }}', '{{ addslashes($kasun_2['nama']) }}', '{{ addslashes($kasun_2['foto']) }}', '{{ addslashes($kasun_2['note']) }}')" class="org-subcard bagan-sub-card">
              <div style="width: 28px; height: 28px; border-radius: 50%; border: 1.5px solid #52633B; overflow: hidden; margin: 0 auto 3px; background: #F4F6F8;">
                <img src="{{ $kasun_2['foto'] }}" alt="{{ $kasun_2['nama'] }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.remove()">
              </div>
              <div style="font-size: 10.5px; font-weight: 800; color: var(--ink);">KASUN</div>
              <div style="font-size: 10px; color: var(--ink-soft); font-weight: 600;">{{ $kasun_2['nama'] }}</div>
              <div style="font-size: 9px; color: #52633B; font-weight: 700;">{{ str_replace('Kadus ', '', $kasun_2['jabatan']) }}</div>
            </div>

            <!-- Kasun 3 -->
            <div style="flex: 1; min-width: 0; border: 1.5px solid #0B3B60; background: #fff; border-radius: 6px; padding: 6px 2px; text-align: center; cursor: pointer;" onclick="bukaPopupOrang('{{ addslashes($kasun_3['jabatan']) }}', '{{ addslashes($kasun_3['nama']) }}', '{{ addslashes($kasun_3['foto']) }}', '{{ addslashes($kasun_3['note']) }}')" class="org-subcard bagan-sub-card">
              <div style="width: 28px; height: 28px; border-radius: 50%; border: 1.5px solid #52633B; overflow: hidden; margin: 0 auto 3px; background: #F4F6F8;">
                <img src="{{ $kasun_3['foto'] }}" alt="{{ $kasun_3['nama'] }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.remove()">
              </div>
              <div style="font-size: 10.5px; font-weight: 800; color: var(--ink);">KASUN</div>
              <div style="font-size: 10px; color: var(--ink-soft); font-weight: 600;">{{ $kasun_3['nama'] }}</div>
              <div style="font-size: 9px; color: #52633B; font-weight: 700;">{{ str_replace('Kadus ', '', $kasun_3['jabatan']) }}</div>
            </div>

            <!-- Kasun 4 -->
            <div style="flex: 1; min-width: 0; border: 1.5px solid #0B3B60; background: #fff; border-radius: 6px; padding: 6px 2px; text-align: center; cursor: pointer;" onclick="bukaPopupOrang('{{ addslashes($kasun_4['jabatan']) }}', '{{ addslashes($kasun_4['nama']) }}', '{{ addslashes($kasun_4['foto']) }}', '{{ addslashes($kasun_4['note']) }}')" class="org-subcard bagan-sub-card">
              <div style="width: 28px; height: 28px; border-radius: 50%; border: 1.5px solid #52633B; overflow: hidden; margin: 0 auto 3px; background: #F4F6F8;">
                <img src="{{ $kasun_4['foto'] }}" alt="{{ $kasun_4['nama'] }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.remove()">
              </div>
              <div style="font-size: 10.5px; font-weight: 800; color: var(--ink);">KASUN</div>
              <div style="font-size: 10px; color: var(--ink-soft); font-weight: 600;">{{ $kasun_4['nama'] }}</div>
              <div style="font-size: 9px; color: #52633B; font-weight: 700;">{{ str_replace('Kadus ', '', $kasun_4['jabatan']) }}</div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <!-- AKHIR STRUKTUR ORGANISASI VERTIKAL -->

  </section>
</main>

@include('partials.footer')

<div class="popup-overlay" id="popup-overlay" onclick="tutupPopupOrang(event)">
  <div class="popup-box">
    <button class="popup-close" onclick="tutupPopupOrang()">✕</button>
    <div class="popup-avatar" id="popup-avatar"><svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.5c-3.3 0-9.8 1.6-9.8 4.9v2.4h19.6v-2.4c0-3.3-6.5-4.9-9.8-4.9z"/></svg></div>
    <div class="popup-jabatan" id="popup-jabatan">Jabatan</div>
    <div class="popup-nama" id="popup-nama">Nama</div>
    <div class="popup-note">📝 Foto &amp; profil singkat menyusul</div>
  </div>
</div>

<script>
  // Logika Geser Slider Pigora Kepemimpinan
  function geserPigora(arah) {
    const track = document.getElementById('pigora-track');
    if (!track) return;
    const jarak = 240;
    if (arah === 'kanan') {
      track.scrollBy({ left: jarak, behavior: 'smooth' });
    } else {
      track.scrollBy({ left: -jarak, behavior: 'smooth' });
    }
  }

  // Support Mouse Drag untuk scroll horizontal
  (function(){
    const track = document.getElementById('pigora-track');
    if (!track) return;
    let isDown = false;
    let startX;
    let scrollLeft;

    track.addEventListener('mousedown', (e) => {
      isDown = true;
      startX = e.pageX - track.offsetLeft;
      scrollLeft = track.scrollLeft;
    });
    track.addEventListener('mouseleave', () => { isDown = false; });
    track.addEventListener('mouseup', () => { isDown = false; });
    track.addEventListener('mousemove', (e) => {
      if (!isDown) return;
      e.preventDefault();
      const x = e.pageX - track.offsetLeft;
      const walk = (x - startX) * 1.8;
      track.scrollLeft = scrollLeft - walk;
    });
  })();

  function pindahHalus(event, url){
    event.preventDefault();
    document.body.style.transition = 'opacity .25s ease, transform .25s ease';
    document.body.style.opacity = '0';
    document.body.style.transform = 'translateY(-6px)';
    setTimeout(() => { window.location.href = url; }, 220);
    return false;
  }

  function bukaPopupOrang(jabatan, nama, pathFoto, note){
    document.getElementById('popup-jabatan').textContent = jabatan;
    document.getElementById('popup-nama').textContent = nama;
    const noteEl = document.querySelector('.popup-note');
    if (noteEl) noteEl.textContent = note || '📝 Profil singkat belum diatur.';

    const avatar = document.getElementById('popup-avatar');
    const imgLama = avatar.querySelector('img');
    if (imgLama) imgLama.remove();

    if (pathFoto){
      const img = document.createElement('img');
      img.alt = nama;
      img.onerror = function(){ this.remove(); };
      img.src = pathFoto;
      avatar.appendChild(img);
    }

    document.getElementById('popup-overlay').classList.add('show');
  }
  function tutupPopupOrang(event){
    if (event && event.target !== event.currentTarget && !event.target.classList.contains('popup-close')) return;
    document.getElementById('popup-overlay').classList.remove('show');
  }
</script>
</body>
</html>