<?php

use App\Http\Controllers\IngredienteController;
use App\Http\Controllers\UnidadController;
use App\Models\Unidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('ingredientes', [IngredienteController::class, 'apiIngredientes']);
Route::get('unidades', function () {
    return (Unidad::all());
});
