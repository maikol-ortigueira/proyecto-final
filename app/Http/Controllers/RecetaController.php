<?php

namespace App\Http\Controllers;

use App\Models\Receta;

class RecetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // El método conFiltros() se encuentra en el modelo y sirve para filtrar las recetas
        return view(
            'recetas.index',
            [
                'recetas' => Receta::latest()
                    ->conFiltros(request([
                        'tag',
                        'categoria',
                        'autor'
                    ]))
                    ->paginate(10)
            ]
        );
    }

    public function apiRecetas()
    {
        return (
            [
                'recetas' => Receta::latest()
                    ->conFiltros(request([
                        'tag',
                        'categoria',
                        'autor'
                    ]))
                    ->paginate(10)
            ]
        ); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        $ingredientes = $receta->ingredientes();

        return view('recetas.show', ['receta' => $receta, 'ingredientes' => $ingredientes]);
    }
}
