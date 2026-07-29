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

  header{
    background:#2E2A1F; color:var(--paper); padding:22px 20px;
    text-align:center; border-bottom:4px solid var(--amber);
  }
  header .eyebrow{
    font-family:'Plus Jakarta Sans',sans-serif; font-size:11px; font-weight:600; letter-spacing:.12em;
    text-transform:uppercase; color:var(--amber); margin-bottom:8px;
  }
  header h1{font-size:clamp(20px,4vw,28px); font-weight:600;}

  .topbar{
    background:#08283F; color:#C9DCEA; font-size:11px;
    padding:6px 20px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:6px;
  }
  .topbar .breadcrumb span{opacity:.75;}

  .navbar{
    background:var(--paper-2); border-bottom:1px solid var(--border);
    position:sticky; top:0; z-index:960; box-shadow:0 1px 3px rgba(11,59,96,0.06);
  }
  .navbar-inner{
    max-width:1200px; margin:0 auto; padding:10px 20px;
    display:flex; align-items:center; justify-content:space-between; gap:16px;
  }
  .brand{display:flex; align-items:center; gap:10px; text-decoration:none; color:inherit;}
  .brand-logo{
    width:38px; height:38px; border-radius:50%; background:var(--ink);
    display:flex; align-items:center; justify-content:center; flex-shrink:0;
    color:var(--amber); font-size:16px; font-weight:800; border:2px solid var(--amber);
  }
  .brand-text .b-title{font-size:13.5px; font-weight:800; color:var(--ink); line-height:1.2;}
  .brand-text .b-sub{font-size:9.5px; color:var(--ink-soft); text-transform:uppercase; letter-spacing:.04em; margin-top:2px;}

  .menu{display:flex; gap:4px; align-items:center;}
  .menu a{
    font-size:13px; font-weight:600; color:var(--ink); padding:9px 14px;
    border-radius:6px; text-decoration:none; transition:background .15s ease, color .15s ease;
  }
  .menu a:hover{background:#E8F1F8;}
  .menu a.active{background:var(--ink); color:#fff;}
  .menu-toggle{display:none; background:none; border:none; cursor:pointer; padding:6px; flex-direction:column; gap:4px;}
  .menu-toggle span{width:20px; height:2.5px; background:var(--ink); border-radius:2px;}
  @media (max-width:860px){
    .menu{
      display:none; position:absolute; top:100%; left:0; right:0; background:var(--paper-2);
      flex-direction:column; padding:8px 20px 14px; border-bottom:1px solid var(--border);
      box-shadow:0 8px 16px rgba(11,59,96,0.08);
    }
    .menu.buka{display:flex;}
    .menu a{width:100%; padding:11px 12px;}
    .menu-toggle{display:flex;}
  }

  main{max-width:1160px; margin:0 auto; padding:40px 20px 60px;}
  .narrow{max-width:800px; margin-left:auto; margin-right:auto;}

  .grid-2kolom{
    display:grid; grid-template-columns:1fr; gap:20px;
    max-width:1000px; margin:0 auto;
  }
  @media (min-width:820px){
    .grid-2kolom{grid-template-columns:1fr 1fr; align-items:start;}
  }
  .grid-2kolom .section{margin-bottom:0;}
  .kolom-kanan{display:flex; flex-direction:column; gap:26px;}

  .section{margin-bottom:26px;}
  .section-head{margin-bottom:18px;}
  .section-head .eyebrow-2{
    font-family:'Plus Jakarta Sans',sans-serif; font-size:11px; font-weight:600; letter-spacing:.1em;
    text-transform:uppercase; color:var(--clay); margin-bottom:6px;
  }
  .section-head h2{font-size:clamp(19px,4vw,24px); font-weight:600;}

  .card{
    background:var(--paper-2); border:1px solid var(--border); border-radius:10px;
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
  .kv-list .value.kosong{color:var(--clay); font-style:italic; font-weight:500;}

  .staff-grid{display:grid; grid-template-columns:1fr; gap:12px; margin-top:16px;}
  @media (min-width:520px){ .staff-grid{grid-template-columns:1fr 1fr;} }
  .staff-card{
    background:var(--paper); border:1px solid var(--border); border-radius:8px;
    padding:14px 16px; text-align:center;
  }
  .staff-card .jabatan{font-family:'Plus Jakarta Sans',sans-serif; font-size:10.5px; font-weight:600; text-transform:uppercase; letter-spacing:.06em; color:var(--moss);}
  .staff-card .nama{font-size:14px; font-weight:700; margin-top:4px; color:var(--ink);}
  .staff-card .nama.kosong{color:var(--clay); font-style:italic; font-weight:500;}

  .stat-grid{display:grid; grid-template-columns:repeat(2,1fr); gap:14px;}
  @media (min-width:520px){ .stat-grid{grid-template-columns:repeat(4,1fr);} }
  .stat-box{background:var(--paper-2); border:1px solid var(--border); border-radius:10px; padding:18px 12px; text-align:center;}
  .stat-box .num{font-family:'Plus Jakarta Sans',sans-serif; font-size:22px; font-weight:600; color:var(--amber);}
  .stat-box .num.kosong{color:var(--clay); font-size:13px; font-style:italic;}
  .stat-box .lbl{font-size:11px; color:var(--ink-soft); margin-top:4px; text-transform:uppercase; letter-spacing:.04em;}

  .note{
    background:rgba(166,61,44,0.07); border-left:3px solid var(--clay); padding:12px 16px;
    font-size:12.5px; color:var(--clay); font-style:italic; border-radius:0 6px 6px 0; margin-top:14px;
  }

  /* ---------- Bagan Struktur Organisasi ---------- */
  .bpd-badge{
    display:flex; align-items:center; justify-content:center; gap:8px;
    max-width:220px; margin:0 auto 8px; padding:10px 16px;
    background:var(--paper); border:1.5px dashed var(--border); border-radius:8px;
    font-size:12px; font-weight:700; color:var(--ink-soft); text-align:center;
  }
  .bpd-arrow{text-align:center; color:var(--border); font-size:11px; margin-bottom:10px; font-family:'Plus Jakarta Sans',sans-serif;}

  .org-scroll{overflow-x:auto; overflow-y:visible; padding:10px 4px 4px; width:100%; -webkit-overflow-scrolling:touch;}
  .org-tree{ transform-origin:top center; transition:transform .2s ease; }
  .org-tree, .org-tree ul{
    display:flex; list-style:none; margin:0; padding:0; justify-content:center;
  }
  .org-tree{padding-top:0;}
  .org-tree li{
    display:flex; flex-direction:column; align-items:center;
    padding:18px 5px 0; position:relative;
  }
  .org-tree li::before, .org-tree li::after{
    content:''; position:absolute; top:0; right:50%; width:50%; height:18px;
    border-top:2px solid var(--border);
  }
  .org-tree li::after{ right:auto; left:50%; border-left:2px solid var(--border); }
  .org-tree li:only-child::after, .org-tree li:only-child::before{ display:none; }
  .org-tree li:only-child{ padding-top:0; }
  .org-tree li:first-child::before, .org-tree li:last-child::after{ border:0 none; }
  .org-tree li:last-child::before{ border-right:2px solid var(--border); border-radius:0 6px 0 0; }
  .org-tree li:first-child::after{ border-radius:6px 0 0 0; }
  .org-tree ul::before{
    content:''; position:absolute; top:0; left:50%; width:0; height:18px;
    border-left:2px solid var(--border);
  }
  .org-tree > li{ padding-top:0; }
  .org-tree > li::before, .org-tree > li::after{ border:0 none; }

  .org-node{
    display:flex; flex-direction:column; align-items:center; gap:4px;
    background:var(--paper-2); border:1px solid var(--border); border-radius:9px;
    padding:8px 6px; width:88px; box-shadow:0 3px 8px rgba(46,42,31,0.06);
  }
  .org-node.root{border-color:var(--amber); border-width:2px;}
  .org-avatar{
    width:30px; height:30px; border-radius:50%; background:var(--moss);
    display:flex; align-items:center; justify-content:center; flex-shrink:0;
    position:relative; overflow:hidden;
  }
  .org-avatar svg{width:16px; height:16px; fill:var(--paper);}
  .org-avatar img{
    position:absolute; inset:0; width:100%; height:100%;
    object-fit:cover; border-radius:50%;
  }
  .org-jabatan{
    font-family:'Plus Jakarta Sans',sans-serif; font-size:7px; font-weight:600; text-transform:uppercase;
    letter-spacing:.02em; color:var(--clay); text-align:center; line-height:1.25;
  }
  .org-nama{font-size:9.5px; font-weight:700; text-align:center; line-height:1.2; color:var(--ink);}
  .org-node{cursor:pointer; transition:transform .15s ease, box-shadow .15s ease;}

  .org-node:hover{transform:translateY(-3px); box-shadow:0 8px 16px rgba(46,42,31,0.14);}

  @media (max-width:480px){
    .org-node{width:68px; padding:6px 4px;}
    .org-avatar{width:24px; height:24px;}
    .org-avatar svg{width:13px; height:13px;}
    .org-jabatan{font-size:6px;}
    .org-nama{font-size:8px;}
    .org-tree li{padding:14px 3px 0;}
  }

  .popup-overlay{
    display:none; position:fixed; inset:0; z-index:2000;
    background:rgba(46,42,31,0.78); align-items:center; justify-content:center; padding:20px;
  }
  .popup-overlay.show{display:flex;}
  .popup-box{
    background:var(--paper-2); border-radius:16px; max-width:320px; width:100%;
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
  .popup-avatar img{
    position:absolute; inset:0; width:100%; height:100%;
    object-fit:cover; border-radius:50%;
  }
  .popup-jabatan{
    font-family:'Plus Jakarta Sans',sans-serif; font-size:11px; font-weight:600; text-transform:uppercase;
    letter-spacing:.06em; color:var(--clay);
  }
  .popup-nama{font-family:'Plus Jakarta Sans',sans-serif; font-weight:800; font-size:20px; font-weight:600; margin-top:6px;}
  .popup-note{font-size:12px; color:var(--ink-soft); margin-top:14px; font-style:italic;}

  footer{text-align:center; padding:20px; font-size:11.5px; color:var(--ink-soft); border-top:1px solid var(--border);}

  /* ---------- Ringkasan Cepat ---------- */
  .quick-strip{
    display:grid; grid-template-columns:repeat(2,1fr); gap:1px;
    background:var(--border); border:1px solid var(--border); border-radius:10px; overflow:hidden;
    margin:20px auto 0; max-width:800px;
  }
  @media (min-width:640px){ .quick-strip{grid-template-columns:repeat(4,1fr);} }
  .quick-item{background:var(--paper-2); padding:16px 12px; text-align:center;}
  .quick-item .q-val{font-family:'Plus Jakarta Sans',sans-serif; font-weight:800; font-size:16px; font-weight:600; color:var(--ink); line-height:1.2;}
  .quick-item .q-lbl{font-family:'Plus Jakarta Sans',sans-serif; font-size:9.5px; color:var(--ink-soft); text-transform:uppercase; letter-spacing:.05em; margin-top:4px;}

  /* ---------- Jump Nav ---------- */
  .jump-nav{
    display:flex; gap:8px; overflow-x:auto; padding:16px 20px 4px; max-width:800px; margin:0 auto;
  }
  .jump-nav a{
    flex-shrink:0; font-family:'Plus Jakarta Sans',sans-serif; font-size:11px; font-weight:600;
    color:var(--ink-soft); text-decoration:none; padding:7px 14px; border:1px solid var(--border);
    border-radius:20px; white-space:nowrap; transition:background .15s ease, color .15s ease;
  }
  .jump-nav a:hover{background:var(--amber); color:var(--ink); border-color:var(--amber);}

  /* ---------- Toggle Rincian ---------- */
  details.rincian{margin-top:16px;}
  details.rincian summary{
    cursor:pointer; list-style:none; font-family:'Plus Jakarta Sans',sans-serif; font-size:11px; font-weight:600;
    color:var(--amber); text-transform:uppercase; letter-spacing:.05em; padding:10px 0;
    display:flex; align-items:center; gap:6px;
  }
  details.rincian summary::-webkit-details-marker{display:none;}
  details.rincian summary::before{content:'▸'; transition:transform .2s ease; display:inline-block;}
  details.rincian[open] summary::before{transform:rotate(90deg);}
  .total-highlight{
    display:flex; justify-content:space-between; align-items:baseline; padding:14px 0;
    border-top:1px solid var(--border);
  }
  .total-highlight .t-lbl{font-size:13px; font-weight:700; color:var(--ink-soft);}
  .total-highlight .t-val{font-family:'Plus Jakarta Sans',sans-serif; font-weight:800; font-size:19px; font-weight:600;}

  /* ---------- Pie Chart Anggaran (versi modern) ---------- */
  .donut-wrap{
    display:flex; align-items:center; gap:26px; flex-wrap:wrap; margin-top:16px;
    animation:fadeUpChart .5s ease;
  }
  @keyframes fadeUpChart{ from{opacity:0; transform:translateY(10px);} to{opacity:1; transform:translateY(0);} }

  .donut-pie-wrap{position:relative; width:150px; height:150px; flex-shrink:0;}
  .donut-glow{
    position:absolute; inset:-10px; border-radius:50%; filter:blur(18px); opacity:0.55;
    z-index:0;
  }
  .donut{
    position:relative; z-index:1;
    width:150px; height:150px; border-radius:50%;
    box-shadow:0 8px 24px rgba(46,42,31,0.22), inset 0 0 0 4px rgba(255,255,255,0.85);
    transition:transform .3s ease;
  }
  .donut-pie-wrap:hover .donut{transform:scale(1.035) rotate(4deg);}

  .donut-legend{flex:1; min-width:200px; list-style:none; display:flex; flex-direction:column; gap:5px;}
  .donut-legend li{
    display:flex; align-items:center; gap:9px; padding:7px 10px; font-size:12px;
    border-radius:9px; transition:background .15s ease, transform .15s ease;
  }
  .donut-legend li:hover{background:var(--paper); transform:translateX(3px);}
  .donut-legend .d-dot{width:10px; height:10px; border-radius:50%; flex-shrink:0; box-shadow:0 0 0 3px rgba(0,0,0,0.03);}
  .donut-legend .d-name{flex:1; color:var(--ink-soft); font-weight:500;}
  .donut-legend .d-pct{
    font-family:'Plus Jakarta Sans',sans-serif; font-weight:700; color:var(--ink);
    background:var(--paper); padding:2px 8px; border-radius:20px; font-size:10.5px;
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
      <a href="/peta" onclick="return pindahHalus(event, '/peta')">Peta &amp; Potensi</a>
      <a href="/profil-desa" class="active">Profil Desa</a>
    </div>
  </div>
</nav>

<header>
  <div class="eyebrow">Profil Desa</div>
  <h1>Desa Munungkerep, Kec. Kabuh, Kab. Jombang</h1>
</header>

<div class="quick-strip">
  <div class="quick-item"><div class="q-val">Sutrismi</div><div class="q-lbl">Kepala Desa</div></div>
  <div class="quick-item"><div class="q-val">7</div><div class="q-lbl">Dusun</div></div>
  <div class="quick-item"><div class="q-val">12</div><div class="q-lbl">Perangkat Desa</div></div>
  <div class="quick-item"><div class="q-val">Rp 1,66 M</div><div class="q-lbl">APBDes 2026</div></div>
</div>

<nav class="jump-nav">
  <a href="#pemerintahan">Pemerintahan</a>
  <a href="#anggaran">Anggaran</a>
  <a href="#geografis">Geografis</a>
  <a href="#demografis">Demografis</a>
  <a href="#visimisi">Visi &amp; Misi</a>
</nav>

<main>

  <section class="section" id="pemerintahan" style="margin-bottom:24px;">
    <div class="section-head">
      <h2>Struktur Organisasi Pemerintah Desa</h2>
    </div>
    <div class="card" style="padding-bottom:10px;">

      <div class="bpd-badge">Badan Permusyawaratan Desa (BPD)</div>
      <div class="bpd-arrow">┊ berkoordinasi dengan ┊</div>

      <div class="org-scroll">
        <ul class="org-tree">
          <li>
            <div class="org-node root" onclick="bukaPopupOrang('Kepala Desa', 'Sutrismi', '/images/perangkat/kepala desa.png')">
              <div class="org-avatar"><svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.5c-3.3 0-9.8 1.6-9.8 4.9v2.4h19.6v-2.4c0-3.3-6.5-4.9-9.8-4.9z"/></svg><img src="/images/perangkat/kepala desa.png" alt="Sutrismi" onerror="this.remove()"></div>
              <div class="org-jabatan">Kepala Desa</div>
              <div class="org-nama">Sutrismi</div>
            </div>
            <ul>
              <li>
                <div class="org-node" onclick="bukaPopupOrang('Kasi Pemerintahan', 'Suyatemo', '/images/perangkat/suyatemo.jpg')">
                  <div class="org-avatar"><svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.5c-3.3 0-9.8 1.6-9.8 4.9v2.4h19.6v-2.4c0-3.3-6.5-4.9-9.8-4.9z"/></svg><img src="/images/perangkat/suyatemo.jpg" alt="Suyatemo" onerror="this.remove()"></div>
                  <div class="org-jabatan">Kasi Pemerintahan</div>
                  <div class="org-nama">Suyatemo</div>
                </div>
              </li>
              <li>
                <div class="org-node" onclick="bukaPopupOrang('Kasi Pelayanan', 'Sugito', '/images/perangkat/sugito.jpg')">
                  <div class="org-avatar"><svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.5c-3.3 0-9.8 1.6-9.8 4.9v2.4h19.6v-2.4c0-3.3-6.5-4.9-9.8-4.9z"/></svg><img src="/images/perangkat/sugito.jpg" alt="Sugito" onerror="this.remove()"></div>
                  <div class="org-jabatan">Kasi Pelayanan</div>
                  <div class="org-nama">Sugito</div>
                </div>
              </li>
              <li>
                <div class="org-node" onclick="bukaPopupOrang('Kasi Kesejahteraan', 'Rusdi', '/images/perangkat/rusdi.jpg')">
                  <div class="org-avatar"><svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.5c-3.3 0-9.8 1.6-9.8 4.9v2.4h19.6v-2.4c0-3.3-6.5-4.9-9.8-4.9z"/></svg><img src="/images/perangkat/rusdi.jpg" alt="Rusdi" onerror="this.remove()"></div>
                  <div class="org-jabatan">Kasi Kesejahteraan</div>
                  <div class="org-nama">Rusdi</div>
                </div>
              </li>
              <li>
                <div class="org-node" onclick="bukaPopupOrang('Sekretaris Desa', 'Siswanto', '/images/perangkat/siswanto.jpg')">
                  <div class="org-avatar"><svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.5c-3.3 0-9.8 1.6-9.8 4.9v2.4h19.6v-2.4c0-3.3-6.5-4.9-9.8-4.9z"/></svg><img src="/images/perangkat/siswanto.jpg" alt="Siswanto" onerror="this.remove()"></div>
                  <div class="org-jabatan">Sekretaris Desa</div>
                  <div class="org-nama">Siswanto</div>
                </div>
                <ul>
                  <li>
                    <div class="org-node" onclick="bukaPopupOrang('Kaur TU &amp; Umum', 'Suntari', '/images/perangkat/suntari.jpg')">
                      <div class="org-avatar"><svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.5c-3.3 0-9.8 1.6-9.8 4.9v2.4h19.6v-2.4c0-3.3-6.5-4.9-9.8-4.9z"/></svg><img src="/images/perangkat/suntari.jpg" alt="Suntari" onerror="this.remove()"></div>
                      <div class="org-jabatan">Kaur TU &amp; Umum</div>
                      <div class="org-nama">Suntari</div>
                    </div>
                  </li>
                  <li>
                    <div class="org-node" onclick="bukaPopupOrang('Kaur Keuangan', 'Agus Sukisno', '/images/perangkat/agus-sukisno.jpg')">
                      <div class="org-avatar"><svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.5c-3.3 0-9.8 1.6-9.8 4.9v2.4h19.6v-2.4c0-3.3-6.5-4.9-9.8-4.9z"/></svg><img src="/images/perangkat/agus-sukisno.jpg" alt="Agus Sukisno" onerror="this.remove()"></div>
                      <div class="org-jabatan">Kaur Keuangan</div>
                      <div class="org-nama">Agus Sukisno</div>
                    </div>
                  </li>
                  <li>
                    <div class="org-node" onclick="bukaPopupOrang('Kaur Perencanaan', 'Iskan', '/images/perangkat/iskan.jpg')">
                      <div class="org-avatar"><svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.5c-3.3 0-9.8 1.6-9.8 4.9v2.4h19.6v-2.4c0-3.3-6.5-4.9-9.8-4.9z"/></svg><img src="/images/perangkat/iskan.jpg" alt="Iskan" onerror="this.remove()"></div>
                      <div class="org-jabatan">Kaur Perencanaan</div>
                      <div class="org-nama">Iskan</div>
                    </div>
                  </li>
                </ul>
              </li>
              <li>
                <div class="org-node" onclick="bukaPopupOrang('Kadus Kalipang &amp; Duren', 'Hartatik', '/images/perangkat/hartatik.jpg')">
                  <div class="org-avatar"><svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.5c-3.3 0-9.8 1.6-9.8 4.9v2.4h19.6v-2.4c0-3.3-6.5-4.9-9.8-4.9z"/></svg><img src="/images/perangkat/hartatik.jpg" alt="Hartatik" onerror="this.remove()"></div>
                  <div class="org-jabatan">Kadus Kalipang &amp; Duren</div>
                  <div class="org-nama">Hartatik</div>
                </div>
              </li>
              <li>
                <div class="org-node" onclick="bukaPopupOrang('Kadus Karanggebang &amp; Slumbung', 'Heru Purnadi', '/images/perangkat/heru-purnadi.jpg')">
                  <div class="org-avatar"><svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.5c-3.3 0-9.8 1.6-9.8 4.9v2.4h19.6v-2.4c0-3.3-6.5-4.9-9.8-4.9z"/></svg><img src="/images/perangkat/heru-purnadi.jpg" alt="Heru Purnadi" onerror="this.remove()"></div>
                  <div class="org-jabatan">Kadus Karanggebang &amp; Slumbung</div>
                  <div class="org-nama">Heru Purnadi</div>
                </div>
              </li>
              <li>
                <div class="org-node" onclick="bukaPopupOrang('Kadus Kadenan &amp; Jatirubuh', 'Wagimin', '/images/perangkat/wagimin.jpg')">
                  <div class="org-avatar"><svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.5c-3.3 0-9.8 1.6-9.8 4.9v2.4h19.6v-2.4c0-3.3-6.5-4.9-9.8-4.9z"/></svg><img src="/images/perangkat/wagimin.jpg" alt="Wagimin" onerror="this.remove()"></div>
                  <div class="org-jabatan">Kadus Kadenan &amp; Jatirubuh</div>
                  <div class="org-nama">Wagimin</div>
                </div>
              </li>
              <li>
                <div class="org-node" onclick="bukaPopupOrang('Kadus Munungkerep', 'Juni Hadi', '/images/perangkat/juni-hadi.jpg')">
                  <div class="org-avatar"><svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.5c-3.3 0-9.8 1.6-9.8 4.9v2.4h19.6v-2.4c0-3.3-6.5-4.9-9.8-4.9z"/></svg><img src="/images/perangkat/juni-hadi.jpg" alt="Juni Hadi" onerror="this.remove()"></div>
                  <div class="org-jabatan">Kadus Munungkerep</div>
                  <div class="org-nama">Juni Hadi</div>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </section>

  <div class="grid-2kolom">
  <section class="section" id="anggaran">
    <div class="section-head">
      <h2>Anggaran Desa (APBDES)</h2>
    </div>

    <div class="card" style="margin-bottom:14px;">
      <p style="font-family:'Plus Jakarta Sans',sans-serif; font-size:10.5px; font-weight:600; text-transform:uppercase; letter-spacing:.08em; color:var(--ink-soft);">Realisasi Tahun 2025</p>
      <div class="total-highlight" style="border-top:none; padding-top:8px;">
        <span class="t-lbl">Total Pendapatan</span>
        <span class="t-val" style="color:var(--amber);">Rp 1,60 M</span>
      </div>
      <div class="total-highlight">
        <span class="t-lbl">Total Belanja</span>
        <span class="t-val" style="color:var(--clay);">Rp 1,49 M</span>
      </div>

      <p style="font-family:'Plus Jakarta Sans',sans-serif; font-size:10.5px; font-weight:600; text-transform:uppercase; letter-spacing:.08em; color:var(--ink-soft); margin:20px 0 4px;">Pendapatan Desa</p>
      <div class="donut-wrap">
        <div class="donut-pie-wrap">
          <div class="donut-glow" style="background:conic-gradient(#C79A3D 0% 51.06%, #3D6B8C 51.06% 77.91%, #52633B 77.91% 92.10%, #8B6F47 92.10% 97.67%, #A63D2C 97.67% 99.38%, #9C9480 99.38% 100%);"></div>
          <div class="donut" style="background:conic-gradient(#C79A3D 0% 51.06%, #3D6B8C 51.06% 77.91%, #52633B 77.91% 92.10%, #8B6F47 92.10% 97.67%, #A63D2C 97.67% 99.38%, #9C9480 99.38% 100%);"></div>
        </div>
        <ul class="donut-legend">
          <li><span class="d-dot" style="background:#C79A3D;"></span><span class="d-name">Dana Desa (DD)</span><span class="d-pct">51,1%</span></li>
          <li><span class="d-dot" style="background:#3D6B8C;"></span><span class="d-name">Alokasi Dana Desa (ADD)</span><span class="d-pct">26,9%</span></li>
          <li><span class="d-dot" style="background:#52633B;"></span><span class="d-name">PAD</span><span class="d-pct">14,2%</span></li>
          <li><span class="d-dot" style="background:#8B6F47;"></span><span class="d-name">PDRD</span><span class="d-pct">5,6%</span></li>
          <li><span class="d-dot" style="background:#A63D2C;"></span><span class="d-name">Lain-lain (DLL)</span><span class="d-pct">1,7%</span></li>
          <li><span class="d-dot" style="background:#9C9480;"></span><span class="d-name">Bantuan Keuangan (BK)</span><span class="d-pct">0,6%</span></li>
        </ul>
      </div>

      <p style="font-family:'Plus Jakarta Sans',sans-serif; font-size:10.5px; font-weight:600; text-transform:uppercase; letter-spacing:.08em; color:var(--ink-soft); margin:22px 0 4px;">Belanja Desa</p>
      <div class="donut-wrap">
        <div class="donut-pie-wrap">
          <div class="donut-glow" style="background:conic-gradient(#A63D2C 0% 52.11%, #C79A3D 52.11% 92.13%, #3D6B8C 92.13% 95.91%, #52633B 95.91% 98.08%, #9C9480 98.08% 100%);"></div>
          <div class="donut" style="background:conic-gradient(#A63D2C 0% 52.11%, #C79A3D 52.11% 92.13%, #3D6B8C 92.13% 95.91%, #52633B 95.91% 98.08%, #9C9480 98.08% 100%);"></div>
        </div>
        <ul class="donut-legend">
          <li><span class="d-dot" style="background:#A63D2C;"></span><span class="d-name">Penyelenggaraan Pemerintahan</span><span class="d-pct">52,1%</span></li>
          <li><span class="d-dot" style="background:#C79A3D;"></span><span class="d-name">Pelaksanaan Pembangunan</span><span class="d-pct">40,0%</span></li>
          <li><span class="d-dot" style="background:#3D6B8C;"></span><span class="d-name">Pemberdayaan Masyarakat</span><span class="d-pct">3,8%</span></li>
          <li><span class="d-dot" style="background:#52633B;"></span><span class="d-name">Pembinaan Kemasyarakatan</span><span class="d-pct">2,2%</span></li>
          <li><span class="d-dot" style="background:#9C9480;"></span><span class="d-name">Penanggulangan Bencana</span><span class="d-pct">1,9%</span></li>
        </ul>
      </div>
    </div>

    <div class="card">
      <p style="font-family:'Plus Jakarta Sans',sans-serif; font-size:10.5px; font-weight:600; text-transform:uppercase; letter-spacing:.08em; color:var(--ink-soft);">Rencana Tahun 2026</p>
      <div class="total-highlight" style="border-top:none; padding-top:8px;">
        <span class="t-lbl">Total Pendapatan</span>
        <span class="t-val" style="color:var(--amber);">Rp 1,66 M</span>
      </div>
      <div class="total-highlight">
        <span class="t-lbl">Total Belanja</span>
        <span class="t-val" style="color:var(--clay);">Rp 1,68 M</span>
      </div>

      <p style="font-family:'Plus Jakarta Sans',sans-serif; font-size:10.5px; font-weight:600; text-transform:uppercase; letter-spacing:.08em; color:var(--ink-soft); margin:20px 0 4px;">Pendapatan Desa</p>
      <div class="donut-wrap">
        <div class="donut-pie-wrap">
          <div class="donut-glow" style="background:conic-gradient(#C79A3D 0% 32.44%, #3D6B8C 32.44% 55.07%, #52633B 55.07% 73.29%, #8B6F47 73.29% 87.16%, #A63D2C 87.16% 94.84%, #9C9480 94.84% 100%);"></div>
          <div class="donut" style="background:conic-gradient(#C79A3D 0% 32.44%, #3D6B8C 32.44% 55.07%, #52633B 55.07% 73.29%, #8B6F47 73.29% 87.16%, #A63D2C 87.16% 94.84%, #9C9480 94.84% 100%);"></div>
        </div>
        <ul class="donut-legend">
          <li><span class="d-dot" style="background:#C79A3D;"></span><span class="d-name">Bantuan Keuangan (BK)</span><span class="d-pct">32,4%</span></li>
          <li><span class="d-dot" style="background:#3D6B8C;"></span><span class="d-name">Alokasi Dana Desa (ADD)</span><span class="d-pct">22,6%</span></li>
          <li><span class="d-dot" style="background:#52633B;"></span><span class="d-name">Dana Desa (DD)</span><span class="d-pct">18,2%</span></li>
          <li><span class="d-dot" style="background:#8B6F47;"></span><span class="d-name">PAD</span><span class="d-pct">13,9%</span></li>
          <li><span class="d-dot" style="background:#A63D2C;"></span><span class="d-name">Lain-lain (DLL)</span><span class="d-pct">7,7%</span></li>
          <li><span class="d-dot" style="background:#9C9480;"></span><span class="d-name">PDRD</span><span class="d-pct">5,2%</span></li>
        </ul>
      </div>

      <p style="font-family:'Plus Jakarta Sans',sans-serif; font-size:10.5px; font-weight:600; text-transform:uppercase; letter-spacing:.08em; color:var(--ink-soft); margin:22px 0 4px;">Belanja Desa</p>
      <div class="donut-wrap">
        <div class="donut-pie-wrap">
          <div class="donut-glow" style="background:conic-gradient(#A63D2C 0% 51.68%, #C79A3D 51.68% 86.39%, #3D6B8C 86.39% 95.81%, #52633B 95.81% 98.34%, #9C9480 98.34% 100%);"></div>
          <div class="donut" style="background:conic-gradient(#A63D2C 0% 51.68%, #C79A3D 51.68% 86.39%, #3D6B8C 86.39% 95.81%, #52633B 95.81% 98.34%, #9C9480 98.34% 100%);"></div>
        </div>
        <ul class="donut-legend">
          <li><span class="d-dot" style="background:#A63D2C;"></span><span class="d-name">Penyelenggaraan Pemerintahan</span><span class="d-pct">51,7%</span></li>
          <li><span class="d-dot" style="background:#C79A3D;"></span><span class="d-name">Pelaksanaan Pembangunan</span><span class="d-pct">34,7%</span></li>
          <li><span class="d-dot" style="background:#3D6B8C;"></span><span class="d-name">Pemberdayaan Masyarakat</span><span class="d-pct">9,4%</span></li>
          <li><span class="d-dot" style="background:#52633B;"></span><span class="d-name">Pembinaan Kemasyarakatan</span><span class="d-pct">2,5%</span></li>
          <li><span class="d-dot" style="background:#9C9480;"></span><span class="d-name">Penanggulangan Bencana</span><span class="d-pct">1,7%</span></li>
        </ul>
      </div>

      <div class="note" style="margin-top:18px;">📝 Sumber: papan infografik APBDES resmi di kantor desa.</div>
    </div>
  </section>

  <div class="kolom-kanan">
  <section class="section" id="geografis">
    <div class="section-head">
      <h2>Kondisi Geografis</h2>
    </div>
    <div class="card">
      <ul class="kv-list">
        <li><span class="label">Luas Wilayah</span><span class="value">≈ 2,10 km² (209,9 Ha)</span></li>
        <li><span class="label">Tipologi Desa</span><span class="value">Persawahan</span></li>
        <li><span class="label">Batas Utara</span><span class="value">Hutan</span></li>
        <li><span class="label">Batas Selatan</span><span class="value">Desa Kauman</span></li>
        <li><span class="label">Batas Timur</span><span class="value">Desa Katemas</span></li>
        <li><span class="label">Batas Barat</span><span class="value">Desa Genenganjasem</span></li>
        <li><span class="label">Jarak ke Kecamatan</span><span class="value">7 km</span></li>
        <li><span class="label">Jarak ke Kabupaten</span><span class="value">22 km</span></li>
        <li><span class="label">Jarak ke Propinsi</span><span class="value">75 km</span></li>
      </ul>
      <div class="note">📝 Luas wilayah dihitung dari peta batas desa (estimasi). Angka di papan monografi fisik tertulis "209,909 km²" — kemungkinan salah satuan (seharusnya Hektar), karena hasilnya sangat dekat dengan hitungan peta.</div>
    </div>
  </section>

  <section class="section" id="demografis">
    <div class="section-head">
      <h2>Data Demografis</h2>
    </div>
    <div class="stat-grid">
      <div class="stat-box"><div class="num">2.120</div><div class="lbl">Jumlah Penduduk</div></div>
      <div class="stat-box"><div class="num">709</div><div class="lbl">Jumlah KK</div></div>
      <div class="stat-box"><div class="num">7</div><div class="lbl">Jumlah Dusun</div></div>
      <div class="stat-box"><div class="num">12</div><div class="lbl">Perangkat Desa</div></div>
    </div>

    <div class="card" style="margin-top:14px;">
      <ul class="kv-list">
        <li><span class="label">Laki-laki</span><span class="value">1.049 jiwa</span></li>
        <li><span class="label">Perempuan</span><span class="value">1.071 jiwa</span></li>
        <li><span class="label">Usia 0–15 tahun</span><span class="value">321 jiwa</span></li>
        <li><span class="label">Usia 15–65 tahun</span><span class="value">1.695 jiwa</span></li>
        <li><span class="label">Usia 65 tahun ke atas</span><span class="value">169 jiwa</span></li>
        <li><span class="label">Mayoritas Pekerjaan</span><span class="value">Petani</span></li>
      </ul>

      <details class="rincian">
        <summary>Lihat tingkat pendidikan masyarakat</summary>
        <ul class="kv-list">
          <li><span class="label">Lulusan SD</span><span class="value">877 orang</span></li>
          <li><span class="label">Lulusan SMP</span><span class="value">432 orang</span></li>
          <li><span class="label">Lulusan SMA/SMU</span><span class="value">132 orang</span></li>
          <li><span class="label">Lulusan Akademi/D1–D3</span><span class="value">5 orang</span></li>
          <li><span class="label">Lulusan Sarjana</span><span class="value">17 orang</span></li>
        </ul>
      </details>

      <details class="rincian">
        <summary>Lihat sarana &amp; prasarana desa</summary>
        <ul class="kv-list">
          <li><span class="label">Masjid</span><span class="value">7 buah</span></li>
          <li><span class="label">Mushola</span><span class="value">4 buah</span></li>
          <li><span class="label">SD</span><span class="value">2 buah</span></li>
          <li><span class="label">TK</span><span class="value">1 buah</span></li>
          <li><span class="label">Poskesdes</span><span class="value">1 buah</span></li>
          <li><span class="label">Posyandu/Polindes (UKBM)</span><span class="value">7 buah</span></li>
          <li><span class="label">Sarana Olahraga</span><span class="value">3 buah</span></li>
          <li><span class="label">Balai Pertemuan</span><span class="value">1 buah</span></li>
        </ul>
      </details>

      <div class="note" style="margin-top:14px;">📝 Sumber: Papan Monografi Desa, periode <strong>2016/2017</strong> — bukan data terkini. Jumlah penduduk &amp; KK aktual kemungkinan sudah berbeda, disarankan konfirmasi ulang ke perangkat desa untuk data terbaru.</div>
    </div>
  </section>
  </div>

</div>

  <section class="section narrow" id="visimisi">
    <div class="section-head">
      <h2>Visi &amp; Misi Desa</h2>
    </div>
    <div class="card">
      <p style="font-family:'Plus Jakarta Sans',sans-serif; font-size:10.5px; font-weight:600; text-transform:uppercase; letter-spacing:.08em; color:var(--clay); margin-bottom:8px;">Visi</p>
      <p style="font-family:'Plus Jakarta Sans',sans-serif; font-weight:800; font-size:16px; font-weight:600; line-height:1.5; color:var(--ink); margin-bottom:24px;">
        "Mewujudkan Masyarakat Desa Munungkerep Sejahtera untuk Semua"
      </p>

      <p style="font-family:'Plus Jakarta Sans',sans-serif; font-size:10.5px; font-weight:600; text-transform:uppercase; letter-spacing:.08em; color:var(--clay); margin-bottom:10px;">Misi</p>
      <ol style="padding-left:20px; display:flex; flex-direction:column; gap:12px;">
        <li style="font-size:13.5px; line-height:1.6; color:var(--ink);">Menyelenggarakan Pemerintah Desa yang efisien, efektif, dan bersih dengan mengutamakan masyarakat.</li>
        <li style="font-size:13.5px; line-height:1.6; color:var(--ink);">Meningkatkan pembangunan Desa Munungkerep di segala bidang dan aspek.</li>
        <li style="font-size:13.5px; line-height:1.6; color:var(--ink);">Meningkatkan kualitas sumber daya manusia dalam pembangunan desa yang berkelanjutan.</li>
        <li style="font-size:13.5px; line-height:1.6; color:var(--ink);">Mengembangkan pemberdayaan masyarakat dan kemitraan dalam pelaksanaan pembangunan desa.</li>
        <li style="font-size:13.5px; line-height:1.6; color:var(--ink);">Menciptakan rasa aman dan tentram dari segala macam keadaan.</li>
      </ol>
    </div>
  </section>

</main>

<footer>
  Disusun oleh Tim KKN Desa Munungkerep 2026
</footer>

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
  // Transisi halus antar halaman: fade-out dulu, baru pindah
  function pindahHalus(event, url){
    event.preventDefault();
    document.body.style.transition = 'opacity .25s ease, transform .25s ease';
    document.body.style.opacity = '0';
    document.body.style.transform = 'translateY(-6px)';
    setTimeout(() => { window.location.href = url; }, 220);
    return false;
  }

  // Popup detail saat kartu struktur organisasi diklik
  function bukaPopupOrang(jabatan, nama, pathFoto){
    document.getElementById('popup-jabatan').textContent = jabatan;
    document.getElementById('popup-nama').textContent = nama;

    const avatar = document.getElementById('popup-avatar');
    const imgLama = avatar.querySelector('img');
    if (imgLama) imgLama.remove();

    if (pathFoto){
      const img = document.createElement('img');
      img.alt = nama;
      img.onerror = function(){
        console.warn('Foto belum ketemu di:', pathFoto, '— ikon default tetap dipakai.');
        this.remove();
      };
      img.onload = function(){
        console.log('Foto berhasil dimuat:', pathFoto);
      };
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