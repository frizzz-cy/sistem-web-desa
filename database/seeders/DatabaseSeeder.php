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
            ['username' => 'admin'],
            [
                'name' => 'Admin Munungkerep',
                'email' => 'admin@munungkerep.desa.id',
                'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
            ]
        );

        User::updateOrCreate(
            ['username' => 'operator'],
            [
                'name' => 'Operator Desa',
                'email' => 'operator@munungkerep.desa.id',
                'password' => \Illuminate\Support\Facades\Hash::make('operator123'),
            ]
        );
    }
}
