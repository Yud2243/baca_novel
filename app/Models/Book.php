<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'cover_path',
        'slug',
        'user_id',
        'status',            // <-- Tambah
        'rejected_reason',   // <-- Tambah
    ];

    /**
     * Relasi: Buku dimiliki oleh User (Penulis)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Buku punya banyak chapter
     */
    public function chapters()
    {
   return $this->hasMany(Chapter::class)->orderBy('chapter_number');
    }


    /**
     * Routing pakai slug
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Event untuk membuat slug unik & set default
     */
    protected static function booted()
    {
        // Saat membuat buku
        static::creating(function ($book) {

            // Auto-set author sesuai nama user (biar penulis tidak bisa memalsukan)
            if (empty($book->author)) {
                $book->author = $book->user->name ?? 'Unknown';
            }

            // Jika slug kosong → buat slug
            if (empty($book->slug)) {
                $baseSlug = Str::slug($book->title);

                $count = Book::where('slug', 'LIKE', "{$baseSlug}%")->count();
                $book->slug = $count ? "{$baseSlug}-{$count}" : $baseSlug;
            }

            // Default status pending jika penulis yang buat
            if (empty($book->status)) {
                $book->status = 'pending';
            }
        });
    }

    /**
     * Helper: apakah buku ini milik user tertentu?
     */
    public function ownedBy($user)
    {
        return $this->user_id === $user->id;
    }
}
