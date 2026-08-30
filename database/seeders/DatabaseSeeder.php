<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
            ['username' => 'adm_mnk_9472_x9'],
            [
                'name' => 'Super Administrator Desa',
                'email' => 'sec.admin@munungkerep.desa.id',
                'password' => \Illuminate\Support\Facades\Hash::make('MngKr3p!#9842*SecGuardX'),
            ]
        );

        User::updateOrCreate(
            ['username' => 'it_dev_mnk_8310'],
            [
                'name' => 'Pengelola IT Desa',
                'email' => 'it.desa@munungkerep.desa.id',
                'password' => \Illuminate\Support\Facades\Hash::make('ItD3sa!#2026*Mng912'),
            ]
        );

        $this->call([
            SettingSeeder::class,
            BeritaSeeder::class,
        ]);
    }
}
