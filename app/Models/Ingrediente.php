<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    use HasFactory;

    /**
     * Relación con la tabla recetas
     *
     * @return void
     */
    public function recetas ()
    {
        return $this->belongsToMany(Receta::class);
    }

    /**
     * Un ingrediente tiene 0 o varias etiquetas
     *
     * @return void
     */
    public function etiquetas ()
    {
        return $this->hasMany(Etiqueta::class);
    }

    /**
     * Un ingrediente tiene una unidad
     *
     * @return void
     */
    public function unidad ()
    {
        return $this->hasOne(Unidad::class);
    }
}
