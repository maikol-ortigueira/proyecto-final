<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Receta;
use App\Models\Unidad;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create(
            [
                'nombre' => 'peso',
                'type' => Unidad::class,
            ]
        );

        Categoria::create(
            [
                'nombre' => 'capacidad',
                'type' => Unidad::class
            ],
        );

        Categoria::factory(10)->state(['type' => Receta::class])->create();
    }
}
