<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactoRequest;
use App\Models\Contacto;
use Illuminate\Http\Request;

class AdminContactoController extends Controller
{
    public function __construct()
    {
        // Solo un usuario administrador puede acceder a los datos de contacto
        // del backend
        $this->middleware(['auth', 'isadmin']);
    }

    /**
     * Muestra el listado de contactos realizados
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Permite editar los datos enviados de contacto
     * 
     * @param \App\Models\Contacto $contacto
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacto $contacto)
    {
        
    }

    /**
     * @param \App\Http\Requests\ContactoRequest $request
     * @param \App\Models\Contacto $contacto
     */
    public function update(ContactoRequest $request, Contacto $contacto)
    {
        
    }
}
