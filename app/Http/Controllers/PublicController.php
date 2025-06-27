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
                      // === AWAL PERUBAHAN LOGIKA ===
                      ->where('status', 'published')
                      ->where(function ($query) {
                          $query->where('published_at', '<=', now())
                                ->orWhereNull('published_at');
                      })
                      // === AKHIR PERUBAHAN LOGIKA ===
                      ->latest('published_at') // Urutkan berdasarkan tanggal tayang
                      ->paginate(5);
        
        $nav_categories = Category::orderBy('name')->get();
                     
        return view('home', compact('posts', 'nav_categories'));
    }

    /**
     * Menampilkan halaman arsip semua berita.
     */
    public function archive()
    {
        $posts = Post::where('status', 'published')
                     // === AWAL PERUBAHAN LOGIKA ===
                     ->where(function ($query) {
                          $query->where('published_at', '<=', now())
                                ->orWhereNull('published_at');
                      })
                     // === AKHIR PERUBAHAN LOGIKA ===
                     ->latest('published_at')
                     ->paginate(15);

        $nav_categories = Category::orderBy('name')->get();

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

        return view('posts.show', compact('post'));
    }

    /**
     * Menampilkan postingan berdasarkan kategori yang dipilih.
     */
    public function showByCategory(Category $category)
    {
        $posts = $category->posts()
                          ->where('status', 'published')
                          // === AWAL PERUBAHAN LOGIKA ===
                          ->where(function ($query) {
                              $query->where('published_at', '<=', now())
                                    ->orWhereNull('published_at');
                          })
                          // === AKHIR PERUBAHAN LOGIKA ===
                          ->latest('published_at')
                          ->paginate(5);

        $nav_categories = Category::orderBy('name')->get();

        return view('categories.show', compact('posts', 'category', 'nav_categories'));
    }
}
