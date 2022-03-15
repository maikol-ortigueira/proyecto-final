<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Etiqueta;
use App\Models\Foto;
use App\Models\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        // Mostrar solo las recetas del autor
        // El superadministrador puede ver todas
        // whereEsAutor() está en el modelo
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
    public function show(Receta $receta)
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
        return view('admin.recetas.edit', [
            'receta' => $receta, 
            'categoriasReceta' => Categoria::all()->where('type', Receta::class),
            'etiquetas' => Etiqueta::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receta  $recetas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        $validated = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'raciones' => ['required', 'numeric'],
            'imagenes_subidas.*' => 'image'
        ]);

        if (isset($request->borrar_fotos)) {
            foreach ($request->borrar_fotos as $foto_id) {
                $foto = Foto::find($foto_id);
                // TODO 
                // Descubrir como almacena las fotos para luego aplicar el siguiente código para eliminar
                /* Storage::delete($foto->url); */
                $foto->delete();
            }
        }

        $receta->update($request->all());

        // Las validaciones se realizan en \App\Http\Requests\StoreRecetaRequest

        // Si la receta tiene fotos las guardamos y recuperamos las urls
        if ($request->hasFile('imagenes_subidas')) {
            $imagenesReceta = $request->file('imagenes_subidas');
            $urlFotosReceta = $this->guardarImagenes($imagenesReceta);
        }

        return back()->with('success', 'La receta se ha actualizado sin ningún problema!!.');
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

    /**
     * Método para subir y almacenar las imágenes
     * 
     * @param object $imagenes La colección de imágenes cargadas por el usuario
     */
    protected function guardarImagenes($imagenes)
    {
        // Variable para almacenar las urls de los ficheros guardados
        $urls = array();

        // Almacenamos cada una de las imágenes guardadas
        foreach ($imagenes as $imagen) {
            $urls[] = $this->guardarImagen($imagen);
        }

        // Devolvemos las urls para guardar en la bbdd
        return $urls;
    }

    /**
     * Método para almacenar una sola imagen
     * 
     * @param object $imagen    La imagen cargada por el usuario
     */
    protected function guardarImagen($imagen)
    {
        // Creamos un array para controlar las extensiones permitidas
        $extensionesPermitidas = ['pdf', 'jpeg', 'jpg', 'png', 'docx'];

        $extension = $imagen->getClientOriginalExtension();
        $valida = in_array($extension, $extensionesPermitidas);

        // Si el tipo de fichero está permitido guardar la imagen
        if ($valida) {
            $urlFichero = $imagen->store('recetas');
        }

        return $urlFichero;
    }
}
