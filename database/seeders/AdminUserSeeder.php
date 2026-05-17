<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin.ben@mgw.local'],
            [
                'name' => 'Ben Admin',
                'password' => 'Ben@7842SecureLogin',
                'email_verified_at' => now(),
            ]
        );
    }
}
