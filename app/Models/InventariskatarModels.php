<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventariskatarModels extends Model
{
    use HasFactory;

    protected $table = 'inventariskatar';

    protected $fillable = [
        'kategori',
        'kode_barang',
        'nama_barang',
        'deskripsi',
        'satuan',
        'lokasi_penyimpanan',
        'kondisi',
        'gambar',
        'tanggal_perolehan',
    ];

    public function riwayat(): HasMany
    {
        return $this->hasMany(RiwayatinventarisModels::class, 'inventaris_id');
    }

    public function riwayatTerakhir(): HasOne
    {
        return $this->hasOne(RiwayatinventarisModels::class, 'inventaris_id')
            ->latestOfMany('tanggal_transaksi'); // <-- Kunci ajaibnya
    }

    protected function stokAkhir(): Attribute
    {
        return Attribute::make(
            get: function () {
                $masuk = $this->riwayat()
                    ->where('tipe_transaksi', 'Masuk')
                    ->sum('jumlah');

                $keluar = $this->riwayat()
                    ->where('tipe_transaksi', 'Keluar')
                    ->sum('jumlah');

                return $masuk - $keluar;
            },
        );
    }
}
