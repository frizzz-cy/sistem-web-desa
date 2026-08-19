<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Potensi dan Produk Unggulan UMKM Masyarakat Desa Munungkerep, Kecamatan Kabuh, Kabupaten Jombang.">
<title>Produk Unggulan Desa Munungkerep</title>
<link rel="icon" type="image/png" href="{{ asset('images/kabupaten.png') }}">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
<link rel="apple-touch-icon" href="{{ asset('images/kabupaten.png') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root {
    --biru-tua: #0B3B60;
    --biru: #1668A3;
    --bg: #F4F6F8;
    --teks: #1A2833;
    --teks-muted: #5B6B7A;
    --border: #DDE3E8;
    
    /* Warna Card Produk */
    --prod-emas: #D4A017;
    --prod-biru: #1D4ED8; 
    --prod-biru-muda: #DBEAFE;
    --prod-abu: #64748B;
    --wa-hijau: #25D366;
  }
  
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg); color: var(--teks); line-height: 1.5; }
  img { max-width: 100%; display: block; }
  a { color: inherit; text-decoration: none; }

  /* ============ LAYOUT UTAMA ============ */
  main {
    max-width: 1100px; margin: 40px auto 80px; padding: 20px;
    animation: fadeInPage .4s ease;
  }
  @keyframes fadeInPage { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

  .page-header { text-align: center; margin-bottom: 50px; }
  .page-header h1 { font-size: clamp(24px, 5vw, 36px); font-weight: 800; color: var(--biru-tua); margin-bottom: 10px; }
  .page-header p { font-size: 15px; color: var(--teks-muted); max-width: 600px; margin: 0 auto; line-height: 1.6; }

  /* ============ GRID PRODUK (DINAMIS) ============ */
  .produk-grid {
    display: grid; grid-template-columns: 1fr; gap: 24px; text-align: left;
  }
  @media (min-width: 768px) { .produk-grid { grid-template-columns: repeat(2, 1fr); } }
  @media (min-width: 1024px) { .produk-grid { grid-template-columns: repeat(3, 1fr); } }

  .prod-card {
    background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.04);
    display: flex; flex-direction: column; border: 1px solid var(--border);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .prod-card:hover { transform: translateY(-4px); box-shadow: 0 10px 24px rgba(0,0,0,0.08); }
  
  .prod-img-wrap { position: relative; width: 100%; height: 220px; background: #e2e8f0; }
  .prod-img { width: 100%; height: 100%; object-fit: cover; }
  .prod-badge {
    position: absolute; top: 12px; left: 12px; background: var(--prod-emas); color: #fff;
    font-size: 11.5px; font-weight: 700; padding: 5px 14px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.05em;
  }
  
  .prod-content { padding: 18px 20px 20px; display: flex; flex-direction: column; flex-grow: 1; }
  .prod-title { font-size: 18px; font-weight: 800; color: #0F172A; margin-bottom: 10px; line-height: 1.3; }
  
  .prod-meta { 
    display: flex; align-items: center; flex-wrap: wrap; gap: 8px; font-size: 13.5px; 
    color: var(--prod-abu); margin-bottom: 16px; font-weight: 600; 
  }
  .prod-meta-item { display: inline-flex; align-items: center; gap: 6px; }
  .prod-meta-item svg { width: 15px; height: 15px; stroke: var(--biru-tua); stroke-width: 2.2; }
  .prod-meta-item.harga { color: var(--biru-tua); font-weight: 800; font-size: 14.5px; }
  .prod-meta-dot { color: #CBD5E1; font-size: 16px; line-height: 0; }
  
  .prod-desc { font-size: 13.5px; color: var(--teks-muted); line-height: 1.6; margin-bottom: 24px; flex-grow: 1; }

  .prod-divider { border: none; border-top: 1px solid #E2E8F0; margin: auto 0 16px; }
  
  /* Footer Penjual */
  .prod-footer { display: flex; align-items: center; justify-content: space-between; }
  .prod-seller { display: flex; align-items: center; gap: 10px; }
  .prod-avatar { 
    width: 32px; height: 32px; border-radius: 50%; background: var(--prod-biru-muda); color: var(--prod-biru); 
    display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 800; letter-spacing: .05em; text-transform: uppercase;
  }
  .prod-seller-name { font-size: 13.5px; font-weight: 700; color: #334155; }
  
  /* Tombol Chat WA */
  .prod-link { 
    font-size: 13.5px; font-weight: 800; color: var(--wa-hijau); text-decoration: none; 
    display: flex; align-items: center; gap: 5px; transition: opacity 0.2s ease; 
  }
  .prod-link:hover { opacity: 0.7; }
  .prod-link svg { width: 16px; height: 16px; fill: currentColor; }

  .empty-state { text-align: center; padding: 60px 20px; color: var(--teks-muted); font-size: 15px; background: #fff; border-radius: 12px; border: 1px dashed var(--border); grid-column: 1 / -1; }

  /* ============ POPUP / MODAL DETAIL PRODUK (ANIMASI NAIK) ============ */
  .prod-modal-overlay {
    display: none; position: fixed; inset: 0; z-index: 2100;
    background: rgba(11, 59, 96, 0.45);
    backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
    align-items: center; justify-content: center; padding: 20px;
    opacity: 0; transition: opacity 0.3s ease;
  }
  .prod-modal-overlay.active {
    display: flex; opacity: 1;
  }
  
  .prod-modal-box {
    background: #fff; border-radius: 16px; max-width: 600px; width: 100%;
    position: relative; overflow: hidden; box-shadow: 0 20px 50px rgba(11, 59, 96, 0.25);
    border: 1px solid var(--border);
    transform: translateY(100px); opacity: 0;
    transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.4s ease;
  }
  .prod-modal-overlay.active .prod-modal-box {
    transform: translateY(0); opacity: 1;
  }
  
  .prod-modal-close {
    position: absolute; top: 12px; right: 12px; z-index: 10;
    background: rgba(255, 255, 255, 0.9); color: var(--biru-tua); border: 1px solid var(--border);
    width: 32px; height: 32px; border-radius: 50%; cursor: pointer; font-size: 20px;
    display: flex; align-items: center; justify-content: center; line-height: 1;
    transition: background 0.2s ease, transform 0.2s ease;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
  }
  .prod-modal-close:hover { background: #fff; transform: scale(1.05); color: #C62828; }
  
  .prod-modal-body {
    display: flex; flex-direction: column; max-height: 85vh;
  }
  
  .prod-modal-img-wrap {
    position: relative; width: 100%; height: 260px; background: #f1f5f9; flex-shrink: 0;
  }
  .prod-modal-img-wrap img { width: 100%; height: 100%; object-fit: cover; }
  .prod-modal-img-wrap .prod-badge {
    position: absolute; top: 12px; left: 12px; background: var(--prod-emas); color: #fff;
    font-size: 11.5px; font-weight: 700; padding: 5px 14px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.05em;
  }
  
  .prod-modal-info {
    padding: 24px; overflow-y: auto; display: flex; flex-direction: column; gap: 16px;
  }
  .prod-modal-info h2 { font-size: 22px; font-weight: 800; color: var(--biru-tua); line-height: 1.25; }
  
  .prod-modal-desc-wrap h4 {
    font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em;
    color: var(--teks-muted); margin-bottom: 6px;
  }
  .prod-modal-desc-wrap p {
    font-size: 14px; color: var(--teks); line-height: 1.65; white-space: pre-line;
  }
  
  .prod-modal-wa-btn {
    background: var(--wa-hijau); color: #fff; padding: 10px 20px; border-radius: 8px;
    font-size: 14px; font-weight: 800; display: inline-flex; align-items: center; gap: 8px;
    transition: background 0.2s ease, transform 0.15s ease;
    box-shadow: 0 4px 12px rgba(37, 211, 102, 0.2);
    justify-content: center;
  }
  .prod-modal-wa-btn:hover { background: #20ba59; transform: translateY(-1px); color: #fff; }
  .prod-modal-wa-btn:active { transform: translateY(0); }
  .prod-modal-wa-btn svg { width: 18px; height: 18px; fill: currentColor; }

  @media (max-width: 576px) {
    .prod-modal-info .prod-footer { flex-direction: column; align-items: stretch; gap: 14px; }
    .prod-modal-wa-btn { width: 100%; justify-content: center; }
  }
</style>
</head>
<body>

@include('partials.navbar', ['active' => 'produk'])

<main>
  <!-- Header Halaman -->
  <div class="page-header">
    <h1>Produk Unggulan Desa</h1>
    <p>Dukung perekonomian lokal dengan membeli hasil bumi, kerajinan tangan, dan produk UMKM asli dari para penjual warga Desa Munungkerep.</p>
  </div>

  <!-- Grid Produk -->
  <div class="produk-grid">
    
    <!-- Forelse: Jika ada data produk, tampilkan. Jika kosong, tampilkan pesan empty state -->
    @forelse ($produks as $item)
    <div class="prod-card" onclick="openProductModal(this)" style="cursor: pointer;"
         data-nama-produk="{{ $item->nama_produk }}"
         data-kategori="{{ $item->kategori }}"
         data-harga="{{ $item->harga }}"
         data-status-stok="{{ $item->status_stok }}"
         data-nama-penjual="{{ $item->nama_penjual }}"
         data-no-whatsapp="{{ preg_replace('/[^0-9]/', '', $item->no_whatsapp) }}"
         data-avatar="{{ substr($item->nama_penjual, 0, 2) }}">
      <div class="prod-img-wrap">
        <span class="prod-badge">{{ $item->kategori }}</span>
        <img src="{{ $item->foto_produk ? asset('storage/'.$item->foto_produk) : 'https://placehold.co/600x400/e2e8f0/94a3b8?text=Foto+Produk' }}" alt="{{ $item->nama_produk }}" class="prod-img" loading="lazy">
      </div>
      <div class="prod-content">
        <h3 class="prod-title">{{ $item->nama_produk }}</h3>
        
        <div class="prod-meta">
          <span class="prod-meta-item harga">
            <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
            Rp {{ $item->harga }}
          </span>
          <span class="prod-meta-dot">&bull;</span>
          <span class="prod-meta-item">
            <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            {{ $item->status_stok }}
          </span>
        </div>

        <p class="prod-desc">{{ Str::limit($item->deskripsi, 120) }}</p>
        
        <!-- Menyimpan deskripsi lengkap secara tersembunyi untuk popup modal -->
        <div class="prod-desc-full" style="display: none;">{{ $item->deskripsi }}</div>
        
        <hr class="prod-divider">
        
        <div class="prod-footer">
          <div class="prod-seller">
            <!-- Menampilkan 2 inisial pertama dari nama penjual -->
            <div class="prod-avatar">{{ substr($item->nama_penjual, 0, 2) }}</div>
            <span class="prod-seller-name">{{ $item->nama_penjual }}</span>
          </div>
          <!-- Link WhatsApp Dinamis dengan stopPropagation agar tidak membuka modal -->
          <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->no_whatsapp) }}?text=Halo,%20saya%20tertarik%20membeli%20{{ urlencode($item->nama_produk) }}%20yang%20ada%20di%20Website%20Desa." target="_blank" class="prod-link" onclick="event.stopPropagation();">
            <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.052 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
            Chat Penjual
          </a>
        </div>
      </div>
    </div>
    @empty
    <div class="empty-state">
      <svg style="width:48px; height:48px; margin:0 auto 12px; color:#cbd5e1;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
      Belum ada data produk UMKM yang diunggah.
    </div>
    @endforelse

  </div>
</main>

<!-- Modal / Popup Detail Produk -->
<div class="prod-modal-overlay" id="prod-modal-overlay" onclick="closeProductModal(event)">
  <div class="prod-modal-box">
    <button class="prod-modal-close" onclick="closeProductModal()">&times;</button>
    <div class="prod-modal-body">
      <div class="prod-modal-img-wrap">
        <img id="modal-prod-img" src="" alt="Detail Produk">
        <span class="prod-badge" id="modal-prod-badge">Kategori</span>
      </div>
      <div class="prod-modal-info">
        <h2 id="modal-prod-title">Nama Produk</h2>
        
        <div class="prod-meta">
          <span class="prod-meta-item harga" id="modal-prod-harga">Rp 0</span>
          <span class="prod-meta-dot">&bull;</span>
          <span class="prod-meta-item" id="modal-prod-stok">Ready</span>
        </div>
        
        <div class="prod-modal-desc-wrap">
          <h4>Deskripsi Lengkap</h4>
          <p id="modal-prod-desc">Deskripsi lengkap produk...</p>
        </div>
        
        <hr class="prod-divider">
        
        <div class="prod-footer">
          <div class="prod-seller">
            <div class="prod-avatar" id="modal-prod-avatar">MU</div>
            <div>
              <span style="font-size: 11px; color: var(--teks-muted); display: block; font-weight: 500; text-align: left;">Penjual</span>
              <span class="prod-seller-name" id="modal-prod-seller-name">Nama Penjual</span>
            </div>
          </div>
          <a href="#" target="_blank" class="prod-modal-wa-btn" id="modal-prod-wa-link">
            <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.052 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
            <span>Hubungi Penjual</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

@include('partials.footer')

<script>
  // Fungsi membuka modal
  function openProductModal(card) {
    const name = card.getAttribute('data-nama-produk');
    const category = card.getAttribute('data-kategori');
    const price = card.getAttribute('data-harga');
    const stock = card.getAttribute('data-status-stok');
    const seller = card.getAttribute('data-nama-penjual');
    const phone = card.getAttribute('data-no-whatsapp');
    const avatar = card.getAttribute('data-avatar');
    
    const imgUrl = card.querySelector('.prod-img').src;
    const fullDesc = card.querySelector('.prod-desc-full').textContent;
    
    document.getElementById('modal-prod-img').src = imgUrl;
    document.getElementById('modal-prod-img').alt = name;
    document.getElementById('modal-prod-badge').textContent = category;
    document.getElementById('modal-prod-title').textContent = name;
    document.getElementById('modal-prod-harga').innerHTML = `
      <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round" style="width: 15px; height: 15px; stroke: var(--biru-tua); stroke-width: 2.2;"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
      Rp ${price}
    `;
    document.getElementById('modal-prod-stok').innerHTML = `
      <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round" style="width: 15px; height: 15px; stroke: var(--biru-tua); stroke-width: 2.2;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
      ${stock}
    `;
    document.getElementById('modal-prod-desc').textContent = fullDesc;
    document.getElementById('modal-prod-avatar').textContent = avatar;
    document.getElementById('modal-prod-seller-name').textContent = seller;
    
    // Tautan whatsapp dinamis
    const waLink = `https://wa.me/${phone}?text=Halo,%20saya%20tertarik%20membeli%20${encodeURIComponent(name)}%20yang%20ada%20di%20Website%20Desa.`;
    document.getElementById('modal-prod-wa-link').href = waLink;
    
    const overlay = document.getElementById('prod-modal-overlay');
    overlay.style.display = 'flex';
    setTimeout(() => {
      overlay.classList.add('active');
    }, 10);
    
    document.body.style.overflow = 'hidden';
  }
  
  // Fungsi menutup modal
  function closeProductModal(event) {
    if (event && event.target !== event.currentTarget && !event.target.classList.contains('prod-modal-close')) {
      return;
    }
    const overlay = document.getElementById('prod-modal-overlay');
    overlay.classList.remove('active');
    
    setTimeout(() => {
      overlay.style.display = 'none';
    }, 300);
    
    document.body.style.overflow = '';
  }

  // Animasi transisi halaman antar a tag
  document.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', function(e) {
      if (this.hostname === window.location.hostname && !this.hasAttribute('target') && !this.classList.contains('prod-modal-close') && this.id !== 'modal-prod-wa-link') {
        e.preventDefault();
        const url = this.href;
        document.body.style.transition = 'opacity .25s ease, transform .25s ease';
        document.body.style.opacity = '0';
        document.body.style.transform = 'translateY(-6px)';
        setTimeout(() => { window.location.href = url; }, 220);
      }
    });
  });
</script>
</body>
</html>