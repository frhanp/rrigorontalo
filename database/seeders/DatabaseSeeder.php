<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Anda bisa membuat user admin/editor di sini jika mau
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
        ]);
        User::factory()->create([
            'name' => 'Editor User',
            'email' => 'editor@gmail.com',
            'role' => 'editor',
        ]);

        // Panggil Seeder yang sudah kita buat
        $this->call([
            CategorySeeder::class,
            PostSeeder::class,
        ]);
    }
}
