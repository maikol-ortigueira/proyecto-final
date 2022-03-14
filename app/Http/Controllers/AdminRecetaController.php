<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

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
    public function edit(Receta $receta)
    {
        return view('admin.recetas.edit', ['receta' => $receta]);
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
        if (isset($request->borrar_fotos))
        {
            foreach($request->borrar_fotos as $foto_id)
            {
                $foto = Foto::find($foto_id);
                // TODO 
                // Descubrir como almacena las fotos para luego aplicar el siguiente código para eliminar
                /* Storage::delete($foto->url); */
                $foto->delete();
            }
        }
        //ddd($request);
        /*         $this->validate($request, [
            'name' => 'required',
            'imagenes_subidas'=>'required',
        ]);
 */
ddd($request);
        if ($request->hasFile('imagenes_subidas')) {
            $allowedfileExtension = ['pdf', 'jpeg', 'jpg', 'png', 'docx'];
            $files = $request->file('imagenes_subidas');
            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                ddd($check, $filename, $extension);
/*                 if ($check) {
                    $items = Item::create($request->all());
                    foreach ($request->imagenes_subidas as $photo) {
                        $filename = $photo->store('imagenes_subidas');
                        ItemDetail::create([
                            'item_id' => $items->id,
                            'filename' => $filename
                        ]);
                    }
                } */
            }
        }
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
