<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // app/Models/User.php (potongan atau ganti seluruh file jika perlu)
protected $fillable = [
    'name',
    'email',
    'password',
    'role',             // user | penulis | admin
    'penulis_status',   // none | pending | approved | rejected
    'penulis_note',     // note dari admin
    'penulis_bio',      // field tambahan
    'penulis_sample',   // link atau keterangan sample karya
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
        return $this->hasMany(\App\Models\Book::class);
    }
    // Cek apakah user role penulis
public function isPenulis(): bool
{
    return $this->role === 'penulis';
}

// Opsional, buat cek user biasa dan admin juga
public function isUser(): bool
{
    return $this->role === 'user';
}

public function isAdmin(): bool
{
    return $this->role === 'admin';
}

}
