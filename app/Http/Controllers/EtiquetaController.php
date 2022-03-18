<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEtiquetaRequest;
use App\Http\Requests\UpdateEtiquetaRequest;
use App\Models\Etiqueta;

class EtiquetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.etiquetas.index', ['etiquetas' => Etiqueta::latest()->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.etiquetas.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEtiquetaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEtiquetaRequest $request)
    {
        // Las validaciones se realizan en \App\Http\Requests\StoreEtiquetaRequest
        Etiqueta::create($request->all());

        return redirect()->route('admin.etiquetas.index')->with('success', 'La etiqueta se ha generado con éxito!!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Etiqueta  $etiqueta
     * @return \Illuminate\Http\Response
     */
    public function edit(Etiqueta $etiqueta)
    {
        return view('admin.etiquetas.edit', ['etiqueta' => $etiqueta]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEtiquetaRequest  $request
     * @param  \App\Models\Etiqueta  $etiqueta
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEtiquetaRequest $request, Etiqueta $etiqueta)
    {
        // Las validaciones se realizan en \App\Http\Requests\UpdateEtiquetaRequest
        $etiqueta->update($request->all());

        return redirect()->route('admin.etiquetas.index')->with('success', 'La etiqueta se ha actualizado con éxito!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etiqueta  $etiqueta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etiqueta $etiqueta)
    {
        $etiqueta->delete();

        return redirect()->route('admin.etiquetas.index')->with('success', 'Se ha eliminado la etiqueta!!');
    }
}
