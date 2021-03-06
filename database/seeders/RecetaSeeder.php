<?php

namespace Database\Seeders;

use App\Models\Etiqueta;
use App\Models\Foto;
use App\Models\Ingrediente;
use App\Models\Paso;
use App\Models\Receta;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class RecetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $editorId = Rol::firstWhere('nombre', 'editor')->id;

        // Buscamos los usuarios que pueden crear recetas
        $usuariosEditores = User::whereHas('roles', function($query) use ($editorId) {
            $query->where('id', $editorId);
        })->pluck('id')->all();

        foreach ($usuariosEditores as $userId)
        {
            $numDeRecetas = rand(1,5);
            for ($i=0; $i < $numDeRecetas; $i++) { 
                // Crear una receta
                $receta = Receta::factory(1)->state([
                    'user_id' => $userId,
                ])->hasFotos(rand(2,5))->create()[0];
                
                // Añadir los ingredientes
                $ingredientes = DB::table('ingredientes')->get()->random(rand(3,7));
                //$ingredientes = Arr::random(Ingrediente::all(), rand(3,7));
                $ings = array();
                $i = 0;
                foreach($ingredientes as $ingrediente)
                {
                    $ings[$i]['ingrediente_id'] = $ingrediente->id;
                    $ings[$i]['unidad_id'] = $ingrediente->unidad_id;
                    $ings[$i]['cantidad'] = rand(1,50);

                    $i++;
                }
                $receta->ingredientes()->sync($ings);

                // Añadir etiquetas
                $etiquetas = Arr::random(Etiqueta::all()->pluck('id')->all(), rand(1,4));

                $receta->etiquetas()->attach($etiquetas);
                //$receta->etiquetas()->attach($etiquetas);

                // Añadir las fotos de la receta
                Foto::factory(rand(1,3))->state([
                    'modelo_type' => Receta::class,
                    'modelo_id' => $receta->id
                ])->create();

                // Añadir los pasos
                for ($j=0; $j < rand(1,3); $j++) { 
                    $pasoId = Paso::factory(1)->hasFotos(rand(1,5))->state([
                        'orden' => $j+1,
                        'receta_id' => $receta->id
                        ]
                    )->create()[0]->id;
                    
                    // Añadir las fotos del paso
/*                     Foto::factory(rand(1,3))->state([
                        'modelo_type' => Paso::class,
                        'modelo_id' => $pasoId
                    ])->create(); */

                }
            }
        }
    }
}
