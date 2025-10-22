<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KatalogModels extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan
    protected $table = 'katalog_pkk';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
        'kategori',
        'foto',
        'nama_penjual',
        'kontak_penjual',
        'alamat_penjual',
        'link_whatsapp',
        'link_facebook',
        'link_instagram',
        'link_tiktok',
        'link_tokopedia',
        'link_shopee',
        'status_stock',
        'status',
    ];

    public function getFotoProdukUrlAttribute()
    {
        if ($this->foto_produk) {
            return asset('storage/' . $this->foto_produk);
        }
        return asset('images/default-product.png'); // fallback jika tidak ada gambar
    }

    /**
     * Format harga agar tampil dalam format rupiah.
     */
    public function getHargaRupiahAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

}
