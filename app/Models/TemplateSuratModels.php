<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TemplateSuratModels extends Model
{
    use HasFactory;

    protected $table = 'template_surat';

    protected $fillable = [
        'id_syarat',
        'nama_template',
        'file',
        'keterangan',
    ];

    // Relasi balik ke layanan
    public function layanan()
    {
        return $this->hasMany(LayananModels::class, 'id_layanan');
    }

     public function syarat_layanan()
    {
        return $this->belongsTo(SyaratLayananModels::class, 'id_syarat');
    }
}
