<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataDiriModels extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'datadiri';

    protected $fillable = [
        'id_users',
        'name',
        'email',
        'notelp',
        'alamat',
    ];

    // Relasi ke tabel struktural
    public function struktural()
    {
        return $this->hasOne(StrukturalModels::class, 'id_datadiri');
    }
}
