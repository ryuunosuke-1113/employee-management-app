<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 管理者
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // 一般ユーザー
        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'General User',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );
    }
}