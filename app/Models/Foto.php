<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    public function paso ()
    {
        return $this->belongsTo(Paso::class);
    }

    public function perfil ()
    {
        return $this->belongsTo(Perfil::class);
    }

    public function receta ()
    {
        return $this->belongsTo(Receta::class);
    }
}
