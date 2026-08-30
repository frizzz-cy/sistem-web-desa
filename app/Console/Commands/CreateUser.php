<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user {--name=} {--username=} {--email=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membuat akun pengguna (admin/operator) baru ke dalam database.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $name     = $this->option('name') ?: $this->ask('Masukkan Nama Lengkap', 'Administrator Desa');
        $username = $this->option('username') ?: $this->ask('Masukkan Username', 'admin');
        $email    = $this->option('email') ?: $this->ask('Masukkan Alamat Email', "{$username}@munungkerep.desa.id");
        $password = $this->option('password') ?: $this->secret('Masukkan Password Baru');

        if (empty($password)) {
            $this->error('❌ Password tidak boleh kosong!');
            return Command::FAILURE;
        }

        // Simpan atau Perbarui User
        $user = User::updateOrCreate(
            ['username' => $username],
            [
                'name'     => $name,
                'email'    => $email,
                'password' => Hash::make($password),
            ]
        );

        $this->newLine();
        $this->info('========================================================');
        $this->info('🎉 AKUN PENGGUNA BERHASIL DIBUAT / DIPERBARUI!');
        $this->info('========================================================');
        $this->line("👤 Nama     : <comment>{$user->name}</comment>");
        $this->line("🏷️ Username : <comment>{$user->username}</comment>");
        $this->line("📧 Email    : <comment>{$user->email}</comment>");
        $this->info('========================================================');
        $this->info('Silakan login di: /login');

        return Command::SUCCESS;
    }
}
