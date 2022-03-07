<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;

    /**
     * Una unidad puede tener una categoría
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function categoria ()
    {
        return $this->hasOne(Categoria::class);
    }
}
