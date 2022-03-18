<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    /**
     * Método para asignar etiquetas a las recetas
     *
     * @return void
     */
    public function recetas ()
    {
        $this->morphedByMany(Receta::class, 'etiquetable');
    }

    /**
     * Método para asignar etiquetas a los ingredientes
     *
     * @return void
     */
    public function ingredientes ()
    {
        $this->morphedByMany(Ingrediente::class, 'etiquetable');
    }
}
