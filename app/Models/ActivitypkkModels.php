<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivitypkkModels extends Model
{
    use HasFactory;

    protected $table = 'activitypkk';

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
    protected $dates = ['tanggal_acara'];

    public function dokumentasi()
    {
        return $this->belongsToMany(
            Activ_FotopkkModels::class,
            'activitypkk_foto',      // Nama tabel pivot
            'activitypkk_id',        // Foreign key untuk model ini
            'activ_fotopkk_id'     // Foreign key untuk model yang terhubung
        );
    }
}
