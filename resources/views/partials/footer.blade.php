<style>
  /* ============ FOOTER ELEGAN & MODERN ============ */
  footer {
    background: #0B1320;
    color: #94A3B8;
    font-family: 'Plus Jakarta Sans', sans-serif;
    border-top: 3px solid #1668A3;
    position: relative;
  }
  .footer-inner {
    max-width: 1200px;
    margin: 0 auto;
    padding: 50px 20px 30px;
    display: grid;
    grid-template-columns: 1fr;
    gap: 32px;
  }
  @media (min-width: 640px) {
    .footer-inner {
      grid-template-columns: repeat(2, 1fr);
      gap: 30px;
    }
  }
  @media (min-width: 1024px) {
    .footer-inner {
      grid-template-columns: 1.4fr 1.1fr 1.2fr 0.9fr 1fr;
      gap: 32px;
    }
  }

  /* Brand Desa */
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
    width: 58px;
    height: 58px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.05);
    padding: 6px;
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.1);
  }
  .footer-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
  }
  .footer-brand .nama-desa {
    color: #FFFFFF;
    font-size: 17px;
    font-weight: 800;
    line-height: 1.25;
  }
  .footer-brand .sub-desa {
    font-size: 11.5px;
    color: #38BDF8;
    font-weight: 600;
    margin-top: 3px;
    letter-spacing: 0.03em;
    text-transform: uppercase;
  }
  .footer-brand p {
    font-size: 12.5px;
    color: #94A3B8;
    line-height: 1.7;
    margin: 0;
  }

  /* Kolom Footer */
  .footer-col h4 {
    color: #FFFFFF;
    font-size: 13px;
    font-weight: 800;
    margin: 0 0 16px 0;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .footer-col h4::before {
    content: '';
    display: inline-block;
    width: 4px;
    height: 14px;
    background: #38BDF8;
    border-radius: 2px;
  }
  .footer-col a {
    font-size: 13px;
    color: #94A3B8;
    line-height: 1.8;
    display: flex;
    align-items: center;
    text-decoration: none;
    transition: all 0.2s ease;
    padding: 3px 0;
  }
  .footer-col a:hover {
    color: #38BDF8;
    transform: translateX(4px);
  }

  /* Jam Pelayanan */
  .jam-pelayanan {
    background: rgba(56, 189, 248, 0.08);
    border: 1px solid rgba(56, 189, 248, 0.2);
    border-radius: 8px;
    padding: 10px 12px;
    margin-bottom: 14px;
  }
  .jam-pelayanan .jam-title {
    font-size: 11px;
    font-weight: 700;
    color: #38BDF8;
    display: flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 3px;
    text-transform: uppercase;
    letter-spacing: 0.03em;
  }
  .jam-pelayanan .jam-waktu {
    font-size: 12px;
    font-weight: 600;
    color: #E2E8F0;
  }

  /* Kontak & Pengaduan */
  .kontak-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 12px;
  }
  .kontak-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 13px;
  }
  .kontak-info {
    display: flex;
    flex-direction: column;
    gap: 2px;
  }
  .kontak-label {
    font-size: 10.5px;
    color: #64748B;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.03em;
  }
  .kontak-val {
    color: #E2E8F0;
    font-size: 12.5px;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.15s ease;
  }
  .kontak-val:hover {
    color: #38BDF8;
  }

  /* Detail Wilayah */
  .footer-wilayah {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 8px;
    padding: 10px 12px;
    display: flex;
    flex-direction: column;
    gap: 6px;
  }
  .footer-wilayah .baris {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 12px;
    padding-bottom: 4px;
    border-bottom: 1px dashed rgba(255, 255, 255, 0.08);
  }
  .footer-wilayah .baris:last-child {
    border-bottom: none;
    padding-bottom: 0;
  }
  .footer-wilayah .label {
    color: #64748B;
    font-weight: 500;
  }
  .footer-wilayah .nilai {
    color: #F1F5F9;
    font-weight: 700;
    text-align: right;
  }

  /* Copyright Bawah */
  .footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.06);
    background: #070D17;
    text-align: center;
    padding: 18px 20px;
    font-size: 12px;
    color: #64748B;
    font-weight: 500;
  }
  .footer-bottom strong {
    color: #94A3B8;
  }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<footer>
  <div class="footer-inner">
    <!-- 1. IDENTITAS BRAND DESA -->
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
      <p>Portal resmi Desa Munungkerep untuk transparansi informasi publik, peta potensi wilayah, dan pelayanan administrasi bagi seluruh warga dan masyarakat umum.</p>
    </div>

    <!-- 2. INFORMASI LAYANAN -->
    <div class="footer-col">
      <h4>Informasi Layanan</h4>
      <div class="jam-pelayanan">
        <div class="jam-title"><i class="fas fa-clock"></i> Jam Kantor Balai Desa</div>
        <div class="jam-waktu">Senin – Jumat: 08.00 – 15.00 WIB</div>
      </div>
      <a href="javascript:void(0)" onclick="if(typeof bukaModalLayanan === 'function'){ bukaModalLayanan(); } else { window.location.href='/#modal-layanan'; }"><i class="fas fa-file-lines" style="margin-right:8px; font-size:12px; color:#38BDF8;"></i> Surat Administrasi</a>
      <a href="javascript:void(0)" onclick="if(typeof bukaModalDemografi === 'function'){ bukaModalDemografi(); } else { window.location.href='/#modal-demografi'; }"><i class="fas fa-id-card" style="margin-right:8px; font-size:12px; color:#38BDF8;"></i> Pelayanan Kependudukan</a>
      <a href="/peta"><i class="fas fa-map-location-dot" style="margin-right:8px; font-size:12px; color:#38BDF8;"></i> Peta Interaktif &amp; Potensi</a>
      <a href="javascript:void(0)" onclick="if(typeof bukaModalInformasi === 'function'){ bukaModalInformasi('apbdes'); } else { window.location.href='/#modal-informasi'; }"><i class="fas fa-chart-pie" style="margin-right:8px; font-size:12px; color:#38BDF8;"></i> Transparansi APBDes</a>
    </div>

    <!-- 3. PENGADUAN & KONTAK -->
    <div class="footer-col">
      <h4>Pengaduan &amp; Kontak</h4>
      <div class="kontak-item">
        <div class="kontak-icon" style="background: rgba(37, 211, 102, 0.15); color: #25D366;"><i class="fab fa-whatsapp"></i></div>
        <div class="kontak-info">
          <span class="kontak-label">WhatsApp Call Center</span>
          <a href="https://wa.me/6281234922365" target="_blank" class="kontak-val">0812-3492-2365</a>
        </div>
      </div> 
      <div class="kontak-item">
        <div class="kontak-icon" style="background: rgba(56, 189, 248, 0.15); color: #38BDF8;"><i class="fas fa-envelope"></i></div>
        <div class="kontak-info">
          <span class="kontak-label">Email Resmi Desa</span>
          <a href="mailto:munungkerep11@gmail.com" class="kontak-val">munungkerep11@gmail.com</a>
        </div>
      </div>
      <div class="kontak-item">
        <div class="kontak-icon" style="background: rgba(239, 68, 68, 0.15); color: #F87171;"><i class="fas fa-building-columns"></i></div>
        <div class="kontak-info">
          <span class="kontak-label">Kotak Aspirasi Warga</span>
          <span class="kontak-val" style="font-size: 12px; color: #CBD5E1;">Balai Desa Munungkerep</span>
        </div>
      </div>
    </div>

    <!-- 4. TAUTAN CEPAT -->
    <div class="footer-col">
      <h4>Tautan Cepat</h4>
      <a href="/"><i class="fas fa-angle-right" style="margin-right:8px; font-size:11px; color:#64748B;"></i> Beranda</a>
      <a href="/peta"><i class="fas fa-angle-right" style="margin-right:8px; font-size:11px; color:#64748B;"></i> Peta &amp; Potensi</a>
      <a href="/profil-desa"><i class="fas fa-angle-right" style="margin-right:8px; font-size:11px; color:#64748B;"></i> Profil Desa</a>
      <a href="/kegiatan"><i class="fas fa-angle-right" style="margin-right:8px; font-size:11px; color:#64748B;"></i> Event &amp; Kegiatan</a>
    </div>

    <!-- 5. DETAIL WILAYAH -->
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
    &copy; 2026 <strong>Pemerintah Desa Munungkerep</strong> — Disusun oleh Tim KKN 2026. Seluruh hak dilindungi.
  </div>
</footer>