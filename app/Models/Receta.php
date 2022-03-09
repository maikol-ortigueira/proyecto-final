<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'raciones'];

    //protected $guards = [];

    /**
     * Relación con la tabla ingredientes
     *
     * @return void
     */
    public function ingredientes () 
    {
        return $this->belongsToMany(Ingrediente::class);
    }

    public function categoria ()
    {
        return $this->hasOne(Categoria::class)->where('type', '=', Receta::class);
    }
}
