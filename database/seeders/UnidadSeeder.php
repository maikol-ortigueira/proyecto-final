<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Unidad;
use Illuminate\Database\Seeder;

class UnidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unidad::create([
            'nombre' => 'l',
            'categoria_id' => Categoria::all()->where('nombre', '=', 'capacidad')->pluck('id')->all()
        ]);
    }
}
