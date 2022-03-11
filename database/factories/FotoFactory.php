<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url' => $this->faker->image('public/storage/images/', 640, 480, null, false)
        ];
    }
}