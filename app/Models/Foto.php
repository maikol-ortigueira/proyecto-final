<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $fillable = ['url'];

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
        return $this->hasOne(Receta::class);
    }

    public function modelo ()
    {
        return $this->morphTo();
    }
}
