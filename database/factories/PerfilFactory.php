<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PerfilFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'domicilio' => $this->faker->address(),
            'localidad' => $this->faker->city(),
            'cp' => $this->faker->numberBetween(10000,99999),
            'telefonos' => $this->faker->phoneNumber(),
            'provincia' => $this->faker->city(),
        ];
    }
}
