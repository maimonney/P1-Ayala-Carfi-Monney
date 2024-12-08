<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $message;

    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->message = $data['message'];
    }

    public function build()
    {
        return $this->from('mailen.monney@davinci.edu.ar', 'Tu Servicio')
                    ->subject('Nuevo mensaje de contacto')
                    ->view('emails.contact.notification');
    }
}
