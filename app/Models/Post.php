<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id',
        'user_id', // <-- Ini yang menyebabkan error sebelumnya
        'status',
        'media',
        'media_type',
        'published_at',
    ];

    // Memberitahu Laravel untuk memperlakukan kolom ini sebagai objek Tanggal/Waktu (Carbon)
    protected $casts = [
        'published_at' => 'datetime', // <-- TAMBAHKAN INI
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
