<?php

namespace App\Console\Commands;

use App\Services\IpBlockService;
use Illuminate\Console\Command;

class UnblockIp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:unblock-ip {ip : Alamat IP yang ingin dibuka blokirnya}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Buka blokir alamat IP yang sebelumnya dilarang';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $ip = trim((string)$this->argument('ip'));

        if (empty($ip)) {
            $this->error('Alamat IP tidak boleh kosong!');
            return 1;
        }

        IpBlockService::unblock($ip);
        $this->info("✓ Berhasil membuka blokir untuk IP: {$ip}.");

        return 0;
    }
}
