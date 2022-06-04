<?php

namespace App\Mail;

use App\Models\Contacto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RespuestaContacto extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Instancia de contacto
     *
     * @var App\Models\Contacto;
     */
    public $contacto;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contacto $contacto)
    {
        $this->contacto = $contacto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.respuesta.contacto');
    }
}
