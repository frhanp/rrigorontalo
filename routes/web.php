<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Dashboard\MediaController;
use App\Http\Controllers\Dashboard\PdfController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
});

Route::middleware(['auth', 'verified', 'role:admin,editor'])->prefix('dashboard')->name('dashboard.')->group(function () {
    // ... route lain
    Route::resource('posts', PostController::class);
    Route::get('/posts/{post}/export-pdf', [PostController::class, 'exportPdf'])->name('posts.exportPdf');
    // === TAMBAHKAN DUA ROUTE BARU DI BAWAH INI ===
    Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    // ==============================================

    Route::get('/media', [MediaController::class, 'index'])->name('media.index');
    Route::delete('/media', [MediaController::class, 'destroy'])->name('media.destroy');

    Route::get('/pdf-manager', [PdfController::class, 'index'])->name('pdf.index');
});


// Route Khusus Admin
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);

});





Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/posts/{post:slug}', [PublicController::class, 'showPost'])->name('posts.show');
// TAMBAHKAN ROUTE BARU DI BAWAH INI
Route::get('/kategori/{category:slug}', [PublicController::class, 'showByCategory'])->name('categories.show');

require __DIR__ . '/auth.php';
