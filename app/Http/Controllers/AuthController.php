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

        // Cek apakah input mengandung '@' (berarti email), jika tidak berarti username
        $loginType = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Susun data kredensial
        $credentials = [
            $loginType => $loginValue,
            'password' => $request->input('password')
        ];

        // Proses pencocokan ke database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // SETELAH LOGIN BERHASIL, ARAHKAN KE DASHBOARD ADMIN
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