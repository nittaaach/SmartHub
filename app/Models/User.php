<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            $user->datadiri()->delete();
            $user->userRolePivot()->delete(); // pastikan relasi ini ada di model
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function datadiri()
    {
        return $this->hasOne(DataDiriModels::class, 'id_users', 'id');
    }

    public function userRolePivot()
    {
        return $this->hasOne(RoleModels::class, 'id_users', 'id');
    }

    public function getDisplayedRoleAttribute()
    {
        if ($this->userRolePivot && $this->userRolePivot->drole) {
            return $this->userRolePivot->drole->role;
        }

        return $this->attributes['role'] ?? 'Role Not Set';
    }
}
