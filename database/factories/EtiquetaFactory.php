<?php

namespace Database\Factories;

use App\Models\Ingrediente;
use App\Models\Receta;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class EtiquetaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = Arr::random([Receta::class, Ingrediente::class]);
        return [
            'nombre' => $this->faker->word(),
            'type' => $type
        ];
    }
}
