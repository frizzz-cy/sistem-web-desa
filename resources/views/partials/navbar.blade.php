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
  .menu-links { display: flex; gap: 4px; }
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

  /* ============ DROPDOWN MENU ADMIN ============ */
  .dropdown-admin { position: relative; display: inline-block; }
  .dropdown-toggle { display: flex; align-items: center; gap: 8px; cursor: pointer; border: none; }
  .panah-bawah { font-size: 8px; transition: transform 0.2s ease; }
  .dropdown-admin.aktif .panah-bawah { transform: rotate(180deg); }
  
  .dropdown-menu-admin {
    display: none; position: absolute; right: 0; top: calc(100% + 10px);
    background: #fff; border: 1px solid var(--border, #DDE3E8); border-radius: 8px;
    width: 220px; box-shadow: 0 10px 25px rgba(11, 59, 96, 0.15);
    z-index: 1000; padding: 6px 0;
    animation: slideDownMenu 0.2s ease;
  }
  .dropdown-admin.aktif .dropdown-menu-admin { display: block; }
  
  @keyframes slideDownMenu {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
  }
  
  .dropdown-menu-admin .user-info { padding: 12px 16px; display: flex; flex-direction: column; gap: 2px; }
  .dropdown-menu-admin .user-info .user-name { font-size: 14px; font-weight: 700; color: #0B3B60; text-align: left; }
  .dropdown-menu-admin .user-info .user-role { font-size: 11px; color: #5B6B7A; font-weight: 500; text-align: left; }
  
  .dropdown-menu-admin hr.dropdown-divider { border: none; border-top: 1px solid #E2E8F0; margin: 6px 0; }
  
  .dropdown-menu-admin .dropdown-item {
    display: flex; align-items: center; gap: 10px; padding: 10px 16px;
    font-size: 13.5px; font-weight: 600; color: #334155; text-decoration: none;
    transition: background 0.15s ease, color 0.15s ease;
    box-sizing: border-box; width: 100%; border: none;
  }
  .dropdown-menu-admin .dropdown-item:hover { background: #F4F6F8; color: #0B3B60; }
  .dropdown-menu-admin .dropdown-item.logout-btn { color: #C62828; }
  .dropdown-menu-admin .dropdown-item.logout-btn:hover { background: #FFF5F5; color: #C62828; }
  
  .dropdown-menu-admin .dropdown-item svg { width: 16px; height: 16px; stroke: currentColor; fill: none; }

  .menu-toggle{ display:none; background:none; border:none; cursor:pointer; padding:6px; flex-direction:column; gap:4px; }
  .menu-toggle span{width:22px; height:2.5px; background:#fff; border-radius:2px; transition: transform 0.3s ease, opacity 0.25s ease;}
  .menu-toggle.aktif span:nth-child(1) { transform: translateY(6.5px) rotate(45deg); }
  .menu-toggle.aktif span:nth-child(2) { opacity: 0; }
  .menu-toggle.aktif span:nth-child(3) { transform: translateY(-6.5px) rotate(-45deg); }

  @media (max-width:960px){
    .menu-wrapper { flex-direction: column; width: 100%; align-items: flex-start; gap: 10px; }
    .menu{ 
      display: flex; 
      visibility: hidden;
      opacity: 0;
      max-height: 0;
      overflow: hidden;
      transform: translateY(-10px);
      position:absolute; top:100%; left:0; right:0; background:#0B3B60; flex-direction:column; padding: 0 20px; 
      border-bottom:1px solid rgba(255,255,255,0.1); box-shadow:0 8px 16px rgba(11,59,96,0.2); 
      transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.25s ease, transform 0.3s ease, padding 0.3s ease, visibility 0.35s;
    }
    .menu.buka{
      visibility: visible;
      opacity: 1;
      max-height: 480px; 
      transform: translateY(0);
      padding: 10px 20px 16px;
    }
    .menu-links { flex-direction: column; width: 100%; gap: 6px; }
    .menu a, .btn-login {width:100%; padding:12px 14px; text-align: center;}
    .menu-toggle{display:flex;}

    .dropdown-admin { width: 100%; }
    .dropdown-toggle { width: 100%; justify-content: center; }
    .dropdown-menu-admin { position: static; width: 100%; box-shadow: none; border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05); margin-top: 8px; }
    .dropdown-menu-admin .user-info .user-name { color: #fff; }
    .dropdown-menu-admin .user-info .user-role { color: #DCE8F2; }
    .dropdown-menu-admin .dropdown-item { color: #DCE8F2; }
    .dropdown-menu-admin .dropdown-item:hover { background: rgba(255,255,255,0.1); color: #fff; }
    .dropdown-menu-admin .dropdown-item.logout-btn { color: #FF8A8A; }
    .dropdown-menu-admin .dropdown-item.logout-btn:hover { background: rgba(198, 40, 40, 0.15); color: #FF8A8A; }
    .dropdown-menu-admin hr.dropdown-divider { border-color: rgba(255,255,255,0.1); }
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
    <button class="menu-toggle" onclick="toggleMobileMenu()">
      <span></span><span></span><span></span>
    </button>
    <div class="menu" id="menu">
      <div class="menu-wrapper">
        <div class="menu-links">
          <a href="/" class="{{ $active === 'beranda' ? 'active' : '' }}" @if($active !== 'beranda') onclick="return pindahHalus(event, '/')" @endif>Beranda</a>
          <a href="/peta" class="{{ $active === 'peta' ? 'active' : '' }}" @if($active !== 'peta') onclick="return pindahHalus(event, '/peta')" @endif>Demografi</a>
          <a href="/profil-desa" class="{{ $active === 'profil' ? 'active' : '' }}" @if($active !== 'profil') onclick="return pindahHalus(event, '/profil-desa')" @endif>Profil Desa</a>
          <a href="/kegiatan" class="{{ $active === 'kegiatan' ? 'active' : '' }}" @if($active !== 'kegiatan') onclick="return pindahHalus(event, '/kegiatan')" @endif>Galeri</a>
          <a href="/produk" class="{{ $active === 'produk' ? 'active' : '' }}" @if($active !== 'produk') onclick="return pindahHalus(event, '/produk')" @endif>Produk</a>
        </div>
        
        <!-- Cek Jika Sudah Login -->
        @auth
          <div class="dropdown-admin" id="dropdown-admin">
            <button class="btn-login dropdown-toggle" onclick="toggleAdminDropdown(event)">
              Menu Admin <span class="panah-bawah">▼</span>
            </button>
            <div class="dropdown-menu-admin" id="dropdown-menu-admin">
              <div class="user-info">
                <span class="user-name">{{ Auth::user()->name }}</span>
                <span class="user-role">Administrator</span>
              </div>
              <hr class="dropdown-divider">
              <a href="/admin/produk" class="dropdown-item">
                <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                Kelola Web
              </a>
              <form action="/logout" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="dropdown-item logout-btn" style="border:none; background:none; cursor:pointer; width:100%; text-align:left; font-family:inherit;">
                  <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                  Logout
                </button>
              </form>
            </div>
          </div>
        @else
          <a href="/login" class="btn-login">Login Admin</a>
        @endauth
      </div>
    </div>
  </div>
</nav>

<script>
  function toggleMobileMenu() {
    const menu = document.getElementById('menu');
    const toggle = document.querySelector('.menu-toggle');
    menu.classList.toggle('buka');
    toggle.classList.toggle('aktif');
  }

  function toggleAdminDropdown(event) {
    event.stopPropagation();
    const dropdown = document.getElementById('dropdown-admin');
    dropdown.classList.toggle('aktif');
  }

  // Tutup menu mobile dan dropdown jika klik di luar area masing-masing
  window.addEventListener('click', function(event) {
    const navbar = document.querySelector('.navbar');
    const menu = document.getElementById('menu');
    const toggle = document.querySelector('.menu-toggle');
    const dropdown = document.getElementById('dropdown-admin');
    
    // Jika klik di luar area navbar, tutup menu mobile
    if (navbar && !navbar.contains(event.target)) {
      if (menu && menu.classList.contains('buka')) {
        menu.classList.remove('buka');
        toggle.classList.remove('aktif');
      }
    }
    
    // Jika klik di luar dropdown, tutup dropdown admin
    if (dropdown && !dropdown.contains(event.target)) {
      dropdown.classList.remove('aktif');
    }
  });
</script>