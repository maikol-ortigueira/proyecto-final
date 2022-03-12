<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    use HasFactory;

    /**
     * Método para asignar etiquetas a las recetas
     *
     * @return void
     */
    public function recetas ()
    {
        $this->morphedByMany(Receta::class, 'modelo', 'etiquetables', 'etiqueta_id');
    }

    /**
     * Método para asignar etiquetas a los ingredientes
     *
     * @return void
     */
    public function ingredientes ()
    {
        $this->morphedByMany(Ingrediente::class, 'modelo', 'etiquetables', 'etiqueta_id');
    }
}
