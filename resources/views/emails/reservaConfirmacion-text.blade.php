<div style=" font-family: Arial, sans-serif; max-width: 600px; background-color: #fdf0f5; border: 2px solid #7e52f5; border-radius: 15px; padding: 20px; text-align: center;">
    <h1 style="color: #7e52f5; font-size: 30px; margin: 20px 0;">Nova</h1>

    <h2 style="color: #7e52f5; font-size: 26px; margin: 20px 0;">Se realizó una reserva:</h2>

    <p style="font-size: 18px; line-height: 1.6; color: #333;">
    El usuario {{ $reserva->user->name }}.
    </p>

    Resevo <b>{{ $reserva->service->title }}</b>.
    </div>
</div>
