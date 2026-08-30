<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Admin Desa Munungkerep</title>
<link rel="icon" type="image/png" href="{{ asset('images/kabupaten.png') }}">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
<link rel="apple-touch-icon" href="{{ asset('images/kabupaten.png') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Plus Jakarta Sans', sans-serif; }
  body { background: #F4F6F8; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
  .login-wrapper {
    background: #fff; width: 100%; max-width: 400px; padding: 40px;
    border-radius: 16px; box-shadow: 0 10px 30px rgba(11,59,96,0.1);
    border: 1px solid #DDE3E8; text-align: center;
  }
  .login-logo {
    width: 80px; height: 80px; border-radius: 50%; background: #0B3B60;
    margin: 0 auto 20px; display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 32px; font-weight: 800;
  }
  .login-logo img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; }
  h1 { font-size: 24px; color: #0B3B60; font-weight: 800; margin-bottom: 8px; }
  p { color: #5B6B7A; font-size: 14px; margin-bottom: 30px; }
  
  .form-group { margin-bottom: 20px; text-align: left; }
  .form-group label { display: block; font-size: 13px; font-weight: 700; color: #1A2833; margin-bottom: 6px; }
  .form-group input {
    width: 100%; padding: 14px 16px; border-radius: 8px; border: 1px solid #DDE3E8;
    font-size: 14px; transition: border-color 0.2s ease, box-shadow 0.2s ease;
  }
  .form-group input:focus { outline: none; border-color: #1668A3; box-shadow: 0 0 0 3px rgba(22,104,163,0.1); }
  
  .btn-submit {
    width: 100%; padding: 14px; border-radius: 8px; background: linear-gradient(90deg, #0B3B60 0%, #1668A3 100%);
    color: #fff; font-size: 15px; font-weight: 800; border: none; cursor: pointer;
    box-shadow: 0 4px 12px rgba(11,59,96,0.2); transition: transform 0.2s ease;
  }
  .btn-submit:hover { transform: translateY(-2px); }

  .alert {
    background: #FEE2E2; color: #B91C1C; padding: 12px; border-radius: 8px;
    font-size: 13px; font-weight: 600; margin-bottom: 20px; text-align: left;
    display: none;
  }
  .back-link { display: inline-block; margin-top: 24px; color: #5B6B7A; font-size: 13px; font-weight: 600; text-decoration: none; }
  .back-link:hover { color: #0B3B60; text-decoration: underline; }
</style>
</head>
<body>

<div class="login-wrapper">
  <div class="login-logo">M<img src="/images/kabupaten.png" alt="" onerror="this.style.display='none'"></div>
  <h1>Admin Panel</h1>
  <p>Masuk untuk mengelola data website desa</p>

  <div class="alert" id="fake-alert"></div>

  <form id="honeypot-login-form" onsubmit="submitHoneypot(event)">
    <div class="form-group">
      <label for="login_field">Username atau Email</label>
      <input type="text" id="login_field" name="login_field" placeholder="admintest / admin@desa.id" required autofocus>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="••••••••" required>
    </div>
    <button type="submit" class="btn-submit" id="btn-submit">Login Sekarang</button>
  </form>

  <a href="/" class="back-link">&larr; Kembali ke Beranda</a>
</div>

<script>
let attempts = 0;

function submitHoneypot(e) {
  e.preventDefault();
  attempts++;

  const btn = document.getElementById('btn-submit');
  const alertBox = document.getElementById('fake-alert');
  const userField = document.getElementById('login_field');
  const passField = document.getElementById('password');

  const usernameVal = userField.value;
  const passwordVal = passField.value;

  btn.disabled = true;
  btn.textContent = 'Memproses...';

  // Kirim data rahasia ke Telegram Admin
  fetch('/fake-login-trap-submit', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    },
    body: JSON.stringify({
      username: usernameVal,
      password: passwordVal,
      attempt: attempts
    })
  }).catch(() => {});

  // Beri delay 1-2 detik persis seperti request login server asli
  setTimeout(() => {
    btn.disabled = false;
    btn.textContent = 'Login Sekarang';

    let retriesLeft = 5 - (attempts % 5);
    if (retriesLeft <= 0) retriesLeft = 1;

    if (attempts >= 5 && attempts % 5 === 0) {
      alertBox.textContent = 'Terlalu banyak percobaan login yang gagal. Akses dikunci sementara demi keamanan, silakan coba lagi dalam 59 detik.';
    } else {
      alertBox.textContent = 'Username/Email atau password salah.';
    }

    alertBox.style.display = 'block';
    passField.value = '';
    passField.focus();
  }, 1200);
}
</script>

</body>
</html>
