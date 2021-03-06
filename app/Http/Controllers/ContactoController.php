<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactoRequest;
use App\Mail\NuevoContacto;
use App\Mail\RespuestaContacto;
use App\Models\Contacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function index()
    {
        return view('contacto.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ContactoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactoRequest $request)
    {
        $contacto = Contacto::create($request->all());

        // Correo al administrador del sitio
        Mail::to(config('mail.from')['address'])->send(new NuevoContacto($contacto));

        // Correo al contacto
        Mail::to($contacto)->send(new RespuestaContacto($contacto));

        return redirect()->route('home')->with('success', 'Gracías por contactar');
    }
}
