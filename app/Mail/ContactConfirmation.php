<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactConfirmation extends Mailable
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
        return $this->from('no-reply@tuservicio.com', 'Tu Servicio')
                    ->subject('Confirmación de tu mensaje')
                    ->view('emails.confirmation')
                    ->text('emails.confirmation-text');
    }
}
