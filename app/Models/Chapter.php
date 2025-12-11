<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'title',
        'chapter_number',
        'content',
    ];

    /**
     * Relasi: Chapter dimiliki oleh 1 Book
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }


    /**
     * Helper: chapter ini milik user tertentu?
     * (digunakan di controller)
     */
    public function ownedBy($user)
    {
        return $this->book->user_id === $user->id;
    }


    /**
     * Event: Auto numbering chapter
     */
    protected static function booted()
    {
        static::creating(function ($chapter) {

            // Jika chapter_number tidak diisi, buat otomatis (1, 2, 3…)
            if (empty($chapter->chapter_number)) {
                $latest = Chapter::where('book_id', $chapter->book_id)
                    ->max('chapter_number');

                $chapter->chapter_number = $latest ? $latest + 1 : 1;
            }
        });
    }
}
