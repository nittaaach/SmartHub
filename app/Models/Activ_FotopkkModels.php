<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activ_FotopkkModels extends Model
{
    use HasFactory;

    protected $table = 'activity_fotopkk';

    protected $fillable = [
        'activitypkk_id', // foreign key ke tabel kegiatan
        'fotopkk',
        'caption',
    ];

    public $timestamps = true;

    public function activities()
    {
        return $this->belongsToMany(
            ActivitypkkModels::class,
            'activitypkk_foto',      // Nama tabel pivot
            'activ_fotopkk_id',    // Foreign key untuk model ini
            'activitypkk_id'       // Foreign key untuk model yang terhubung
        );
    }
}
