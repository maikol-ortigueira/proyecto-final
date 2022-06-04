<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactoRequest;
use App\Models\Contacto;
use Illuminate\Http\Request;

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
        Contacto::create($request->all());

        redirect()->route('home')->with('success', 'Gracías por contactar');
    }
}
