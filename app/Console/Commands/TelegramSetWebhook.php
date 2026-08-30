<?php

namespace App\Console\Commands;

use App\Services\TelegramService;
use Illuminate\Console\Command;

class TelegramSetWebhook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:telegram-set-webhook {url? : Domain/URL publik website (contoh: https://munungkerep.com)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set URL Webhook Telegram Bot untuk mengaktifkan fitur tombol interaktif blokir/unblock IP';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $domain = $this->argument('url');

        if (empty($domain)) {
            $domain = env('APP_URL', 'https://munungkerep.com');
        }

        $domain = rtrim($domain, '/');
        $webhookUrl = "{$domain}/api/telegram-webhook";

        $this->info("Menghubungkan Webhook ke: {$webhookUrl}...");

        $res = TelegramService::setWebhook($webhookUrl);

        if (!empty($res['ok'])) {
            $this->info('✓ BERHASIL! Webhook Telegram Bot telah aktif.');
            $this->line('Deskripsi: ' . ($res['description'] ?? 'Webhook was set'));
            $this->line('Sekarang Anda bisa menggunakan perintah /block, /unblock, /list dan tombol interaktif langsung dari Telegram!');
            return 0;
        }

        $this->error('Gagal menghubungkan webhook ke Telegram:');
        $this->line($res['description'] ?? json_encode($res));
        return 1;
    }
}
