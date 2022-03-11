<?php

namespace Database\Factories;

use App\Models\Foto;
use App\Models\Receta;
use Illuminate\Database\Eloquent\Factories\Factory;

class PasoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fotos = Foto::factory(1)->create;
        
        return [
            'nombre' => $this->faker->word(),
            'descripcion' => $this->faker->paragraph(),
        ];
    }
}
