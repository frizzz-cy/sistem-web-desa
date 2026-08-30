<?php

namespace App\Http\Controllers;

use App\Services\TelegramService;
use Illuminate\Http\Request;

class FakeHoneypotController extends Controller
{
    /**
     * Tampilkan halaman login jebakan
     */
    public function show()
    {
        return view('errors.fake_login_trap');
    }

    /**
     * Tangkap input jebakan hacker dan laporkan ke Telegram Admin
     */
    public function submit(Request $request)
    {
        $user = (string)$request->input('username', '-');
        $pass = (string)$request->input('password', '-');
        $pin  = (string)$request->input('pin', '-');
        $attempt = (int)$request->input('attempt', 1);
        $ip   = $request->ip();
        $ua   = (string)$request->userAgent();

        $waktu = now()->locale('id')->isoFormat('dddd, D MMMM Y - HH:mm:ss') . ' WIB';
        $device = TelegramService::parseUserAgent($ua);

        $msg = "🪤 <b>HACKER TERJEBAK DI LOGIN PALSU! 🤡</b>\n\n"
             . "👤 <b>Username Dicoba:</b> <code>{$user}</code>\n"
             . "🔑 <b>Password Dicoba:</b> <code>{$pass}</code>\n"
             . "🔢 <b>PIN 2FA Dicoba:</b> <code>{$pin}</code>\n"
             . "⏳ <b>Percobaan Ke:</b> {$attempt}x\n"
             . "🌐 <b>IP Penyerang:</b> <code>{$ip}</code>\n"
             . "💻 <b>Perangkat:</b> {$device}\n"
             . "⏰ <b>Waktu:</b> {$waktu}\n\n"
             . "<i>Hacker ini sedang sibuk membuang-buang waktunya di halaman jebakan! 😂</i>";

        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => "🚫 Blokir Permanen IP ({$ip})", 'callback_data' => "block:{$ip}"]
                ]
            ]
        ];

        TelegramService::sendMessageWithKeyboard($msg, $keyboard);

        return response()->json(['status' => 'processed']);
    }
}
