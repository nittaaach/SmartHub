<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class K_NewsModels extends Model
{
    use HasFactory;

    protected $table = 'k_news'; // Nama tabel kategori
    protected $fillable = [
        'kategori_news',
        'slug'
    ];

    public function news()
    {
        return $this->hasMany(NewsModels::class, 'id_knews');
    }
}
