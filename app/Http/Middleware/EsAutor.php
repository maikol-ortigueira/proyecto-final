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

        $receta = $request->receta;
        if (is_numeric($receta))
        {
            $receta = Receta::where('id', (int) $receta)->get()[0];
        }

        if (auth()->user() === $receta->autor || auth()->user()->isAdmin(['superadmin'])) {
            return $next($request);
        }

        return redirect(route('admin.recetas.index'));
    }
}
