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

        // Kunci pembatasan percobaan login (berdasarkan username/email + IP Address)
        $throttleKey = Str::transliterate(Str::lower($loginValue).'|'.$ipAddress);

        // 1. Cek apakah pengguna terkena batasan coba login (Max: 5 kali gagal dalam 1 menit)
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            
            Log::warning("[LOGIN_BRUTEFORCE_BLOCKED] Percobaan login diblokir sementara | IP: {$ipAddress} | Akun: {$loginValue} | Tunggu: {$seconds} detik");

            // Kirim notifikasi Telegram alert brute force
            \App\Services\TelegramService::notifyBruteForceBlocked($loginValue, $ipAddress, (string)$request->userAgent(), $seconds);

            return back()->withErrors([
                'login_field' => "Terlalu banyak percobaan login yang gagal. Akses dikunci sementara demi keamanan, silakan coba lagi dalam {$seconds} detik.",
            ])->withInput($request->only('login_field'));
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
            RateLimiter::clear($throttleKey);

            $request->session()->regenerate();
            
            Log::info("[LOGIN_SUCCESS] User berhasil login | ID: " . Auth::id() . " | IP: {$ipAddress}");

            // Kirim Notifikasi Login Berhasil ke Telegram Bot
            \App\Services\TelegramService::notifyLoginSuccess(Auth::user(), $ipAddress, (string)$request->userAgent());

            // SETELAH LOGIN BERHASIL, ARAHKAN KE DASHBOARD ADMIN
            return redirect()->intended('/admin/dashboard'); 
        }

        // 2. Jika gagal login, tambah hitungan kegagalan (Lockout 60 detik setelah 5 kegagalan)
        RateLimiter::hit($throttleKey, 60);

        $attemptsLeft = RateLimiter::retriesLeft($throttleKey, 5);
        Log::warning("[LOGIN_FAILED] Gagal login | Akun: {$loginValue} | IP: {$ipAddress} | Sisa percobaan: {$attemptsLeft}");

        // Kirim Notifikasi Login Gagal ke Telegram Bot
        \App\Services\TelegramService::notifyLoginFailed($loginValue, $ipAddress, (string)$request->userAgent(), $attemptsLeft);

        // Jika salah password atau username/email
        return back()->withErrors([
            'login_field' => "Username/Email atau password salah. (Sisa percobaan: {$attemptsLeft})",
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