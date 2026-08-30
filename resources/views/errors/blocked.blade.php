<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        html, body {
            width: 100vw;
            height: 100vh;
            overflow: hidden;
            background: #000;
            margin: 0;
            padding: 0;
        }
        #meme-gif {
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            display: block;
        }
    </style>
</head>
<body>

    <img id="meme-gif" src="https://media.giphy.com/media/dC9DTdqPmRnlS/giphy.gif" alt="Meme">

    <script>
        // Koleksi GIF Meme Ketawa Kocak Full Layar
        const gifs = [
            'https://media.giphy.com/media/dC9DTdqPmRnlS/giphy.gif',      // Mutahar laughing
            'https://media.giphy.com/media/10JhviFuU2gWD6/giphy.gif',      // Tom Cruise laughing
            'https://media.giphy.com/media/unQ3IJU2RG7DO/giphy.gif',      // Leo DiCaprio laughing
            'https://media.giphy.com/media/Q7ozWVYCR0nyW2rvPW/giphy.gif', // Laughing meme
            'https://media.giphy.com/media/Z9OGuQyrfHAE8/giphy.gif',      // Kawhi laughing
            'https://media.giphy.com/media/3o7TKSjRrfIPjeiVyM/giphy.gif', // Cat laughing
            'https://media.giphy.com/media/YmZOBDYBcmWK4/giphy.gif'       // Spongebob laughing
        ];

        // Pilih GIF acak saat halaman pertama kali dibuka
        const randomGif = gifs[Math.floor(Math.random() * gifs.length)];
        document.getElementById('meme-gif').src = randomGif;

        // Ganti GIF acak setiap 4 detik agar si hacker disuguhkan berbagai macam tawa
        setInterval(() => {
            const nextGif = gifs[Math.floor(Math.random() * gifs.length)];
            document.getElementById('meme-gif').src = nextGif;
        }, 4000);
    </script>

</body>
</html>
