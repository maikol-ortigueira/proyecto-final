<?php

namespace Database\Seeders;

use App\Models\Perfil;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Rol::all()->where('nombre', '<>', 'superadmin')->pluck('id')->all();

        $miUsuario = User::create([
            'name' => 'Maikol Fustes',
            'email' => 'maikol.ortigueira@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$MC8bbxmYp6NX8P4W6mKo4ertnh.OB0hBPAhghrQNuO90yToEwKnRi',
            'remember_token' => \Illuminate\Support\Str::random(10),
        ])->roles()->sync([1]);
        
        $miPerfil = Perfil::factory(1)->state(['user_id' => '1'])->create();

        $users = User::factory(10)->hasPerfil()->create();
        foreach ($users as $user) {
            $rol = Arr::random($roles);
            $user->roles()->attach([$rol]);
        }
    }
}
