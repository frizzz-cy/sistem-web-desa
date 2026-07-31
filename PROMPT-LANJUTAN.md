# Prompt Lanjutan — Sistem Informasi Desa Munungkerep

Salin semua isi di bawah ini ke percakapan Claude yang baru, **sambil upload ulang file-file project kamu yang terbaru** (beranda.blade.php, home.blade.php, profil-desa.blade.php, partials/navbar.blade.php, titik-lokasi.geojson, web.php) supaya Claude bisa lanjut kerja dari kode yang paling update.

---

## Konteks Proyek

Saya (mahasiswa KKN UNWAHA) sedang membangun **Sistem Informasi Desa (SID) Munungkerep** — Kecamatan Kabuh, Kabupaten Jombang, Jawa Timur — sebagai bagian dari program KKN 2026. Stack: **Laravel + Blade**, peta interaktif pakai **Leaflet.js**, semua styling & JS ditulis manual (vanilla CSS/JS, tanpa framework CSS).

## Struktur File

```
resources/views/
  beranda.blade.php          → Halaman utama/portal (Beranda)
  home.blade.php              → Peta & Potensi Desa (route: /peta)
  profil-desa.blade.php       → Profil Desa (struktur, anggaran, geografis, demografis, visi-misi)
  partials/navbar.blade.php   → Navbar bersama (di-include di 3 halaman via @include)

routes/web.php                → '/' → beranda, '/peta' → home, '/profil-desa' → profil-desa
public/data/titik-lokasi.geojson → Data semua titik & polygon peta
```

## Desain & Palet Warna (Gaya Website Pemerintahan Resmi)

```css
--biru-tua / --ground / --ink : #0B3B60   (navy utama)
--biru / --biru               : #1668A3
--merah / --clay              : #C62828
--emas / --gold / --amber     : #D4A017
--bg / --paper                : #F4F6F8
```
Font: **Plus Jakarta Sans** (satu-satunya font di seluruh situs, sudah menggantikan font lama Fraunces/IBM Plex Mono). Border-radius umumnya kecil (5-12px, formal — bukan gaya bulat "playful"). Hover animation dijaga minim/statis (bukan translateY/scale berlebihan) sesuai arahan "biar formal".

## Status Tiap Halaman

**Beranda** (`beranda.blade.php`)
- Hero: carousel foto full-1-layar (100vh) dengan fade transisi ke bawah, partikel daun jatuh animasi, judul "Selamat Datang di Desa Munungkerep"
- Section "Tentang Desa" (teks kiri, dulu ada peta kanan — sudah dipindah, cek versi terbaru)
- Section "Layanan & Informasi Desa" — 3 kartu (badge bulat gradasi biru + ikon SVG line-art buatan sendiri: peta, gedung, orang) menuju Peta, Profil Desa, Struktur Pemerintahan
- Section Berita placeholder (belum ada konten asli)
- Menu navbar: Beranda | Peta & Potensi | Profil Desa | Event & Kegiatan (**halaman /kegiatan belum dibuat — masih 404**)

**Peta & Potensi** (`home.blade.php`)
- Section "Demografi Penduduk": teks kiri (data 2.120 jiwa dll + garis pemisah) + peta lengkap kanan (Leaflet, basemap switcher Peta/Satelit/Kontur, legenda 10 kategori)
- Strip 5 kartu statistik (Titik Terdata, Dusun, Sarana Ibadah, Pendidikan, Potensi Ekonomi) — otomatis terhitung dari GeoJSON
- Section "Hasil Bumi" (Potensi Ekonomi): carousel 3 kartu (Tembakau, Pandan, Anyaman) — geser otomatis halus terus-menerus (bukan lompat), berhenti sementara saat di-hover, swipe manual dinonaktifkan
- Popup detail tiap komoditas: galeri foto, manfaat, cara pengolahan (bisa dibuka-tutup), **daftar chip "Bisa Diolah Jadi"** (macam-macam bentuk produk turunan, bukan 1 produk tunggal)
- Section "Sejarah Desa" — cerita asal-usul lengkap

**Profil Desa** (`profil-desa.blade.php`)
- Bagan struktur organisasi (12 orang, foto per-orang dengan fallback ikon default kalau foto belum ada)
- Anggaran APBDes (pie chart CSS 2025 & 2026)
- Kondisi Geografis, Data Demografis (2016/2017, ditandai perlu update)
- Visi & Misi (sudah terisi teks asli)

## Data Peta (titik-lokasi.geojson)
~31 fitur: titik (masjid, sekolah, kantor desa, dusun, UMKM) + polygon (7 wilayah dusun berwarna, batas desa merah putus-putus, 2 area "Potensi Ekonomi" — Tembakau area mayoritas & Tembakau+Pandan campuran).

## Konvensi Penting
- Semua nama variabel/fungsi JS pakai **Bahasa Indonesia** (`petaMini`, `bukaPopupPotensi`, dll)
- Validasi selalu jalanin `node -e` cek JavaScript valid + hitung tag `<style>`/`</style>` seimbang sebelum kasih file final (pernah ada bug tag `</style>` hilang yang bikin seluruh CSS gagal ke-apply)
- Foto pakai fallback `onerror` — kalau file belum ada, tampilkan ikon/teks default, jangan pecah/error
- Semua konten (sejarah, deskripsi produk, dll) ditulis original, bukan hasil salin situs lain — sempat dipakai 2 situs referensi (desakebonagung.net, desajogoloyo.com) tapi HANYA pola layout/struktur yang diadaptasi, bukan konten/gambar mereka

## PR yang Masih Menggantung
1. **Konfirmasi nama Kadus Kalipang & Duren** — Hartatik atau Sampan? (paling lama belum kelar)
2. **Halaman /kegiatan** — belum dibuat, link navbar & footer masih 404
3. Foto asli: perangkat desa (11 dari 12 masih placeholder), tembakau/pandan/anyaman (produk & komoditas)
4. Data demografis masih dari monografi 2016/2017 — perlu update
5. Kontak resmi kantor desa (telepon/WA) belum ada
6. Ketinggian desa (mdpl) belum ada datanya

---

**Instruksi ke Claude yang baru:** Lanjutkan pekerjaan dari file-file yang saya upload di atas. Jangan ulang dari awal — pakai kode yang sudah ada sebagai basis, dan ikuti konvensi/gaya yang sudah ditetapkan di ringkasan ini.
