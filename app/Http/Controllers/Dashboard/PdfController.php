<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PdfController extends Controller
{
    /**
     * Menampilkan halaman untuk mengelola (download) PDF.
     */
    public function index()
    {
        // Ambil semua post, tidak peduli statusnya (draft/published)
        $posts = Post::with(['user', 'category'])->latest()->paginate(20);

        return view('dashboard.pdf.index', compact('posts'));
    }
}
