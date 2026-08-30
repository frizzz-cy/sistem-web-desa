<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 — AWOKAWOK KENA BAN 🤡</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Impact&family=Plus+Jakarta+Sans:wght@700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            background: #09090b;
            color: #f4f4f5;
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            text-align: center;
            overflow-x: hidden;
        }

        .meme-card {
            background: #18181b;
            border: 3px solid #ef4444;
            box-shadow: 0 0 40px rgba(239, 68, 68, 0.4), 0 20px 25px -5px rgba(0, 0, 0, 0.8);
            border-radius: 24px;
            max-width: 580px;
            width: 100%;
            padding: 32px 24px;
            position: relative;
        }

        .meme-title {
            font-family: 'Impact', 'Arial Black', sans-serif;
            font-size: 32px;
            color: #fef08a;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            text-shadow: 3px 3px 0 #000, -2px -2px 0 #000, 2px -2px 0 #000, -2px 2px 0 #000, 0 4px 10px rgba(0,0,0,0.8);
            line-height: 1.2;
            margin-bottom: 16px;
        }

        .meme-img-wrap {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            border: 3px solid #27272a;
            margin-bottom: 20px;
            background: #000;
            box-shadow: 0 8px 20px rgba(0,0,0,0.6);
        }

        .meme-img {
            width: 100%;
            height: auto;
            max-height: 280px;
            object-fit: cover;
            display: block;
        }

        .meme-bottom-text {
            font-family: 'Impact', 'Arial Black', sans-serif;
            font-size: 24px;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 2px 2px 0 #000, -2px -2px 0 #000, 2px -2px 0 #000, -2px 2px 0 #000;
            position: absolute;
            bottom: 12px;
            left: 10px;
            right: 10px;
            line-height: 1.2;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 20px;
        }

        .stat-box {
            background: #27272a;
            border: 1px solid #3f3f46;
            padding: 10px 14px;
            border-radius: 12px;
            font-size: 12.5px;
            text-align: left;
        }

        .stat-label {
            color: #a1a1aa;
            font-size: 11px;
            font-weight: 700;
            display: block;
            margin-bottom: 2px;
        }

        .stat-val {
            font-weight: 800;
            color: #fafafa;
        }

        .stat-val.red { color: #f87171; }
        .stat-val.yellow { color: #fde047; }
        .stat-val.green { color: #4ade80; }

        .roast-msg {
            background: rgba(239, 68, 68, 0.12);
            border: 1.5px dashed #ef4444;
            border-radius: 14px;
            padding: 14px 16px;
            font-size: 13.5px;
            color: #fca5a5;
            font-weight: 700;
            line-height: 1.5;
            margin-bottom: 22px;
        }

        .action-btns {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn-meme {
            display: block;
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            font-weight: 900;
            font-size: 14.5px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            font-family: inherit;
        }

        .btn-rickroll {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: #fff;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
        }

        .btn-rickroll:hover {
            transform: scale(1.03);
            background: linear-gradient(135deg, #dc2626, #b91c1c);
        }

        .btn-belajar {
            background: #27272a;
            color: #e4e4e7;
            border: 1.5px solid #3f3f46;
        }

        .btn-belajar:hover {
            background: #3f3f46;
            color: #fff;
            transform: scale(1.02);
        }

        .footer-tag {
            margin-top: 18px;
            font-size: 11px;
            color: #71717a;
            font-weight: 700;
        }
    </style>
</head>
<body>

<div class="meme-card">
    <div class="meme-title">
        POV: LU NYOBA HACK WEB DESA TAPI KENA BANNED 🤡
    </div>

    <div class="meme-img-wrap">
        <!-- Meme GIF Keyboard Cat / Hackerman / Clown -->
        <img class="meme-img" src="https://media.giphy.com/media/unQ3IJU2RG7DO/giphy.gif" alt="Hacker Meme" onerror="this.src='https://media.giphy.com/media/3o7TKSjRrfIPjeiVyM/giphy.gif'">
        <div class="meme-bottom-text">
            SKILL ISSUE BANGET DECK! 😭🙏
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-box">
            <span class="stat-label">🌐 IP KORBAN (LU):</span>
            <span class="stat-val red">{{ $ip ?? request()->ip() }}</span>
        </div>
        <div class="stat-box">
            <span class="stat-label">📉 IQ HACKER:</span>
            <span class="stat-val yellow">-9999 (Noob)</span>
        </div>
        <div class="stat-box">
            <span class="stat-label">🚨 STATUS AKSES:</span>
            <span class="stat-val red">AUTO-BANNED 24 JAM 🚫</span>
        </div>
        <div class="stat-box">
            <span class="stat-label">🛡️ SERVER DEFENSE:</span>
            <span class="stat-val green">100% UNTOUCHED 😎</span>
        </div>
    </div>

    <div class="roast-msg">
        "Kira-kira begini rasanya install Termux kemarin sore terus sok-sokan mau nge-hack web desa... Pulang deck, disuruh emak beli beras! 🍚😂"
    </div>

    <div class="action-btns">
        <button onclick="playMemeSound()" class="btn-meme btn-rickroll">
            😭 NANGIS DI POJOKAN (KLIK DISINI) 🔊
        </button>
        <a href="https://www.w3schools.com/html/" target="_blank" class="btn-meme btn-belajar">
            📚 Belajar HTML Dasar Dulu di W3Schools 👨‍💻
        </a>
    </div>

    <div class="footer-tag">
        🛡️ Munungkerep Cyber Shield &bull; Automated Hacker Bully System &bull; 403 Forbidden
    </div>
</div>

<script>
function playMemeSound() {
    // Putar sound effect meme lucu (Wah / Sad Trombone / Emotional Damage)
    const audio = new Audio('https://www.myinstants.com/media/sounds/emotional-damage-meme.mp3');
    audio.play().catch(() => {});
    alert("AWOKAWOKAWOK... Jangan sedih ya deck! Besok coba lagi siapa tahu tetep gagal total! wkwkwkwk 🤣🤡");
}
</script>

</body>
</html>
