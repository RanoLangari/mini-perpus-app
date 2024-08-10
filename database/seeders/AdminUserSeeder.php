<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@mail.com',
            "password" => Hash::make('user'),
        ]);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@mail.com',
            "password" => Hash::make('admin'),
            'role' => 'admin',
        ]);
    }
}
