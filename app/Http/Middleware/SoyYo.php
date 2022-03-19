<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class SoyYo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Si el usuario registrado es el mismo que trata de acceder al perfil le damos permiso
        if ($request->user->id === auth()->user()->id)
        {
            return $next($request);
        }
        
        // Si no es así lo redireccionamos al inicio del sitio
        return redirect(route('home'));
    }
}
