<?php

use App\Http\Controllers\AdminRecetaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EtiquetaController;
use App\Http\Controllers\IngredienteController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [RecetaController::class, 'index'])->name('home');

// Rutas para la gestión de recetas
Route::resource('/recetas', RecetaController::class, ['only' => ['index', 'show']]);
Route::resource('/admin/recetas', AdminRecetaController::class, ['names' => 'admin.recetas', 'except' => ['show']]);
Route::resource('/admin/ingredientes', IngredienteController::class, ['names' => 'admin.ingredientes', 'except' => ['show']]);
Route::resource('/admin/categorias', CategoriaController::class, ['names' => 'admin.categorias', 'except' => ['show']]);
Route::resource('/admin/etiquetas', EtiquetaController::class, ['names' => 'admin.etiquetas', 'except' => ['show']]);
Route::resource('/admin/users', UserController::class, ['names' => 'admin.users']);
Route::resource('/admin/roles', RolController::class, ['names' => 'admin.roles'])->parameters(['roles' => 'rol']);


Route::get('/admin', function () {
    return view('admin.recetas.index');
})->middleware(['auth', 'isadmin'])->name('dashboard');

Route::get('locale/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back();
});

require __DIR__ . '/auth.php';
