<?php

namespace App\Http\Controllers;

use App\Services\IpBlockService;
use App\Services\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TelegramWebhookController extends Controller
{
    /**
     * Handle incoming webhook updates from Telegram Bot
     */
    public function handle(Request $request)
    {
        $update = $request->all();

        // 1. Tangani Callback Query (Saat tombol inline ditekan)
        if (isset($update['callback_query'])) {
            $this->handleCallbackQuery($update['callback_query']);
            return response()->json(['status' => 'ok']);
        }

        // 2. Tangani Pesan Teks Masuk (Perintah /block, /unblock, /list, dll)
        if (isset($update['message']['text'])) {
            $this->handleTextMessage($update['message']);
            return response()->json(['status' => 'ok']);
        }

        return response()->json(['status' => 'ignored']);
    }

    /**
     * Memproses penekanan tombol interaktif (Inline Keyboard)
     */
    protected function handleCallbackQuery(array $callback)
    {
        $callbackId = $callback['id'];
        $fromId     = (string)($callback['from']['id'] ?? '');
        $data       = (string)($callback['data'] ?? '');
        $message    = $callback['message'] ?? [];
        $chatId     = (string)($message['chat']['id'] ?? '');
        $messageId  = $message['message_id'] ?? null;
        $adminChatId = (string)config('services.telegram.chat_id', env('TELEGRAM_CHAT_ID'));

        // Proteksi Otoritas: Hanya Admin yang terdaftar yang boleh mengeksekusi
        if ($fromId !== $adminChatId && $chatId !== $adminChatId) {
            TelegramService::answerCallbackQuery($callbackId, '⚠️ Akses ditolak! Anda bukan administrator berwenang.', true);
            return;
        }

        // 1. Aksi Blokir IP
        if (str_starts_with($data, 'block:')) {
            $ip = substr($data, 6);
            IpBlockService::block($ip, 'Diblokir oleh Admin via Tombol Telegram');

            TelegramService::answerCallbackQuery($callbackId, "✓ IP {$ip} Berhasil Diblokir Permanen!", false);

            if ($messageId && !empty($message['text'])) {
                $newText = $message['text'] . "\n\n🚫 <b>STATUS: IP [{$ip}] TELAH DIBLOKIR OLEH ADMIN.</b>";
                $newKeyboard = [
                    'inline_keyboard' => [
                        [
                            ['text' => "🔓 Buka Blokir IP {$ip}", 'callback_data' => "unblock:{$ip}"]
                        ]
                    ]
                ];
                TelegramService::editMessageText($chatId, $messageId, $newText, $newKeyboard);
            }
            return;
        }

        // 2. Aksi Buka Blokir IP
        if (str_starts_with($data, 'unblock:')) {
            $ip = substr($data, 8);
            IpBlockService::unblock($ip);

            TelegramService::answerCallbackQuery($callbackId, "✓ Blokir IP {$ip} Berhasil Dibuka!", false);

            if ($messageId && !empty($message['text'])) {
                $newText = $message['text'] . "\n\n🔓 <b>STATUS: BLOKIR IP [{$ip}] TELAH DIBUKA.</b>";
                $newKeyboard = [
                    'inline_keyboard' => [
                        [
                            ['text' => "🚫 Blokir Kembali IP {$ip}", 'callback_data' => "block:{$ip}"]
                        ]
                    ]
                ];
                TelegramService::editMessageText($chatId, $messageId, $newText, $newKeyboard);
            }
            return;
        }

        TelegramService::answerCallbackQuery($callbackId, 'Perintah diterima.', false);
    }

    /**
     * Memproses pesan teks perintah seperti /block, /unblock, /list, /help
     */
    protected function handleTextMessage(array $message)
    {
        $fromId     = (string)($message['from']['id'] ?? '');
        $chatId     = (string)($message['chat']['id'] ?? '');
        $text       = trim((string)($message['text'] ?? ''));
        $adminChatId = (string)config('services.telegram.chat_id', env('TELEGRAM_CHAT_ID'));

        // Proteksi Otoritas: Hanya admin pemilik Chat ID yang diizinkan
        if ($fromId !== $adminChatId && $chatId !== $adminChatId) {
            TelegramService::sendMessageToChat($chatId, "⛔ <b>AKSES DITOLAK</b>\nAnda tidak memiliki izin mengelola sistem keamanan desa.");
            return;
        }

        // Perintah /start atau /help atau /menu
        if ($text === '/start' || $text === '/help' || $text === '/menu') {
            $helpMsg = "🛡️ <b>PUSAT KONTROL KEAMANAN BOT TELEGRAM</b>\n"
                     . "Sistem Informasi Desa Munungkerep\n\n"
                     . "📋 <b>Daftar Perintah Keamanan:</b>\n\n"
                     . "🚫 <code>/block &lt;ip&gt;</code>\n"
                     . "👉 Blokir alamat IP secara permanen.\n"
                     . "Contoh: <code>/block 114.122.204.85</code>\n\n"
                     . "🔓 <code>/unblock &lt;ip&gt;</code>\n"
                     . "👉 Buka blokir alamat IP.\n"
                     . "Contoh: <code>/unblock 114.122.204.85</code>\n\n"
                     . "📑 <code>/list</code>\n"
                     . "👉 Lihat seluruh daftar IP yang sedang diblokir.\n\n"
                     . "💡 <i>Setiap notifikasi login atau serangan mencurigakan juga akan langsung disertai tombol <b>[ 🚫 Blokir IP ]</b> otomatis!</i>";

            TelegramService::sendMessageToChat($chatId, $helpMsg);
            return;
        }

        // Perintah /list
        if ($text === '/list' || $text === '/list_block' || $text === '/status') {
            $blockedList = IpBlockService::all();
            if (empty($blockedList)) {
                TelegramService::sendMessageToChat($chatId, "✅ <b>STATUS BERSIH</b>\nTidak ada alamat IP yang sedang diblokir saat ini.");
                return;
            }

            $listText = "🚫 <b>DAFTAR IP YANG SEDANG DIBLOKIR (" . count($blockedList) . "):</b>\n\n";
            $buttons = [];

            foreach ($blockedList as $ip => $item) {
                $alasan = $item['reason'] ?? 'Manual Block';
                $tgl    = !empty($item['blocked_at']) ? date('d/m/Y H:i', strtotime($item['blocked_at'])) : '-';
                $listText .= "• <code>{$ip}</code>\n  Alasan: {$alasan}\n  Waktu: {$tgl}\n\n";

                $buttons[] = [
                    ['text' => "🔓 Buka Blokir {$ip}", 'callback_data' => "unblock:{$ip}"]
                ];
            }

            $keyboard = ['inline_keyboard' => $buttons];
            TelegramService::sendMessageWithKeyboard($listText, $keyboard);
            return;
        }

        // Perintah /block <ip>
        if (str_starts_with($text, '/block ') || str_starts_with($text, '/blok ')) {
            $parts = preg_split('/\s+/', $text);
            $ip = $parts[1] ?? '';
            $ip = trim($ip);

            if (empty($ip) || !filter_var($ip, FILTER_VALIDATE_IP)) {
                TelegramService::sendMessageToChat($chatId, "⚠️ Format IP tidak valid!\nContoh penggunaan: <code>/block 182.253.140.22</code>");
                return;
            }

            IpBlockService::block($ip, 'Diblokir via Perintah Telegram');

            $keyboard = [
                'inline_keyboard' => [
                    [
                        ['text' => "🔓 Buka Blokir IP {$ip}", 'callback_data' => "unblock:{$ip}"]
                    ]
                ]
            ];

            $resp = "🚫 <b>IP BERHASIL DIBLOKIR!</b>\n\n"
                  . "🌐 <b>Alamat IP:</b> <code>{$ip}</code>\n"
                  . "🛡️ <b>Status:</b> Akses ke website ditolak secara permanen (403 Forbidden).";

            TelegramService::sendMessageWithKeyboard($resp, $keyboard);
            return;
        }

        // Perintah /unblock <ip>
        if (str_starts_with($text, '/unblock ') || str_starts_with($text, '/buka ')) {
            $parts = preg_split('/\s+/', $text);
            $ip = $parts[1] ?? '';
            $ip = trim($ip);

            if (empty($ip)) {
                TelegramService::sendMessageToChat($chatId, "⚠️ Masukkan IP yang ingin dibuka blokirnya!\nContoh: <code>/unblock 182.253.140.22</code>");
                return;
            }

            IpBlockService::unblock($ip);
            TelegramService::sendMessageToChat($chatId, "🔓 <b>BERHASIL DIBUKA!</b>\nAlamat IP <code>{$ip}</code> sekarang sudah dapat mengakses website kembali.");
            return;
        }

        // Default response jika teks tidak dikenali
        TelegramService::sendMessageToChat($chatId, "❓ Perintah tidak dikenali. Ketik <code>/help</code> untuk melihat panduan kontrol keamanan.");
    }
}
