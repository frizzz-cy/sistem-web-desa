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
  .bd-content img { max-width: 100%; height: auto; display: block; margin: 20px auto; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }

  /* ============ MODAL LAYANAN ADMINISTRASI & INFORMASI PUBLIK ============ */
  .modal-layanan-overlay, .modal-informasi-overlay{ display:none; position:fixed; inset:0; z-index:3000; background:rgba(11,40,63,0.78); backdrop-filter:blur(4px); align-items:center; justify-content:center; padding:20px; }
  .modal-layanan-overlay.show, .modal-informasi-overlay.show{display:flex;}
  .modal-layanan-box { background:#fff; border-radius:14px; max-width:680px; width:100%; max-height:88vh; overflow-y:auto; position:relative; padding:28px 24px; box-shadow:0 20px 40px rgba(0,0,0,0.25); }
  .modal-informasi-box { background:#fff; border-radius:14px; max-width:820px; width:100%; max-height:85vh; overflow-y:auto; position:relative; padding:28px 24px 36px; box-shadow:0 20px 40px rgba(0,0,0,0.25); }
  .modal-informasi-box::-webkit-scrollbar { width:6px; }
  .modal-informasi-box::-webkit-scrollbar-thumb { background:#CBD5E1; border-radius:4px; }
  .modal-layanan-close, .modal-informasi-close{ position:absolute; top:18px; right:18px; background:var(--biru-tua); color:#fff; border:none; width:32px; height:32px; border-radius:50%; cursor:pointer; font-size:15px; display:flex; align-items:center; justify-content:center; }
  .modal-layanan-box h3, .modal-informasi-box h3{font-size:20px; font-weight:800; color:var(--biru-tua); margin-bottom:6px;}
  .modal-layanan-box .sub, .modal-informasi-box .sub{font-size:12.5px; color:var(--teks-muted); margin-bottom:20px;}
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

  /* Style khusus APBDes & Tab di Modal Informasi */
  .info-tab-btn {
    background: #F1F5F9; border: 1px solid #CBD5E1; color: #475569;
    padding: 7px 14px; border-radius: 20px; font-size: 12px; font-weight: 700;
    cursor: pointer; white-space: nowrap; transition: all 0.2s ease;
  }
  .info-tab-btn:hover { background: #E2E8F0; color: #0F172A; }
  .info-tab-btn.active { background: #0B3B60; color: #fff; border-color: #0B3B60; box-shadow: 0 4px 10px rgba(11,59,96,0.2); }

  .apbdes-section { border: 1px solid var(--border); border-radius: 10px; margin-bottom: 16px; overflow: hidden; }
  .apbdes-head { padding: 12px 16px; background: var(--biru-tua); color: #fff; display: flex; justify-content: space-between; align-items: center; font-weight: 700; font-size: 13.5px; }
  .apbdes-head.belanja { background: var(--merah); }
  .apbdes-head.pembiayaan { background: #0F6B58; }
  .apbdes-head .total { background: rgba(255, 255, 255, 0.2); padding: 4px 10px; border-radius: 20px; font-size: 12.5px; letter-spacing: 0.02em; }
  .apbdes-body { padding: 12px 16px; background: #FAFCFE; }
  .apbdes-row { display: flex; justify-content: space-between; align-items: center; padding: 7px 0; border-bottom: 1px dashed #E2E8F0; font-size: 13px; }
  .apbdes-row:last-child { border-bottom: none; }
  .apbdes-row .label { color: #4A5568; }
  .apbdes-row .val { font-weight: 700; color: #1A202C; }
</style>
</head>
<body>

@include('partials.navbar', ['active' => 'beranda'])

<!-- HERO HEADER -->
<header class="hero" id="hero-header">
  <div class="hero-slides" id="hero-slides">
    @foreach($hero_slides as $index => $slide)
      <div class="hero-slide {{ $index === 0 ? 'aktif' : '' }}" style="background-color:#0B3B60;" data-src="{{ $slide }}"></div>
    @endforeach
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
    @foreach($tentang as $para)
      @if(!empty($para))
        <p>{{ $para }}</p>
      @endif
    @endforeach
  </div>

  <div class="sect-head">
    <h2>Layanan & Informasi</h2>
  </div>

  <div class="portal-grid reveal">
    @foreach($layanan_cards as $index => $card)
      @php
        $link = strtolower(trim($card['link'] ?? ''));
        $title = strtolower(trim($card['title'] ?? ''));
      @endphp

      @if(str_contains($title, 'layanan') || str_contains($link, 'layanan') || $index === 0)
        <button class="portal-card" type="button" onclick="bukaModalLayanan()">
          <div class="p-badge">{!! $card['icon'] !!}</div>
          <h3>{{ $card['title'] }}</h3>
          <p>{{ $card['desc'] }}</p>
          <div class="p-link">Lihat Persyaratan <svg viewBox="0 0 12 12" fill="none"><path d="M4 2L9 6L4 10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
        </button>
      @elseif(str_contains($title, 'informasi') || str_contains($title, 'anggaran') || str_contains($link, 'informasi') || str_contains($link, 'apbdes') || $index === 1)
        <button class="portal-card" type="button" onclick="bukaModalInformasi()">
          <div class="p-badge">{!! $card['icon'] !!}</div>
          <h3>{{ $card['title'] }}</h3>
          <p>{{ $card['desc'] }}</p>
          <div class="p-link">Lihat Rincian <svg viewBox="0 0 12 12" fill="none"><path d="M4 2L9 6L4 10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
        </button>
      @elseif(str_contains($title, 'pemerintahan') || str_contains($link, 'pemerintahan') || $index === 2)
        <a href="/profil-desa#pemerintahan" class="portal-card" onclick="return pindahHalus(event, '/profil-desa#pemerintahan')">
          <div class="p-badge">{!! $card['icon'] !!}</div>
          <h3>{{ $card['title'] }}</h3>
          <p>{{ $card['desc'] }}</p>
          <div class="p-link">Lihat Detail <svg viewBox="0 0 12 12" fill="none"><path d="M4 2L9 6L4 10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
        </a>
      @elseif(str_contains($title, 'kelembagaan') || str_contains($link, 'kelembagaan') || $index === 3)
        <button class="portal-card" type="button" onclick="bukaModalKelembagaan()">
          <div class="p-badge">{!! $card['icon'] !!}</div>
          <h3>{{ $card['title'] }}</h3>
          <p>{{ $card['desc'] }}</p>
          <div class="p-link">Lihat Detail <svg viewBox="0 0 12 12" fill="none"><path d="M4 2L9 6L4 10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
        </button>
      @elseif(str_contains($title, 'kependudukan') || str_contains($title, 'demografi') || str_contains($link, 'demografi') || $index === 4)
        <button class="portal-card" type="button" onclick="bukaModalDemografi()">
          <div class="p-badge">{!! $card['icon'] !!}</div>
          <h3>{{ $card['title'] }}</h3>
          <p>{{ $card['desc'] }}</p>
          <div class="p-link">Lihat Data <svg viewBox="0 0 12 12" fill="none"><path d="M4 2L9 6L4 10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
        </button>
      @elseif(str_contains($title, 'kegiatan') || str_contains($link, 'kegiatan') || $index === 5)
        <a href="/kegiatan" class="portal-card" onclick="return pindahHalus(event, '/kegiatan')">
          <div class="p-badge">{!! $card['icon'] !!}</div>
          <h3>{{ $card['title'] }}</h3>
          <p>{{ $card['desc'] }}</p>
          <div class="p-link">Lihat Detail <svg viewBox="0 0 12 12" fill="none"><path d="M4 2L9 6L4 10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
        </a>
      @else
        <button class="portal-card" type="button" onclick="bukaModalDemografi()">
          <div class="p-badge">{!! $card['icon'] !!}</div>
          <h3>{{ $card['title'] }}</h3>
          <p>{{ $card['desc'] }}</p>
          <div class="p-link">Lihat Detail <svg viewBox="0 0 12 12" fill="none"><path d="M4 2L9 6L4 10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
        </button>
      @endif
    @endforeach
  </div>

  <!-- ==================== TEMPLATE KARTU BERITA ==================== -->
  <div class="berita-section reveal">
    <div class="berita-head" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:20px;">
      <h2 style="margin:0;">Berita Desa Terkini</h2>
      @if(count($beritas) > 0)
        <button class="btn-semua-berita" onclick="bukaModalSemuaBerita()" style="background:#0B3B60; color:#fff; border:none; padding:8px 18px; border-radius:20px; font-weight:700; font-size:13px; cursor:pointer; display:inline-flex; align-items:center; gap:6px; box-shadow:0 4px 12px rgba(11,59,96,0.18); transition:all 0.2s ease;">
          📰 Lihat Semua Berita ({{ count($beritas) }}) <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </button>
      @endif
    </div>
    
    <div class="berita-grid">
      @forelse($beritas->take(3) as $item)
      <div class="berita-card">
        <img src="{{ $item->foto ? asset('storage/'.$item->foto) : 'https://placehold.co/600x400/e2e8f0/94a3b8?text=Gambar+Berita' }}" alt="{{ $item->judul }}" class="berita-img" loading="lazy">
        <div class="berita-content">
          <span class="berita-badge">{{ $item->kategori }}</span>
          <h3 class="berita-title">{{ $item->judul }}</h3>
          <div class="berita-date">{{ date('d M Y', strtotime($item->tanggal)) }}</div>
          @php
            $excerptClean = preg_replace('/!\[.*?\]\((https?:\/\/.*?)\)/i', '', $item->isi);
            $excerptClean = preg_replace('/https?:\/\/\S+\.(?:jpg|jpeg|png|gif|webp|svg)\b/i', '', $excerptClean);
            $excerptClean = trim(strip_tags($excerptClean));
          @endphp
          <p class="berita-excerpt">{{ Str::limit($excerptClean, 120) }}</p>
          <a class="berita-link" onclick="bukaBerita(this)" 
             data-id="{{ $item->id }}"
             data-judul="{{ $item->judul }}"
             data-kategori="{{ $item->kategori }}"
             data-tanggal="{{ date('d M Y', strtotime($item->tanggal)) }}"
             data-foto="{{ $item->foto ? asset('storage/'.$item->foto) : 'https://placehold.co/600x400/e2e8f0/94a3b8?text=Gambar+Berita' }}"
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

  @include('partials.footer')
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

<!-- Modal Informasi Publik / Transparansi APBDes -->
<div class="modal-informasi-overlay" id="modal-informasi-overlay" onclick="tutupModalInformasi(event)">
  <div class="modal-informasi-box">
    <button class="modal-informasi-close" onclick="tutupModalInformasi()">✕</button>
    <h3>Informasi Publik &amp; Transparansi Desa</h3>
    <div class="sub">Portal Resmi Keterbukaan Informasi Publik Desa Munungkerep</div>

    <!-- TAB NAVIGASI -->
    <div class="info-tab-btns" style="display:flex; flex-wrap:wrap; gap:8px; margin-bottom:20px;">
      <button class="info-tab-btn active" onclick="switchInfoTab('apbdes', this)">💰 APBDes</button>
      <button class="info-tab-btn" onclick="switchInfoTab('geografi', this)">🗺️ Geografi &amp; Wilayah</button>
      <button class="info-tab-btn" onclick="switchInfoTab('demografi', this)">👥 Demografi</button>
      <button class="info-tab-btn" onclick="switchInfoTab('fasilitas', this)">🏥 Sarana &amp; Prasarana</button>
      <button class="info-tab-btn" onclick="switchInfoTab('kelembagaan', this)">🤝 Kelembagaan</button>
    </div>

    @php
      $ap = $apbdes ?? [];
      $demo = $demografi ?? [];
    @endphp

    <!-- TAB 1: APBDES -->
    <div class="info-tab-content" id="infotab-apbdes">
      <!-- 1. PENDAPATAN DESA -->
      <div class="apbdes-section">
        <div class="apbdes-head">
          <span><i class="fas fa-wallet" style="margin-right:6px;"></i> PENDAPATAN DESA</span>
          <span class="total">{{ $ap['pendapatan_total'] ?? 'Rp 1.663.629.803,00' }}</span>
        </div>
        <div class="apbdes-body">
          <div class="apbdes-row"><span class="label">Pendapatan Asli Desa (PAD)</span><span class="val">{{ $ap['pad'] ?? 'Rp 230.760.000,00' }}</span></div>
          <div class="apbdes-row"><span class="label">Dana Desa (DD - APBN Pusat)</span><span class="val">{{ $ap['dd'] ?? 'Rp 303.093.000,00' }}</span></div>
          <div class="apbdes-row"><span class="label">Alokasi Dana Desa (ADD - APBD Jombang)</span><span class="val">{{ $ap['add'] ?? 'Rp 376.615.000,00' }}</span></div>
          <div class="apbdes-row"><span class="label">Bagi Hasil Pajak &amp; Retribusi (PDRD)</span><span class="val">{{ $ap['pdrd'] ?? 'Rp 85.805.300,00' }}</span></div>
          <div class="apbdes-row"><span class="label">Bantuan Keuangan (BK Provinsi/Kabupaten)</span><span class="val">{{ $ap['bk'] ?? 'Rp 539.600.603,00' }}</span></div>
          <div class="apbdes-row"><span class="label">Lain-Lain Pendapatan Desa Sah (DLL)</span><span class="val">{{ $ap['dll'] ?? 'Rp 127.755.900,00' }}</span></div>

          <div style="background:#E0F2FE; border-left:3px solid #0284C7; padding:8px 12px; margin-top:10px; border-radius:4px; font-size:12px; color:#0369A1; line-height:1.5;">
            <strong>ℹ️ Rincian Sumber Dana:</strong> {{ $ap['keterangan_pendapatan'] ?? 'Sumber penerimaan APBDes berasal dari Pendapatan Asli Desa (PAD), Dana Desa (DD APBN Pusat), Alokasi Dana Desa (ADD APBD Kab. Jombang), Bagi Hasil Pajak & Retribusi Daerah (PDRD), Bantuan Keuangan (BK Provinsi/Kabupaten), serta Lain-Lain Pendapatan Desa Sah.' }}
          </div>
        </div>
      </div>

      <!-- 2. BELANJA DESA -->
      <div class="apbdes-section">
        <div class="apbdes-head belanja">
          <span><i class="fas fa-shopping-bag" style="margin-right:6px;"></i> BELANJA DESA</span>
          <span class="total">{{ $ap['belanja_total'] ?? 'Rp 1.676.895.127,92' }}</span>
        </div>
        <div class="apbdes-body">
          <div class="apbdes-row"><span class="label">Penyelenggaraan Pemerintahan Desa</span><span class="val">{{ $ap['belanja_pemerintahan'] ?? 'Rp 866.594.524,92' }}</span></div>
          <div class="apbdes-row"><span class="label">Pelaksanaan Pembangunan Desa</span><span class="val">{{ $ap['belanja_pembangunan'] ?? 'Rp 582.090.603,00' }}</span></div>
          <div class="apbdes-row"><span class="label">Pembinaan Kemasyarakatan</span><span class="val">{{ $ap['belanja_pembinaan'] ?? 'Rp 42.450.000,00' }}</span></div>
          <div class="apbdes-row"><span class="label">Pemberdayaan Masyarakat</span><span class="val">{{ $ap['belanja_pemberdayaan'] ?? 'Rp 158.000.000,00' }}</span></div>
          <div class="apbdes-row"><span class="label">Penanggulangan Bencana &amp; Keadaan Darurat</span><span class="val">{{ $ap['belanja_bencana'] ?? 'Rp 27.760.000,00' }}</span></div>

          <div style="background:#FEF2F2; border-left:3px solid #EF4444; padding:8px 12px; margin-top:10px; border-radius:4px; font-size:12px; color:#B91C1C; line-height:1.5;">
            <strong>📌 Prioritas Alokasi Belanja:</strong> {{ $ap['keterangan_belanja'] ?? 'Pengalokasian anggaran belanja desa diprioritaskan untuk Penyelenggaraan Pemerintahan Desa, Pembangunan Sarana & Prasarana Desa, Pembinaan Kemasyarakatan, Pemberdayaan Masyarakat, serta Penanggulangan Bencana/Darurat.' }}
          </div>
        </div>
      </div>

      <!-- 3. PEMBIAYAAN DESA -->
      <div class="apbdes-section">
        <div class="apbdes-head pembiayaan">
          <span><i class="fas fa-coins" style="margin-right:6px;"></i> PEMBIAYAAN DESA (NETTO)</span>
          <span class="total">{{ $ap['pembiayaan_total'] ?? 'Rp 13.265.324,92' }}</span>
        </div>
        <div class="apbdes-body">
          <div class="apbdes-row"><span class="label">Penerimaan Pembiayaan (SiLPA)</span><span class="val">{{ $ap['penerimaan_pembiayaan'] ?? 'Rp 13.265.324,92' }}</span></div>
          <div class="apbdes-row"><span class="label">Pengeluaran Pembiayaan</span><span class="val">{{ $ap['pengeluaran_pembiayaan'] ?? 'Rp 0,00' }}</span></div>

          <div style="background:#ECFDF5; border-left:3px solid #10B981; padding:8px 12px; margin-top:10px; border-radius:4px; font-size:12px; color:#047857; line-height:1.5;">
            <strong>💡 Keterangan Pembiayaan:</strong> {{ $ap['keterangan_pembiayaan'] ?? 'Penerimaan Pembiayaan Netto berasal dari Sisa Lebih Perhitungan Anggaran (SiLPA) tahun anggaran sebelumnya.' }}
          </div>
        </div>
      </div>
    </div>

    <!-- TAB 2: GEOGRAFI & WILAYAH -->
    <div class="info-tab-content" id="infotab-geografi" style="display:none;">
      <div class="apbdes-section">
        <div class="apbdes-head" style="background:#1668A3;">
          <span><i class="fas fa-map-marked-alt" style="margin-right:6px;"></i> GEOGRAFI &amp; BATAS WILAYAH</span>
          <span class="total">209,909 Ha</span>
        </div>
        <div class="apbdes-body">
          <div class="apbdes-row"><span class="label">Nama Desa / Kecamatan / Kab.</span><span class="val">Munungkerep / Kabuh / Jombang</span></div>
          <div class="apbdes-row"><span class="label">Luas Total Wilayah</span><span class="val">209,909 Hektar</span></div>
          <div class="apbdes-row"><span class="label">Iklim Dominan</span><span class="val">Kemarau &amp; Penghujan</span></div>
          <div class="apbdes-row"><span class="label">Batas Wilayah Utara</span><span class="val">Hutan</span></div>
          <div class="apbdes-row"><span class="label">Batas Wilayah Selatan</span><span class="val">Desa Kauman</span></div>
          <div class="apbdes-row"><span class="label">Batas Wilayah Timur</span><span class="val">Desa Katemas, Kec. Kudu</span></div>
          <div class="apbdes-row"><span class="label">Batas Wilayah Barat</span><span class="val">Desa Genengan Jasem</span></div>
        </div>
      </div>

      <div class="apbdes-section">
        <div class="apbdes-head" style="background:#0F6B58;">
          <span><i class="fas fa-home" style="margin-right:6px;"></i> PEMBAGIAN WILAYAH DUSUN (7 DUSUN)</span>
          <span class="total">7 RW / 15 RT</span>
        </div>
        <div class="apbdes-body">
          <div style="font-size: 13px; color: var(--teks); line-height: 1.6;">
            Wilayah administratif Desa Munungkerep terbagi menjadi <strong>7 Dusun</strong>:
          </div>
          <div style="display: flex; flex-wrap: wrap; gap: 6px; margin-top: 10px;">
            <span style="background:#E0F2FE; color:#0369A1; padding:5px 10px; border-radius:6px; font-weight:700; font-size:12px;">🏡 Dusun Munungkerep</span>
            <span style="background:#E0F2FE; color:#0369A1; padding:5px 10px; border-radius:6px; font-weight:700; font-size:12px;">🏡 Dusun Karanggebang</span>
            <span style="background:#E0F2FE; color:#0369A1; padding:5px 10px; border-radius:6px; font-weight:700; font-size:12px;">🏡 Dusun Slumbung</span>
            <span style="background:#E0F2FE; color:#0369A1; padding:5px 10px; border-radius:6px; font-weight:700; font-size:12px;">🏡 Dusun Kalipang</span>
            <span style="background:#E0F2FE; color:#0369A1; padding:5px 10px; border-radius:6px; font-weight:700; font-size:12px;">🏡 Dusun Duren</span>
            <span style="background:#E0F2FE; color:#0369A1; padding:5px 10px; border-radius:6px; font-weight:700; font-size:12px;">🏡 Dusun Kadenan</span>
            <span style="background:#E0F2FE; color:#0369A1; padding:5px 10px; border-radius:6px; font-weight:700; font-size:12px;">🏡 Dusun Jatirubuh</span>
          </div>
        </div>
      </div>
    </div>

    <!-- TAB 3: DEMOGRAFI -->
    <div class="info-tab-content" id="infotab-demografi" style="display:none;">
      <div class="apbdes-section">
        <div class="apbdes-head" style="background:#1668A3;">
          <span><i class="fas fa-users" style="margin-right:6px;"></i> DATA DEMOGRAFI &amp; KEPENDUDUKAN</span>
          <span class="total">{{ $demo['total_penduduk'] ?? '2.113' }} Jiwa</span>
        </div>
        <div class="apbdes-body">
          <div class="apbdes-row"><span class="label">Total Penduduk</span><span class="val">{{ $demo['total_penduduk'] ?? '2.113' }} Orang</span></div>
          <div class="apbdes-row"><span class="label">Penduduk Laki-Laki</span><span class="val">{{ $demo['laki_laki'] ?? '1.042' }} Orang</span></div>
          <div class="apbdes-row"><span class="label">Penduduk Perempuan</span><span class="val">{{ $demo['perempuan'] ?? '1.071' }} Orang</span></div>
          <div class="apbdes-row"><span class="label">Total Kepala Keluarga (KK)</span><span class="val">{{ $demo['total_kk'] ?? '761' }} KK</span></div>
          <div class="apbdes-row"><span class="label">Agama Mayoritas</span><span class="val">Islam (100%)</span></div>
        </div>
      <div class="apbdes-section">
        <div class="apbdes-head" style="background:#0B3B60;">
          <span><i class="fas fa-child" style="margin-right:6px;"></i> KOMPOSISI KELOMPOK USIA PENDUDUK</span>
          <span class="total">Demografi Usia</span>
        </div>
        <div class="apbdes-body">
          <div class="apbdes-row"><span class="label">Usia Balita (0 – 4 Tahun)</span><span class="val">{{ $demo['usia_balita'] ?? '145' }} Orang</span></div>
          <div class="apbdes-row"><span class="label">Usia Anak-Anak (5 – 14 Tahun)</span><span class="val">{{ $demo['usia_anak'] ?? '312' }} Orang</span></div>
          <div class="apbdes-row"><span class="label">Usia Produktif / Angkatan Kerja (15 – 55 Tahun)</span><span class="val">{{ $demo['usia_produktif'] ?? '1.169' }} Orang</span></div>
          <div class="apbdes-row"><span class="label">Usia Dewasa / Pra-Lansia (56 – 64 Tahun)</span><span class="val">{{ $demo['usia_pralansia'] ?? '280' }} Orang</span></div>
          <div class="apbdes-row"><span class="label">Usia Lansia (65+ Tahun)</span><span class="val">{{ $demo['usia_lansia'] ?? '207' }} Orang</span></div>
        </div>
      </div>

      <div class="apbdes-section">
        <div class="apbdes-head" style="background:#D4A017;">
          <span><i class="fas fa-briefcase" style="margin-right:6px;"></i> MATA PENCAHARIAN &amp; KESEJAHTERAAN</span>
          <span class="total">Mayoritas Tani</span>
        </div>
        <div class="apbdes-body">
          <div class="apbdes-row"><span class="label">Petani Utama / Pemilik Lahan</span><span class="val">{{ $demo['petani_utama'] ?? '986' }} Orang</span></div>
          <div class="apbdes-row"><span class="label">Buruh Tani</span><span class="val">{{ $demo['buruh_tani'] ?? '457' }} Orang</span></div>
          <div class="apbdes-row"><span class="label">Total Angkatan Kerja (15-55 Thn)</span><span class="val">{{ $demo['angkatan_kerja'] ?? '1.169' }} Orang</span></div>
          <div class="apbdes-row"><span class="label">Tingkat Kesejahteraan Miskin</span><span class="val">{{ $demo['kk_miskin'] ?? '450' }} KK</span></div>
          <div class="apbdes-row"><span class="label">Tingkat Kesejahteraan Sedang</span><span class="val">{{ $demo['kk_sedang'] ?? '300' }} KK</span></div>
          <div class="apbdes-row"><span class="label">Tingkat Kesejahteraan Kaya</span><span class="val">{{ $demo['kk_kaya'] ?? '11' }} KK</span></div>
        </div>
      </div>

      <div class="apbdes-section">
        <div class="apbdes-head" style="background:#0F6B58;">
          <span><i class="fas fa-book" style="margin-right:6px;"></i> ASAL USUL NAMA MUNUNGKEREP</span>
        </div>
        <div class="apbdes-body" style="font-size:13px; color:var(--teks); line-height:1.6;">
          Nama Desa Munungkerep berasal dari kata <strong>"Munung"</strong> (pohon Sriwikutil) dan <strong>"Kerep"</strong> (rapat/banyak). Tokoh perintis sejarah desa dipelopori oleh <strong>Ki Suroyudo, Ki Godek, dan Mbah Jenggot Surowijoyo</strong>. Kepala Desa saat ini dipimpin oleh <strong>Ibu Sutrismi</strong>.
        </div>
      </div>
    </div>

    <!-- TAB 4: SARANA & PRASARANA -->
    <div class="info-tab-content" id="infotab-fasilitas" style="display:none;">
      <div class="apbdes-section">
        <div class="apbdes-head" style="background:#1668A3;">
          <span><i class="fas fa-building" style="margin-right:6px;"></i> SARANA PENDIDIKAN &amp; KESEHATAN</span>
        </div>
        <div class="apbdes-body">
          <div class="apbdes-row"><span class="label">Gedung TK</span><span class="val">1 Unit</span></div>
          <div class="apbdes-row"><span class="label">Gedung SD</span><span class="val">2 Unit</span></div>
          <div class="apbdes-row"><span class="label">TPA / TPQ</span><span class="val">7 Unit</span></div>
          <div class="apbdes-row"><span class="label">Posyandu Balita</span><span class="val">7 Unit</span></div>
          <div class="apbdes-row"><span class="label">Posyandu Lansia</span><span class="val">7 Unit</span></div>
          <div class="apbdes-row"><span class="label">Polindes / Jubastik</span><span class="val">1 Unit / 1 Unit</span></div>
          <div class="apbdes-row"><span class="label">Tenaga Bidan Desa</span><span class="val">1 Orang</span></div>
        </div>
      </div>

      <div class="apbdes-section">
        <div class="apbdes-head" style="background:#0F6B58;">
          <span><i class="fas fa-futbol" style="margin-right:6px;"></i> FASILITAS UMUM &amp; PETERNAKAN</span>
        </div>
        <div class="apbdes-body">
          <div class="apbdes-row"><span class="label">Tempat Ibadah (Masjid/Musholla)</span><span class="val">10 Unit</span></div>
          <div class="apbdes-row"><span class="label">Lapangan Olahraga</span><span class="val">1 Unit</span></div>
          <div class="apbdes-row"><span class="label">Populasi Ternak Ayam / Itik</span><span class="val">{{ $demo['ternak_ayam'] ?? '450' }} Ekor</span></div>
          <div class="apbdes-row"><span class="label">Populasi Ternak Kambing</span><span class="val">{{ $demo['ternak_kambing'] ?? '170' }} Ekor</span></div>
          <div class="apbdes-row"><span class="label">Populasi Ternak Sapi</span><span class="val">{{ $demo['ternak_sapi'] ?? '76' }} Ekor</span></div>
        </div>
      </div>
    </div>

    <!-- TAB 5: KELEMBAGAAN DESA -->
    <div class="info-tab-content" id="infotab-kelembagaan" style="display:none;">
      <div class="apbdes-section">
        <div class="apbdes-head" style="background:#1668A3;">
          <span><i class="fas fa-hands-helping" style="margin-right:6px;"></i> KELEMBAGAAN &amp; ORGANISASI DESA</span>
        </div>
        <div class="apbdes-body">
          <div style="font-size: 13px; color: var(--teks); line-height: 1.6; margin-bottom: 12px;">
            Desa Munungkerep memiliki berbagai kelembagaan dan organisasi kemasyarakatan yang aktif:
          </div>
          <div style="display: flex; flex-direction: column; gap: 8px;">
            <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:8px 12px; border-radius:6px; font-size:12.5px;">
              <strong>🏛️ BPD (Badan Permusyawaratan Desa)</strong><br>
              <span style="color:var(--teks-muted);">Perwujudan demokrasi desa untuk menetapkan Perdes dan menampung aspirasi warga.</span>
            </div>
            <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:8px 12px; border-radius:6px; font-size:12.5px;">
              <strong>🌺 PKK &amp; Dharma Wanita</strong><br>
              <span style="color:var(--teks-muted);">Pemberdayaan kesejahteraan keluarga dan kegiatan kemasyarakatan wanita desa.</span>
            </div>
            <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:8px 12px; border-radius:6px; font-size:12.5px;">
              <strong>⚡ Karang Taruna &amp; Remaja Masjid</strong><br>
              <span style="color:var(--teks-muted);">Wadah pembinaan dan kegiatan kepemudaan, sosial, serta keagamaan.</span>
            </div>
            <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:8px 12px; border-radius:6px; font-size:12.5px;">
              <strong>📖 Jamiyah Yasin, Tahlil &amp; Kelompok Arisan</strong><br>
              <span style="color:var(--teks-muted);">Kegiatan rutin keagamaan dan kebersamaan warga di 7 dusun.</span>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- Modal Data Kependudukan (Demografi) -->
<div class="modal-informasi-overlay" id="modal-demografi-overlay" onclick="tutupModalDemografi(event)">
  <div class="modal-informasi-box" style="max-width:760px;">
    <button class="modal-informasi-close" onclick="tutupModalDemografi()">✕</button>
    <h3>Statistik &amp; Data Kependudukan Desa</h3>
    <div class="sub">Data Monografi &amp; Profil Kependudukan Desa Munungkerep</div>

    <!-- HIGHLIGHT STATS GRID (4 KARTU ANGKAN) -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(130px, 1fr)); gap: 10px; margin-bottom: 20px;">
      <div style="background: linear-gradient(135deg, #0B3B60, #1668A3); color: #fff; padding: 12px 14px; border-radius: 10px; text-align: center;">
        <div style="font-size: 22px; font-weight: 800;">{{ $demo['total_penduduk'] ?? '2.113' }}</div>
        <div style="font-size: 11px; opacity: 0.9; font-weight: 600;">Total Penduduk (Jiwa)</div>
      </div>
      <div style="background: linear-gradient(135deg, #0F6B58, #15803D); color: #fff; padding: 12px 14px; border-radius: 10px; text-align: center;">
        <div style="font-size: 22px; font-weight: 800;">{{ $demo['total_kk'] ?? '761' }}</div>
        <div style="font-size: 11px; opacity: 0.9; font-weight: 600;">Kepala Keluarga (KK)</div>
      </div>
      <div style="background: linear-gradient(135deg, #0284C7, #0369A1); color: #fff; padding: 12px 14px; border-radius: 10px; text-align: center;">
        <div style="font-size: 22px; font-weight: 800;">{{ $demo['laki_laki'] ?? '1.042' }}</div>
        <div style="font-size: 11px; opacity: 0.9; font-weight: 600;">Laki-Laki</div>
      </div>
      <div style="background: linear-gradient(135deg, #DB2777, #BE185D); color: #fff; padding: 12px 14px; border-radius: 10px; text-align: center;">
        <div style="font-size: 22px; font-weight: 800;">{{ $demo['perempuan'] ?? '1.071' }}</div>
        <div style="font-size: 11px; opacity: 0.9; font-weight: 600;">Perempuan</div>
      </div>
    </div>

    <!-- SEKSI KELOMPOK USIA PENDUDUK -->
    <div class="apbdes-section">
      <div class="apbdes-head" style="background:#0B3B60;">
        <span><i class="fas fa-child" style="margin-right:6px;"></i> KOMPOSISI KELOMPOK USIA PENDUDUK</span>
        <span class="total">Demografi Usia</span>
      </div>
      <div class="apbdes-body">
        <div class="apbdes-row"><span class="label">Usia Balita (0 – 4 Tahun)</span><span class="val">{{ $demo['usia_balita'] ?? '145' }} Orang</span></div>
        <div class="apbdes-row"><span class="label">Usia Anak-Anak (5 – 14 Tahun)</span><span class="val">{{ $demo['usia_anak'] ?? '312' }} Orang</span></div>
        <div class="apbdes-row"><span class="label">Usia Produktif / Angkatan Kerja (15 – 55 Tahun)</span><span class="val">{{ $demo['usia_produktif'] ?? '1.169' }} Orang</span></div>
        <div class="apbdes-row"><span class="label">Usia Dewasa / Pra-Lansia (56 – 64 Tahun)</span><span class="val">{{ $demo['usia_pralansia'] ?? '280' }} Orang</span></div>
        <div class="apbdes-row"><span class="label">Usia Lansia (65+ Tahun)</span><span class="val">{{ $demo['usia_lansia'] ?? '207' }} Orang</span></div>
      </div>
    </div>

    <!-- SEKSI 1: MATA PENCAHARIAN & KETENAGAKERJAAN -->
    <div class="apbdes-section">
      <div class="apbdes-head" style="background:#1668A3;">
        <span><i class="fas fa-briefcase" style="margin-right:6px;"></i> MATA PENCAHARIAN &amp; KETENAGAKERJAAN</span>
        <span class="total">Mayoritas Tani</span>
      </div>
      <div class="apbdes-body">
        <div class="apbdes-row"><span class="label">Petani Pemilik Lahan Utama</span><span class="val">{{ $demo['petani_utama'] ?? '986' }} Orang</span></div>
        <div class="apbdes-row"><span class="label">Buruh Tani</span><span class="val">{{ $demo['buruh_tani'] ?? '457' }} Orang</span></div>
        <div class="apbdes-row"><span class="label">Total Angkatan Kerja Aktif (Usia 15-55 Thn)</span><span class="val">{{ $demo['angkatan_kerja'] ?? '1.169' }} Orang</span></div>
        <div class="apbdes-row"><span class="label">Belum / Dalam Pencarian Kerja</span><span class="val">{{ $demo['belum_kerja'] ?? '55' }} Orang</span></div>
      </div>
    </div>

    <!-- SEKSI 2: TINGKAT KESEJAHTERAAN EKONOMI -->
    <div class="apbdes-section">
      <div class="apbdes-head" style="background:#D4A017;">
        <span><i class="fas fa-chart-line" style="margin-right:6px;"></i> TINGKAT KESEJAHTERAAN KELUARGA (KK)</span>
        <span class="total">{{ $demo['total_kk'] ?? '761' }} KK Total</span>
      </div>
      <div class="apbdes-body">
        <div class="apbdes-row"><span class="label">Masyarakat Ekonomi Prasejahtera (Miskin)</span><span class="val">{{ $demo['kk_miskin'] ?? '450' }} KK</span></div>
        <div class="apbdes-row"><span class="label">Masyarakat Ekonomi Menengah (Sedang)</span><span class="val">{{ $demo['kk_sedang'] ?? '300' }} KK</span></div>
        <div class="apbdes-row"><span class="label">Masyarakat Ekonomi Sejahtera (Kaya)</span><span class="val">{{ $demo['kk_kaya'] ?? '11' }} KK</span></div>
      </div>
    </div>

    <!-- SEKSI 3: PENDIDIKAN & AGAMA -->
    <div class="apbdes-section">
      <div class="apbdes-head" style="background:#0F6B58;">
        <span><i class="fas fa-graduation-cap" style="margin-right:6px;"></i> PENDIDIKAN &amp; AGAMA WARGA</span>
        <span class="total">100% Islam</span>
      </div>
      <div class="apbdes-body">
        <div class="apbdes-row"><span class="label">Agama Warga</span><span class="val">Islam (100% / {{ $demo['agama_islam'] ?? '2.113' }} Orang)</span></div>
        <div class="apbdes-row"><span class="label">Rentang Pendidikan Tidak / Belum Tamat SD</span><span class="val">{{ $demo['pendidikan_sd'] ?? '542' }} Orang</span></div>
        <div class="apbdes-row"><span class="label">Lulusan Sarjana / Perguruan Tinggi (S-1)</span><span class="val">{{ $demo['pendidikan_s1'] ?? '40' }} Orang</span></div>
      </div>
    </div>

    <!-- SEKSI 4: PETERNAKAN WARGA -->
    <div class="apbdes-section">
      <div class="apbdes-head" style="background:#854D0E;">
        <span><i class="fas fa-paw" style="margin-right:6px;"></i> POPULASI PETERNAKAN WARGA</span>
      </div>
      <div class="apbdes-body">
        <div class="apbdes-row"><span class="label">Populasi Ternak Ayam &amp; Itik</span><span class="val">{{ $demo['ternak_ayam'] ?? '450' }} Ekor</span></div>
        <div class="apbdes-row"><span class="label">Populasi Ternak Kambing</span><span class="val">{{ $demo['ternak_kambing'] ?? '170' }} Ekor</span></div>
        <div class="apbdes-row"><span class="label">Populasi Ternak Sapi</span><span class="val">{{ $demo['ternak_sapi'] ?? '76' }} Ekor</span></div>
      </div>
    </div>

  </div>
</div>

<!-- Modal Kelembagaan Desa -->
<div class="modal-informasi-overlay" id="modal-kelembagaan-overlay" onclick="tutupModalKelembagaan(event)">
  <div class="modal-informasi-box" style="max-width:720px;">
    <button class="modal-informasi-close" onclick="tutupModalKelembagaan()">✕</button>
    <h3>Kelembagaan &amp; Organisasi Desa</h3>
    <div class="sub">Daftar Kelembagaan Resmi &amp; Organisasi Kemasyarakatan Desa Munungkerep</div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 12px;">
      <!-- BPD -->
      <div style="background: #F8FAFC; border: 1.5px solid #CBD5E1; padding: 14px; border-radius: 10px;">
        <div style="font-size: 14px; font-weight: 800; color: var(--biru-tua); margin-bottom: 4px;">
          🏛️ BPD (Badan Permusyawaratan Desa)
        </div>
        <div style="font-size: 12.5px; color: var(--teks-muted); line-height: 1.55;">
          Bertindak sebagai perwujudan demokrasi desa untuk menetapkan Peraturan Desa bersama Kepala Desa dan menampung aspirasi masyarakat.
        </div>
      </div>

      <!-- PKK DHARMA WANITA -->
      <div style="background: #F8FAFC; border: 1.5px solid #CBD5E1; padding: 14px; border-radius: 10px;">
        <div style="font-size: 14px; font-weight: 800; color: #DB2777; margin-bottom: 4px;">
          🌺 PKK &amp; Dharma Wanita Desa
        </div>
        <div style="font-size: 12.5px; color: var(--teks-muted); line-height: 1.55;">
          Pemberdayaan kesejahteraan keluarga, kegiatan sosial, dan kemasyarakatan wanita Desa Munungkerep.
        </div>
      </div>

      <!-- KARANG TARUNA -->
      <div style="background: #F8FAFC; border: 1.5px solid #CBD5E1; padding: 14px; border-radius: 10px;">
        <div style="font-size: 14px; font-weight: 800; color: #0284C7; margin-bottom: 4px;">
          ⚡ Karang Taruna Desa
        </div>
        <div style="font-size: 12.5px; color: var(--teks-muted); line-height: 1.55;">
          Wadah pembinaan kepemudaan, olah raga, kreativitas sosial, dan kegiatan gotong royong pemuda desa.
        </div>
      </div>

      <!-- REMAJA MASJID & JAMIYAH -->
      <div style="background: #F8FAFC; border: 1.5px solid #CBD5E1; padding: 14px; border-radius: 10px;">
        <div style="font-size: 14px; font-weight: 800; color: #0F6B58; margin-bottom: 4px;">
          🕌 Remaja Masjid &amp; Jamiyah Yasin Tahlil
        </div>
        <div style="font-size: 12.5px; color: var(--teks-muted); line-height: 1.55;">
          Wadah pembinaan kerohanian Islam, pengajian rutin, dan kebersamaan warga di 7 dusun.
        </div>
      </div>

      <!-- POSYANDU BALITA & LANSIA -->
      <div style="background: #F8FAFC; border: 1.5px solid #CBD5E1; padding: 14px; border-radius: 10px;">
        <div style="font-size: 14px; font-weight: 800; color: #1668A3; margin-bottom: 4px;">
          🏥 Posyandu Balita &amp; Lansia (7 Unit)
        </div>
        <div style="font-size: 12.5px; color: var(--teks-muted); line-height: 1.55;">
          Pelayanan kesehatan dasar ibu, balita, dan lansia terpadu di 7 dusun Desa Munungkerep.
        </div>
      </div>

      <!-- KELOMPOK ARISAN -->
      <div style="background: #F8FAFC; border: 1.5px solid #CBD5E1; padding: 14px; border-radius: 10px;">
        <div style="font-size: 14px; font-weight: 800; color: #D4A017; margin-bottom: 4px;">
          🤝 Kelompok Arisan &amp; Kemasyarakatan
        </div>
        <div style="font-size: 12.5px; color: var(--teks-muted); line-height: 1.55;">
          Wadah silaturahmi, gotong royong, dan arisan warga desa di tingkat RT dan RW.
        </div>
      </div>
    </div>

  </div>
</div>

<!-- Modal Semua Berita Desa -->
<div class="modal-informasi-overlay" id="modal-semua-berita-overlay" onclick="tutupModalSemuaBerita(event)">
  <div class="modal-informasi-box" style="max-width:860px; padding:28px 24px;">
    <button class="modal-informasi-close" onclick="tutupModalSemuaBerita()">✕</button>
    <h3>📰 Arsip Lengkap Berita Desa</h3>
    <div class="sub">Daftar Seluruh Berita &amp; Informasi Resmi Desa Munungkerep</div>

    <!-- Input Cari Berita -->
    <div style="margin-bottom:20px;">
      <input type="text" id="cari-berita-input" onkeyup="filterModalBerita()" placeholder="🔍 Cari berita berdasarkan judul atau kategori..." style="width:100%; padding:10px 16px; border-radius:20px; border:1.5px solid #CBD5E1; font-size:13px; font-family:'Plus Jakarta Sans',sans-serif; outline:none; box-sizing:border-box;">
    </div>

    <!-- Grid Daftar Berita di Modal -->
    <div class="modal-berita-grid" style="display:grid; grid-template-columns:repeat(auto-fit, minmax(250px, 1fr)); gap:16px; max-height:60vh; overflow-y:auto; padding-right:4px;" id="modal-berita-container">
      @foreach($beritas as $item)
        <div class="berita-card item-modal-berita" data-judul="{{ strtolower($item->judul) }}" data-kategori="{{ strtolower($item->kategori) }}" style="margin:0; box-shadow:0 2px 10px rgba(0,0,0,0.05); border:1px solid #E2E8F0;">
          <img src="{{ $item->foto ? asset('storage/'.$item->foto) : 'https://placehold.co/600x400/e2e8f0/94a3b8?text=Gambar+Berita' }}" alt="{{ $item->judul }}" class="berita-img" style="height:150px;" loading="lazy">
          <div class="berita-content" style="padding:14px;">
            <span class="berita-badge" style="font-size:10px; padding:3px 10px;">{{ $item->kategori }}</span>
            <h3 class="berita-title" style="font-size:14px; margin:6px 0; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">{{ $item->judul }}</h3>
            <div class="berita-date" style="font-size:11px; color:#888; margin-bottom:8px;">{{ date('d M Y', strtotime($item->tanggal)) }}</div>
            @php
              $excerptCleanModal = preg_replace('/!\[.*?\]\((https?:\/\/.*?)\)/i', '', $item->isi);
              $excerptCleanModal = preg_replace('/https?:\/\/\S+\.(?:jpg|jpeg|png|gif|webp|svg)\b/i', '', $excerptCleanModal);
              $excerptCleanModal = trim(strip_tags($excerptCleanModal));
            @endphp
            <p class="berita-excerpt" style="font-size:12px; line-height:1.5; margin-bottom:10px; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">{{ Str::limit($excerptCleanModal, 90) }}</p>
            <a class="berita-link" onclick="bukaBerita(this)" 
               data-id="{{ $item->id }}"
               data-judul="{{ $item->judul }}"
               data-kategori="{{ $item->kategori }}"
               data-tanggal="{{ date('d M Y', strtotime($item->tanggal)) }}"
               data-foto="{{ $item->foto ? asset('storage/'.$item->foto) : 'https://placehold.co/600x400/e2e8f0/94a3b8?text=Gambar+Berita' }}"
               data-views="{{ $item->views }}" style="font-size:12px; cursor:pointer;">
              Baca Selengkapnya 
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
              <span class="berita-isi-full" style="display:none;">{{ $item->isi }}</span>
            </a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>

<script>
  // ================= LOGIKA BUKA/TUTUP HALAMAN BERITA =================
  function bukaBerita(link) {
    const id = link.getAttribute('data-id');
    const judul = link.getAttribute('data-judul');
    const kategori = link.getAttribute('data-kategori');
    const tanggal = link.getAttribute('data-tanggal');
    const foto = link.getAttribute('data-foto');
    const views = link.getAttribute('data-views');
    let isi = link.querySelector('.berita-isi-full').textContent;

    // Parse Markdown image syntax: ![](URL)
    isi = isi.replace(/!\[.*?\]\((https?:\/\/[^\s)]+)\)/gi, (match, url) => {
        return `<img src="${url}" style="max-width:100%; border-radius:8px; display:block; margin:16px auto; box-shadow:0 4px 12px rgba(0,0,0,0.08);">`;
    });

    // Parse raw image URLs on their own line (wrapped in <p>)
    isi = isi.replace(/<p>\s*(https?:\/\/[^\s<]+\.(?:jpg|jpeg|png|gif|webp|svg)(?:\?[^\s<]+)?)\s*<\/p>/gi, (match, url) => {
        return `<img src="${url}" style="max-width:100%; border-radius:8px; display:block; margin:16px auto; box-shadow:0 4px 12px rgba(0,0,0,0.08);">`;
    });
    
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
    
    // Tutup modal semua berita jika sedang terbuka
    const modalSemua = document.getElementById('modal-semua-berita-overlay');
    if (modalSemua) modalSemua.classList.remove('show');

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

  // ================= PENGELOLA MODAL (SINGLE ACTIVE MODAL) =================
  function tutupSemuaModal() {
    ['modal-layanan-overlay', 'modal-informasi-overlay', 'modal-demografi-overlay', 'modal-kelembagaan-overlay', 'modal-semua-berita-overlay'].forEach(id => {
      var el = document.getElementById(id);
      if (el) {
        el.classList.remove('show');
        el.style.display = 'none';
      }
    });
  }

  // Tutup modal jika tombol Escape ditekan
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      tutupSemuaModal();
    }
  });

  // ================= MODAL LAYANAN =================
  const DATA_SURAT = [
    { nama: 'Surat Keterangan Domisili', syarat: ['Fotocopy KTP', 'Fotocopy KK', 'Pas foto 3x4 (2 lembar)', 'Surat pengantar RT/RW'], keterangan: 'Berlaku selama 6 bulan' },
    { nama: 'Surat Keterangan Usaha', syarat: ['Fotocopy KTP', 'Fotocopy KK', 'Pas foto 3x4 (2 lembar)', 'Surat keterangan usaha dari RT/RW'], keterangan: 'Untuk keperluan kredit atau izin usaha' },
    { nama: 'Surat Pengantar KTP', syarat: ['Fotocopy KK', 'Pas foto 4x6 (2 lembar)', 'Formulir permohonan'], keterangan: 'Untuk pembuatan KTP baru atau perpanjangan' },
    { nama: 'Surat Pengantar Kartu Keluarga', syarat: ['Fotocopy KTP kepala keluarga', 'Fotocopy KK lama (jika ada)', 'Akta kelahiran/nikah/cerai', 'Formulir permohonan'], keterangan: 'Untuk pembuatan KK baru atau perubahan' },
    { nama: 'Surat Keterangan Tidak Mampu', syarat: ['Fotocopy KK', 'Data sekolah'], keterangan: 'Untuk keringanan biaya sekolah & beasiswa' }
  ];

  function bukaModalLayanan(){
    tutupSemuaModal();
    const wadah = document.getElementById('daftar-surat');
    if (wadah) {
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
    }
    var el = document.getElementById('modal-layanan-overlay');
    if (el) {
      el.classList.add('show');
      el.style.display = 'flex';
    }
  }

  function tutupModalLayanan(event){
    if (event && event.target !== event.currentTarget && !event.target.classList.contains('modal-layanan-close')) return;
    var el = document.getElementById('modal-layanan-overlay');
    if (el) {
      el.classList.remove('show');
      el.style.display = 'none';
    }
  }

  // ================= MODAL INFORMASI PUBLIK & APBDES =================
  function switchInfoTab(tabId, btn) {
    document.querySelectorAll('.info-tab-content').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.info-tab-btn').forEach(b => b.classList.remove('active'));
    
    const target = document.getElementById('infotab-' + tabId);
    if (target) target.style.display = 'block';
    if (btn) btn.classList.add('active');
  }

  function bukaModalInformasi(){
    tutupSemuaModal();
    var el = document.getElementById('modal-informasi-overlay');
    if (el) {
      el.classList.add('show');
      el.style.display = 'flex';
    }
  }

  function tutupModalInformasi(event){
    if (event && event.target !== event.currentTarget && !event.target.classList.contains('modal-informasi-close')) return;
    var el = document.getElementById('modal-informasi-overlay');
    if (el) {
      el.classList.remove('show');
      el.style.display = 'none';
    }
  }

  // ================= MODAL DATA KEPENDUDUKAN (DEMOGRAFI) =================
  function bukaModalDemografi(){
    tutupSemuaModal();
    var el = document.getElementById('modal-demografi-overlay');
    if (el) {
      el.classList.add('show');
      el.style.display = 'flex';
    }
  }

  function tutupModalDemografi(event){
    if (event && event.target !== event.currentTarget && !event.target.classList.contains('modal-informasi-close')) return;
    var el = document.getElementById('modal-demografi-overlay');
    if (el) {
      el.classList.remove('show');
      el.style.display = 'none';
    }
  }

  // ================= MODAL KELEMBAGAAN DESA =================
  function bukaModalKelembagaan(){
    tutupSemuaModal();
    var el = document.getElementById('modal-kelembagaan-overlay');
    if (el) {
      el.classList.add('show');
      el.style.display = 'flex';
    }
  }

  function tutupModalKelembagaan(event){
    if (event && event.target !== event.currentTarget && !event.target.classList.contains('modal-informasi-close')) return;
    var el = document.getElementById('modal-kelembagaan-overlay');
    if (el) {
      el.classList.remove('show');
      el.style.display = 'none';
    }
  }

  // Global listener pelindung modal
  document.addEventListener('click', function(e) {
    const el = e.target.closest('a, button');
    if (!el) return;
    const href = (el.getAttribute('href') || '').toLowerCase();
    if (href === '#modal-demografi') {
      e.preventDefault();
      bukaModalDemografi();
    } else if (href === '#modal-kelembagaan') {
      e.preventDefault();
      bukaModalKelembagaan();
    } else if (href === '#modal-informasi' || href === '#modal-apbdes') {
      e.preventDefault();
      bukaModalInformasi();
    } else if (href === '#modal-layanan') {
      e.preventDefault();
      bukaModalLayanan();
    }
  });

  // ================= MODAL ARSIP SEMUA BERITA DESA =================
  function bukaModalSemuaBerita(){
    document.getElementById('modal-semua-berita-overlay').classList.add('show');
  }

  function tutupModalSemuaBerita(event){
    if (event && event.target !== event.currentTarget && !event.target.classList.contains('modal-informasi-close')) return;
    document.getElementById('modal-semua-berita-overlay').classList.remove('show');
  }

  function filterModalBerita(){
    const input = document.getElementById('cari-berita-input').value.toLowerCase();
    const items = document.querySelectorAll('.item-modal-berita');
    items.forEach(item => {
      const judul = item.getAttribute('data-judul') || '';
      const kategori = item.getAttribute('data-kategori') || '';
      if (judul.includes(input) || kategori.includes(input)){
        item.style.display = 'block';
      } else {
        item.style.display = 'none';
      }
    });
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