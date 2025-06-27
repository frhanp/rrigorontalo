<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PostController extends Controller
{/**
     * Display a listing of the resource.
     */
        public function index()
        {
            
            $query = Post::with('category', 'user');

            $posts = $query->latest()->paginate(10);
            return view('dashboard.posts.index', compact('posts'));
        }

        public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,gif,mp3,mp4|max:20480', // Maks 20MB
        ]);

        $file = $request->file('file');
        $path = $file->store('content_media', 'public'); // Simpan di folder storage/app/public/content_media

        // TinyMCE membutuhkan response JSON dengan format 'location'
        return response()->json(['location' => asset('storage/' . $path)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('dashboard.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'media' => 'nullable|file|mimes:jpg,png,jpeg,mp3,mp4,mov|max:20480', // max 20MB
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date', // <-- TAMBAHKAN INI
        ]);

        $mediaPath = null;
        $mediaType = null;
        if ($request->hasFile('media')) {
            $mediaPath = $request->file('media')->store('posts', 'public');
            $mime = $request->file('media')->getMimeType();
            if (strstr($mime, "video/")) {
                $mediaType = 'video';
            } elseif (strstr($mime, "image/")) {
                $mediaType = 'image';
            } elseif (strstr($mime, "audio/")) {
                $mediaType = 'audio';
            }
        }

        Post::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(), // Menambahkan waktu agar slug selalu unik
            'content' => $request->content,
            'media' => $mediaPath,
            'media_type' => $mediaType,
            'status' => $request->status,
            'published_at' => ($request->status == 'published' && !$request->published_at) ? now() : $request->published_at, // <-- TAMBAHKAN INI
        ]);
        
        // PENTING: Jalankan 'php artisan storage:link' di terminal Anda sekali saja
        return redirect()->route('dashboard.posts.index')->with('success', 'Berita berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Otorisasi: Hanya penulis asli atau admin yang boleh edit
        if (Auth::user()->role !== 'admin' && Auth::id() !== $post->user_id) {
            abort(403, 'ANDA TIDAK BERHAK MENGEDIT POSTINGAN INI.');
        }

        $categories = Category::orderBy('name')->get();

        // TAMBAHKAN BARIS INI untuk mengambil data komentar terkait
        $post->load('comments.user');

        return view('dashboard.posts.edit', compact('post', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Otorisasi
        if (Auth::user()->role !== 'admin' && Auth::id() !== $post->user_id) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'media' => 'nullable|file|mimes:jpg,png,jpeg,mp3,mp4,mov|max:20480',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date', // <-- TAMBAHKAN INI
        ]);

        $mediaPath = $post->media;
        $mediaType = $post->media_type;

        if ($request->hasFile('media')) {
            // Hapus media lama jika ada
            if ($post->media) {
                Storage::disk('public')->delete($post->media);
            }
            // Simpan media baru
            $mediaPath = $request->file('media')->store('posts', 'public');
            $mime = $request->file('media')->getMimeType();
            if (strstr($mime, "video/")) {
                $mediaType = 'video';
            } elseif (strstr($mime, "image/")) {
                $mediaType = 'image';
            } elseif (strstr($mime, "audio/")) {
                $mediaType = 'audio';
            }
        }

        $post->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'content' => $request->content,
            'media' => $mediaPath,
            'media_type' => $mediaType,
            'status' => $request->status,
            'published_at' => ($request->status == 'published' && !$request->published_at) ? now() : $request->published_at, // <-- TAMBAHKAN INI
        ]);

        return redirect()->route('dashboard.posts.index')->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Otorisasi
        if (Auth::user()->role !== 'admin' && Auth::id() !== $post->user_id) {
            abort(403);
        }

        // Hapus media dari storage
        if ($post->media) {
            Storage::disk('public')->delete($post->media);
        }

        $post->delete();

        return redirect()->route('dashboard.posts.index')->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * Export post to PDF.
     */
    public function exportPdf(Post $post)
    {
        if (Auth::user()->role !== 'admin' && Auth::id() !== $post->user_id) {
            abort(403);
        }

        $pdf = PDF::loadView('dashboard.posts.pdf', compact('post'));
        return $pdf->download($post->slug . '.pdf');
    }
}
