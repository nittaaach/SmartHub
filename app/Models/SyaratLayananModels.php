<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SyaratLayananModels extends Model
{
    use HasFactory;

    protected $table = 'syarat_layanan';

    protected $fillable = [
        'nama_dokumen',
        'lembaran',
        'jenis_berkas',
        'status',
    ];

    // Relasi balik ke layanan
    public function layanan()
    {
        return $this->belongsTo(LayananModels::class, 'id_layanan');
    }

    public function template_surat()
    {
        return $this->hasMany(TemplateSuratModels::class, 'id_syarat');
    }
}
