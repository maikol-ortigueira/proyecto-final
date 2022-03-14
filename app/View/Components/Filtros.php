<?php

namespace App\View\Components;

use App\Models\Categoria;
use App\Models\Etiqueta;
use App\Models\Receta;
use Illuminate\View\Component;

class Filtros extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $etiquetas = Etiqueta::all();
        $etiquetas->name = 'etiquetas';
        $categorias = Categoria::all()->where('type', Receta::class);
        $categorias->name = 'categorias';
        return view('components.filtros', ['etiquetas' => $etiquetas, 'categorias' => $categorias]);
    }
}
