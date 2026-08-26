<style>
  /* ============ FOOTER UTAMA DESA ============ */
  footer {
    background: #111723;
    color: #94A3B8;
    font-family: 'Plus Jakarta Sans', sans-serif;
    position: relative;
    width: 100%;
    box-sizing: border-box;
  }
  .footer-inner {
    max-width: 1200px;
    margin: 0 auto;
    padding: 48px 20px 32px;
    display: grid;
    grid-template-columns: 1fr;
    gap: 32px;
    box-sizing: border-box;
  }
  @media (min-width: 640px) {
    .footer-inner {
      grid-template-columns: repeat(2, 1fr);
      gap: 30px;
    }
  }
  @media (min-width: 1024px) {
    .footer-inner {
      grid-template-columns: 1.35fr 1.1fr 1.25fr 0.85fr 0.95fr;
      gap: 32px;
    }
  }

  /* 1. Brand Desa */
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
    width: 68px;
    height: auto;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .footer-logo img {
    width: 100%;
    height: auto;
    object-fit: contain;
    display: block;
  }
  .footer-brand .nama-desa {
    color: #FFFFFF;
    font-size: 18px;
    font-weight: 800;
    line-height: 1.25;
  }
  .footer-brand .sub-desa {
    font-size: 12px;
    color: #8E9DAA;
    margin-top: 3px;
  }
  .footer-brand p {
    font-size: 12.5px;
    color: #8E9DAA;
    line-height: 1.7;
    margin: 0;
    max-width: 310px;
  }

  /* 2. Judul Kolom & Tautan */
  .footer-col h4 {
    color: #FFFFFF;
    font-size: 13px;
    font-weight: 800;
    margin: 0 0 16px 0;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }
  .footer-col a {
    font-size: 13px;
    color: #8E9DAA;
    line-height: 1.85;
    display: flex;
    align-items: center;
    text-decoration: none;
    transition: color 0.15s ease;
  }
  .footer-col a:hover {
    color: #FFFFFF;
  }

  /* Jam Pelayanan */
  .jam-pelayanan {
    background: rgba(22, 104, 163, 0.15);
    border: 1px solid rgba(22, 104, 163, 0.35);
    border-radius: 8px;
    padding: 10px 14px;
    margin-bottom: 14px;
  }
  .jam-pelayanan .jam-title {
    font-size: 11.5px;
    font-weight: 700;
    color: #38BDF8;
    display: flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 3px;
  }
  .jam-pelayanan .jam-waktu {
    font-size: 12px;
    color: #DDE3EA;
    line-height: 1.4;
  }

  /* 3. Kontak & Pengaduan */
  .kontak-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 12px;
  }
  .kontak-icon {
    width: 32px;
    height: 32px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 13px;
    margin-top: 1px;
  }
  .kontak-info {
    display: flex;
    flex-direction: column;
    gap: 1px;
  }
  .kontak-label {
    font-size: 10.5px;
    color: #718096;
    line-height: 1.3;
  }
  .kontak-val {
    color: #DDE3EA;
    font-size: 12.5px;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.15s ease;
  }
  .kontak-val:hover {
    color: #FFFFFF;
  }

  /* 4. Tautan Cepat */
  .footer-links-col a {
    display: block;
    padding: 3px 0;
  }

  /* 5. Detail Wilayah */
  .footer-wilayah {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }
  .footer-wilayah .baris {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 12.5px;
    gap: 10px;
  }
  .footer-wilayah .label {
    color: #718096;
  }
  .footer-wilayah .nilai {
    color: #DDE3EA;
    font-weight: 700;
    text-align: right;
  }

  /* Copyright Bawah */
  .footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.06);
    text-align: center;
    padding: 18px 20px;
    font-size: 12px;
    color: #6E7C8B;
  }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@php
  $f_nama_desa    = \App\Models\Setting::get('footer_nama_desa', 'Pemerintah Desa Munungkerep');
  $f_sub_desa     = \App\Models\Setting::get('footer_sub_desa', 'Sistem Informasi Desa');
  $f_deskripsi    = \App\Models\Setting::get('footer_deskripsi', 'Portal resmi Desa Munungkerep untuk transparansi informasi, peta wilayah, dan pelayanan publik bagi seluruh warga dan masyarakat umum.');
  $f_jam_judul    = \App\Models\Setting::get('footer_jam_judul', 'Jam Kantor Balai Desa:');
  $f_jam_waktu    = \App\Models\Setting::get('footer_jam_waktu', 'Senin – Jumat: 08.00 – 15.00 WIB');
  $f_wa_pengaduan = \App\Models\Setting::get('footer_wa_pengaduan', '0812-3492-2365');
  $f_wa_layanan   = \App\Models\Setting::get('footer_wa_layanan', '0812-3492-2365');
  $f_email        = \App\Models\Setting::get('footer_email', 'munungkerep11@gmail.com');
  $f_aspirasi     = \App\Models\Setting::get('footer_aspirasi', 'Balai Desa Munungkerep');
  $f_wil_desa     = \App\Models\Setting::get('footer_wilayah_desa', 'Munungkerep');
  $f_wil_kec      = \App\Models\Setting::get('footer_wilayah_kecamatan', 'Kabuh');
  $f_wil_kab      = \App\Models\Setting::get('footer_wilayah_kabupaten', 'Jombang');
  $f_wil_prov     = \App\Models\Setting::get('footer_wilayah_provinsi', 'Jawa Timur');
  $f_wil_kodepos  = \App\Models\Setting::get('footer_wilayah_kodepos', '61455');
  $f_copyright    = \App\Models\Setting::get('footer_copyright', '© 2026 Pemerintah Desa Munungkerep — Disusun oleh Tim KKN 2026. Seluruh hak dilindungi.');

  $formatWa = function($no) {
    $clean = preg_replace('/[^0-9]/', '', (string)$no);
    if (substr($clean, 0, 1) === '0') {
      $clean = '62' . substr($clean, 1);
    }
    return $clean;
  };
