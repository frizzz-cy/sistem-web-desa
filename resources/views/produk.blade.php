<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Produk Unggulan UMKM - Sistem Informasi Desa Munungkerep">
<title>Produk Unggulan — Desa Munungkerep</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
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
    <div class="prod-card">
      <div class="prod-img-wrap">
        <span class="prod-badge">{{ $item->kategori }}</span>
        <img src="{{ $item->foto_produk ? asset('storage/'.$item->foto_produk) : 'https://placehold.co/600x400/e2e8f0/94a3b8?text=Foto+Produk' }}" alt="{{ $item->nama_produk }}" class="prod-img">
      </div>
      <div class="prod-content">
        <h3 class="prod-title">{{ $item->nama_produk }}</h3>
        
        <div class="prod-meta">
          <span class="prod-meta-item harga">
            <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
            {{ $item->harga }}
          </span>
          <span class="prod-meta-dot">&bull;</span>
          <span class="prod-meta-item">
            <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            {{ $item->status_stok }}
          </span>
        </div>

        <p class="prod-desc">{{ Str::limit($item->deskripsi, 120) }}</p>
        
        <hr class="prod-divider">
        
        <div class="prod-footer">
          <div class="prod-seller">
            <!-- Menampilkan 2 inisial pertama dari nama penjual -->
            <div class="prod-avatar">{{ substr($item->nama_penjual, 0, 2) }}</div>
            <span class="prod-seller-name">{{ $item->nama_penjual }}</span>
          </div>
          <!-- Link WhatsApp Dinamis -->
          <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->no_whatsapp) }}?text=Halo,%20saya%20tertarik%20membeli%20{{ urlencode($item->nama_produk) }}%20yang%20ada%20di%20Website%20Desa." target="_blank" class="prod-link">
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

@include('partials.footer')

<script>
  document.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', function(e) {
      if (this.hostname === window.location.hostname && !this.hasAttribute('target')) {
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