<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'raciones'];

    // Queremos que siempre cargue pasos, fotos, autor, categoría y etiquetas con cada receta
    protected $with = ['pasos', 'fotos', 'categoria', 'autor', 'etiquetas'];

    /**
     * Relación con la tabla ingredientes
     *
     * @return void
     */
    public function ingredientes()
    {
        return $this->belongsToMany(Ingrediente::class);
    }

    /**
     * Tiene una sola categoría
     *
     * @return void
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Puede tener varias etiquetas
     * Las etiquetas solo corresponden a recetas, no comparten
     *
     * @return void
     */
    public function etiquetas()
    {
        return $this->morphToMany(Etiqueta::class, 'etiquetable');
    }

    /**
     * Una receta puede tener varios pasos
     *
     * @return void
     */
    public function pasos()
    {
        return $this->hasMany(Paso::class);
    }

    /**
     * Una receta debe tener un autor
     *
     * @return void
     */
    public function autor()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Una receta puede tener varias fotos
     *
     * @return void
     */
    public function fotos()
    {
        return $this->morphMany(Foto::class, 'modelo');
    }

    /**
     * Los posibles filtros en una búsqueda de recetas
     * 
     */
    public function scopeConFiltros($query, array $filtros)
    {
        // Filtro por etiquetas
        $query->when($filtros['tag'] ?? false, function ($query, $etiqueta) {
            $query->whereHas('etiquetas', function (Builder $query) use ($etiqueta) {
                $query->where('id', $etiqueta);
            });
        });

        // Filtro por categoría
        $query->when($filtros['categoria'] ?? false, function ($query, $categoria) {
            $query->whereHas('categoria', function (Builder $query) use ($categoria) {
                $query->where('id', $categoria);
            });
        });

        // Filtro por autor
        $query->when($filtros['autor'] ?? false, function ($query, $autor) {
            $query->whereHas('autor', function (Builder $query) use ($autor) {
                $query->where('id', $autor);
            });
        });
    }

    /**
     * Método que filtra las recetas por el autor de las mismas
     * 
     * @param $query
     * @param bool $inclusoSuperAdmin
     */
    public function scopeWhereEsAutor($query, $inclusoSuperAdmin = true)
    {
        $usuario = auth()->user();
        // Filtro por autor
        if ($inclusoSuperAdmin) {
            foreach($usuario->roles as $rol)
            {
                if ($rol->nombre === 'superadmin')
                {
                    return;
                }
            }
        }

        $query->where('user_id', $usuario->id);
    }
}
