<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@lab.test'],
            [
                'name' => 'Admin Lab',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff@lab.test'],
            [
                'name' => 'Staff Lab',
                'password' => Hash::make('password123'),
                'role' => 'staff',
            ]
        );
    }
}