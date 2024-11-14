<div style=" font-family: Arial, sans-serif; max-width: 600px; background-color: #fdf0f5; border: 2px solid #7e52f5; border-radius: 15px; padding: 20px; text-align: center;">
    <div style="padding: 15px 0;">
        <img src="/img/logo_1.png" alt="Nova Logo" style="height: 60px; margin-bottom: 15px;">
    </div>

    <h1 style="color: #7e52f5; font-size: 26px; margin: 20px 0;">¡Reserva Confirmada!</h1>

    <p style="font-size: 18px; line-height: 1.6; color: #333;">
        Hola <b>{{ $reserva->user->name }}</b>,
    </p>

    <p style="font-size: 16px; line-height: 1.6; color: #555;">
        Nos complace informarte que tu reserva para el servicio <b>{{ $reserva->service->title }}</b> ha sido registrada con éxito.
    </p>

    <p style="font-size: 16px; line-height: 1.6; color: #555;">
        Guarda este correo como comprobante de tu reserva. ¡Gracias por confiar en nosotros!
    </p>

    <div style="margin: 25px 0;">
        <a href="#" style="display: inline-block; border: 1px solid #7e52f5; border-radius: 10px; padding: 12px 25px; text-decoration: none; font-weight: bold; background-color: #7e52f5; color: #fff; font-size: 16px; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.15);">
            Ver Detalles de tu Reserva
        </a>
    </div>

    <p style="font-size: 14px; color: #777;">
        Atentamente,<br>
        <b>El equipo de Nova</b>
    </p>
</div>
