<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = ['nombre'];

    /**
     * Un rol puede pertenecer a varios usuarios
     */
    public function users ()
    {
        return $this->belongsToMany(User::class)->using(RolUser::class);
    }
}
