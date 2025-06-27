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
    /**
     * Menampilkan homepage dengan daftar berita yang sudah di-publish.
     */
    public function home()
    {
        $posts = Post::with(['user', 'category'])
                      ->where('status', 'published')
                      ->latest()
                      ->paginate(5);
                      
        // TAMBAHKAN INI: Ambil data kategori untuk sidebar
        $nav_categories = Category::orderBy('name')->get();

        // TAMBAHKAN 'nav_categories' ke compact()
        return view('home', compact('posts', 'nav_categories'));
    }

    /**
     * Menampilkan halaman arsip semua berita.
     */
    public function archive()
    {
        $posts = Post::where('status', 'published')
                      ->latest()
                      ->paginate(15);

        // TAMBAHKAN INI: Ambil data kategori untuk sidebar
        $nav_categories = Category::orderBy('name')->get();

        // TAMBAHKAN 'nav_categories' ke compact()
        return view('archive', compact('posts', 'nav_categories'));
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

        // Halaman ini tidak punya sidebar, jadi tidak perlu $nav_categories
        return view('posts.show', compact('post'));
    }

    /**
     * Menampilkan postingan berdasarkan kategori yang dipilih.
     */
    public function showByCategory(Category $category)
    {
        // Ambil semua post yang statusnya 'published' DARI KATEGORI INI
        $posts = $category->posts()
                          ->where('status', 'published')
                          ->latest()
                          ->paginate(5);

        // TAMBAHKAN INI: Ambil data kategori untuk sidebar
        $nav_categories = Category::orderBy('name')->get();

        // TAMBAHKAN 'nav_categories' ke compact()
        return view('categories.show', compact('posts', 'category', 'nav_categories'));
    }
}
