<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 — AWOKAWOK KENA BAN 🤡</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Impact&family=Plus+Jakarta+Sans:wght@800;900&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        html, body {
            width: 100%;
            height: 100%;
            overflow: hidden;
            background: #000;
            font-family: 'Impact', 'Arial Black', sans-serif;
            user-select: none;
        }

        /* GIF Full 1 Layar Penuh */
        .bg-gif {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            z-index: 1;
            filter: brightness(0.9);
        }

        /* Dark overlay tipis agar teks sangat kontras */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.25);
            z-index: 2;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            padding: 4vh 20px;
            text-align: center;
            cursor: pointer;
        }

        .meme-text-top {
            font-size: clamp(26px, 5vw, 56px);
            color: #fef08a;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 4px 4px 0 #000, -3px -3px 0 #000, 3px -3px 0 #000, -3px 3px 0 #000, 0 6px 15px rgba(0,0,0,0.9);
            line-height: 1.15;
            max-width: 900px;
            animation: pulse 1.5s infinite alternate;
        }

        .meme-text-bottom {
            font-size: clamp(28px, 6vw, 64px);
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 4px 4px 0 #000, -3px -3px 0 #000, 3px -3px 0 #000, -3px 3px 0 #000, 0 6px 15px rgba(0,0,0,0.9);
            line-height: 1.15;
            max-width: 950px;
        }

        .ip-badge {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: rgba(239, 68, 68, 0.85);
            color: #fff;
            padding: 8px 18px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 900;
            margin-top: 10px;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(0,0,0,0.6);
            letter-spacing: 0.5px;
        }

        .sound-hint {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 12px;
            font-weight: 800;
            background: rgba(0, 0, 0, 0.7);
            color: #a1a1aa;
            padding: 6px 16px;
            border-radius: 20px;
            margin-top: 8px;
            border: 1px solid #3f3f46;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            100% { transform: scale(1.03); }
        }
    </style>
</head>
<body>

    <!-- Gambar GIF Ketawa Full 1 Layar Penuh -->
    <img class="bg-gif" src="https://media.giphy.com/media/dC9DTdqPmRnlS/giphy.gif" alt="Ketawa Full Screen" onerror="this.src='https://media.giphy.com/media/Q7ozWVYCR0nyW2rvPW/giphy.gif'">

    <!-- Teks Meme di Atas & Bawah Layar -->
    <div class="overlay" onclick="playKetawaSound()">
        <div>
            <div class="meme-text-top">
                POV: LU NYOBA HACK WEB DESA TAPI KENA AUTO-BAN 🤡
            </div>
            <div class="ip-badge">
                IP KORBAN: {{ $ip ?? request()->ip() }} &bull; STATUS: BANNED 🚫
            </div>
        </div>

        <div>
            <div class="meme-text-bottom">
                AWOKAWOKAWOK KENA BAN 24 JAM DECK! 😂🤣
            </div>
            <div class="sound-hint">
                🔊 Klik di mana saja di layar untuk bunyi ketawa!
            </div>
        </div>
    </div>

    <script>
        function playKetawaSound() {
            const audio = new Audio('https://www.myinstants.com/media/sounds/rick-roll.mp3');
            audio.play().catch(() => {});
            alert("AWOKAWOKAWOK KENA BAN KAN LU DECK! 🤣🤡");
        }

        // Coba putar otomatis saat pertama kali dibuka jika diizinkan browser
        window.addEventListener('load', () => {
            const laugh = new Audio('https://www.myinstants.com/media/sounds/sitcom-laughing.mp3');
            laugh.play().catch(() => {});
        });
    </script>

</body>
</html>
