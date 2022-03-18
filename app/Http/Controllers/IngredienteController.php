<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIngredienteRequest;
use App\Http\Requests\UpdateIngredienteRequest;
use App\Models\Ingrediente;

class IngredienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredientes = Ingrediente::latest()->paginate(10);
        return view('admin.ingredientes.index', ['ingredientes' => $ingredientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ingredientes.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIngredienteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIngredienteRequest $request)
    {
        Ingrediente::create($request->all());

        return redirect()->route('admin.ingredientes.index')->with('success', 'El ingrediente se ha añadido a la base de datos!!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ingrediente  $ingrediente
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingrediente $ingrediente)
    {
        return view('admin.ingredientes.edit', ['ingrediente' => $ingrediente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIngredienteRequest  $request
     * @param  \App\Models\Ingrediente  $ingrediente
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIngredienteRequest $request, Ingrediente $ingrediente)
    {
        // La validación se realiza en App\Http\Requests\UpdateIngredienteRequest
        $data = $request->all(['nombre', 'unidad_id']);
        $ingrediente->update($data);

        return redirect(route('admin.ingredientes.index'))->with('success', 'El ingrediente se ha actualizado correctamente!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ingrediente  $ingrediente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingrediente $ingrediente)
    {
        $ingrediente->delete();

        return back()->with('success', 'El ingrediente se ha eliminado con éxito!!');
    }

    /**
     * Método para mostrar todos los ingredientes a través del API
     */
    public function apiIngredientes ()
    {
        return(Ingrediente::all());
    }
}
