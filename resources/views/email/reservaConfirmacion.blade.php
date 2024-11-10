<div style="font-family: sans-serif; max-width: 600px; margin: auto; background-color: #f9f9f9; padding: 20px; text-align: center; color: #333;">
    <div style="padding: 10px 0;">
        <img src="/img/logo_1.png" alt="Nova Logo" style="height: 50px;">
    </div>

    <h1 style="color: #333; font-size: 24px; margin: 20px 0;">¡Tu Reserva se Realizó con Éxito!</h1>
    <p style="font-size: 16px; line-height: 1.6;">
        Hola <b>{{ $reserva->user->name }}</b>,
    </p>
    <p style="font-size: 16px; line-height: 1.6;">
        Tu reserva para el servicio <b>{{ $reserva->service->title }}</b> se ha registrado exitosamente.
    </p>
    <p style="font-size: 16px; line-height: 1.6;">
        Guarda este correo como comprobante de tu reserva.
    </p>

    <div style="margin: 20px 0;">
        <a href="#" style="background-color: #ff5733; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-size: 16px;">Ver Detalles de tu Reserva</a>
    </div>

    <p style="font-size: 14px; color: #555;">
        Atentamente,<br>
        Tus amigos de <b>Nova</b>
    </p>
</div>