@endphp

<footer>
  <div class="footer-inner">
    <!-- 1. BRAND DESA -->
    <div class="footer-brand">
      <div class="baris-logo">
        <div class="footer-logo">
          <img src="/images/kabupaten.png" alt="Logo Kabupaten Jombang" onerror="this.style.display='none'">
        </div>
        <div>
          <div class="nama-desa">{!! nl2br(e($f_nama_desa)) !!}</div>
          <div class="sub-desa">{{ $f_sub_desa }}</div>
        </div>
      </div>
      <p>{{ $f_deskripsi }}</p>
    </div>

    <!-- 2. INFORMASI LAYANAN -->
    <div class="footer-col">
      <h4>INFORMASI LAYANAN</h4>
      <div class="jam-pelayanan">
        <div class="jam-title"><i class="fas fa-clock"></i> {{ $f_jam_judul }}</div>
        <div class="jam-waktu">{{ $f_jam_waktu }}</div>
      </div>
      <a href="javascript:void(0)" onclick="if(typeof bukaModalLayanan === 'function'){ bukaModalLayanan(); } else { window.location.href='/#modal-layanan'; }"><i class="fas fa-file-signature" style="margin-right:8px; font-size:12px; color:#8E9DAA;"></i> Surat Administrasi</a>
      <a href="javascript:void(0)" onclick="if(typeof bukaModalDemografi === 'function'){ bukaModalDemografi(); } else { window.location.href='/#modal-demografi'; }"><i class="fas fa-id-card" style="margin-right:8px; font-size:12px; color:#8E9DAA;"></i> Pelayanan Kependudukan</a>
      <a href="/peta"><i class="fas fa-map-marked-alt" style="margin-right:8px; font-size:12px; color:#8E9DAA;"></i> Peta Interaktif &amp; Potensi</a>
      <a href="javascript:void(0)" onclick="if(typeof bukaModalInformasi === 'function'){ bukaModalInformasi('apbdes'); } else { window.location.href='/#modal-informasi'; }"><i class="fas fa-chart-pie" style="margin-right:8px; font-size:12px; color:#8E9DAA;"></i> Transparansi APBDes</a>
    </div>

    <!-- 3. PENGADUAN & INFORMASI -->
    <div class="footer-col">
      <h4>PENGADUAN &amp; INFORMASI</h4>
      <div class="kontak-item">
        <div class="kontak-icon" style="background: rgba(37, 211, 102, 0.15); color: #25D366;"><i class="fab fa-whatsapp"></i></div>
        <div class="kontak-info">
          <span class="kontak-label">Pengaduan &amp; Call Center:</span>
          <a href="https://wa.me/{{ $formatWa($f_wa_pengaduan) }}" target="_blank" class="kontak-val">{{ $f_wa_pengaduan }}</a>
        </div>
      </div> 
      <div class="kontak-item">
        <div class="kontak-icon" style="background: rgba(212, 160, 23, 0.15); color: #D4A017;"><i class="fas fa-headset"></i></div>
        <div class="kontak-info">
          <span class="kontak-label">Khusus Layanan Informasi:</span>
          <a href="https://wa.me/{{ $formatWa($f_wa_layanan) }}" target="_blank" class="kontak-val">{{ $f_wa_layanan }}</a>
        </div>
      </div>
      <div class="kontak-item">
        <div class="kontak-icon" style="background: rgba(22, 104, 163, 0.2); color: #38BDF8;"><i class="fas fa-envelope"></i></div>
        <div class="kontak-info">
          <span class="kontak-label">Email Resmi Desa:</span>
          <a href="mailto:{{ $f_email }}" class="kontak-val">{{ $f_email }}</a>
        </div>
      </div>
      <div class="kontak-item">
        <div class="kontak-icon" style="background: rgba(198, 40, 40, 0.2); color: #ef5350;"><i class="fas fa-box-archive"></i></div>
        <div class="kontak-info">
          <span class="kontak-label">Kotak Aspirasi Warga:</span>
          <span class="kontak-val" style="font-weight: 500; font-size: 12px;">{{ $f_aspirasi }}</span>
        </div>
      </div>
    </div>

    <!-- 4. TAUTAN CEPAT -->
    <div class="footer-col footer-links-col">
      <h4>TAUTAN CEPAT</h4>
      <a href="/">Beranda</a>
      <a href="/peta">Peta &amp; Potensi</a>
      <a href="/profil-desa">Profil Desa</a>
      <a href="/kegiatan">Event &amp; Kegiatan</a>
    </div>

    <!-- 5. DETAIL WILAYAH -->
    <div class="footer-col">
      <h4>DETAIL WILAYAH</h4>
      <div class="footer-wilayah">
        <div class="baris"><span class="label">Desa</span><span class="nilai">{{ $f_wil_desa }}</span></div>
        <div class="baris"><span class="label">Kecamatan</span><span class="nilai">{{ $f_wil_kec }}</span></div>
        <div class="baris"><span class="label">Kabupaten</span><span class="nilai">{{ $f_wil_kab }}</span></div>
        <div class="baris"><span class="label">Provinsi</span><span class="nilai">{{ $f_wil_prov }}</span></div>
        <div class="baris"><span class="label">Kode Pos</span><span class="nilai">{{ $f_wil_kodepos }}</span></div>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    {{ $f_copyright }}
  </div>
</footer>