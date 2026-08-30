<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->validateCsrfTokens(except: [
            'api/*',
            'api/telegram-webhook',
            'fake-login-trap-submit',
        ]);
        $middleware->append(\App\Http\Middleware\HoneypotTrap::class);
        $middleware->append(\App\Http\Middleware\SecurityHeaders::class);
        $middleware->append(\App\Http\Middleware\SecurityFirewall::class);
        $middleware->append(\App\Http\Middleware\XssSanitizer::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );

        // Penanganan CSRF Token Expired (419) yang ramah & aman
        $exceptions->render(function (\Illuminate\Session\TokenMismatchException $e, Request $request) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Sesi keamanan formulir Anda telah kedaluwarsa demi keamanan. Silakan coba kirim kembali.');
        });
        
        $exceptions->render(function (\Illuminate\Http\Exceptions\PostTooLargeException $e, Request $request) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => 'Ukuran data/file yang diunggah melebihi kapasitas batas maksimum server.'
                ], 413);
            }
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ukuran file gambar terlalu besar untuk diunggah langsung. Gambar telah kami kompres otomatis, silakan coba unggah kembali.');
        });
    })->create();
