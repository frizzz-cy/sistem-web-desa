<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sertifikat Serah Terima Website Resmi Desa Munungkerep</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Playfair+Display:ital,wght@0,700;1,600&display=swap" rel="stylesheet">
  <style>
    :root {
      --emut-emas: #C59B27;
      --biru-tua: #0B3B60;
      --hijau-tua: #0F6B58;
      --border-emas: #D4AF37;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      background: #F1F5F9;
      font-family: 'Plus Jakarta Sans', sans-serif;
      color: #1E293B;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 30px 15px;
    }

    .action-bar {
      margin-bottom: 20px;
      display: flex;
      gap: 12px;
    }
    .btn-action {
      background: var(--biru-tua);
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 30px;
      font-weight: 700;
      font-size: 13.5px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      box-shadow: 0 4px 12px rgba(11,59,96,0.2);
      text-decoration: none;
      transition: all 0.2s ease;
    }
    .btn-action:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(11,59,96,0.3); }

    /* KONTAINER SERTIFIKAT A4 LANDSCAPE */
    .sertifikat-box {
      background: #fff;
      width: 1000px;
      max-width: 100%;
      min-height: 680px;
      padding: 35px;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      position: relative;
      overflow: hidden;
      border: 12px solid #fff;
      outline: 2px solid var(--border-emas);
    }

    .border-dalam {
      border: 2px solid var(--emut-emas);
      padding: 30px 35px;
      min-height: 610px;
      position: relative;
      background: radial-gradient(circle at center, #FFFFFF 0%, #FAFCFF 100%);
    }

    .corner-ornament {
      position: absolute;
      width: 40px;
      height: 40px;
      border-color: var(--emut-emas);
      border-style: solid;
    }
    .top-left { top: 8px; left: 8px; border-width: 3px 0 0 3px; }
    .top-right { top: 8px; right: 8px; border-width: 3px 3px 0 0; }
    .bottom-left { bottom: 8px; left: 8px; border-width: 0 0 3px 3px; }
    .bottom-right { bottom: 8px; right: 8px; border-width: 0 3px 3px 0; }

    .header-kop {
      text-align: center;
      margin-bottom: 20px;
    }
    .instansi-title {
      font-family: 'Cinzel', serif;
      font-size: 18px;
      letter-spacing: 0.15em;
      color: var(--biru-tua);
      text-transform: uppercase;
      font-weight: 700;
    }
    .sub-instansi {
      font-size: 13px;
      color: #64748B;
      font-weight: 600;
      letter-spacing: 0.05em;
      margin-top: 4px;
    }

    .divider-gold {
      width: 180px;
      height: 3px;
      background: linear-gradient(90deg, transparent, var(--emut-emas), transparent);
      margin: 12px auto 20px;
    }

    .sertifikat-title {
      font-family: 'Playfair Display', serif;
      font-size: 28px;
      color: var(--biru-tua);
      text-align: center;
      font-weight: 700;
      margin-bottom: 6px;
    }
    .sertifikat-subtitle {
      text-align: center;
      font-size: 13px;
      color: #475569;
      margin-bottom: 25px;
    }

    .isi-pernyataan {
      text-align: center;
      font-size: 14.5px;
      line-height: 1.7;
      color: #334155;
      max-width: 820px;
      margin: 0 auto 30px;
    }
    .highlight-web {
      font-weight: 800;
      color: var(--hijau-tua);
      background: #F0FDF4;
      padding: 2px 8px;
      border-radius: 4px;
      border: 1px solid #BBF7D0;
    }

    /* GRID BARCODE & TANDA TANGAN */
    .footer-grid {
      display: grid;
      grid-template-columns: 1fr 180px 1fr;
      align-items: center;
      gap: 20px;
      margin-top: 20px;
    }

    .ttd-box {
      text-align: center;
    }
    .ttd-jabatan {
      font-size: 13px;
      font-weight: 700;
      color: var(--biru-tua);
      margin-bottom: 50px;
    }
    .ttd-nama {
      font-size: 14px;
      font-weight: 800;
      color: #0F172A;
      border-bottom: 1px dashed #94A3B8;
      display: inline-block;
      padding-bottom: 2px;
    }
    .ttd-nip {
      font-size: 11.5px;
      color: #64748B;
      margin-top: 4px;
    }

    /* BARCODE QR CODE BOX */
    .qr-box {
      text-align: center;
      background: #fff;
      padding: 10px;
      border-radius: 10px;
      border: 1.5px solid #CBD5E1;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .qr-box img {
      width: 110px;
      height: 110px;
      display: block;
      margin: 0 auto;
    }
    .qr-label {
      font-size: 10px;
      font-weight: 700;
      color: var(--biru-tua);
      margin-top: 6px;
      letter-spacing: 0.03em;
    }

    /* ATURAN CETAK LANDSCAPE A4 */
    @media print {
      @page { size: A4 landscape; margin: 0; }
      body { background: #fff; padding: 0; }
      .action-bar { display: none !important; }
      .sertifikat-box {
        width: 100vw;
        height: 100vh;
        box-shadow: none;
        border-radius: 0;
        border: none;
        outline: none;
      }
    }
  </style>
</head>
<body>

  <!-- TOMBOL AKSI HARIAN & CETAK -->
  <div class="action-bar">
    <a href="/" class="btn-action" style="background:#475569;">← Kembali ke Beranda</a>
    <button onclick="window.print()" class="btn-action">🖨️ Cetak / Simpan PDF Sertifikat</button>
  </div>

  <!-- BOKS SERTIFIKAT A4 LANDSCAPE -->
  <div class="sertifikat-box">
    <div class="border-dalam">
      <div class="corner-ornament top-left"></div>
      <div class="corner-ornament top-right"></div>
      <div class="corner-ornament bottom-left"></div>
      <div class="corner-ornament bottom-right"></div>

      <!-- KOP HEAD -->
      <div class="header-kop">
        <div class="instansi-title">Pemerintah Desa Munungkerep</div>
        <div class="sub-instansi">Kecamatan Kabuh &bull; Kabupaten Jombang &bull; Provinsi Jawa Timur</div>
        <div class="divider-gold"></div>
      </div>

      <!-- JUDUL SERTIFIKAT -->
      <div class="sertifikat-title">Sertifikat Serah Terima &amp; Pengesahan</div>
      <div class="sertifikat-subtitle">Nomor: 045/SERAH-TERIMA/KKN-UNWAHA/MUNUNGKEREP/2026</div>

      <!-- ISI ANOTASI -->
      <div class="isi-pernyataan">
        Dengan ini diterangkan secara resmi bahwa pembangunan dan peluncuran <span class="highlight-web">Sistem Informasi Desa (SID) &amp; Peta Digital Interaktif Desa Munungkerep</span> telah selesai dilaksanakan oleh <strong>Tim Mahasiswa KKN-PPM 2026</strong> dan diserahterimakan sepenuhnya kepada <strong>Pemerintah Desa Munungkerep</strong> untuk dikelola secara mandiri demi mendukung pelayanan publik dan transparansi desa.
      </div>

      <!-- FOOTER TANDA TANGAN & QR BARCODE -->
      <div class="footer-grid">
        <!-- TTD 1: KETUA TIM KKN -->
        <div class="ttd-box">
          <div class="ttd-jabatan">Ketua Tim KKN 2026</div>
          <div class="ttd-nama">Firstian Yusril K.</div>
          <div class="ttd-nip">Koordinator Mahasiswa KKN</div>
        </div>

        <!-- BARCODE QR CODE SCANNER -->
        <div class="qr-box">
          <!-- QR CODE GENERATOR LIVE VIA QUICKCHART -->
          <img src="https://quickchart.io/qr?text=https%3A%2F%2Fmunungkerep.desa.id&size=180" alt="Scan Barcode Website Desa">
          <div class="qr-label">📱 SCAN BARCODE</div>
          <div style="font-size:8.5px; color:#64748B; margin-top:2px;">Kunjungi Website Resmi</div>
        </div>

        <!-- TTD 2: KEPALA DESA MUNUNGKEREP -->
        <div class="ttd-box">
          <div class="ttd-jabatan">Kepala Desa Munungkerep</div>
          <div class="ttd-nama">SUTRISMI</div>
          <div class="ttd-nip">Kepala Desa Periode 2019 - Sekarang</div>
        </div>
      </div>

    </div>
  </div>

</body>
</html>
