<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\ChapterController as AdminChapterController;
use App\Http\Controllers\BookReaderController; // Pastikan ini ada

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute Halaman Depan
Route::get('/', function () {
    return view('welcome');
});

// === GRUP UNTUK USER YANG SUDAH LOGIN ===
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Rute Dashboard User Biasa (BERANDA)
    // Ini mengarah ke Controller untuk ambil data
    Route::get('/dashboard', [BookReaderController::class, 'beranda'])
         ->name('dashboard');

    // Rute User Profile (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- RUTE UNTUK PEMBACA ---
    
    // 1. Halaman Katalog (Daftar semua buku)
    Route::get('/books', [BookReaderController::class, 'index'])->name('books.index');

    // 2. Halaman Detail Buku (Info & Daftar Bab)
    Route::get('/books/{book:slug}', [BookReaderController::class, 'show'])->name('books.show');

    // 3. Halaman BACA (Konten Bab)
    Route::get('/books/{book:slug}/chapter/{chapter_number}', [BookReaderController::class, 'showChapter'])
         ->name('books.chapter.show');
});


// === GRUP RUTE ADMIN ===
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('books', AdminBookController::class);
    Route::resource('books.chapters', AdminChapterController::class);

});


// Rute Autentikasi (Bawaan Breeze)
require __DIR__.'/auth.php';