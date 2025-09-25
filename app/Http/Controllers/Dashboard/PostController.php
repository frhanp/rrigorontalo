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
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil semua user untuk dropdown filter
        $authors = User::orderBy('name')->get();
        
        // Mulai query
        $query = Post::with('category', 'user');

        // === AWAL PERBAIKAN LOGIKA FILTER ===
        
        // Filter Penulis
        $selectedAuthor = $request->input('author');
        if ($selectedAuthor) {
            $query->where('user_id', $selectedAuthor);
        }

        // Filter Tanggal
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        if ($startDate && $endDate) {
            $query->whereDate('created_at', '>=', $startDate)
                  ->whereDate('created_at', '<=', $endDate);
        }

        // === AKHIR PERBAIKAN LOGIKA FILTER ===

        // Paginasi dan sertakan parameter filter di link halaman
        $posts = $query->latest()->paginate(10)->withQueryString();

        return view('dashboard.posts.index', compact('posts', 'authors', 'selectedAuthor', 'startDate', 'endDate'));
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
        // === PERUBAHAN DI SINI ===
        // if (Auth::user()->role === 'editor' && $post->status === 'published') {
        //     // Ganti abort(403) dengan redirect dan pesan error
        //     return back()->with('error', 'Anda tidak dapat mengedit postingan yang sudah terbit.');
        // }

        $categories = Category::orderBy('name')->get();
        $post->load('comments.user');

        return view('dashboard.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        // === PERUBAHAN DI SINI ===
        if (Auth::user()->role === 'editor' && $post->status === 'published') {
            return back()->with('error', 'Anda tidak dapat mengedit postingan yang sudah terbit.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'media' => 'nullable|file|mimes:jpg,png,jpeg,mp3,mp4,mov|max:20480',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        $mediaPath = $post->media;
        $mediaType = $post->media_type;

        if ($request->hasFile('media')) {
            if ($post->media) {
                Storage::disk('public')->delete($post->media);
            }
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
            'published_at' => ($request->status == 'published' && !$request->published_at) ? now() : $request->published_at,
        ]);

        return redirect()->route('dashboard.posts.index')->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // === PERUBAHAN DI SINI ===
        if (Auth::user()->role === 'editor' && $post->status === 'published') {
            return back()->with('error', 'Anda tidak dapat menghapus postingan yang sudah terbit.');
        }
        // Otorisasi
        if (!in_array(Auth::user()->role, ['admin', 'editor', 'kepsta'])) {
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
        // === PERUBAHAN LOGIKA HAK AKSES ===
        // Sekarang, semua user dengan role 'admin' ATAU 'editor' bisa mengekspor.
        if (!in_array(Auth::user()->role, ['admin', 'editor', 'kepsta'])) {
            abort(403, 'ANDA TIDAK MEMILIKI HAK AKSES UNTUK MELAKUKAN INI.');
        }

        $pdf = PDF::loadView('dashboard.posts.pdf', compact('post'));
        return $pdf->download($post->slug . '.pdf');
    }
}
