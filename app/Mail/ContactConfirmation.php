<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ContactConfirmation extends Mailable
{
    public $name;
    public $email;
    public $message;

    // Recibir los datos del formulario
    public function __construct($data)
    {
        $this->name = (string) $data['name'];
        $this->email = (string) $data['email'];
        $this->message = (string) $data['message'];
    }

    public function build()
    {
        return $this->from('no-responder@novaservicio.com', 'Nova') 
                    ->subject('Gracias por contactarnos')
                    ->view('emails.confirmation')
                    ->with([
                        'name' => $this->name,
                        'email' => $this->email,
                        'message' => $this->message,
                    ]); 
    }
}
