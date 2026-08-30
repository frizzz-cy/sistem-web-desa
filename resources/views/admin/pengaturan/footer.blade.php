@extends('layouts.admin', ['activePage' => 'pengaturan-footer'])

@section('title', 'Pengaturan Footer, Kontak & Detail Wilayah')

@section('styles')
    <style>
        .setting-section {
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            padding: 24px;
            background: #FFF;
            margin-bottom: 24px;
        }
        .section-header {
            font-size: 15px;
            font-weight: 800;
            color: var(--biru-tua);
            margin-top: 0;
            margin-bottom: 18px;
            border-bottom: 2px solid var(--border);
            padding-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
    </style>
@endsection

@section('content')
    <div class="admin-box">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
            <div>
                <h1 style="margin: 0; font-size: 24px; color: var(--biru-tua); font-weight: 800;">
                    🦶 Pengaturan Footer, Kontak &amp; Wilayah
                </h1>
                <p style="margin: 4px 0 0; font-size: 13.5px; color: var(--teks-muted);">
                    Kelola seluruh informasi footer, nomor WhatsApp pengaduan, email, jam kantor, dan detail wilayah desa.
                </p>
            </div>
            <a href="/" class="btn btn-secondary" target="_blank">Lihat Footer di Website</a>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="/admin/pengaturan/footer" method="POST">
            @csrf

            <!-- 1. IDENTITAS & DESKRIPSI FOOTER -->
            <div class="setting-section">
                <div class="section-header">
                    <span>🏛️ 1. Identitas &amp; Deskripsi Desa di Footer</span>
                </div>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px; margin-bottom: 16px;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label style="font-size: 12.5px; font-weight: 700;">Nama Pemerintah Desa (Header)</label>
                        <input type="text" name="nama_desa" value="{{ $footer_settings['nama_desa'] ?? 'Pemerintah Desa Munungkerep' }}" required placeholder="Contoh: Pemerintah Desa Munungkerep">
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label style="font-size: 12.5px; font-weight: 700;">Sub Judul / Label Sistem</label>
                        <input type="text" name="sub_desa" value="{{ $footer_settings['sub_desa'] ?? 'Sistem Informasi Desa' }}" required placeholder="Contoh: Sistem Informasi Desa">
                    </div>
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label style="font-size: 12.5px; font-weight: 700;">Teks Deskripsi / Profil Singkat di Bawah Logo</label>
                    <textarea name="deskripsi" rows="3" required placeholder="Tuliskan deskripsi singkat portal resmi desa...">{{ $footer_settings['deskripsi'] ?? 'Portal resmi Desa Munungkerep untuk transparansi informasi, peta wilayah, dan pelayanan publik bagi seluruh warga dan masyarakat umum.' }}</textarea>
                </div>
            </div>

            <!-- 2. PUSAT PENGADUAN & KONTAK RESMI -->
            <div class="setting-section" style="border-left: 4px solid #10B981;">
                <div class="section-header" style="color: #065F46;">
                    <span>📞 2. Kontak WhatsApp, Email &amp; Pengaduan Warga</span>
                </div>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px;">
                    <div class="form-group">
                        <label style="font-size: 12.5px; font-weight: 700; color: #065F46;">🟢 No. WhatsApp Pengaduan &amp; Call Center</label>
                        <input type="text" name="wa_pengaduan" value="{{ $footer_settings['wa_pengaduan'] ?? '0812-3492-2365' }}" required placeholder="Contoh: 0812-3492-2365">
                        <small style="color: #64748B; font-size: 11px;">Otomatis menjadi link WhatsApp aktif di footer.</small>
                    </div>
                    <div class="form-group">
                        <label style="font-size: 12.5px; font-weight: 700; color: #B45309;">🟡 No. WhatsApp Khusus Layanan Informasi</label>
                        <input type="text" name="wa_layanan" value="{{ $footer_settings['wa_layanan'] ?? '0812-3492-2365' }}" required placeholder="Contoh: 0812-3492-2365">
                        <small style="color: #64748B; font-size: 11px;">Nomor admin informasi surat &amp; pelayanan.</small>
                    </div>
                    <div class="form-group">
                        <label style="font-size: 12.5px; font-weight: 700; color: #0369A1;">✉️ Email Resmi Desa</label>
                        <input type="email" name="email" value="{{ $footer_settings['email'] ?? 'munungkerep11@gmail.com' }}" required placeholder="Contoh: munungkerep11@gmail.com">
                        <small style="color: #64748B; font-size: 11px;">Alamat email surat-menyurat resmi desa.</small>
                    </div>
                    <div class="form-group">
                        <label style="font-size: 12.5px; font-weight: 700; color: #DC2626;">📥 Lokasi Kotak Aspirasi Warga</label>
                        <input type="text" name="aspirasi" value="{{ $footer_settings['aspirasi'] ?? 'Balai Desa Munungkerep' }}" required placeholder="Contoh: Balai Desa Munungkerep">
                        <small style="color: #64748B; font-size: 11px;">Tempat penyerahan surat fisik / aspirasi warga.</small>
                    </div>
                </div>
            </div>

            <!-- 3. JAM KANTOR & PELAYANAN -->
            <div class="setting-section" style="border-left: 4px solid #0284C7;">
                <div class="section-header" style="color: #0369A1;">
                    <span>⏰ 3. Jam Operasional Kantor Pelayanan</span>
                </div>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label style="font-size: 12.5px; font-weight: 700;">Judul Jam Pelayanan</label>
                        <input type="text" name="jam_judul" value="{{ $footer_settings['jam_judul'] ?? 'Jam Kantor Balai Desa:' }}" required placeholder="Contoh: Jam Kantor Balai Desa:">
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label style="font-size: 12.5px; font-weight: 700;">Hari &amp; Jam Pelayanan Aktif</label>
                        <input type="text" name="jam_waktu" value="{{ $footer_settings['jam_waktu'] ?? 'Senin – Jumat: 08.00 – 15.00 WIB' }}" required placeholder="Contoh: Senin – Jumat: 08.00 – 15.00 WIB">
                    </div>
                </div>
            </div>

            <!-- 4. DETAIL WILAYAH DESA -->
            <div class="setting-section">
                <div class="section-header">
                    <span>📍 4. Detail Data Wilayah Pemerintahan</span>
                </div>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label style="font-size: 12px; font-weight: 700;">Desa</label>
                        <input type="text" name="wilayah_desa" value="{{ $footer_settings['wilayah_desa'] ?? 'Munungkerep' }}" required placeholder="Munungkerep">
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label style="font-size: 12px; font-weight: 700;">Kecamatan</label>
                        <input type="text" name="wilayah_kecamatan" value="{{ $footer_settings['wilayah_kecamatan'] ?? 'Kabuh' }}" required placeholder="Kabuh">
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label style="font-size: 12px; font-weight: 700;">Kabupaten</label>
                        <input type="text" name="wilayah_kabupaten" value="{{ $footer_settings['wilayah_kabupaten'] ?? 'Jombang' }}" required placeholder="Jombang">
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label style="font-size: 12px; font-weight: 700;">Provinsi</label>
                        <input type="text" name="wilayah_provinsi" value="{{ $footer_settings['wilayah_provinsi'] ?? 'Jawa Timur' }}" required placeholder="Jawa Timur">
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label style="font-size: 12px; font-weight: 700;">Kode Pos</label>
                        <input type="text" name="wilayah_kodepos" value="{{ $footer_settings['wilayah_kodepos'] ?? '61455' }}" required placeholder="61455">
                    </div>
                </div>
            </div>

            <!-- 5. NOTIFIKASI KEAMANAN & LOGIN KE TELEGRAM BOT -->
            <div class="setting-section" style="border-left: 4px solid #0284C7; background: #F0F9FF;">
                <div class="section-header" style="color: #0369A1;">
                    <span>✈️ 5. Notifikasi Keamanan &amp; Login IP ke Telegram Bot</span>
                </div>
                <p style="font-size: 13px; color: #475569; margin-top: 0; margin-bottom: 16px;">
                    Setiap kali ada admin atau user yang login (atau percobaan serangan gagal), sistem akan otomatis mengirimkan detail <b>Alamat IP</b>, <b>Perangkat &amp; Browser</b>, serta <b>Waktu Login</b> ke akun Telegram Anda.
                </p>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px; margin-bottom: 16px;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label style="font-size: 12.5px; font-weight: 700; color: #0369A1;">🤖 Telegram Bot Token</label>
                        <input type="text" name="telegram_bot_token" id="input_bot_token" value="{{ $footer_settings['telegram_bot_token'] ?? '' }}" placeholder="Contoh: 7123456789:AAFlkjh89sd7f98s7df...">
                        <small style="color: #64748B; font-size: 11px;">Didapat dari <b>@BotFather</b> di Telegram.</small>
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label style="font-size: 12.5px; font-weight: 700; color: #0369A1;">🆔 Telegram Chat ID (ID Akun/Grup Anda)</label>
                        <input type="text" name="telegram_chat_id" id="input_chat_id" value="{{ $footer_settings['telegram_chat_id'] ?? '' }}" placeholder="Contoh: 123456789 atau -100123456789">
                        <small style="color: #64748B; font-size: 11px;">Didapat dari <b>@userinfobot</b> atau <b>@getidsbot</b> di Telegram.</small>
                    </div>
                </div>

                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; padding-top: 8px; border-top: 1px dashed #BAE6FD;">
                    <span style="font-size: 12px; color: #0369A1; font-weight: 600;">Tes apakah bot sudah terhubung dengan benar:</span>
                    <button type="submit" formaction="/admin/pengaturan/telegram-test" class="btn btn-secondary" style="background: #E0F2FE; color: #0369A1; border: 1.5px solid #BAE6FD; font-size: 12.5px; font-weight: 700;">
                        🔔 Kirim Tes Notifikasi ke Telegram
                    </button>
                </div>
            </div>

            <!-- 6. COPYRIGHT FOOTER -->
            <div class="setting-section">
                <div class="section-header">
                    <span>©️ 6. Baris Hak Cipta (Copyright Bawah)</span>
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label style="font-size: 12.5px; font-weight: 700;">Teks Copyright Paling Bawah</label>
                    <input type="text" name="copyright" value="{{ $footer_settings['copyright'] ?? '© 2026 Pemerintah Desa Munungkerep — Disusun oleh Tim KKN 2026. Seluruh hak dilindungi.' }}" required placeholder="Teks hak cipta footer...">
                </div>
            </div>

            <!-- Submit Floating Bar / Bottom Action -->
            <div style="background: #F8FAFC; border: 1.5px solid var(--border); padding: 18px 24px; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-top: 10px;">
                <span style="font-size: 13px; color: var(--teks-muted);">Periksa kembali formulir di atas sebelum menyimpan.</span>
                <button type="submit" class="btn btn-primary" style="padding: 12px 28px; font-size: 14.5px;">
                    Simpan Seluruh Pengaturan
                </button>
            </div>
        </form>
    </div>
@endsection
