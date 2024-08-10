<?php

namespace Database\Seeders;

use App\Models\bookCategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        bookCategory::factory(5)->create();
        $this->call([
            AdminUserSeeder::class,
        ]);

       
    }
}
