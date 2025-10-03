<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KtpModels extends Model
{
    use HasFactory;

    protected $table = 'ktp_rw12';

    protected $fillable = ['rt', 'laki_laki', 'perempuan', 'jumlah_kk'];
}
