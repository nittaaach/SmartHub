<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DroleModels extends Model
{
    use HasFactory;

    protected $table = 'drole';

    protected $fillable = ['role'];
}
