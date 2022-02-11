<?php

namespace Quimaira\Contactos\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->from($this->data->email)
            ->to('direccion@calzadoarmada.com')
            ->bcc('grupoquimaira@gmail.com')
            ->subject('Mensaje desde el sitio Web')
            ->view('contactos::mail.contacto');
    }
}
