<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LayananModels extends Model
{
    use HasFactory;

    protected $table = 'layanan';

    protected $fillable = [
        'id_syarat',
        'id_template',
        'nama_layanan',
        'deskripsi',
        'status_aktif',
    ];

    // Relasi: satu layanan memiliki banyak persyaratan
    public function syarat_layanan()
    {
        return $this->belongsTo(SyaratLayananModels::class, 'id_syarat');
    }

    // Relasi: satu layanan bisa punya banyak template surat
    public function template_surat()
    {
        return $this->belongsTo(TemplateSuratModels::class, 'id_template');
    }
}
