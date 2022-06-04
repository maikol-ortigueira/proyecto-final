<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecetaRequest;
use App\Http\Requests\UpdateRecetaRequest;
use App\Models\Categoria;
use App\Models\Etiqueta;
use App\Models\Foto;
use App\Models\Paso;
use App\Models\Receta;
use Illuminate\Support\Facades\Storage;

class AdminRecetaController extends Controller
{
    public function __construct()
    {
        // Solo un usuario administrador puede acceder a las recetas en el backend
        $this->middleware(['auth', 'isadmin']);
        // Limitar permisos de edición o actualización al autor y al superadministrador
        $this->middleware('esautor')->except(['index', 'create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.recetas.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRecetaRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRecetaRequest $request)
    {
        // Las validaciones se realizan en App\Http\Requests\StoreRecetaRequest
        $receta = new Receta;
        $receta->categoria()->associate($request->categoria);
        $receta->user_id = auth()->user()->id;
        $receta->nombre = $request->nombre;
        $receta->descripcion = $request->descripcion;
        $receta->raciones = $request->raciones;

        $receta->save();

        // Si la receta tiene fotos las guardamos y recuperamos las urls
        if (!is_null($request->file('fotos')) && is_array($request->file('fotos')) && count($request->file('fotos')) > 0) {

            $imagenesReceta = $request->file('fotos');
            $urlsFotosReceta = $this->guardarImagenes($imagenesReceta, 'recetas');

            foreach ($urlsFotosReceta as $url) {
                $receta->fotos()->create($url);
            }
        }

        // Guardar las etiquetas, si las hay
        if (isset($request->etiquetas)) {
            $receta->etiquetas()->attach($request->etiquetas);
        }

        // Guardar los ingredientes, si los hay
        if (isset($request->ingredientes)) {
            $receta->ingredientes()->attach([...$request->ingredientes]);
        }

        // Guardar los pasos, si existen
        if (isset($request->pasos)) {
            foreach ($request->pasos as $paso) {
                $pasoModel = $receta->pasos()->create($paso);

                // Si el paso tiene imágenes es el momento de guardarlas
                if (is_array($request->file('pasos.' . $paso['orden'])) && count($request->file('pasos.' . $paso['orden'])) > 0) {
                    $fotos = $request->file('pasos.' . $paso['orden']);
                    $urls = $this->guardarImagenes($fotos, 'pasos');
                    foreach ($urls as $url) {
                        $pasoModel->fotos()->create($url);
                    }
                }
            }
        }

        return redirect()->route('admin.recetas.index')->with('success', 'La receta se ha guardado con éxito!!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Receta $recetas
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        return view('admin.recetas.edit', array(
            'receta' => $receta,
            'categoriasReceta' => Categoria::all()->where('type', Receta::class),
            'etiquetas' => Etiqueta::all()
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateRecetaRequest $request
     * @param \App\Models\Receta $recetas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecetaRequest $request, Receta $receta)
    {
        // Las validaciones se realizan en App\Http\Requests\UpdateRecetaRequest;

        // Elimnar fotos de receta si lo solicita el usuario
        if (isset($request->borrar_fotos)) {
            foreach ($request->borrar_fotos as $foto_id) {
                $foto = Foto::find($foto_id);

                // Eliminar la foto del sistema de archivos
                Storage::delete('public/' . $foto->url);

                // Eliminar el registro con la foto
                $foto->delete();
            }
        }

        // Guardar la receta
        // Debemos primero asociar la categoría a la receta
        $receta->categoria()->associate($request->categoria);
        $receta->update($request->all());

        // Si la receta tiene fotos las guardamos y recuperamos las urls
        if (!is_null($request->file('fotos')) && is_array($request->file('fotos')) && count($request->file('fotos')) > 0) {

            $imagenesReceta = $request->file('fotos');
            $urlsFotosReceta = $this->guardarImagenes($imagenesReceta, 'recetas');

            foreach ($urlsFotosReceta as $url) {
                $receta->fotos()->create($url);
            }
        }

        // Guardar los pasos de la receta
        // Primero comprobamos que existen pasos
        if (isset($request->pasos) && !empty($request->pasos)) {

            foreach ($request->pasos as $orden => $paso) {
                $paso['orden'] = $orden;
                if ((int)$paso['id'] === 0) {
                    $pasoModel = $receta->pasos()->create($paso);
                } else {
                    $pasoModel = Paso::find($paso['id']);
                    $pasoModel->update($paso);
                }

                // Si el paso tiene imágenes es el momento de guardarlas
                if (is_array($request->file('pasos.' . $orden)) && count($request->file('pasos.' . $orden)) > 0) {
                    $fotos = $request->file('pasos.' . $orden);
                    $urls = $this->guardarImagenes($fotos, 'pasos');
                    foreach ($urls as $url) {
                        $pasoModel->fotos()->create($url);
                    }
                }
            }
        }

        // Guardar los ingredientes
        // El id del ingrediente y la receta ya se guarda automáticamente
        // pero debemos añadir la cantidad y el tipo de unidad a la relación
        $ingredientes = collect($request->input('ingredientes', []))
            ->map(function ($ingrediente) {
                return [
                    'cantidad' => $ingrediente['cantidad'],
                    'ingrediente_id' => $ingrediente['ingrediente'],
                    'unidad_id' => $ingrediente['unidad']
                ];
            });

        $receta->ingredientes()->sync($ingredientes);

        //  No hay problemas, ok.
        return back()->with('success', 'La receta se ha actualizado sin ningún problema!!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Receta $recetas
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
     * @param string $carpeta Carpeta de destino de las fotos
     */
    protected function guardarImagenes($imagenes, $carpeta)
    {
        // Variable para almacenar las urls de los ficheros guardados
        $urls = array();

        // Almacenamos cada una de las imágenes guardadas
        foreach ($imagenes as $imagen) {
            $urls[]['url'] = $this->guardarImagen($imagen, $carpeta);
        }

        // Devolvemos las urls para guardar en la bbdd
        return $urls;
    }

    /**
     * Método para almacenar una sola imagen
     *
     * @param object $imagen La imagen cargada por el usuario
     * @param string $carpeta Carpeta de destino de las imagenes
     */
    protected function guardarImagen($imagen, $carpeta)
    {
        // Creamos un array para controlar las extensiones permitidas
        $extensionesPermitidas = ['pdf', 'jpeg', 'jpg', 'png', 'docx'];

        $extension = $imagen->getClientOriginalExtension();
        $valida = in_array($extension, $extensionesPermitidas);

        if (!$imagen->isValid()) {
            throw new \Exception('Error al subir la imagen: ' . $imagen->getErrorMessage());
        }

        // Si el tipo de fichero está permitido guardar la imagen
        if ($valida) {

            $urlFichero = $imagen->store('public/');
        }

        return $imagen->hashName();
    }
}
