<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FasilitasModels extends Model
{
    use HasFactory;

    protected $table = 'facilities';

    protected $fillable = ['name', 'kategori', 'alamat', 'lokasi_rt', 'condition', 'gambar'];
}
