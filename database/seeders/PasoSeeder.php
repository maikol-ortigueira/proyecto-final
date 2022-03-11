<?php

namespace Database\Seeders;

use App\Models\Paso;
use App\Models\Receta;
use Illuminate\Database\Seeder;

class PasoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recetas = Receta::all()->pluck('id');

        foreach ($recetas as $receta)
        {
            $pasos = rand(1,3);
            for ($i=0; $i < $pasos; $i++) { 
                Paso::factory(1)->state(
                    ['orden' => $i+1,
                    'receta_id' => $receta
                    ]
                )->create();
            }
        }
    }
}
