<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaganModels extends Model
{
    use HasFactory;

    protected $table = 'baganstruktur';
    protected $fillable = [
        'fotobagan',
        'tingkatan',
        'deskripsi',
    ];
    public $timestamps = true;
    
}
