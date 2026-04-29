<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@rekap.local',
            'password' => Hash::make('password123'),
        ]);

        $this->command->info('Akun admin berhasil dibuat!');
        $this->command->info('Email: admin@rekap.local');
        $this->command->info('Password: password123');
    }
}
