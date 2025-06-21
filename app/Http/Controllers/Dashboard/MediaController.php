<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Menampilkan galeri semua media yang sudah di-upload.
     */
    public function index()
    {
        // Ambil semua post yang MEMILIKI media, urutkan dari yang terbaru.
        $postsWithMedia = Post::whereNotNull('media')->latest()->paginate(12);

        return view('dashboard.media.index', compact('postsWithMedia'));
    }

    /**
     * Menghapus file media dan men-detach dari post-nya.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'media_path' => 'required|string',
        ]);

        $path = $request->media_path;

        // Cari post yang menggunakan media ini
        $post = Post::where('media', $path)->first();

        // 1. Jika post ditemukan, update kolom media menjadi null
        if ($post) {
            $post->media = null;
            $post->media_type = null;
            $post->save();
        }

        // 2. Hapus file dari storage
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        return back()->with('success', 'Media berhasil dihapus.');
    }
}
