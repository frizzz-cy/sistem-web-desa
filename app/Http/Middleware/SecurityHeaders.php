<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request and add strict HTTP security headers.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Mencegah MIME Confusion Attack
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Mencegah Clickjacking Attack
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Mengaktifkan filter XSS bawaan browser modern
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Kebijakan Referrer yang aman
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Batasi izin hardware browser (Geolocation, Kamera, Mikrofon) jika tidak dibutuhkan
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');

        // Content Security Policy (CSP) untuk membatasi eksekusi resource pihak ketiga yang tidak diizinkan
        $response->headers->set('Content-Security-Policy', "default-src 'self' https: data: 'unsafe-inline' 'unsafe-eval'; img-src 'self' data: https: blob:; font-src 'self' https: data:; frame-ancestors 'self';");

        // HSTS (HTTP Strict Transport Security) jika koneksi HTTPS
        if ($request->isSecure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }

        // Hapus header identitas teknologi / PHP jika header belum dikirim
        if (!headers_sent() && function_exists('header_remove')) {
            @header_remove('X-Powered-By');
        }
        $response->headers->remove('X-Powered-By');

        return $response;
    }
}
