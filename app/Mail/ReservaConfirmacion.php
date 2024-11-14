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

    public function __construct(
        public Reserva $reserva
    )
    {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmación de Reserva de servicio',
            from: new Address('no-responder@novaservicio.com', 'Nova')
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails/reservaConfirmacion',
            text: 'emails/reservaConfirmacion-text',
        );
    }

      /**
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
