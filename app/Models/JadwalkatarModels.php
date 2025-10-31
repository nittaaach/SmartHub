<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalkatarModels extends Model
{
    use HasFactory;
    protected $table = 'jadwalpkk';

    protected $fillable = [
        'nama_kegiatan',
        'kategori',
        'target_peserta',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'lokasi',
        'penanggung_jawab',
        'status',
        'tanggal_tunda',
        'catatan',
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'tanggal_tunda' => 'datetime',
    ];
}
