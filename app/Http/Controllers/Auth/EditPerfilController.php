<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EditPerfilController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('auth.perfil', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'perfil.cp' => ['numeric'],
            'perfil.telefonos' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:9'
        ]);
        
        $user->perfil()->update($request->perfil);

        return redirect()->route('perfil.editar', ['user' => $user])->with('success', 'Los datos se han actualizado correctamente!!');
    }
}
