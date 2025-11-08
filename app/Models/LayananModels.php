<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LayananModels extends Model
{
    use HasFactory;

    protected $table = 'layanan';

    protected $fillable = [
        'nama_layanan',
        'deskripsi',
        'status_aktif',
    ];

    // Relasi: satu layanan memiliki banyak persyaratan
    public function syaratLayanans()
    {
        return $this->belongsToMany(
            SyaratLayananModels::class,
            'layanan_syarat',
            'layanan_id',
            'syarat_layanan_id'
        );
    }
}
