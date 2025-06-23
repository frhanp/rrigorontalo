<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PublicController extends Controller
{
    /**
     * Menampilkan homepage dengan daftar berita yang sudah di-publish.
     */
    public function home()
    {
        $posts = Post::with(['user', 'category'])
                     ->where('status', 'published')
                     ->latest()
                     ->paginate(5);
                     
        return view('home', compact('posts'));
    }
    public function archive()
    {
        $posts = Post::where('status', 'published')
                     ->latest()
                     ->paginate(15); // Tampilkan 15 berita per halaman

        return view('archive', compact('posts'));
    }

    /**
     * Menampilkan satu berita secara detail beserta komentarnya.
     */
    public function showPost(Post $post)
    {
        // Pastikan hanya post yang statusnya 'published' yang bisa diakses publik
        if ($post->status !== 'published') {
            abort(404);
        }

        // Ambil data komentar beserta relasi ke user-nya
        $post->load('comments.user');

        return view('posts.show', compact('post'));
    }

    /**
     * Menampilkan postingan berdasarkan kategori yang dipilih.
     */
    public function showByCategory(Category $category)
    {
        // Ambil semua post yang statusnya 'published' DARI KATEGORI INI,
        // urutkan dari yang terbaru, dan paginasi.
        $posts = $category->posts()
                          ->where('status', 'published')
                          ->latest()
                          ->paginate(5); // Angka 5 bisa Anda sesuaikan

        // Kirim data posts dan data kategori itu sendiri ke sebuah view baru
        return view('categories.show', compact('posts', 'category'));
    }
}
