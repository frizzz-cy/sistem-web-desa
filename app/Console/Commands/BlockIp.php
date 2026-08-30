<?php

namespace App\Console\Commands;

use App\Services\IpBlockService;
use Illuminate\Console\Command;

class BlockIp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:block-ip 
                            {ip : Alamat IP yang ingin diblokir} 
                            {--reason=Manual Administrator Block : Alasan pemblokiran} 
                            {--duration= : Durasi blokir dalam jam (kosongkan untuk blokir permanen)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Blokir alamat IP dari mengakses website / admin secara permanen atau sementara';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $ip = trim((string)$this->argument('ip'));
        $reason = (string)$this->option('reason');
        $duration = $this->option('duration') ? (int)$this->option('duration') : null;

        if (empty($ip)) {
            $this->error('Alamat IP tidak boleh kosong!');
            return 1;
        }

        IpBlockService::block($ip, $reason, $duration);

        $durasiTeks = $duration ? "selama {$duration} jam" : "secara PERMANEN";
        $this->info("✓ Berhasil memblokir IP: {$ip} {$durasiTeks}.");
        $this->line("Alasan: {$reason}");

        return 0;
    }
}
