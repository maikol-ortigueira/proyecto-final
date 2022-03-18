<?php

namespace App\View\Components\Filtros;

use App\Models\Categoria;
use App\Models\Etiqueta;
use App\Models\Receta;
use Illuminate\View\Component;

class Index extends Component
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
        $etiquetas->name = 'tags';
        $categorias = Categoria::all()->where('type', Receta::class);
        $categorias->name = 'categories';
        return view('components.filtros.index', ['tag' => $etiquetas, 'categoria' => $categorias]);
    }
}
