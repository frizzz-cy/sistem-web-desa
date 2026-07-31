<style>
  /* ============ NAVBAR ============ */
  .navbar{ background:linear-gradient(90deg, #4A7FB5 0%, #6699CC 100%); border-bottom:2px solid rgba(0,0,0,0.15); position:sticky; top:0; z-index:960; box-shadow:0 2px 6px rgba(11,59,96,0.15); }
  .navbar-inner{ max-width:1200px; margin:0 auto; padding:12px 20px; display:flex; align-items:center; justify-content:space-between; gap:16px; }
  .brand{display:flex; align-items:center; gap:12px; text-decoration:none; color:inherit;}
  .brand-logo{ width:58px; height:58px; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; color:#fff; font-size:24px; font-weight:800; position:relative; overflow:hidden; }
  .brand-logo img{position:absolute; inset:0; width:100%; height:100%; object-fit:contain; border-radius:50%;}
  .brand-text .b-title{font-size:20px; font-weight:800; color:#fff; line-height:1.2;}
  .brand-text .b-sub{font-size:12px; color:#EAF2FA; letter-spacing:.02em; margin-top:2px;}

  .menu-wrapper { display: flex; align-items: center; gap: 20px; }
  .menu{display:flex; gap:4px; align-items:center;}
  .menu a{ font-size:13.5px; font-weight:600; color:#DCE8F2; padding:10px 16px; border-radius:6px; text-decoration:none; transition:background .15s ease, color .15s ease; }
  .menu a:hover{background:rgba(255,255,255,0.12); color:#fff;}
  .menu a.active{background:#D4A017; color:#0B3B60;}

  /* Tombol Login Khusus */
  .btn-login {
    background: #D4A017; color: #0B3B60 !important; font-weight: 800 !important; 
    padding: 10px 20px !important; border-radius: 30px !important;
    box-shadow: 0 4px 10px rgba(212, 160, 23, 0.3); transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .btn-login:hover { transform: translateY(-2px); box-shadow: 0 6px 14px rgba(212, 160, 23, 0.4); background: #eab72c; }

  .menu-toggle{ display:none; background:none; border:none; cursor:pointer; padding:6px; flex-direction:column; gap:4px; }
  .menu-toggle span{width:22px; height:2.5px; background:#fff; border-radius:2px;}

  @media (max-width:960px){
    .menu-wrapper { flex-direction: column; width: 100%; align-items: flex-start; gap: 10px; }
    .menu{ display:none; position:absolute; top:100%; left:0; right:0; background:#0B3B60; flex-direction:column; padding:10px 20px 16px; border-bottom:1px solid rgba(255,255,255,0.1); box-shadow:0 8px 16px rgba(11,59,96,0.2); }
    .menu.buka{display:flex;}
    .menu a, .btn-login {width:100%; padding:12px 14px; text-align: center;}
    .menu-toggle{display:flex;}
  }
</style>

<nav class="navbar">
  <div class="navbar-inner">
    <a href="/" class="brand" @if($active !== 'beranda') onclick="return pindahHalus(event, '/')" @endif>
      <div class="brand-logo">M<img src="/images/kabupaten.png" alt="Logo Kabupaten Jombang" onerror="this.remove()"></div>
      <div class="brand-text">
        <div class="b-title">Desa Munungkerep</div>
        <div class="b-sub">Kecamatan Kabuh</div>
      </div>
    </a>
    <button class="menu-toggle" onclick="document.getElementById('menu').classList.toggle('buka')">
      <span></span><span></span><span></span>
    </button>
    <div class="menu" id="menu">
      <div class="menu-wrapper">
        <div class="menu-links" style="display:flex; gap:4px;">
          <a href="/" class="{{ $active === 'beranda' ? 'active' : '' }}" @if($active !== 'beranda') onclick="return pindahHalus(event, '/')" @endif>Beranda</a>
          <a href="/peta" class="{{ $active === 'peta' ? 'active' : '' }}" @if($active !== 'peta') onclick="return pindahHalus(event, '/peta')" @endif>Demografi</a>
          <a href="/profil-desa" class="{{ $active === 'profil' ? 'active' : '' }}" @if($active !== 'profil') onclick="return pindahHalus(event, '/profil-desa')" @endif>Profil Desa</a>
          <a href="/kegiatan" class="{{ $active === 'kegiatan' ? 'active' : '' }}" @if($active !== 'kegiatan') onclick="return pindahHalus(event, '/kegiatan')" @endif>Galeri</a>
          <a href="/produk" class="{{ $active === 'produk' ? 'active' : '' }}" @if($active !== 'produk') onclick="return pindahHalus(event, '/produk')" @endif>Produk</a>
        </div>
        
        <!-- Cek Jika Sudah Login -->
        @auth
          <form action="/logout" method="POST" style="margin:0;">
            @csrf
            <button type="submit" class="btn-login" style="border:none; cursor:pointer;">Logout ({{ Auth::user()->name }})</button>
          </form>
        @else
          <a href="/login" class="btn-login">Login Admin</a>
        @endauth
      </div>
    </div>
  </div>
</nav>