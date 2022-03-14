<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;

class AdminRecetaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isadmin']);
        $this->middleware('esautor')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mostrar solo las recetas del autor, y si el usuario es superadmin puede ver todas
        $recetas = Receta::whereEsAutor()->paginate(10);

        return view(
            'admin.recetas.index',
            ['recetas' => $recetas]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receta  $recetas
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $recetas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receta  $recetas
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $recetas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receta  $recetas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $recetas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receta  $recetas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        $receta->delete();

        return redirect()->route('admin.recetas.index')->with('succes', 'Receta eliminada!!');
    }
}
