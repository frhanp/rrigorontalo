<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;
class PdfController extends Controller
{
    /**
     * Menampilkan halaman untuk mengelola (download) PDF dengan filter.
     */
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();
        
        $query = Post::with(['user', 'category']);
        
        $selectedMonth = $request->input('month');
        $selectedCategoryId = $request->input('category_id');

        // Terapkan filter HANYA JIKA nilainya ada dan bukan string kosong
        if ($selectedMonth) {
            $year = substr($selectedMonth, 0, 4);
            $month = substr($selectedMonth, 5, 2);
            $query->whereYear('created_at', $year)->whereMonth('created_at', $month);
        }

        if ($selectedCategoryId) {
            $query->where('category_id', $selectedCategoryId);
        }

        // Eksekusi query, paginasi, dan pastikan filter tetap ada di link halaman berikutnya
        $posts = $query->latest()->paginate(20)->withQueryString();

        return view('dashboard.pdf.index', compact('posts', 'categories', 'selectedMonth', 'selectedCategoryId'));
    }

    /**
     * Membuat rekapitulasi dari semua post yang terfilter menjadi satu PDF berisi konten penuh.
     */
    public function recap(Request $request)
    {
        $query = Post::with(['user', 'category']);
        
        $selectedMonth = $request->input('month');
        $selectedCategoryId = $request->input('category_id');
        
        $categoryName = 'Semua Kategori';
        $monthName = 'Semua Waktu';
        
        // Terapkan filter dan siapkan judul laporan
        if ($selectedMonth) {
            // === AWAL PERBAIKAN ===
            // Ubah string tahun dan bulan menjadi angka (integer)
            $year = (int) substr($selectedMonth, 0, 4);
            $month = (int) substr($selectedMonth, 5, 2);
            // === AKHIR PERBAIKAN ===

            $query->whereYear('created_at', $year)->whereMonth('created_at', $month);
            $monthName = now()->month($month)->year($year)->format('F Y');
        }

        if ($selectedCategoryId) {
            $query->where('category_id', $selectedCategoryId);
            $category = Category::find($selectedCategoryId);
            if ($category) {
                $categoryName = $category->name;
            }
        }
        
        $posts = $query->latest()->get();
        
        $filename = 'Rekap Berita - ' . str_replace(' ', '_', $categoryName) . ' - ' . str_replace(' ', '_', $monthName) . '.pdf';

        $pdf = PDF::loadView('dashboard.pdf.recap', compact('posts', 'categoryName', 'monthName'));
        
        return $pdf->setPaper('a4', 'portrait')->download($filename);
    }
}
