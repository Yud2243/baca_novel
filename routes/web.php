<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\ChapterController as AdminChapterController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BookReaderController;
use App\Http\Controllers\Penulis\BookController as PenulisBookController;
use App\Http\Controllers\Penulis\ChapterController as PenulisChapterController;
use App\Http\Controllers\Penulis\ApplyController; // Controller untuk Pengajuan Penulis
use App\Http\Controllers\PenulisController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman depan
use App\Models\Book;

Route::get('/', function () {
    $books = Book::latest()->take(6)->get();
    return view('welcome', compact('books'));
});



// USER BIASA (termasuk dashboard utama)
Route::middleware(['auth', 'verified'])->group(function () {
    // Rute utama (memanggil BookReaderController@beranda untuk mendapatkan data books)
    Route::get('/dashboard', [BookReaderController::class, 'beranda'])->name('dashboard');
    
    // Rute Buku
    Route::get('/books', [BookReaderController::class, 'index'])->name('books.index');
    Route::get('/books/{book:slug}', [BookReaderController::class, 'show'])->name('books.show');
    Route::get('/books/{book:slug}/chapter/{chapter_number}', [BookReaderController::class, 'showChapter'])->name('books.chapter');

    // Rute Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // PENGURUSAN PENGAJUAN PENULIS
    Route::prefix('penulis/apply')
        ->name('penulis.apply.')
        ->group(function () {
            // GET: /penulis/apply -> Tampilkan form (jika perlu)
            Route::get('/', [ApplyController::class, 'create'])->name('create');
            Route::post('/', [ApplyController::class, 'store'])->name('store');
        });
});


// PENULIS (Hanya yang memiliki role 'penulis')
Route::middleware(['auth', 'verified', 'role:penulis'])
    ->prefix('penulis')
    ->name('penulis.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('penulis.dashboard'))->name('dashboard');
        Route::resource('books', PenulisBookController::class);
        Route::resource('chapters', PenulisChapterController::class);
    });

// ADMIN
Route::middleware(['auth', 'is_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
        Route::resource('users', UserController::class);
        Route::resource('books', AdminBookController::class);
        Route::resource('books.chapters', AdminChapterController::class);
        Route::get('penulis/applicants', [UserController::class, 'penulisApplicants'])
            ->name('penulis.applicants');
        Route::post('penulis/{user}/approve', [UserController::class, 'approvePenulis'])
            ->name('penulis.approve');
        Route::post('penulis/{user}/reject', [UserController::class, 'rejectPenulis'])
            ->name('penulis.reject');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])
            ->name('admin.users.destroy');
        // Rute untuk Approve/Reject Penulis
        Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::post('/admin/users/{user}/approve', [UserController::class, 'approve'])->name('admin.users.approve');
        Route::post('/admin/users/{user}/reject', [UserController::class, 'reject'])->name('admin.users.reject');
        Route::get('/admin/books', [BookController::class, 'adminIndex'])->name('admin.books.index');

    Route::post('/admin/books/{book}/approve', [BookController::class, 'approve'])->name('admin.books.approve');

    Route::post('/admin/books/{book}/reject', [BookController::class, 'reject'])->name('admin.books.reject');

 });

// Auth Breeze
require __DIR__.'/auth.php';