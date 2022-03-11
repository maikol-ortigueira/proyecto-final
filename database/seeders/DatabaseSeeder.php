<?php

namespace Database\Seeders;

use App\Models\Etiqueta;
use App\Models\Ingrediente;
use App\Models\Perfil;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolSeeder::class);
        $this->call(UserSeeder::class);

        //User::factory(5)->create()->roles()->sync([3]);
        Etiqueta::factory(20)->create();
        // Quitar el comentario a foto cuando necesitemos fotos. Tarde un poco en cargar
        // Foto::factory(60)->create();
        $this->call(UnidadSeeder::class);
        Ingrediente::factory(20)->create();
        $this->call(CategoriaSeeder::class);
        $this->call(RecetaSeeder::class);
        $this->call(PasoSeeder::class);
    }
}
