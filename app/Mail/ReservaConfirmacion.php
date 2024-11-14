<?php

namespace App\Mail;

use App\Models\Reserva;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservaConfirmacion extends Mailable
{
    use Queueable, SerializesModels;

    public Reserva $reserva;

    public function __construct(Reserva $reserva)
    {
        $this->reserva = $reserva;
    }

    public function build()
    {
        return $this->from('no-responder@novaservicio.com', 'Nova')
                    ->subject('Confirmación de Reserva de servicio')
                    ->view('emails.reservaConfirmacion')
                    ->text('emails.reservaConfirmacion-text');
    }
}
