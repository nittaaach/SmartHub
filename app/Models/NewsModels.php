<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsModels extends Model
{
    use HasFactory;

    protected $table = 'news'; // Nama tabel
    protected $fillable = [
        'id_users',
        'id_knews',
        'title',
        'slug',
        'content',
        'gambar',
        'status',
        'published_at'
    ];

    public function k_news()
    {
        return $this->belongsTo(K_NewsModels::class, 'id_knews');
    }
    public function datadiri()
    {
        return $this->belongsTo(DataDiriModels::class, 'id_users');
    }

    // Relasi ke user (jika ada tabel users)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function kategori()
    {
        return $this->belongsToMany(K_NewsModels::class, 'news_kategori', 'news_id', 'k_news_id');
    }
}
