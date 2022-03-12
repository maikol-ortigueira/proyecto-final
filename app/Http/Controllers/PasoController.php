<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePasoRequest;
use App\Http\Requests\UpdatePasoRequest;
use App\Models\Paso;

class PasoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StorePasoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePasoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paso  $paso
     * @return \Illuminate\Http\Response
     */
    public function show(Paso $paso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paso  $paso
     * @return \Illuminate\Http\Response
     */
    public function edit(Paso $paso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePasoRequest  $request
     * @param  \App\Models\Paso  $paso
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePasoRequest $request, Paso $paso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paso  $paso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paso $paso)
    {
        //
    }
}
