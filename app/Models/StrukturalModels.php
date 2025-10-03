<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StrukturalModels extends Model
{
    use HasFactory;

    protected $table = 'struktural';

    protected $fillable = [
        'id_datadiri',
        'jabatan',
        'tingkatan',
        'gambar',
    ];

    // Relasi ke tabel datadiri
    public function datadiri()
    {
        return $this->belongsTo(DataDiriModels::class, 'id_datadiri');
    }
}
