<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Receta;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class RecetaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categorias = Categoria::all()->where('type', '=', Receta::class)->pluck('id')->all();

        return [
            'nombre' => $this->faker->word(),
            'descripcion' => $this->faker->paragraph(),
            'raciones' => rand(1,6),
            'categoria_id' => Arr::random($categorias)
        ];
    }
}
