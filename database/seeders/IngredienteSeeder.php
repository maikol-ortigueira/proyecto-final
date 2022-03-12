<?php

namespace Database\Seeders;

use App\Models\Etiqueta;
use App\Models\Ingrediente;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class IngredienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Añadir etiquetas a los ingredientes
        $etiquetas = Arr::random(Etiqueta::all()->pluck('id')->all(), rand(1,4));
        
        for ($i=0; $i < 20; $i++) { 
            $ingrediente = Ingrediente::factory(1)->create()[0];

            $ingrediente->etiquetas()->attach($etiquetas);
        }
    }
}
