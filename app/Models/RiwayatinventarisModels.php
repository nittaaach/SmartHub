<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatinventarisModels extends Model
{
    protected $table = 'riwayat_inventaris';

    protected $fillable = [
        'inventaris_id',
        'tipe_transaksi',
        'jumlah',
        'keterangan',
        'penanggung_jawab',
        'tanggal_transaksi',
    ];

    protected $casts = [
        'tanggal_transaksi' => 'datetime',
    ];

    public function inventaris(): BelongsTo
    {
        return $this->belongsTo(InventariskatarModels::class, 'inventaris_id');
    }
}
