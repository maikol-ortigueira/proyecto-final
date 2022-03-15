<?php

namespace App\Http\Middleware;

use App\Models\Receta;
use Closure;
use Illuminate\Http\Request;

class EsAutor
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
        // Controlamos la receta a la que tratamos de acceder
        $receta = $request->receta;

        // Para cuando nos devuelve el id de la receta la pasamos a objeto
        if (is_numeric($receta))
        {
            $receta = Receta::where('id', (int) $receta)->get()[0];
        }

        // Si es el autor o un superadministrador puede acceder
        if (auth()->user() === $receta->autor || auth()->user()->isAdmin(['superadmin'])) {
            return $next($request);
        }

        // sino lo enviamos al listado de recetaas
        return redirect(route('admin.recetas.index'));
    }
}
