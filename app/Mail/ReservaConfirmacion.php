<?php

namespace App\Mail;

use App\Models\Reserva;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReservaConfirmacion extends Mailable
{
    use Queueable, SerializesModels;

    public $reserva;

    public function __construct(Reserva $reserva)
    {
        $this->reserva = $reserva;
    }

    public function build()
    {
        return $this->subject('Confirmación de Reserva')
                    ->markdown('emails.reserva.confirmacion')
                    ->with([
                        'serviceTitle' => $this->reserva->service->title,
                        'userName' => $this->reserva->user->name,
                        'reservationDate' => $this->reserva->created_at->format('d-m-Y'),
                    ]);
    }
}
