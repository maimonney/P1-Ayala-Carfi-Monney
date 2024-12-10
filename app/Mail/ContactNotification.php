<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ContactNotification extends Mailable
{
    public $name;
    public $email;
    public $message;

    public function __construct($data)
    {
        $this->name = (string) $data['name'];
        $this->email = (string) $data['email'];
        $this->message = (string) $data['message'];
    }

    public function build()
    {

        // dd($this->name, $this->email, $this->message);

        return $this->from($this->email, $this->name) 
                    ->subject('Nuevo mensaje de contacto')
                    ->view('emails.notification') 
                    ->with([
                        'name' => $this->name,
                        'email' => $this->email,
                        'message' => $this->message,
                    ]); 
    }
}
