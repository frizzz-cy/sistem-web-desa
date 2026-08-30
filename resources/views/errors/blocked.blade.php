<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - NICE TRY, NOOB HACKER 🤡</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            background-color: #0a0a0f;
            color: #00ff66;
            font-family: 'Courier New', Courier, monospace;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-x: hidden;
            position: relative;
        }
        
        /* Grid background pattern */
        body::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(rgba(0, 255, 102, 0.03) 1px, transparent 1px),
                        linear-gradient(90deg, rgba(0, 255, 102, 0.03) 1px, transparent 1px);
            background-size: 30px 30px;
            z-index: 1;
            pointer-events: none;
        }

        .container {
            position: relative;
            z-index: 2;
            max-width: 680px;
            width: 100%;
            background: rgba(15, 23, 42, 0.95);
            border: 2px solid #ef4444;
            box-shadow: 0 0 35px rgba(239, 68, 68, 0.4), inset 0 0 15px rgba(239, 68, 68, 0.2);
            border-radius: 14px;
            padding: 30px 24px;
            text-align: center;
        }

        .clown {
            font-size: 64px;
            animation: bounce 1.2s infinite alternate;
            display: inline-block;
            margin-bottom: 10px;
        }

        @keyframes bounce {
            0% { transform: translateY(0) scale(1); }
            100% { transform: translateY(-12px) scale(1.1); }
        }

        h1 {
            color: #ef4444;
            font-size: 26px;
            font-weight: 900;
            text-shadow: 0 0 10px rgba(239, 68, 68, 0.8);
            margin-bottom: 8px;
            letter-spacing: 2px;
        }

        .subtitle {
            color: #fbbf24;
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .terminal-box {
            background: #020617;
            border: 1px solid #334155;
            border-radius: 8px;
            padding: 16px;
            text-align: left;
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 22px;
            box-shadow: inset 0 2px 8px rgba(0,0,0,0.8);
        }

        .terminal-box .red { color: #f87171; }
        .terminal-box .yellow { color: #fde047; }
        .terminal-box .green { color: #4ade80; }
        .terminal-box .blue { color: #38bdf8; }

        .quote-box {
            background: rgba(239, 68, 68, 0.1);
            border-left: 4px solid #ef4444;
            padding: 12px 16px;
            border-radius: 4px;
            font-size: 13.5px;
            color: #f1f5f9;
            margin-bottom: 24px;
            line-height: 1.5;
            text-align: left;
        }

        .btn-troll {
            display: inline-block;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: #ffffff;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
            font-family: inherit;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
            transition: all 0.2s ease;
        }

        .btn-troll:hover {
            transform: scale(1.05);
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.6);
        }

        .footer-note {
            margin-top: 20px;
            font-size: 11px;
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="clown">🤡</div>
        <h1>403 — ACCESS BLOCKED!</h1>
        <div class="subtitle">CIEEE MAU NGE-HACK YA? KETAHUAN DEH! 😂</div>

        <div class="terminal-box">
            <div><span class="blue">[>] Target:</span> Website Resmi Desa Munungkerep</div>
            <div><span class="blue">[>] Attacker IP:</span> <span class="red">{{ $ip ?? request()->ip() }}</span></div>
            <div><span class="yellow">[>] Status Payload:</span> <span class="red">GAGAL TOTAL (Skill Issue Detected)</span></div>
            <div><span class="yellow">[>] Error Code:</span> <span class="red">0xNOOB_HACKER_ATTEMPT</span></div>
            <div><span class="green">[✓] Security Action:</span> <span class="green">IP Anda sudah dicatat &amp; dilaporkan ke Telegram Admin!</span></div>
        </div>

        <div class="quote-box">
            💡 <b>Saran dari Tim Keamanan Kami:</b><br>
            Daripada buang-buang kuota nyari celah di web desa, mending seduh kopi dulu ☕, terus belajar dasar HTML &amp; PHP lagi dari awal di W3Schools. Semangat ya belajarnya! 🚀
        </div>

        <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank" class="btn-troll">
            🔓 Coba Bypass Firewall Lagi (Klik Di Sini) 🤡
        </a>

        <div class="footer-note">
            🛡️ Munungkerep Cyber Shield &bull; Automated Defense Active &bull; IP Banned
        </div>
    </div>
</body>
</html>
