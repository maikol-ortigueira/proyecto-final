<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Un usuario puede tener varios roles
     */
    public function roles () 
    {
        return $this->belongsToMany(Rol::class);
    }

    /**
     * Un usuario tiene un perfil
     *
     * @return void
     */
    public function perfil ()
    {
        return $this->hasOne(Perfil::class);
    }

    /**
     * Un usuario puede tener varias recetas
     *
     * @return void
     */
    public function recetas ()
    {
        return $this->hasMany(Receta::class);
    }

    /**
     * Filtrar por los usuarios administradores
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeIsAdmin($query)
    {
        $query->where('admin', 1);
    }
}
