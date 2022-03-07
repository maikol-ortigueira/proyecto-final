<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Receta;
use App\Models\Unidad;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Output\ConsoleOutput;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Maikol Fustes',
            'email' => 'maikol.ortigueira@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$MC8bbxmYp6NX8P4W6mKo4ertnh.OB0hBPAhghrQNuO90yToEwKnRi',
            'remember_token' => \Illuminate\Support\Str::random(10),
        ]);
        
        User::factory(10)->create();
        $this->call(CategoriaSeeder::class);

        //Receta::factory()->count(10)->hasCategoria()->create();
/*          Receta::factory()
            ->count(10)               
            ->state(new Sequence(
            fn ($sequence) => ['categoria_id' => Categoria::all()->random()],
        ))->create(); */
    }
}
