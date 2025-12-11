<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',             // user | penulis | admin
        'penulis_status',   // none | pending | approved | rejected
        'penulis_note',     // note dari admin
        'penulis_bio',      // opsi tambahan
        'penulis_sample',   // sample karya
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relasi ke buku
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function isPenulis(): bool
    {
        return $this->role === 'penulis';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
