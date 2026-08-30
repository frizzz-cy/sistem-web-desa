<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class EmergencyResetUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:emergency-reset {--username=admin} {--password=AdminMunung2026!@#} {--email=admin@munungkerep.desa.id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Darurat: Hapus semua user & sesi login terhack, lalu buat 1 akun admin baru yang bersih.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->warn('========================================================');
        $this->warn('🚨 MEMULAI PROSES PEMBERSIHAN DARURAT AKUN & SESI...');
        $this->warn('========================================================');

        // 1. Hapus semua data di tabel users
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            User::truncate();
            $this->info('✅ Seluruh akun user lama berhasil dihapus total (TRUNCATE).');
        } catch (\Throwable $e) {
            User::query()->delete();
            $this->info('✅ Seluruh akun user lama berhasil dihapus (DELETE).');
        }

        // 2. Hapus semua sesi login aktif (Tendang keluar semua hacker/sesi login)
        try {
            if (Schema::hasTable('sessions')) {
                DB::table('sessions')->truncate();
                $this->info('✅ Seluruh sesi login aktif berhasil dimusnahkan (Force Logout All).');
            }
        } catch (\Throwable $e) {
            // Abaikan jika tidak menggunakan database session driver
        }

        // 3. Buat 1 User Admin Baru yang Bersih
        $username = $this->option('username');
        $password = $this->option('password');
        $email    = $this->option('email');

        $admin = User::create([
            'name'     => 'Administrator Utama',
            'username' => $username,
            'email'    => $email,
            'password' => Hash::make($password),
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->newLine();
        $this->info('========================================================');
        $this->info('🎉 PEMBERSIHAN SELESAI! AKUN ADMIN BARU TELAH DIBUAT:');
        $this->info('========================================================');
        $this->line("👤 Username : <comment>{$username}</comment>");
        $this->line("📧 Email    : <comment>{$email}</comment>");
        $this->line("🔑 Password : <comment>{$password}</comment>");
        $this->info('========================================================');
        $this->warn('⚠️ Segera login di /login dan ganti password Anda jika diperlukan.');

        return Command::SUCCESS;
    }
}
