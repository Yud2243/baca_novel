<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\ChapterController as AdminChapterController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BookReaderController;
use App\Http\Controllers\Penulis\BookController as PenulisBookController;
use App\Http\Controllers\Penulis\ChapterController as PenulisChapterController;
use App\Http\Controllers\Penulis\ApplyController;
use App\Http\Controllers\Admin\PenulisController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman depan
use App\Models\Book;

Route::get('/', function () {
    $books = Book::where('status', 'approved')
                 ->latest()
                 ->take(6)
                 ->get();

    return view('welcome', compact('books'));
});

Route::get('/about', function () {
    return view('about');
})->name('about');


// USER BIASA
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [BookReaderController::class, 'beranda'])->name('dashboard');
    
    // Rute Buku
    Route::get('/books', [BookReaderController::class, 'index'])->name('books.index');
    Route::get('/books/{book:slug}', [BookReaderController::class, 'show'])->name('books.show');
    Route::get('/books/{book:slug}/chapter/{chapter_number}', [BookReaderController::class, 'showChapter'])->name('books.chapter');

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pengajuan penulis
    Route::prefix('penulis/apply')
        ->name('penulis.apply.')
        ->group(function () {
            Route::get('/', [ApplyController::class, 'create'])->name('create');
            Route::post('/', [ApplyController::class, 'store'])->name('store');
        });
});

// PENULIS
Route::middleware(['auth', 'verified', 'role:penulis'])
    ->prefix('penulis')
    ->name('penulis.')
    ->group(function () {

        Route::get('/dashboard', fn () => view('penulis.dashboard'))
            ->name('dashboard');

        // Buku milik penulis
        Route::resource('books', PenulisBookController::class);

        // ===============================
        // CHAPTER (NESTED KE BOOK)
        // ===============================
        Route::get(
            'books/{book}/chapters/create',
            [PenulisChapterController::class, 'create']
        )->name('books.chapters.create');

        Route::post(
            'books/{book}/chapters',
            [PenulisChapterController::class, 'store']
        )->name('books.chapters.store');

        Route::get(
            'books/{book}/chapters/{chapter}/edit',
            [PenulisChapterController::class, 'edit']
        )->name('books.chapters.edit');

        Route::put(
            'books/{book}/chapters/{chapter}',
            [PenulisChapterController::class, 'update']
        )->name('books.chapters.update');

        Route::delete(
            'books/{book}/chapters/{chapter}',
            [PenulisChapterController::class, 'destroy']
        )->name('books.chapters.destroy');
    });



// ADMIN
Route::middleware(['auth', 'is_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');

        // Users
        Route::resource('users', UserController::class);
        Route::get('penulis/applicants', [UserController::class, 'penulisApplicants'])->name('penulis.applicants');
        Route::post('penulis/{user}/approve', [UserController::class, 'approvePenulis'])->name('penulis.approve');
        Route::post('penulis/{user}/reject', [UserController::class, 'rejectPenulis'])->name('penulis.reject');

        // Buku
        Route::get('/books', [AdminBookController::class, 'adminIndex'])->name('books.index');

        // Halaman daftar buku pending (GET)
        Route::get('/books/approve', [AdminBookController::class, 'approvePage'])->name('books.approve');

        // Aksi approve/reject buku
        Route::post('/books/{book}/approve', [AdminBookController::class, 'approve'])->name('books.approve.action');
        Route::post('/books/{book}/reject', [AdminBookController::class, 'reject'])->name('books.reject');

        // Chapters admin
        Route::resource('books.chapters', AdminChapterController::class);
    });

// Auth Breeze
require __DIR__.'/auth.php';
