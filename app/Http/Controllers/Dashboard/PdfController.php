<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;

class PdfController extends Controller
{
    /**
     * Menampilkan halaman untuk mengelola (download) PDF dengan filter.
     */
    public function index(Request $request)
    {
        // Ambil data untuk semua dropdown filter
        $categories = Category::orderBy('name')->get();
        $authors = User::orderBy('name')->get();
        
        $query = Post::with(['user', 'category']);
        
        $selectedMonth = $request->input('month');
        $selectedCategoryId = $request->input('category_id');
        $selectedAuthorId = $request->input('author_id'); // <-- Ambil input penulis

        // Terapkan filter bulan
        if ($selectedMonth) {
            $year = substr($selectedMonth, 0, 4);
            $month = substr($selectedMonth, 5, 2);
            $query->whereYear('created_at', $year)->whereMonth('created_at', $month);
        }

        // Terapkan filter kategori
        if ($selectedCategoryId) {
            $query->where('category_id', $selectedCategoryId);
        }
        
        // === TERAPKAN FILTER PENULIS BARU ===
        if ($selectedAuthorId) {
            $query->where('user_id', $selectedAuthorId);
        }

        $posts = $query->latest()->paginate(20)->withQueryString();

        // Kirim semua variabel yang dibutuhkan ke view
        return view('dashboard.pdf.index', compact('posts', 'categories', 'authors', 'selectedMonth', 'selectedCategoryId', 'selectedAuthorId'));
    }

    /**
     * Membuat rekapitulasi dari semua post yang terfilter menjadi satu PDF.
     */
    public function recap(Request $request)
    {
        $query = Post::with(['user', 'category']);
        
        $selectedMonth = $request->input('month');
        $selectedCategoryId = $request->input('category_id');
        $selectedAuthorId = $request->input('author_id'); // <-- Ambil input penulis
        
        // Data untuk judul laporan
        $categoryName = 'Semua Kategori';
        $monthName = 'Semua Waktu';
        $authorName = 'Semua Penulis'; // <-- Default judul penulis
        
        // Terapkan filter dan siapkan judul laporan
        if ($selectedMonth) {
            $year = (int) substr($selectedMonth, 0, 4);
            $month = (int) substr($selectedMonth, 5, 2);
            $query->whereYear('created_at', $year)->whereMonth('created_at', $month);
            $monthName = now()->month($month)->year($year)->format('F Y');
        }

        if ($selectedCategoryId) {
            $query->where('category_id', $selectedCategoryId);
            $category = Category::find($selectedCategoryId);
            if ($category) $categoryName = $category->name;
        }

        // === TERAPKAN FILTER PENULIS BARU DI REKAP ===
        if ($selectedAuthorId) {
            $query->where('user_id', $selectedAuthorId);
            $author = User::find($selectedAuthorId);
            if ($author) $authorName = $author->name;
        }
        
        $posts = $query->latest()->get();
        
        $filename = 'Rekap Berita - ' . str_replace(' ', '_', $authorName) . ' - ' . str_replace(' ', '_', $categoryName) . '.pdf';

        $pdf = PDF::loadView('dashboard.pdf.recap', compact('posts', 'categoryName', 'monthName', 'authorName'));
        
        return $pdf->setPaper('a4', 'portrait')->download($filename);
    }
}
