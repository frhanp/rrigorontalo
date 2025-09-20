<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;


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

      $month = request('month');
$year = request('year');

// Siapkan parameter filter
$params = [];
$filter = "";

if ($month && $year) {
    $filter = " AND MONTH(published_at) = ? AND YEAR(published_at) = ?";
    $params[] = $month;
    $params[] = $year;
} elseif ($year) {
    $filter = " AND YEAR(published_at) = ?";
    $params[] = $year;
}

// Query WARTA PAGI
$queryPagi = "
    SELECT 
        SUM(CASE WHEN content REGEXP '001' THEN 1 ELSE 0 END) AS jumlah_diandra,
        SUM(CASE WHEN content REGEXP '006' THEN 1 ELSE 0 END) AS jumlah_budi_akantu,
        SUM(CASE WHEN content REGEXP '07' THEN 1 ELSE 0 END) AS jumlah_fery_apantu,
        SUM(CASE WHEN content REGEXP '08' THEN 1 ELSE 0 END) AS jumlah_hendra_rauf,
        SUM(CASE WHEN content REGEXP '09' THEN 1 ELSE 0 END) AS jumlah_andi_sanga,
        SUM(CASE WHEN content REGEXP '010' THEN 1 ELSE 0 END) AS jumlah_bobi_irawan,
        SUM(CASE WHEN content REGEXP '011' THEN 1 ELSE 0 END) AS jumlah_taufik_usman,
        SUM(CASE WHEN content REGEXP '012' THEN 1 ELSE 0 END) AS jumlah_rusdi_aneta,
        COUNT(*) AS total_berita
    FROM posts
    WHERE title LIKE '%WARTA PAGI%' $filter
";

$report_pagi = DB::select($queryPagi, $params);
$report_pagi = $report_pagi ? $report_pagi[0] : null;

// Query WARTA SIANG
$querySiang = "
    SELECT 
        SUM(CASE WHEN content REGEXP '001' THEN 1 ELSE 0 END) AS jumlah_diandra,
        SUM(CASE WHEN content REGEXP '006' THEN 1 ELSE 0 END) AS jumlah_budi_akantu,
        SUM(CASE WHEN content REGEXP '07' THEN 1 ELSE 0 END) AS jumlah_fery_apantu,
        SUM(CASE WHEN content REGEXP '08' THEN 1 ELSE 0 END) AS jumlah_hendra_rauf,
        SUM(CASE WHEN content REGEXP '09' THEN 1 ELSE 0 END) AS jumlah_andi_sanga,
        SUM(CASE WHEN content REGEXP '010' THEN 1 ELSE 0 END) AS jumlah_bobi_irawan,
        SUM(CASE WHEN content REGEXP '011' THEN 1 ELSE 0 END) AS jumlah_taufik_usman,
        SUM(CASE WHEN content REGEXP '012' THEN 1 ELSE 0 END) AS jumlah_rusdi_aneta,
        COUNT(*) AS total_berita
    FROM posts
    WHERE title LIKE '%WARTA SIANG%' $filter
";

$report_siang = DB::select($querySiang, $params);
$report_siang = $report_siang ? $report_siang[0] : null;



       return view('dashboard', [
    'todayPostsCount' => $todayPostsCount,
    'dailyChange'     => $dailyChange,
    'totalPosts'      => $totalPosts,
    'publishedPosts'  => $publishedPosts,
    'draftPosts'      => $draftPosts,
    'totalCategories' => $totalCategories,
    'totalComments'   => $totalComments,
    'userPostCount'   => $userPostCount,
    'totalUsers'      => $totalUsers,
    'latestPosts'     => $latestPosts,
    'latestComments'  => $latestComments,
    'report_pagi'          => $report_pagi,
    'report_siang'          => $report_siang,

]);

    }
}
