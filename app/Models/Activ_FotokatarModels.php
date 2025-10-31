<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activ_FotokatarModels extends Model
{
    use HasFactory;

    protected $table = 'activity_fotokatar';

    protected $fillable = [
        'activitykatar_id', // foreign key ke tabel kegiatan
        'fotokatar',
        'caption',
    ];

    public $timestamps = true;

    public function activities()
    {
        return $this->belongsToMany(
            ActivitykatarModels::class,
            'activitykatar_foto',      // Nama tabel pivot
            'activ_fotokatar_id',    // Foreign key untuk model ini
            'activitykatar_id'       // Foreign key untuk model yang terhubung
        );
    }
}
