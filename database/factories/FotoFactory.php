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
            'url' => 'https://source.unsplash.com/random/640×480/?food'
        ];
    }
}
