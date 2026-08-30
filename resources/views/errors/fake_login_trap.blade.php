<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pusat Kontrol Database & Server Desa — Autentikasi Super Administrator</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            background-color: #07090e;
            color: #e2e8f0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
        }
        body::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: radial-gradient(circle at 50% 30%, rgba(30, 58, 138, 0.25), transparent 70%);
            pointer-events: none;
        }
        .login-card {
            background: #0f172a;
            border: 1px solid #1e293b;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7), 0 0 20px rgba(59, 130, 246, 0.15);
            border-radius: 16px;
            width: 100%;
            max-width: 440px;
            padding: 36px 32px;
            position: relative;
            z-index: 10;
        }
        .header {
            text-align: center;
            margin-bottom: 26px;
        }
        .badge {
            display: inline-block;
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1px;
            padding: 4px 10px;
            border-radius: 20px;
            margin-bottom: 12px;
            text-transform: uppercase;
        }
        h2 {
            font-size: 20px;
            font-weight: 800;
            color: #f8fafc;
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }
        p.sub {
            font-size: 12.5px;
            color: #94a3b8;
        }
        .form-group {
            margin-bottom: 16px;
            text-align: left;
        }
        label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #cbd5e1;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        input {
            width: 100%;
            background: #020617;
            border: 1.5px solid #334155;
            border-radius: 8px;
            padding: 12px 14px;
            color: #f8fafc;
            font-size: 14px;
            font-family: inherit;
            outline: none;
            transition: all 0.2s;
        }
        input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 13px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
            margin-top: 6px;
        }
        .btn-submit:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
        }
        
        /* Loading modal overlay */
        #trap-overlay {
            display: none;
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(15, 23, 42, 0.96);
            border-radius: 16px;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 24px;
            text-align: center;
            z-index: 50;
        }
        .spinner {
            width: 44px;
            height: 44px;
            border: 4px solid rgba(59, 130, 246, 0.2);
            border-top-color: #3b82f6;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin-bottom: 18px;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        .progress-bar-wrap {
            width: 100%;
            height: 8px;
            background: #1e293b;
            border-radius: 10px;
            overflow: hidden;
            margin: 16px 0;
        }
        .progress-bar {
            width: 0%;
            height: 100%;
            background: linear-gradient(90deg, #3b82f6, #10b981);
            transition: width 0.3s;
        }
        .status-log {
            font-family: monospace;
            font-size: 12px;
            color: #38bdf8;
            margin-bottom: 8px;
        }
        .alert-box {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid #ef4444;
            color: #fca5a5;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 12px;
            margin-bottom: 16px;
            display: none;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="header">
        <span class="badge">🔒 RESTRICTED ROOT SYSTEM</span>
        <h2>Konsol Administrator Database</h2>
        <p class="sub">Pemerintah Desa Munungkerep &bull; Secure Gateway</p>
    </div>

    <div class="alert-box" id="error-alert"></div>

    <form id="fake-form" onsubmit="handleFakeLogin(event)">
        <div class="form-group">
            <label>Username / Root ID</label>
            <input type="text" id="fake_user" placeholder="root / admin_master" required autocomplete="off">
        </div>

        <div class="form-group">
            <label>Master Security Password</label>
            <input type="password" id="fake_pass" placeholder="••••••••••••••••" required autocomplete="off">
        </div>

        <div class="form-group">
            <label>Server 2FA Secret Key / Token PIN</label>
            <input type="text" id="fake_pin" placeholder="Contoh: 9842" autocomplete="off">
        </div>

        <button type="submit" class="btn-submit" id="btn-login">
            AUTENTIKASI &amp; MASUK SERVER 🔑
        </button>
    </form>

    <!-- Overlay Jebakan Loading Palsu -->
    <div id="trap-overlay">
        <div class="spinner"></div>
        <div style="font-weight: 800; font-size: 15px; color: #f8fafc; margin-bottom: 4px;">Sedang Mengautentikasi Root...</div>
        <div class="status-log" id="trap-log">Connecting to Master Gateway...</div>
        
        <div class="progress-bar-wrap">
            <div class="progress-bar" id="trap-progress"></div>
        </div>

        <div style="font-size: 11px; color: #94a3b8;">
            Mohon jangan tutup jendela ini saat handshake enkripsi berlangsung.
        </div>
    </div>
</div>

<script>
let attemptCount = 0;

function handleFakeLogin(e) {
    e.preventDefault();
    attemptCount++;

    const user = document.getElementById('fake_user').value;
    const pass = document.getElementById('fake_pass').value;
    const pin = document.getElementById('fake_pin').value;

    const overlay = document.getElementById('trap-overlay');
    const log = document.getElementById('trap-log');
    const prog = document.getElementById('trap-progress');
    const alertBox = document.getElementById('error-alert');

    alertBox.style.display = 'none';
    overlay.style.display = 'flex';
    prog.style.width = '10%';
    log.textContent = 'Mengirim payload ke Server Auth...';

    // Kirim data rahasia ke backend untuk dikirim ke Telegram admin
    fetch('/fake-login-trap-submit', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({
            username: user,
            password: pass,
            pin: pin,
            attempt: attemptCount
        })
    }).catch(() => {});

    // Animasi proses palsu yang bikin si hacker penasaran
    setTimeout(() => {
        prog.style.width = '45%';
        log.textContent = 'Memverifikasi Kunci RSA-4096 Database...';
    }, 1200);

    setTimeout(() => {
        prog.style.width = '78%';
        log.textContent = 'Bypassing Zero-Trust Firewall Node 3...';
    }, 2800);

    setTimeout(() => {
        prog.style.width = '99%';
        log.textContent = 'Sinkronisasi Privilege Administrator...';
    }, 4500);

    setTimeout(() => {
        overlay.style.display = 'none';
        prog.style.width = '0%';

        // Pesan error palsu yang bikin hacker terus nyoba berulang kali
        const fakeErrors = [
            `Error 0x800403: Kredensial tidak cocok pada cluster master. Coba periksa kembali password atau PIN 2FA Anda. (Percobaan ke-${attemptCount})`,
            `Error 0xDEADBEEF: Handshake SSL ditolak oleh hardware security module. Silakan ulangi autentikasi.`,
            `Autentikasi Gagal: Token 2FA telah kedaluwarsa (Selisih waktu 0.04s). Masukkan kembali PIN baru!`,
            `Warning: Percobaan ke-${attemptCount} dicurigai brute-force. Sesi direset untuk keamanan jaringan.`
        ];

        const errText = fakeErrors[(attemptCount - 1) % fakeErrors.length];
        alertBox.textContent = errText;
        alertBox.style.display = 'block';

        // Kosongkan password agar dia mengetik lagi
        document.getElementById('fake_pass').value = '';
        document.getElementById('fake_pass').focus();
    }, 6000);
}
</script>

</body>
</html>
