<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar kategori yang Anda berikan
        $categories = [
            'WARTA PAGI',
            'WARTA SIANG',
            'MAGOTA',
            'PUASA ORANG SUSAH',
            'PAS JAM',
            'CEK FAKTA',
            'ARUS MUDIK / BALIK'
        ];

        // Looping untuk setiap kategori dan menyimpannya ke database
        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName) // Membuat versi URL-friendly, contoh: 'warta-pagi'
            ]);
        }
    }
}
