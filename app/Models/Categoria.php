<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    /**
     * Muchas unidades pueden pertencer a una categoría
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function unidades ()
    {
        return $this->belongsToMany(Unidad::class);
    }

    /**
     * Muchas recetas pueden pertenecer a una categoría
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function recetas ()
    {
        return $this->belongsToMany(Receta::class);
    }
}
