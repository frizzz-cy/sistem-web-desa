<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan Halaman Form Login
    public function showLogin()
    {
        return view('login');
    }

    // Memproses Data Login
    public function login(Request $request)
    {
        // Validasi input form
        $request->validate([
            'login_field' => 'required',
            'password'    => 'required'
        ]);

        $loginValue = $request->input('login_field');

        // Deteksi otomatis: apakah yang diketik mengandung '@' (berarti email) atau teks biasa (username)
        $loginType = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Susun data kredensial untuk dicocokkan ke database
        $credentials = [
            $loginType => $loginValue,
            'password' => $request->input('password')
        ];

        // Proses pencocokan ke database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Jika berhasil, arahkan ke Dashboard Admin Produk
            return redirect()->intended('/admin/produk'); 
        }

        // Jika salah password atau username/email
        return back()->withErrors([
            'login_field' => 'Username/Email atau password yang Anda masukkan salah.',
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