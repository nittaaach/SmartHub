<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleModels extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'role';
    // protected $primaryKey = 'id_users';
    public $incrementing = false;

    protected $fillable = [
        'id_users',
        'id_datadiri',
        'id_drole',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id');
    }
    public function datadiri()
    {
        return $this->belongsTo(DatadiriModels::class, 'id_datadiri', 'id');
    }
    public function drole()
    {
        return $this->belongsTo(DroleModels::class, 'id_drole', 'id');
    }
}
