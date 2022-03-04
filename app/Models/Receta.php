<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;

    /**
     * Relación con la tabla ingredientes
     *
     * @return void
     */
    public function ingredientes () 
    {
        return $this->belongsToMany(Ingrediente::class);
    }
}
