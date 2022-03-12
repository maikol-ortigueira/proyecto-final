<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;

    protected $table = 'unidades';

    /**
     * Una unidad puede tener una categoría
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function categoria ()
    {
        return $this->hasOne(Categoria::class);
    }

    /**
     * Una unidad puede pertenecer a varios ingredientes
     *
     * @return void
     */
    public function ingredientes ()
    {
        return $this->belongsToMany(Ingrediente::class);
    }
}
