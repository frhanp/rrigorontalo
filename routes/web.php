<?php

use Illuminate\Support\Facades\Route;

// Import semua controller di satu tempat agar rapi
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\MediaController;
use App\Http\Controllers\Dashboard\PdfController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Rute Publik (Bisa diakses semua pengunjung)
|--------------------------------------------------------------------------
*/

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/berita', [PublicController::class, 'beritaIndex'])->name('berita.index');
Route::get('/arsip', [PublicController::class, 'archive'])->name('posts.archive');
Route::get('/kategori/{category:slug}', [PublicController::class, 'showByCategory'])->name('categories.show');
Route::get('/posts/{post:slug}', [PublicController::class, 'showPost'])->name('posts.show');


/*
|--------------------------------------------------------------------------
| Rute Pengguna Terotentikasi (Harus Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Rute untuk profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute untuk mengirim komentar dari halaman publik
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
});




/*
|--------------------------------------------------------------------------
| Rute Panel Kontrol (Dashboard dan Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // --- Rute yang bisa diakses oleh KEPSTA, EDITOR, & ADMIN ---
    Route::middleware('role:admin,editor,kepsta')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Grup untuk Laporan PDF
        Route::prefix('dashboard')->name('dashboard.')->group(function () {
            Route::get('/pdf-manager', [PdfController::class, 'index'])->name('pdf.index');
            Route::get('/pdf-manager/recap', [PdfController::class, 'recap'])->name('pdf.recap');
        });
    });

    // --- Rute yang bisa diakses oleh EDITOR & ADMIN ---
    Route::middleware('role:admin,editor,kepsta')->prefix('dashboard')->name('dashboard.')->group(function () {
        Route::post('/upload-media', [PostController::class, 'upload'])->name('posts.upload');
        Route::get('/posts/{post}/export-pdf', [PostController::class, 'exportPdf'])->name('posts.exportPdf');
        Route::resource('posts', PostController::class);

        Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
        Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

        Route::get('/media', [MediaController::class, 'index'])->name('media.index');
        Route::delete('/media', [MediaController::class, 'destroy'])->name('media.destroy');
    });

    // --- Rute yang HANYA bisa diakses oleh ADMIN ---
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::post('/categories/update-order', [CategoryController::class, 'updateOrder'])->name('categories.updateOrder');
        Route::resource('categories', CategoryController::class);
        Route::resource('users', UserController::class);
    });
});

/*
|--------------------------------------------------------------------------
| Rute Autentikasi Bawaan
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
