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
}
