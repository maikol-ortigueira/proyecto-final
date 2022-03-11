<?php

namespace Database\Seeders;

use App\Models\Etiqueta;
use App\Models\Ingrediente;
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

        User::create([
            'name' => 'Maikol Fustes',
            'email' => 'maikol.ortigueira@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$MC8bbxmYp6NX8P4W6mKo4ertnh.OB0hBPAhghrQNuO90yToEwKnRi',
            'remember_token' => \Illuminate\Support\Str::random(10),
        ])->roles()->sync([1]);
        
        $users = User::factory(10)->create();
        foreach ($users as $user) {
            $user->roles()->sync([rand(2,3)]);
        }
        //User::factory(5)->create()->roles()->sync([3]);
        Etiqueta::factory(20)->create();
        // Quitar el comentario a foto cuando necesitemos fotos. Tarde un poco en cargar
        // Foto::factory(60)->create();
        Ingrediente::factory(20)->create();
        $this->call(CategoriaSeeder::class);
        $this->call(RecetaSeeder::class);
        $this->call(PasoSeeder::class);
    }
}
