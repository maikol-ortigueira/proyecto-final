<?php

namespace Tests\Feature\misPruebas;

use App\Models\Ingrediente;
use App\Models\Rol;
use App\Models\Unidad;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CrearIngredientesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {

        parent::setUp(); // TODO: Change the autogenerated stub

        // Creamos el rol superadmin
        $rol = Rol::factory()->create(['nombre' => 'superadmin']);
        // Creamos un usuario
        $user = User::factory()->create();
        // Le asignamos el rol de superadmin para poder acceder al backend
        $user->roles()->sync($rol);

        // Actuamos como este usuario
        $this->actingAs($user);

    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_se_puede_acceder_a_la_pagina_de_alta_de_ingredientes()
    {
        // Ir a la página de crear etiquetas
        $response = $this->get('/admin/ingredientes/crear');

        // Comprobar que accede a la página
        $response->assertStatus(200);
    }

    public function test_se_puede_crear_un_ingrediente ()
    {
        $this->artisan('db:seed --class CategoriaSeeder');
        $this->artisan('db:seed --class UnidadSeeder');
        $unidades = Unidad::all();

        $response = $this->post('/admin/ingredientes', [
            'nombre' => 'test',
            'unidad_id' => $unidades->pluck('id')[0]
        ]);

        $ingrediente = Ingrediente::first();

        $this->assertEquals(1, Ingrediente::count());
        $this->assertEquals('test', $ingrediente->nombre);
        $this->assertEquals($unidades->pluck('id')[0], $ingrediente->unidad_id);
        $response->assertRedirect('/admin/ingredientes');
    }
}
