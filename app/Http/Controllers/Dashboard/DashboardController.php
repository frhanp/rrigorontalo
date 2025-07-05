<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard dengan data statistik.
     */
    public function index()
    {
        // === AWAL PERUBAHAN & PENAMBAHAN LOGIKA ===
        // Statistik Harian
        $todayPostsCount = Post::whereDate('created_at', today())->count();
        $yesterdayPostsCount = Post::whereDate('created_at', today()->subDay())->count();
        $dailyChange = $todayPostsCount - $yesterdayPostsCount;

        // Statistik Umum
        $totalPosts = Post::count();
        $publishedPosts = Post::where('status', 'published')->count();
        $draftPosts = Post::where('status', 'draft')->count();
        $totalCategories = Category::count();
        $totalComments = Comment::count();
        $userPostCount = Post::where('user_id', Auth::id())->count();
        
        // Statistik Khusus Admin
        $totalUsers = null;
        if (Auth::user()->role === 'admin') {
            $totalUsers = User::count();
        }

        // Data Aktivitas Terbaru
        $latestPosts = Post::with('user')->latest()->take(5)->get();
        $latestComments = Comment::with(['user', 'post'])->latest()->take(5)->get();

        return view('dashboard', compact(
            'todayPostsCount',
            'dailyChange',
            'totalPosts',
            'publishedPosts',
            'draftPosts',
            'totalCategories',
            'totalComments',
            'userPostCount',
            'totalUsers',
            'latestPosts',
            'latestComments'
        ));
    }
}
