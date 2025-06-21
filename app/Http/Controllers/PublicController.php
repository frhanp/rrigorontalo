<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

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
}
