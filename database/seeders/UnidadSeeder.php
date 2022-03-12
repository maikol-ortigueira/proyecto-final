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
        $capacidad = Categoria::firstWhere('nombre', 'capacidad')->id;
        $peso = Categoria::firstWhere('nombre', 'peso')->id;

        Unidad::create([
            'abreviatura' => 'l.',
            'nombre' => 'litro',
            'categoria_id' => $capacidad
        ]);

        Unidad::create([
            'abreviatura' => 'cl.',
            'unidad_equivalencia' => Unidad::firstWhere('nombre', 'litro')->id,
            'equivalencia' => 100,
            'nombre' => 'centilitro',
            'categoria_id' => $capacidad
        ]);

        Unidad::create([
            'abreviatura' => 'ml.',
            'nombre' => 'mililitro',
            'unidad_equivalencia' => Unidad::firstWhere('nombre', 'litro')->id,
            'equivalencia' => 1000,
            'categoria_id' => $capacidad
        ]);

        Unidad::create([
            'abreviatura' => 'gl.',
            'nombre' => 'galón',
            'unidad_equivalencia' => Unidad::firstWhere('nombre', 'litro')->id,
            'equivalencia' => 3.785,
            'categoria_id' => $capacidad
        ]);

        Unidad::create([
            'abreviatura' => 'fl. oz.',
            'nombre' => 'onza fluida',
            'unidad_equivalencia' => Unidad::firstWhere('nombre', 'litro')->id,
            'equivalencia' => 0.029,
            'categoria_id' => $capacidad
        ]);

        Unidad::create([
            'abreviatura' => 'g.',
            'nombre' => 'gramo',
            'categoria_id' => $peso
        ]);

        Unidad::create([
            'abreviatura' => 'kg.',
            'nombre' => 'kilogramo',
            'unidad_equivalencia' => Unidad::firstWhere('nombre', 'gramo')->id,
            'equivalencia' => 1000,
            'categoria_id' => $peso
        ]);

        Unidad::create([
            'abreviatura' => 'lb.',
            'nombre' => 'libra',
            'unidad_equivalencia' => Unidad::firstWhere('nombre', 'gramo')->id,
            'equivalencia' => 453.59,
            'categoria_id' => $peso
        ]);

        Unidad::create([
            'abreviatura' => 'oz.',
            'nombre' => 'onza',
            'unidad_equivalencia' => Unidad::firstWhere('nombre', 'gramo')->id,
            'equivalencia' => 28.35,
            'categoria_id' => $peso
        ]);
    }
}
