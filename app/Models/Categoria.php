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
     */
    public function unidades ()
    {
        return $this->hasMany(Unidad::class);
    }

    /**
     * Muchas recetas pueden pertenecer a una categoría
     *
     */
    public function recetas ()
    {
        return $this->hasMany(Receta::class);
    }

    /**
     * Una categoría puede tener varias subcategoría
     *
     * @return void
     */
    public function subcategoria ()
    {
        return $this->hasMany(Categoria::class, 'parent_id');
    }

    /**
     * Una subcategoria tiene una categoria padre
     *
     * @return void
     */
    public function parent ()
    {
        return $this->belongsTo(Categoria::class, 'parent_id');
    }
}
