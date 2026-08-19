<style>
  /* ============ FOOTER ============ */
  footer {
    background: #111723;
    color: #B8B8B8;
    font-family: 'Plus Jakarta Sans', sans-serif;
  }
  .footer-inner {
    max-width: 1200px;
    margin: 0 auto;
    padding: 48px 20px 24px;
    display: grid;
    grid-template-columns: 1fr;
    gap: 32px;
  }
  @media (min-width: 640px) {
    .footer-inner {
      grid-template-columns: repeat(2, 1fr);
    }
  }
  @media (min-width: 1024px) {
    .footer-inner {
      grid-template-columns: 1.3fr 1fr 1fr 0.9fr 0.8fr;
    }
  }

  .footer-brand {
    display: flex;
    flex-direction: column;
    gap: 14px;
  }
  .footer-brand .baris-logo {
    display: flex;
    align-items: center;
    gap: 14px;
  }
  .footer-logo {
    width: 80px;            /* Lebar logo agar proporsional */
    height: auto;           /* Tinggi otomatis mengikuti rasio gambar */
    flex-shrink: 0;
    overflow: visible;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .footer-logo img {
    width: 100%;
    height: auto;
    object-fit: contain;
    padding: 0;             /* Menghilangkan padding agar logo full */
  }
  .footer-brand .nama-desa {
    color: #fff;
    font-size: 18px;
    font-weight: 800;
  }
  .footer-brand .sub-desa {
    font-size: 12px;
    color: #8A8A8A;
    margin-top: 2px;
  }
  .footer-brand p {
    font-size: 12.5px;
    color: #9A9A9A;
    line-height: 1.75;
    max-width: 320px;
  }

  .footer-col h4 {
    color: #fff;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 14px;
    text-transform: uppercase;
    letter-spacing: .05em;
  }
  .footer-col p, .footer-col a {
    font-size: 13px;
    color: #9A9A9A;
    line-height: 1.85;
    display: block;
    text-decoration: none;
  }
  .footer-col a:hover {
    color: #fff;
  }

  .jam-pelayanan {
    background: rgba(22, 104, 163, 0.12);
    border: 1px solid rgba(22, 104, 163, 0.25);
    border-radius: 8px;
    padding: 10px 12px;
    margin-bottom: 14px;
  }
  .jam-pelayanan .jam-title {
    font-size: 11.5px;
    font-weight: 700;
    color: #4CB5FF;
    display: flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 4px;
  }
  .jam-pelayanan .jam-waktu {
    font-size: 12px;
    color: #D8D8D8;
  }

  .kontak-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 12px;
  }
  .kontak-icon {
    width: 30px;
    height: 30px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    flex-shrink: 0;
    margin-top: 2px;
    font-size: 13px;
  }
  .kontak-info {
    display: flex;
    flex-direction: column;
  }
  .kontak-label {
    font-size: 10.5px;
    color: #7A7A7A;
    line-height: 1.3;
  }
  .kontak-val {
    color: #D8D8D8;
    font-size: 12.5px;
    font-weight: 600;
    text-decoration: none;
  }
  .kontak-val:hover {
    color: #fff;
  }

  .footer-wilayah {
    display: flex;
    flex-direction: column;
    gap: 5px;
  }
  .footer-wilayah .baris {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    font-size: 12.5px;
  }
  .footer-wilayah .label {
    color: #7A7A7A;
  }
  .footer-wilayah .nilai {
    color: #D8D8D8;
    font-weight: 600;
    text-align: right;
  }

  .footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    text-align: center;
    padding: 18px 20px;
    font-size: 12px;
    color: #7A7A7A;
    max-width: 1200px;
    margin: 0 auto;
  }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<footer>
  <div class="footer-inner">
    <!-- BRAND DESA -->
    <div class="footer-brand">
      <div class="baris-logo">
        <div class="footer-logo">
          <img src="/images/kabupaten.png" alt="Logo Kabupaten Jombang" onerror="this.style.display='none'">
        </div>
        <div>
          <div class="nama-desa">Pemerintah Desa<br>Munungkerep</div>
          <div class="sub-desa">Sistem Informasi Desa</div>
        </div>
      </div>
      <p>Portal resmi Desa Munungkerep untuk transparansi informasi, peta wilayah, dan pelayanan publik bagi seluruh warga dan masyarakat umum.</p>
    </div>

    <!-- INFORMASI LAYANAN -->
    <div class="footer-col">
      <h4>Informasi Layanan</h4>
      <div class="jam-pelayanan">
        <div class="jam-title"><i class="fas fa-clock"></i> Jam Kantor Balai Desa:</div>
        <div class="jam-waktu">Senin – Jumat: 08.00 – 15.00 WIB</div>
      </div>
      <a href="javascript:void(0)" onclick="if(typeof bukaModalLayanan === 'function'){ bukaModalLayanan(); } else { window.location.href='/#modal-layanan'; }"><i class="fas fa-file-signature" style="margin-right:6px; font-size:11px;"></i> Surat Administrasi</a>
      <a href="/profil-desa#demografis"><i class="fas fa-id-card" style="margin-right:6px; font-size:11px;"></i> Pelayanan Kependudukan</a>
      <a href="/peta"><i class="fas fa-map-marked-alt" style="margin-right:6px; font-size:11px;"></i> Peta Interaktif &amp; Potensi</a>
      <a href="/profil-desa#anggaran"><i class="fas fa-chart-pie" style="margin-right:6px; font-size:11px;"></i> Transparansi APBDes</a>
    </div>

    <!-- INFORMASI PENGADUAN & CALL CENTER -->
    <div class="footer-col">
      <h4>Pengaduan &amp; Informasi</h4>
      <div class="kontak-item">
        <div class="kontak-icon" style="background: rgba(37, 211, 102, 0.15); color: #25D366;"><i class="fab fa-whatsapp"></i></div>
        <div class="kontak-info">
          <span class="kontak-label">Pengaduan &amp; Call Center:</span>
          <a href="https://wa.me/6281234922365" target="_blank" class="kontak-val">0812-3492-2365</a>
        </div>
      </div> 
      <div class="kontak-item">
        <div class="kontak-icon" style="background: rgba(212, 160, 23, 0.15); color: #D4A017;"><i class="fas fa-headset"></i></div>
        <div class="kontak-info">
          <span class="kontak-label">Khusus Layanan Informasi:</span>
          <a href="https://wa.me/6281234922365" target="_blank" class="kontak-val">0812-3492-2365</a>
        </div>
      </div>
      <div class="kontak-item">
        <div class="kontak-icon" style="background: rgba(22, 104, 163, 0.15); color: #4CB5FF;"><i class="fas fa-envelope"></i></div>
        <div class="kontak-info">
          <span class="kontak-label">Email Resmi Desa:</span>
          <a href="mailto:munungkerep11@gmail.com" class="kontak-val">munungkerep11@gmail.com</a>
        </div>
      </div>
      <div class="kontak-item">
        <div class="kontak-icon" style="background: rgba(198, 40, 40, 0.15); color: #ef5350;"><i class="fas fa-box-archive"></i></div>
        <div class="kontak-info">
          <span class="kontak-label">Kotak Aspirasi Warga:</span>
          <span class="kontak-val" style="font-weight: 500; font-size: 12px;">Balai Desa Munungkerep</span>
        </div>
      </div>
    </div>

    <!-- TAUTAN CEPAK -->
    <div class="footer-col">
      <h4>Tautan Cepat</h4>
      <a href="/">Beranda</a>
      <a href="/peta">Peta &amp; Potensi</a>
      <a href="/profil-desa">Profil Desa</a>
      <a href="/kegiatan">Event &amp; Kegiatan</a>
      <a href="/sertifikat" target="_blank" style="color:#D4A017; font-weight:700;"><i class="fas fa-certificate" style="margin-right:4px;"></i> Sertifikat &amp; Barcode</a>
    </div>

    <!-- DETAIL WILAYAH -->
    <div class="footer-col">
      <h4>Detail Wilayah</h4>
      <div class="footer-wilayah">
        <div class="baris"><span class="label">Desa</span><span class="nilai">Munungkerep</span></div>
        <div class="baris"><span class="label">Kecamatan</span><span class="nilai">Kabuh</span></div>
        <div class="baris"><span class="label">Kabupaten</span><span class="nilai">Jombang</span></div>
        <div class="baris"><span class="label">Provinsi</span><span class="nilai">Jawa Timur</span></div>
        <div class="baris"><span class="label">Kode Pos</span><span class="nilai">61455</span></div>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    © 2026 Pemerintah Desa Munungkerep — Disusun oleh Tim KKN 2026. Seluruh hak dilindungi.
  </div>
</footer>