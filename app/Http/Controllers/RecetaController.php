<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecetaRequest;
use App\Http\Requests\UpdateRecetaRequest;
use App\Models\Categoria;
use App\Models\Receta;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class RecetaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $recetas = Receta::orderByDesc('created_at');

        if ($request->has('tag'))
        {
            $etiqueta = $request->input('tag');

            $recetas->whereHas('etiquetas', function (Builder $query) use ($etiqueta) {
                $query->where('id', $etiqueta);
            });
        }
//         $categorias = Categoria::all()->where('type', '=' , Receta::class)->pluck('id');
        return view('recetas.index', ['recetas' => $recetas->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recetas.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRecetaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecetaRequest $request)
    {
        return redirect(route('recetas.edit'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        return view('recetas.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        return view('recetas.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRecetaRequest  $request
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecetaRequest $request, Receta $receta)
    {
        // Validación del artículo
        $data = $this->validate($request, [
            'titulo' => 'required',
            'texto' => 'required'
        ]);

        $receta->update($data);
        $receta->etiquetas()->sync($request->etiquetas);

        return back()->with('success', 'La receta se ha actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        $receta->delete();

        return redirect()->route('recetas.index')->with('success', 'Receta eliminada!');
    }
}
