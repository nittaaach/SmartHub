<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NonktpModels extends Model
{
    use HasFactory;

    protected $table = 'nonktp_rw12';

    protected $fillable = ['rt', 'laki_laki', 'perempuan', 'jumlah_kk'];
}
