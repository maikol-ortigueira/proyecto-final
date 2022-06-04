<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactoRequest;
use App\Mail\RespuestaContacto;
use App\Models\Contacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

        Mail::to($contacto)->send(new RespuestaContacto($contacto));

        redirect()->route('inicio')->with('success', 'Gracías por contactar');
    }
}
