<?php

namespace App\Console\Commands;

use App\Services\IpBlockService;
use Illuminate\Console\Command;

class ListBlockedIps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:list-blocked-ips';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tampilkan seluruh daftar IP yang sedang diblokir oleh sistem';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $list = IpBlockService::all();

        if (empty($list)) {
            $this->info('Tidak ada IP yang sedang diblokir.');
            return 0;
        }

        $rows = [];
        foreach ($list as $item) {
            $rows[] = [
                $item['ip'],
                $item['reason'] ?? '-',
                $item['blocked_at'] ? date('d-m-Y H:i', strtotime($item['blocked_at'])) : '-',
                $item['expires_at'] ? date('d-m-Y H:i', strtotime($item['expires_at'])) : 'PERMANEN',
            ];
        }

        $this->table(['Alamat IP', 'Alasan', 'Diblokir Sejak', 'Kadaluarsa'], $rows);

        return 0;
    }
}
