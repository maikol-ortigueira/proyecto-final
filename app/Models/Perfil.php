<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    protected $table = 'perfiles';

    /**
     * Un perfil pertenece solamente a un usuario
     *
     * @return void
     */
    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function foto ()
    {
        return $this->hasOne(Foto::class);
    }
}
