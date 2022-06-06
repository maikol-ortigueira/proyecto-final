<?php

namespace Tests\Feature\misPruebas;

use App\Models\Contacto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FormularioContactoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_la_pagina_de_contacto_se_puede_desplegar()
    {
        $response = $this->get('/contacto');

        $response->assertStatus(200);
    }

    public function test_se_pueden_enviar_formularios_de_contacto()
    {

        // Queremos introducir los datos del formulario
        $response = $this->post('/contacto', [
            'nombre' => 'Test',
            'email' => 'test@test.com',
            'asunto' => 'asunto de prueba',
            'contenido' => 'contenido de prueba'
        ]);

        // Comprobar que
        $response->assertStatus(302);

        // Buscar el último contacto realizado
        $contacto = Contacto::first();

        // Confirmar que solo hay un formulario cubierto
        $this->assertEquals(1, Contacto::count());

        // Comprobar que los campos están almacenados en la base de datos correctamente
        $this->assertEquals('Test', $contacto->nombre);
        $this->assertEquals('test@test.com', $contacto->email);
        $this->assertEquals('asunto de prueba', $contacto->asunto);
        $this->assertEquals('contenido de prueba', $contacto->contenido);
    }
}
