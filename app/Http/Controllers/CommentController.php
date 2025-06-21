<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{/**
     * Menampilkan daftar semua komentar untuk dikelola.
     */
    public function index()
    {
        // Ambil semua komentar, sertakan data 'user' dan 'post' nya
        // untuk menghindari query berulang (N+1 Problem).
        // Urutkan dari yang terbaru dan paginasi.
        $comments = Comment::with(['user', 'post'])->latest()->paginate(15);

        return view('dashboard.comments.index', compact('comments'));
    }

    /**
     * Menyimpan komentar baru dari halaman publik.
     */
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string|min:5|max:1000',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $request->post_id,
            'content' => $request->content,
        ]);

        return back()->with('success', 'Komentar berhasil diposting!');
    }

    /**
     * Menghapus komentar dari database.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Komentar berhasil dihapus.');
    }
}
