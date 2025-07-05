<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PublicController extends Controller
{
     /**
     * Menampilkan halaman utama dengan layout sidebar dan area sambutan.
     */
    public function home()
    {
        // Method ini sekarang HANYA mengambil data kategori untuk sidebar.
        $nav_categories = Category::orderBy('name')->get();
                     
        return view('home', compact('nav_categories'));
    }

    /**
     * Menampilkan halaman arsip semua berita.
     */
    public function archive()
    {
        $posts = Post::where('status', 'published')
                     ->where(function ($query) {
                          $query->where('published_at', '<=', now())
                                ->orWhereNull('published_at');
                      })
                     ->latest('published_at')
                     ->paginate(15);

        // Halaman arsip juga butuh data kategori untuk sidebarnya.
        $nav_categories = Category::orderBy('name')->get();

        return view('archive', compact('posts', 'nav_categories'));
    }

    /**
     * Menampilkan satu berita secara detail.
     */
    public function showPost(Post $post)
    {
        if ($post->status !== 'published') {
            abort(404);
        }
        $post->load('comments.user');
        return view('posts.show', compact('post'));
    }

    /**
     * Menampilkan postingan berdasarkan kategori.
     */
    public function showByCategory(Category $category)
    {
        $posts = $category->posts()
                          ->where('status', 'published')
                          ->where(function ($query) {
                              $query->where('published_at', '<=', now())
                                    ->orWhereNull('published_at');
                          })
                          ->latest('published_at')
                          ->paginate(5);

        // Halaman kategori juga butuh data kategori lain untuk sidebarnya.
        $nav_categories = Category::orderBy('name')->get();

        return view('categories.show', compact('posts', 'category', 'nav_categories'));
    }
}
