<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Profil pemerintahan, geografis, dan demografis Desa Munungkerep, Kecamatan Kabuh, Kabupaten Jombang.">
<title>Profil Desa Munungkerep</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
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
  html{ scroll-behavior:smooth; }
  body{
    font-family:'Plus Jakarta Sans',sans-serif; background:var(--paper); color:var(--ink);
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
  @media (max-width: 640px) { .sejarah-img { float: none; max-width: 100%; margin: 0 0 20px 0; } }

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

  /* ============ STRUKTUR ORGANISASI (MIRIP PAPAN) ============ */
  .board-chart-wrapper {
    position: relative;
    width: 960px; /* Lebar statis agar garis tidak meleset */
    height: 870px;
    margin: 0 auto;
    font-family: 'Plus Jakarta Sans', sans-serif;
  }

  .board-box {
    width: 130px; 
    height: 170px;
    background: #fff;
    border: 2px solid #222;
    border-radius: 2px;
    display: flex; flex-direction: column;
    overflow: hidden;
    position: absolute;
    box-shadow: 2px 2px 6px rgba(0,0,0,0.15);
    cursor: pointer;
    transition: transform 0.2s ease;
    z-index: 2;
  }
  .board-box:hover { transform: translateY(-2px); }

  .board-box-bpd {
    width: 160px;
    background: #E53935; 
    color: #fff;
    border: 2px solid #222;
    border-radius: 2px;
    font-size: 9px; 
    font-weight: 700; 
    text-align: center;
    padding: 8px 6px;
    position: absolute; 
    display: flex; 
    align-items: center; 
    justify-content: center;
    box-shadow: 2px 2px 6px rgba(0,0,0,0.15);
    z-index: 2;
  }

  .bb-title {
    background: #E53935; 
    color: #fff;
    font-size: 8px; 
    font-weight: 700; 
    text-align: center;
    padding: 2px; 
    text-transform: uppercase;
    border-bottom: 2px solid #222;
    flex-shrink: 0;
    display: flex; 
    align-items: center; 
    justify-content: center;
    height: 34px;
    line-height: 1.2;
  }
  
  .bb-img-wrap {
    flex-grow: 1; 
    position: relative;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 9px;
    color: #94A3B8;
  }
  .bb-img-wrap img {
    width: 100%; height: 100%; 
    object-fit: cover; 
    position: absolute; 
    inset: 0;
  }

  .bb-name {
    background: #C5E1A5; 
    color: #111;
    font-size: 9.5px; 
    font-weight: 800; 
    text-align: center;
    padding: 2px; 
    border-top: 2px solid #222;
    flex-shrink: 0;
    height: 28px;
    display: flex; 
    align-items: center; 
    justify-content: center;
    text-transform: uppercase;
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

  .jump-nav{
    display:flex; gap:8px; overflow-x:auto; padding:16px 20px 4px; max-width:800px; margin:0 auto;
  }
  .jump-nav a{
    flex-shrink:0; font-family:'Plus Jakarta Sans',sans-serif; font-size:11px; font-weight:600;
    color:var(--ink-soft); text-decoration:none; padding:7px 14px; border:1px solid var(--border);
    border-radius:6px; white-space:nowrap; transition:background .15s ease, color .15s ease;
  }
  .jump-nav a:hover{background:var(--amber); color:var(--ink); border-color:var(--amber);}

  details.rincian{margin-top:16px;}
  details.rincian summary{
    cursor:pointer; list-style:none; font-family:'Plus Jakarta Sans',sans-serif; font-size:11px; font-weight:600;
    color:var(--amber); text-transform:uppercase; letter-spacing:.05em; padding:10px 0;
    display:flex; align-items:center; gap:6px;
  }
  details.rincian summary::-webkit-details-marker{display:none;}
  details.rincian summary::before{content:'\25B8'; transition:transform .2s ease; display:inline-block;}
  details.rincian[open] summary::before{transform:rotate(90deg);}
  .total-highlight{
    display:flex; justify-content:space-between; align-items:baseline; padding:14px 0;
    border-top:1px solid var(--border);
  }
  .total-highlight .t-lbl{font-size:13px; font-weight:700; color:var(--ink-soft);}
  .total-highlight .t-val{font-family:'Plus Jakarta Sans',sans-serif; font-weight:800; font-size:19px;}

  /* ---------- Pie Chart Anggaran ---------- */
  .donut-wrap{ display:flex; align-items:center; gap:26px; flex-wrap:wrap; margin-top:16px; animation:fadeUpChart .5s ease; }
  @keyframes fadeUpChart{ from{opacity:0; transform:translateY(10px);} to{opacity:1; transform:translateY(0);} }
  .donut-pie-wrap{position:relative; width:150px; height:150px; flex-shrink:0;}
  .donut{
    position:relative; z-index:1; width:150px; height:150px; border-radius:50%;
    box-shadow:0 8px 24px rgba(46,42,31,0.22), inset 0 0 0 4px rgba(255,255,255,0.85);
    transition:transform .3s ease;
  }
  .donut-legend{flex:1; min-width:200px; list-style:none; display:flex; flex-direction:column; gap:5px;}
  .donut-legend li{
    display:flex; align-items:center; gap:9px; padding:7px 10px; font-size:12px;
    border-radius:5px; transition:background .15s ease, transform .15s ease;
  }
  .donut-legend li:hover{background:var(--paper); transform:translateX(3px);}
  .donut-legend .d-dot{width:10px; height:10px; border-radius:50%; flex-shrink:0; box-shadow:0 0 0 3px rgba(0,0,0,0.03);}
  .donut-legend .d-name{flex:1; color:var(--ink-soft); font-weight:500;}
  .donut-legend .d-pct{
    font-family:'Plus Jakarta Sans',sans-serif; font-weight:700; color:var(--ink);
    background:var(--paper); padding:2px 8px; border-radius:6px; font-size:10.5px;
  }
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

  <section class="section narrow" id="wilayah" style="margin-bottom:24px;">
    <div class="section-head">
      <div class="eyebrow-2">Pembagian Wilayah</div>
      <h2>7 Dusun Desa Munungkerep</h2>
    </div>
    <div class="stat-grid">
      <div class="stat-box"><div class="num" style="font-size:14px;">Munungkerep</div><div class="lbl">Dusun</div></div>
      <div class="stat-box"><div class="num" style="font-size:14px;">Karanggebang</div><div class="lbl">Dusun</div></div>
      <div class="stat-box"><div class="num" style="font-size:14px;">Slumbung</div><div class="lbl">Dusun</div></div>
      <div class="stat-box"><div class="num" style="font-size:14px;">Kalipang</div><div class="lbl">Dusun</div></div>
      <div class="stat-box"><div class="num" style="font-size:14px;">Kadenan</div><div class="lbl">Dusun</div></div>
      <div class="stat-box"><div class="num" style="font-size:14px;">Jatirubuh</div><div class="lbl">Dusun</div></div>
      <div class="stat-box"><div class="num" style="font-size:14px;">Duren</div><div class="lbl">Dusun</div></div>
    </div>
  </section>

  <section class="section narrow" id="pemerintahan" style="margin-bottom:24px;">
    <div class="section-head">
      <h2>Pemerintahan Desa</h2>
    </div>

    <div class="card" id="visimisi" style="margin-bottom:24px;">
      <div class="sambutan-wrapper">
        <div class="kades-profile">
          <div class="kades-photo-frame">
            <img src="/images/perangkat/kepala desa.png" alt="Sutrismi" onerror="this.parentElement.style.display='none'">
          </div>
          <div class="kades-name">Sutrismi</div>
          <div class="kades-title">Kepala Desa Munungkerep</div>
          <a href="javascript:void(0)" class="btn-biografi" onclick="bukaPopupOrang('Kepala Desa', 'Sutrismi', '/images/perangkat/kepala desa.png')">
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

    <!-- STRUKTUR ORGANISASI: ABSOLUTE BOARD LAYOUT (Sesuai Foto Papan) -->
    <div class="card" style="padding:10px 0 20px; overflow:hidden; background: #fafafa;">
      
      <!-- Container dengan lebar mutlak agar layout garis presisi -->
      <div style="overflow-x:auto; padding:10px;">
        <div class="board-chart-wrapper">

          <!-- 1. LAPISAN GARIS (ABSOLUTE) -->
          <div style="position: absolute; inset: 0; pointer-events: none; z-index: 1;">
              
              <!-- Garis BPD ke Kades -->
              <div style="position: absolute; left: 210px; top: 60px; width: 205px; border-top: 3px dashed #222;"></div>

              <!-- Tiang Utama dari Kades -->
              <div style="position: absolute; left: 480px; top: 190px; width: 3px; height: 430px; background: #222;"></div>

              <!-- Cabang ke Sekdes -->
              <div style="position: absolute; left: 480px; top: 205px; width: 285px; height: 3px; background: #222;"></div>
              <div style="position: absolute; left: 765px; top: 205px; width: 3px; height: 15px; background: #222;"></div>

              <!-- Cabang Kasi (Kiri) -->
              <div style="position: absolute; left: 85px; top: 400px; width: 395px; height: 3px; background: #222;"></div>
              <!-- Tiang Turun ke Kasi -->
              <div style="position: absolute; left: 85px; top: 400px; width: 3px; height: 40px; background: #222;"></div>
              <div style="position: absolute; left: 235px; top: 400px; width: 3px; height: 40px; background: #222;"></div>
              <div style="position: absolute; left: 385px; top: 400px; width: 3px; height: 40px; background: #222;"></div>

              <!-- Cabang Kaur (Kanan dari Sekdes) -->
              <div style="position: absolute; left: 765px; top: 390px; width: 3px; height: 20px; background: #222;"></div>
              <div style="position: absolute; left: 565px; top: 410px; width: 300px; height: 3px; background: #222;"></div>
              <!-- Tiang Turun ke Kaur -->
              <div style="position: absolute; left: 565px; top: 410px; width: 3px; height: 30px; background: #222;"></div>
              <div style="position: absolute; left: 715px; top: 410px; width: 3px; height: 30px; background: #222;"></div>
              <div style="position: absolute; left: 865px; top: 410px; width: 3px; height: 30px; background: #222;"></div>

              <!-- Cabang Kasun (Bawah) -->
              <div style="position: absolute; left: 197px; top: 620px; width: 570px; height: 3px; background: #222;"></div>
              <!-- Tiang Turun ke Kasun -->
              <div style="position: absolute; left: 197px; top: 620px; width: 3px; height: 40px; background: #222;"></div>
              <div style="position: absolute; left: 387px; top: 620px; width: 3px; height: 40px; background: #222;"></div>
              <div style="position: absolute; left: 577px; top: 620px; width: 3px; height: 40px; background: #222;"></div>
              <div style="position: absolute; left: 767px; top: 620px; width: 3px; height: 40px; background: #222;"></div>
          </div>

          <!-- 2. KOTAK JABATAN -->

          <!-- BPD -->
          <div class="board-box-bpd" style="left: 50px; top: 40px;">
            BADAN PERMUSYAWARATAN DESA<br>(BPD)
          </div>

          <!-- KEPALA DESA -->
          <div class="board-box" style="left: 415px; top: 20px;" onclick="bukaPopupOrang('Kepala Desa', 'Sutrismi', '/images/perangkat/kepala desa.png')">
            <div class="bb-title">KEPALA DESA</div>
            <div class="bb-img-wrap"><img src="/images/perangkat/kepala desa.png" onerror="this.style.display='none'">Foto</div>
            <div class="bb-name">SUTRISMI</div>
          </div>

          <!-- SEKRETARIS DESA -->
          <div class="board-box" style="left: 700px; top: 220px;" onclick="bukaPopupOrang('Sekretaris Desa', 'Siswanto', '/images/perangkat/siswanto.jpg')">
            <div class="bb-title">SEKRETARIS DESA</div>
            <div class="bb-img-wrap"><img src="/images/perangkat/siswanto.jpg" onerror="this.style.display='none'">Foto</div>
            <div class="bb-name">SISWANTO</div>
          </div>

          <!-- 3 KASI -->
          <div class="board-box" style="left: 20px; top: 440px;" onclick="bukaPopupOrang('Kepala Seksi Pemerintahan', 'Suyatemo', '/images/perangkat/suyatemo.jpg')">
            <div class="bb-title">KEPALA SEKSI<br>PEMERINTAHAN</div>
            <div class="bb-img-wrap"><img src="/images/perangkat/suyatemo.jpg" onerror="this.style.display='none'">Foto</div>
            <div class="bb-name">SUYATEMO</div>
          </div>
          <div class="board-box" style="left: 170px; top: 440px;" onclick="bukaPopupOrang('Kepala Seksi Pelayanan', 'Sugito', '/images/perangkat/sugito.jpg')">
            <div class="bb-title">KEPALA SEKSI<br>PELAYANAN</div>
            <div class="bb-img-wrap"><img src="/images/perangkat/sugito.jpg" onerror="this.style.display='none'">Foto</div>
            <div class="bb-name">SUGITO</div>
          </div>
          <div class="board-box" style="left: 320px; top: 440px;" onclick="bukaPopupOrang('Kepala Seksi Kesejahteraan', 'Rusdi', '/images/perangkat/rusdi.jpg')">
            <div class="bb-title">KEPALA SEKSI<br>KESEJAHTERAAN</div>
            <div class="bb-img-wrap"><img src="/images/perangkat/rusdi.jpg" onerror="this.style.display='none'">Foto</div>
            <div class="bb-name">RUSDI</div>
          </div>

          <!-- 3 KAUR -->
          <div class="board-box" style="left: 500px; top: 440px;" onclick="bukaPopupOrang('Kaur Tata Usaha dan Umum', 'Suntari', '/images/perangkat/suntari.jpg')">
            <div class="bb-title">KAUR TATA USAHA<br>DAN UMUM</div>
            <div class="bb-img-wrap"><img src="/images/perangkat/suntari.jpg" onerror="this.style.display='none'">Foto</div>
            <div class="bb-name">SUNTARI</div>
          </div>
          <div class="board-box" style="left: 650px; top: 440px;" onclick="bukaPopupOrang('Kaur Keuangan', 'Agus Sukisno', '/images/perangkat/agus-sukisno.jpg')">
            <div class="bb-title">KAUR KEUANGAN</div>
            <div class="bb-img-wrap"><img src="/images/perangkat/agus-sukisno.jpg" onerror="this.style.display='none'">Foto</div>
            <div class="bb-name">AGUS SUKISNO</div>
          </div>
          <div class="board-box" style="left: 800px; top: 440px;" onclick="bukaPopupOrang('Kaur Perencanaan', 'Iskan', '/images/perangkat/iskan.jpg')">
            <div class="bb-title">KAUR PERENCANAAN</div>
            <div class="bb-img-wrap"><img src="/images/perangkat/iskan.jpg" onerror="this.style.display='none'">Foto</div>
            <div class="bb-name">ISKAN</div>
          </div>

          <!-- 4 KEPALA DUSUN -->
          <div class="board-box" style="left: 132px; top: 660px;" onclick="bukaPopupOrang('Kepala Dusun Kalipang - Duren', 'Hartatik', '/images/perangkat/hartatik.jpg')">
            <div class="bb-title">KEPALA DUSUN<br>KALIPANG - DUREN</div>
            <div class="bb-img-wrap"><img src="/images/perangkat/hartatik.jpg" onerror="this.style.display='none'">Foto</div>
            <div class="bb-name">HARTATIK</div>
          </div>
          <div class="board-box" style="left: 322px; top: 660px;" onclick="bukaPopupOrang('Kepala Dusun Karanggebang - Slumbung', 'Heru Purnadi', '/images/perangkat/heru-purnadi.jpg')">
            <div class="bb-title" style="font-size:7px;">KEPALA DUSUN<br>KARANGGEBANG - SLUMBUNG</div>
            <div class="bb-img-wrap"><img src="/images/perangkat/heru-purnadi.jpg" onerror="this.style.display='none'">Foto</div>
            <div class="bb-name">HERU PURNADI</div>
          </div>
          <div class="board-box" style="left: 512px; top: 660px;" onclick="bukaPopupOrang('Kepala Dusun Kadengan - Jatirubuh', 'Wagimin', '/images/perangkat/wagimin.jpg')">
            <div class="bb-title">KEPALA DUSUN<br>KADENGAN - JATIRUBUH</div>
            <div class="bb-img-wrap"><img src="/images/perangkat/wagimin.jpg" onerror="this.style.display='none'">Foto</div>
            <div class="bb-name">WAGIMIN</div>
          </div>
          <div class="board-box" style="left: 702px; top: 660px;" onclick="bukaPopupOrang('Kepala Dusun Munungkerep', 'Juni Hadi', '/images/perangkat/juni-hadi.jpg')">
            <div class="bb-title">KEPALA DUSUN<br>MUNUNGKEREP</div>
            <div class="bb-img-wrap"><img src="/images/perangkat/juni-hadi.jpg" onerror="this.style.display='none'">Foto</div>
            <div class="bb-name">JUNI HADI</div>
          </div>

        </div>
      </div>
    </div>
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
  function pindahHalus(event, url){
    event.preventDefault();
    document.body.style.transition = 'opacity .25s ease, transform .25s ease';
    document.body.style.opacity = '0';
    document.body.style.transform = 'translateY(-6px)';
    setTimeout(() => { window.location.href = url; }, 220);
    return false;
  }

  function bukaPopupOrang(jabatan, nama, pathFoto){
    document.getElementById('popup-jabatan').textContent = jabatan;
    document.getElementById('popup-nama').textContent = nama;

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