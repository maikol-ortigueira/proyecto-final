<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Perfil;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolSeeder::class);

        $miUsuario = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@ejemplo.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Illuminate\Support\Str::random(10),
        ])->roles()->sync([1]);

        Perfil::factory(1)->state(['user_id' => '1'])->create();

        $this->call(CategoriaSeeder::class);
        $this->call(UnidadSeeder::class);

    }
}
