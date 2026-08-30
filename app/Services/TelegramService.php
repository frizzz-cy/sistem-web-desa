<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    /**
     * Kirim pesan format HTML ke Telegram Bot
     */
    public static function sendMessage(string $message): bool
    {
        $botToken = config('services.telegram.bot_token') ?: env('TELEGRAM_BOT_TOKEN');
        $chatId   = config('services.telegram.chat_id') ?: env('TELEGRAM_CHAT_ID');

        if (empty($botToken) || empty($chatId)) {
            return false;
        }

        try {
            $url = "https://api.telegram.org/bot{$botToken}/sendMessage";
            
            $response = Http::timeout(4)->post($url, [
                'chat_id'                  => $chatId,
                'text'                     => $message,
                'parse_mode'               => 'HTML',
                'disable_web_page_preview' => true,
            ]);

            return $response->successful();
        } catch (\Throwable $e) {
            Log::warning('[TELEGRAM_NOTIF_ERROR] Gagal mengirim notifikasi Telegram: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Kirim Notifikasi Login Berhasil
     */
    public static function notifyLoginSuccess($user, string $ip, string $userAgent): void
    {
        $waktu = now()->locale('id')->isoFormat('dddd, D MMMM Y - HH:mm:ss') . ' WIB';
        $device = self::parseUserAgent($userAgent);

        $msg = "🔔 <b>NOTIFIKASI KEAMANAN: LOGIN ADMIN BERHASIL</b>\n\n"
             . "👤 <b>Nama Pengguna:</b> {$user->name}\n"
             . "🏷️ <b>Username:</b> <code>{$user->username}</code>\n"
             . "📧 <b>Email:</b> {$user->email}\n"
             . "🌐 <b>Alamat IP:</b> <code>{$ip}</code>\n"
             . "💻 <b>Perangkat & Browser:</b> {$device}\n"
             . "⏰ <b>Waktu:</b> {$waktu}\n"
             . "📍 <b>Sistem:</b> Website Desa Munungkerep\n\n"
             . "<i>Jika ini bukan Anda, segera login dan amankan akun Anda!</i>";

        self::sendMessage($msg);
    }

    /**
     * Kirim Notifikasi Percobaan Login Gagal (Peringatan Serangan)
     */
    public static function notifyLoginFailed(string $loginValue, string $ip, string $userAgent, int $attemptsLeft): void
    {
        $waktu = now()->locale('id')->isoFormat('dddd, D MMMM Y - HH:mm:ss') . ' WIB';
        $device = self::parseUserAgent($userAgent);

        $msg = "⚠️ <b>PERINGATAN: PERCOBAAN LOGIN GAGAL!</b>\n\n"
             . "🎯 <b>Target Akun:</b> <code>{$loginValue}</code>\n"
             . "🌐 <b>Alamat IP:</b> <code>{$ip}</code>\n"
             . "💻 <b>Perangkat & Browser:</b> {$device}\n"
             . "⏳ <b>Sisa Percobaan:</b> {$attemptsLeft}x lagi sebelum diblokir\n"
             . "⏰ <b>Waktu:</b> {$waktu}\n\n"
             . "<i>Sistem sedang memantau aktivitas mencurigakan ini.</i>";

        self::sendMessage($msg);
    }

    /**
     * Kirim Notifikasi Brute Force Terblokir
     */
    public static function notifyBruteForceBlocked(string $loginValue, string $ip, string $userAgent, int $seconds): void
    {
        $waktu = now()->locale('id')->isoFormat('dddd, D MMMM Y - HH:mm:ss') . ' WIB';
        $device = self::parseUserAgent($userAgent);

        $msg = "🚨 <b>ALERTA KEAMANAN: BRUTE-FORCE DIBLOKIR!</b>\n\n"
             . "🎯 <b>Akun yang Diserang:</b> <code>{$loginValue}</code>\n"
             . "🌐 <b>IP Penyerang:</b> <code>{$ip}</code>\n"
             . "💻 <b>User-Agent:</b> {$device}\n"
             . "🛑 <b>Status:</b> Akses IP Dikunci Sementara ({$seconds} detik)\n"
             . "⏰ <b>Waktu:</b> {$waktu}";

        self::sendMessage($msg);
    }

    /**
     * Kirim Notifikasi Honeypot / Scanner Bot Terdeteksi & Diblokir
     */
    public static function notifyHoneypotTriggered(string $path, string $ip, string $userAgent): void
    {
        // Rate-limit notifikasi agar tidak spamming jika bot memindai 100 URL sekaligus
        $cacheKey = "tele_notif_honeypot_{$ip}";
        try {
            if (\Illuminate\Support\Facades\Cache::has($cacheKey)) {
                return;
            }
            \Illuminate\Support\Facades\Cache::put($cacheKey, true, now()->addMinutes(5));
        } catch (\Throwable $e) {}

        $waktu = now()->locale('id')->isoFormat('dddd, D MMMM Y - HH:mm:ss') . ' WIB';
        $device = self::parseUserAgent($userAgent);

        $msg = "🪤 <b>PERINGATAN: SCANNER BOT / HACKER TERPERANGKAP!</b>\n\n"
             . "🎯 <b>Target Path:</b> <code>/{$path}</code>\n"
             . "🌐 <b>Alamat IP:</b> <code>{$ip}</code>\n"
             . "💻 <b>Scanner / Tool:</b> {$device}\n"
             . "⛔ <b>Tindakan Sistem:</b> <b>IP DIBLOKIR OTOMATIS 24 JAM!</b>\n"
             . "⏰ <b>Waktu:</b> {$waktu}\n\n"
             . "<i>Sistem Honeypot berhasil menetralkan pemindaian otomatis ini.</i>";

        self::sendMessage($msg);
    }

    /**
     * Kirim Notifikasi Serangan WAF (SQL Injection / XSS / LFI) Terblokir
     */
    public static function notifyAttackBlocked(string $type, string $ip, string $userAgent, string $uri): void
    {
        // Rate-limit notifikasi agar tidak spamming
        $cacheKey = "tele_notif_waf_{$ip}_{$type}";
        try {
            if (\Illuminate\Support\Facades\Cache::has($cacheKey)) {
                return;
            }
            \Illuminate\Support\Facades\Cache::put($cacheKey, true, now()->addMinutes(5));
        } catch (\Throwable $e) {}

        $waktu = now()->locale('id')->isoFormat('dddd, D MMMM Y - HH:mm:ss') . ' WIB';
        $device = self::parseUserAgent($userAgent);

        $typeLabel = match($type) {
            'BAD_BOT_SCANNER' => 'Vulnerability Scanner / Bad Bot',
            'MALICIOUS_URI_ATTACK' => 'Eksploitasi SQLi / XSS / LFI Attack',
            'SENSITIVE_FILE_ACCESS' => 'Percobaan Akses File Sensitif (.env / .git)',
            default => $type
        };

        $msg = "🛑 <b>FIREWALL WAF: SERANGAN TERBLOKIR!</b>\n\n"
             . "⚠️ <b>Jenis Serangan:</b> {$typeLabel}\n"
             . "🎯 <b>Target URL/Payload:</b> <code>{$uri}</code>\n"
             . "🌐 <b>IP Penyerang:</b> <code>{$ip}</code>\n"
             . "💻 <b>User-Agent:</b> {$device}\n"
             . "🛡️ <b>Status:</b> Akses Ditolak (HTTP 403 Forbidden)\n"
             . "⏰ <b>Waktu:</b> {$waktu}";

        self::sendMessage($msg);
    }

    /**
     * Helper sederhana parse User-Agent
     */
    public static function parseUserAgent(string $ua): string
    {
        if (empty($ua)) return 'Tidak Diketahui';

        $os = 'Unknown OS';
        if (stripos($ua, 'windows nt 10') !== false) $os = 'Windows 10/11';
        elseif (stripos($ua, 'windows') !== false) $os = 'Windows';
        elseif (stripos($ua, 'android') !== false) $os = 'Android';
        elseif (stripos($ua, 'iphone') !== false) $os = 'iPhone (iOS)';
        elseif (stripos($ua, 'ipad') !== false) $os = 'iPad (iPadOS)';
        elseif (stripos($ua, 'macintosh') !== false || stripos($ua, 'mac os x') !== false) $os = 'macOS';
        elseif (stripos($ua, 'linux') !== false) $os = 'Linux';

        $browser = 'Browser';
        if (stripos($ua, 'edg') !== false) $browser = 'Microsoft Edge';
        elseif (stripos($ua, 'chrome') !== false) $browser = 'Google Chrome';
        elseif (stripos($ua, 'safari') !== false) $browser = 'Safari';
        elseif (stripos($ua, 'firefox') !== false) $browser = 'Mozilla Firefox';
        elseif (stripos($ua, 'opera') !== false || stripos($ua, 'opr') !== false) $browser = 'Opera';

        return "{$browser} on {$os}";
    }
}
