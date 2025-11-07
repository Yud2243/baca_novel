<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;

    /**
     * Kolom yang bisa diisi secara massal (mass assignment)
     */
    protected $fillable = [
        'title',
        'author',
        'description',
        'cover_path',
        'slug',
    ];

    /**
     * Relasi: Satu Buku memiliki banyak Chapter
     */
    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class)->orderBy('chapter_number', 'asc');
    }

    /**
     * Gunakan 'slug' sebagai route model binding key,
     * agar URL seperti /books/judul-buku berfungsi otomatis.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Event booting untuk otomatis membuat slug dari title (opsional)
     */
    protected static function booted()
    {
        static::creating(function ($book) {
            if (empty($book->slug)) {
                $book->slug = Str::slug($book->title);
            }
        });
    }
}
