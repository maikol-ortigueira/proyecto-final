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
        return $this->hasMany(Ingrediente::class);
    }

    /**
     * Tiene una sola categoría
     *
     * @return void
     */
    public function categoria ()
    {
        return $this->hasOne(Categoria::class);
    }

    /**
     * Puede tener varias etiquetas
     * Las etiquetas solo corresponden a recetas, no comparten
     *
     * @return void
     */
    public function etiquetas ()
    {
        return $this->morphToMany(Etiqueta::class, 'etiquetable');
    }

    /**
     * Una receta puede tener varios pasos
     *
     * @return void
     */
    public function pasos ()
    {
        return $this->hasMany(Paso::class);
    }

    /**
     * Una receta debe tener un autor
     *
     * @return void
     */
    public function autor ()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Una receta puede tener varias fotos
     *
     * @return void
     */
    public function fotos ()
    {
        return $this->hasMany(Foto::class);
    }
}
