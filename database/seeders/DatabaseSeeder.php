<?php

namespace Database\Seeders;

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
        User::create([
            'name' => 'Maikol Fustes',
            'email' => 'maikol.ortigueira@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$MC8bbxmYp6NX8P4W6mKo4ertnh.OB0hBPAhghrQNuO90yToEwKnRi',
            'remember_token' => \Illuminate\Support\Str::random(10),
        ]);
        
        User::factory(10)->create();
    }
}
