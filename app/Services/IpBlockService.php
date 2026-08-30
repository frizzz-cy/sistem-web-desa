<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class IpBlockService
{
    protected static string $storagePath = 'app/security/blocked_ips.json';

    /**
     * Dapatkan path file penyimpanan daftar IP terblokir
     */
    protected static function getFilePath(): string
    {
        $dir = storage_path('app/security');
        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }
        return storage_path(self::$storagePath);
    }

    /**
     * Dapatkan seluruh data IP yang diblokir
     */
    public static function all(): array
    {
        $filePath = self::getFilePath();
        if (!File::exists($filePath)) {
            return [];
        }

        try {
            $data = json_decode(File::get($filePath), true);
            return is_array($data) ? $data : [];
        } catch (\Throwable $e) {
            return [];
        }
    }

    /**
     * Cek apakah sebuah IP sedang diblokir
     */
    public static function isBlocked(string $ip): bool
    {
        // 1. Cek Cache terlebih dahulu (sangat cepat)
        $cacheKey = "banned_ip_{$ip}";
        try {
            if (Cache::has($cacheKey)) {
                return true;
            }
        } catch (\Throwable $e) {}

        // 2. Cek file permanen jika cache tidak ada
        $blockedList = self::all();
        if (isset($blockedList[$ip])) {
            $record = $blockedList[$ip];
            // Jika ada waktu kadaluarsa, cek apakah sudah lewat
            if (!empty($record['expires_at']) && strtotime($record['expires_at']) < time()) {
                self::unblock($ip);
                return false;
            }

            // Simpan kembali ke cache agar request selanjutnya instan
            try {
                Cache::put($cacheKey, true, now()->addHours(24));
            } catch (\Throwable $e) {}

            return true;
        }

        return false;
    }

    /**
     * Blokir IP (Permanen atau dengan durasi jam)
     */
    public static function block(string $ip, string $reason = 'Manual Administrator Block', ?int $hours = null): void
    {
        $blockedList = self::all();

        $expiresAt = $hours ? now()->addHours($hours)->toIso8601String() : null;

        $blockedList[$ip] = [
            'ip'         => $ip,
            'reason'     => $reason,
            'blocked_at' => now()->toIso8601String(),
            'expires_at' => $expiresAt,
        ];

        // Tulis ke file permanen
        File::put(self::getFilePath(), json_encode($blockedList, JSON_PRETTY_PRINT));

        // Simpan ke Cache
        $cacheKey = "banned_ip_{$ip}";
        try {
            if ($hours) {
                Cache::put($cacheKey, true, now()->addHours($hours));
            } else {
                Cache::put($cacheKey, true, now()->addYears(10)); // Blokir permanen
            }
        } catch (\Throwable $e) {}
    }

    /**
     * Buka blokir sebuah IP
     */
    public static function unblock(string $ip): bool
    {
        $blockedList = self::all();

        if (isset($blockedList[$ip])) {
            unset($blockedList[$ip]);
            File::put(self::getFilePath(), json_encode($blockedList, JSON_PRETTY_PRINT));
        }

        $cacheKey = "banned_ip_{$ip}";
        try {
            Cache::forget($cacheKey);
        } catch (\Throwable $e) {}

        return true;
    }
}
