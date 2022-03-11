<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paso extends Model
{
    use HasFactory;


    /**
     * El paso pertenece a una receta
     *
     * @return void
     */
    public function receta ()
    {
        return $this->belongsTo(Receta::class);
    }

    /**
     * Un paso puede tener varias fotos
     *
     * @return void
     */
    public function fotos ()
    {
        return $this->hasMany(Foto::class);
    }
}
