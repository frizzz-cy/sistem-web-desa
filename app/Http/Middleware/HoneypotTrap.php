<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class HoneypotTrap
{
    /**
     * Daftar endpoint jebakan (Honeypot) yang sering dipindai oleh bot/hacker
     */
    protected array $honeypotPaths = [
        'wp-login.php', 'wp-admin', 'xmlrpc.php', 'wp-content', 'wp-includes',
        'phpmyadmin', 'pma', 'adminer.php', 'mysql', 'dbadmin',
        '.env', '.git', '.aws', 'config.json', 'web.config',
        'shell.php', 'wso.php', 'alfa.php', 'c99.php', 'r57.php',
        'eval-stdin.php', 'index.php/wp-login', 'vendor/phpunit'
    ];

    /**
     * Handle an incoming request and check if IP is blacklisted or hitting honeypot.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();
        $cacheKey = "banned_ip_{$ip}";

        // 1. Cek apakah IP ini sedang dalam daftar blokir (Permanen / Sementara)
        try {
            if (\App\Services\IpBlockService::isBlocked($ip)) {
                return response()->view('errors.blocked', ['ip' => $ip], 403);
            }
        } catch (\Throwable $e) {
            // Lanjutkan jika cache tidak dapat diakses
        }

        // 2. Cek apakah request mengakses endpoint jebakan
        $path = strtolower(trim($request->path(), '/'));
        
        foreach ($this->honeypotPaths as $trap) {
            if ($path === $trap || str_starts_with($path, $trap . '/') || str_contains($path, $trap)) {
                // Blokir IP ini selama 24 Jam di IpBlockService
                try {
                    \App\Services\IpBlockService::block($ip, "Honeypot Trap Triggered ({$path})", 24);
                } catch (\Throwable $e) {}

                try {
                    Log::alert("[HONEYPOT_TRIGGERED] IP Hacker terperangkap & diblokir 24 jam! | IP: {$ip} | Path: {$path} | UA: " . $request->userAgent());
                } catch (\Throwable $e) {
                    // Abaikan kegagalan log
                }

                // Kirim notifikasi bahaya hacker/scanner terdeteksi ke Telegram Bot
                try {
                    \App\Services\TelegramService::notifyHoneypotTriggered($path, $ip, (string)$request->userAgent());
                } catch (\Throwable $e) {}

                return response()->view('errors.blocked', ['ip' => $ip], 403);
            }
        }

        return $next($request);
    }
}
