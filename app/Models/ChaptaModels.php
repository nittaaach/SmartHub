<?php

namespace App\Models;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Eloquent\Model;

class ChaptaModels extends Model
{
    protected $table = 'chapta';                 // TABEL = chapta
    protected $fillable = ['id_users', 'number'];

    public function user()
    {
        // foreign key = id_users
        return $this->belongsTo(AuthModel::class, 'id_users');
    }
}
