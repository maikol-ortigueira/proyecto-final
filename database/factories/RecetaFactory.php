<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RecetaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->words(2),
            'descripcion' => $this->faker->paragraph(),
            'raciones' => rand(1,6),
        ];
    }
}
