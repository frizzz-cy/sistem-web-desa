<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    /**
     * Kirim pesan teks format HTML ke Telegram Bot (Chat default)
     */
    public static function sendMessage(string $message): bool
    {
        $chatId = config('services.telegram.chat_id') ?: env('TELEGRAM_CHAT_ID');
        return self::sendMessageToChat((string)$chatId, $message);
    }

    /**
     * Kirim pesan ke Chat ID tertentu
     */
    public static function sendMessageToChat(string $chatId, string $message): bool
    {
        $botToken = config('services.telegram.bot_token') ?: env('TELEGRAM_BOT_TOKEN');

        if (empty($botToken) || empty($chatId)) {
            return false;
        }

        try {
            $url = "https://api.telegram.org/bot{$botToken}/sendMessage";
            
            $response = Http::timeout(5)->post($url, [
                'chat_id'                  => $chatId,
                'text'                     => $message,
                'parse_mode'               => 'HTML',
                'disable_web_page_preview' => true,
            ]);

            return $response->successful();
        } catch (\Throwable $e) {
            Log::warning('[TELEGRAM_NOTIF_ERROR] Gagal mengirim pesan Telegram: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Kirim pesan dengan tombol interaktif (Inline Keyboard)
     */
    public static function sendMessageWithKeyboard(string $message, array $keyboard): bool
    {
        $botToken = config('services.telegram.bot_token') ?: env('TELEGRAM_BOT_TOKEN');
        $chatId   = config('services.telegram.chat_id') ?: env('TELEGRAM_CHAT_ID');

        if (empty($botToken) || empty($chatId)) {
            return false;
        }

        try {
            $url = "https://api.telegram.org/bot{$botToken}/sendMessage";
            
            $response = Http::timeout(5)->post($url, [
                'chat_id'                  => $chatId,
                'text'                     => $message,
                'parse_mode'               => 'HTML',
                'disable_web_page_preview' => true,
                'reply_markup'             => json_encode($keyboard),
            ]);

            return $response->successful();
        } catch (\Throwable $e) {
            Log::warning('[TELEGRAM_NOTIF_ERROR] Gagal mengirim pesan keyboard: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Jawab Callback Query dari tombol
     */
    public static function answerCallbackQuery(string $callbackId, string $text, bool $showAlert = false): bool
    {
        $botToken = config('services.telegram.bot_token') ?: env('TELEGRAM_BOT_TOKEN');
        if (empty($botToken)) return false;

        try {
            $url = "https://api.telegram.org/bot{$botToken}/answerCallbackQuery";
            $response = Http::timeout(5)->post($url, [
                'callback_query_id' => $callbackId,
                'text'              => $text,
                'show_alert'        => $showAlert,
            ]);
            return $response->successful();
        } catch (\Throwable $e) {
            return false;
        }
    }

    /**
     * Edit teks pesan Telegram yang sudah ada
     */
    public static function editMessageText(string $chatId, int $messageId, string $text, ?array $keyboard = null): bool
    {
        $botToken = config('services.telegram.bot_token') ?: env('TELEGRAM_BOT_TOKEN');
        if (empty($botToken) || empty($chatId)) return false;

        try {
            $url = "https://api.telegram.org/bot{$botToken}/editMessageText";
            $payload = [
                'chat_id'                  => $chatId,
                'message_id'               => $messageId,
                'text'                     => $text,
                'parse_mode'               => 'HTML',
                'disable_web_page_preview' => true,
            ];

            if ($keyboard) {
                $payload['reply_markup'] = json_encode($keyboard);
            }

            $response = Http::timeout(5)->post($url, $payload);
            return $response->successful();
        } catch (\Throwable $e) {
            return false;
        }
    }

    /**
     * Set Webhook URL ke Telegram API
     */
    public static function setWebhook(string $webhookUrl): array
    {
        $botToken = config('services.telegram.bot_token') ?: env('TELEGRAM_BOT_TOKEN');
        if (empty($botToken)) {
            return ['ok' => false, 'description' => 'TELEGRAM_BOT_TOKEN belum diset di .env'];
        }

        try {
            $url = "https://api.telegram.org/bot{$botToken}/setWebhook";
            $response = Http::timeout(10)->post($url, [
                'url' => $webhookUrl
            ]);
            return $response->json() ?: ['ok' => $response->successful()];
        } catch (\Throwable $e) {
            return ['ok' => false, 'description' => $e->getMessage()];
        }
    }

    /**
     * Kirim Notifikasi Login Berhasil (disertai tombol blokir IP jika mencurigakan)
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
             . "<i>Jika ini bukan Anda, klik tombol blokir di bawah!</i>";

        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => "🚫 Blokir IP Ini ({$ip})", 'callback_data' => "block:{$ip}"]
                ]
            ]
        ];

        self::sendMessageWithKeyboard($msg, $keyboard);
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
             . "<i>Ingin langsung menonaktifkan IP penyerang ini?</i>";

        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => "🚫 Blokir IP Ini ({$ip})", 'callback_data' => "block:{$ip}"]
                ]
            ]
        ];

        self::sendMessageWithKeyboard($msg, $keyboard);
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

        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => "🚫 Blokir Permanen IP ({$ip})", 'callback_data' => "block:{$ip}"]
                ]
            ]
        ];

        self::sendMessageWithKeyboard($msg, $keyboard);
    }

    /**
     * Kirim Notifikasi Honeypot / Scanner Bot Terdeteksi & Diblokir
     */
    public static function notifyHoneypotTriggered(string $path, string $ip, string $userAgent): void
    {
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
             . "⛔ <b>Tindakan Sistem:</b> <b>IP DIBLOKIR OTOMATIS!</b>\n"
             . "⏰ <b>Waktu:</b> {$waktu}";

        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => "🔓 Buka Blokir IP ({$ip})", 'callback_data' => "unblock:{$ip}"]
                ]
            ]
        ];

        self::sendMessageWithKeyboard($msg, $keyboard);
    }

    /**
     * Kirim Notifikasi Serangan WAF (SQL Injection / XSS / LFI) Terblokir
     */
    public static function notifyAttackBlocked(string $type, string $ip, string $userAgent, string $uri): void
    {
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

        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => "🚫 Blokir Permanen IP ({$ip})", 'callback_data' => "block:{$ip}"]
                ]
            ]
        ];

        self::sendMessageWithKeyboard($msg, $keyboard);
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
