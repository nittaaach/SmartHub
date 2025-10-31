<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivitykatarModels extends Model
{
    use HasFactory;

    protected $table = 'activitykatar';

    protected $fillable = [
        'judul',
        'kategori',
        'deskripsi',
        'penyelenggara',
        'lokasi',
        'tanggal_acara',
        'status',
    ];
    public $timestamps = true;
    protected $casts = [
        'tanggal_acara' => 'datetime',
    ];

    public function dokumentasi()
    {
        return $this->belongsToMany(
            Activ_FotokatarModels::class,
            'activitykatar_foto',
            'activitykatar_id',
            'activ_fotokatar_id'
        );
    }
}
