<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuthModel extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password', // e.g., admin, user
    ];

    protected $hidden = [
        'password', // Hide password from array and JSON representations
    ];

     public function chaptas()
    {
        // relasi ke tabel chapta
        return $this->hasMany(ChaptaModels::class, 'id_users');
    }
}
