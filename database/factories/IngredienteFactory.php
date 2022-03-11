<?php

namespace Database\Factories;

use App\Models\Unidad;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class IngredienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $unidades = Unidad::all()->pluck('id')->all();
        $unidad = Arr::random($unidades);

        return [
            'nombre' => $this->faker->word(),
            'unidad_id' => $unidad
        ];
    }
}
