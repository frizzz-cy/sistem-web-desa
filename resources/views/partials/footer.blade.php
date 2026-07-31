<style>
  /* ============ FOOTER ============ */
  footer {
    background: #111723;
    color: #B8B8B8;
    font-family: 'Plus Jakarta Sans', sans-serif;
  }
  .footer-inner {
    max-width: 1180px;
    margin: 0 auto;
    padding: 48px 20px 24px;
    display: grid;
    grid-template-columns: 1fr;
    gap: 32px;
  }
  @media (min-width: 820px) {
    .footer-inner {
      grid-template-columns: 1.3fr 1fr 1fr 1fr;
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

  .kontak-item {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
  }
  .kontak-icon {
    width: 32px;
    height: 32px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    flex-shrink: 0;
  }
  .kontak-item p.placeholder {
    color: #5A6270;
    font-style: italic;
    font-size: 11.5px;
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
    max-width: 1180px;
    margin: 0 auto;
  }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<footer>
  <div class="footer-inner">
    <div class="footer-brand">
      <div class="baris-logo">
        <div class="footer-logo">
          <!-- Pastikan gambar /images/kabupaten.png menggunakan file PNG transparan yang baru -->
          <img src="/images/kabupaten.png" alt="Logo Kabupaten Jombang" onerror="this.style.display='none'">
        </div>
        <div>
          <div class="nama-desa">Pemerintah Desa<br>Munungkerep</div>
          <div class="sub-desa">Sistem Informasi Desa</div>
        </div>
      </div>
      <p>Portal resmi Desa Munungkerep untuk transparansi informasi, peta wilayah, dan pelayanan publik bagi seluruh warga dan masyarakat umum.</p>
    </div>

    <div class="footer-col">
      <h4>Tautan Cepat</h4>
      <a href="/">Beranda</a>
      <a href="/peta">Peta &amp; Potensi</a>
      <a href="/profil-desa">Profil Desa</a>
      <a href="/kegiatan">Event &amp; Kegiatan</a>
    </div>

    <div class="footer-col">
      <h4>Hubungi Kami</h4>
      <div class="kontak-item">
        <div class="kontak-icon"><i class="fas fa-phone-alt"></i></div>
        <p class="placeholder">📝 Nomor kantor desa belum diisi</p>
      </div>
      <div class="kontak-item">
        <div class="kontak-icon"><i class="fas fa-envelope"></i></div>
        <p class="placeholder">📝 Email kantor desa belum diisi</p>
      </div>
      <div class="kontak-item">
        <div class="kontak-icon"><i class="fas fa-map-marker-alt"></i></div>
        <p>Kantor Desa Munungkerep</p>
      </div>
    </div>

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