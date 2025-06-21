<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua user dan kategori yang ada
        $users = User::all();
        $categories = Category::all();

        // Pastikan ada user dan kategori sebelum membuat post
        if ($users->isEmpty() || $categories->isEmpty()) {
            $this->command->info('Tidak dapat membuat post karena tidak ada user atau kategori.');
            return;
        }

        // Buat 15 postingan contoh
        for ($i = 0; $i < 15; $i++) {
            $title = fake()->sentence(6); // Membuat judul acak dengan 6 kata
            
            Post::create([
                'title'       => $title,
                'slug'        => Str::slug($title) . '-' . time(), // Slug unik
                'content'     => fake()->paragraphs(10, true), // Konten 10 paragraf
                'category_id' => $categories->random()->id, // Pilih kategori secara acak
                'user_id'     => $users->random()->id,     // Pilih user penulis secara acak
                'status'      => 'published', // Langsung di-publish agar muncul di web
                'media'       => null, // Anda bisa menambahkan path gambar default di sini jika mau
                'media_type'  => null,
            ]);
        }
    }
}
