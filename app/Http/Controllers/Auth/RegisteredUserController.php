<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'perfil.cp' => ['nullable', 'numeric'],
            'perfil.telefonos' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Guardar los datos del perfil
        $user->perfil()->create($request->perfil);

        // Si el usuario se ha registrado en el front no tiene rol
        if (!$request->roles)
        {
            // Se registra como usuario registrado
            $registrado = Rol::where('nombre', 'registrado')->firstOrFail();
            $user->roles()->attach([$registrado->id]);
        }

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
