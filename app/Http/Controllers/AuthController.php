<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Menampilkan Halaman Form Login
    public function showLogin()
    {
        return view('login');
    }

    // Memproses Data Login dengan Proteksi Anti Brute-Force
    public function login(Request $request)
    {
        // Validasi input form
        $request->validate([
            'login_field' => 'required|string|max:100',
            'password'    => 'required|string|max:255'
        ]);

        $loginValue = trim((string)$request->input('login_field'));
        $ipAddress  = $request->ip();

        // Kunci pembatasan percobaan login (Global per IP Address untuk mencegah gonta-ganti username)
        $ipThrottleKey = 'login_ip|' . $ipAddress;

        // 1. Cek apakah IP ini sudah melebihi 5 kali percobaan gagal
        if (RateLimiter::tooManyAttempts($ipThrottleKey, 5)) {
            $seconds = RateLimiter::availableIn($ipThrottleKey);
            
            // HUKUMAN: Otomatis Blokir IP selama 24 Jam
            \App\Services\IpBlockService::block($ipAddress, 'Brute-force login attack (5x gagal berturut-turut)', 24);
            
            Log::alert("[LOGIN_PUNISHMENT_BANNED] IP {$ipAddress} otomatis diblokir 24 jam karena 5x gagal login!");

            // Kirim notifikasi Telegram alert brute force & auto ban
            \App\Services\TelegramService::notifyBruteForceBlocked($loginValue, $ipAddress, (string)$request->userAgent(), 86400);

            // Lempar langsung ke halaman hukuman (trolling page)
            return response()->view('errors.blocked', ['ip' => $ipAddress], 403);
        }

        // Cek apakah input mengandung '@' (berarti email), jika tidak berarti username
        $loginType = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Susun data kredensial
        $credentials = [
            $loginType => $loginValue,
            'password' => $request->input('password')
        ];

        // Proses pencocokan ke database
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Bersihkan riwayat kegagalan login jika berhasil
            RateLimiter::clear($ipThrottleKey);

            $request->session()->regenerate();
            
            Log::info("[LOGIN_SUCCESS] User berhasil login | ID: " . Auth::id() . " | IP: {$ipAddress}");

            // Kirim Notifikasi Login Berhasil ke Telegram Bot
            \App\Services\TelegramService::notifyLoginSuccess(Auth::user(), $ipAddress, (string)$request->userAgent());

            // SETELAH LOGIN BERHASIL, ARAHKAN KE DASHBOARD ADMIN
            return redirect()->intended('/admin/dashboard'); 
        }

        // 2. Tambah hitungan kegagalan untuk IP ini (Masa lockout 5 menit jika tembus limit)
        RateLimiter::hit($ipThrottleKey, 300);

        $attemptsLeft = RateLimiter::retriesLeft($ipThrottleKey, 5);
        Log::warning("[LOGIN_FAILED] Gagal login | Akun: {$loginValue} | IP: {$ipAddress} | Sisa percobaan: {$attemptsLeft}");

        // Jika sudah 0 sisa percobaan, langsung blokir dan lempar ke halaman punishment
        if ($attemptsLeft <= 0) {
            \App\Services\IpBlockService::block($ipAddress, 'Brute-force login attack (5x gagal berturut-turut)', 24);
            \App\Services\TelegramService::notifyBruteForceBlocked($loginValue, $ipAddress, (string)$request->userAgent(), 86400);
            return response()->view('errors.blocked', ['ip' => $ipAddress], 403);
        }

        // Kirim Notifikasi Login Gagal ke Telegram Bot
        \App\Services\TelegramService::notifyLoginFailed($loginValue, $ipAddress, (string)$request->userAgent(), $attemptsLeft);

        // Jika salah password atau username/email
        return back()->withErrors([
            'login_field' => "Username/Email atau password salah.",
        ])->withInput($request->only('login_field'));
    }

    // Memproses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}