<?php

namespace App\Http\Controllers;



function createPayment($serviceId)
{
    // Crear instancia de MercadoPagoPayment
    $mercadoPago = new MercadoPagoPayment();

    // Obtener el servicio seleccionado
    $service = Service::findOrFail($serviceId);

    // Validar precio
    if (empty($service->price)) {
        abort(400, 'El precio del servicio no está configurado correctamente.');
    }

    $item = [
        [
            'id' => $service->id,
            'title' => $service->title,
            'quantity' => 1,
            'unit_price' => (float) $service->price, // Convertir a flotante
            'currency_id' => 'ARS',
        ]
    ];
    
    // Registrar los datos para depuración
    error_log("Items enviados: " . print_r($item, true));
    

    // Configurar los items y las URLs de retorno
    $mercadoPago->setItems($item);
    $mercadoPago->setBackUrls(
        route('mercadopago.success'),
        route('mercadopago.pending'),
        route('mercadopago.failure')
    );

    try {
        // Crear la preferencia de pago
        $preference = $mercadoPago->createPreference();

        // Registrar respuesta para depuración
        \Log::info('Respuesta de MercadoPago: ', $preference);

    } catch (\Exception $e) {
        \Log::error('Error al crear preferencia de MercadoPago: ' . $e->getMessage());
        abort(500, 'Error al procesar el pago.');
    }

    // Pasar los datos a la vista
    return view('pago.mercadopago', [
        'servicios' => [$service],
        'preference' => $preference,
        'mpPublicKey' => $mercadoPago->getPublicKey(),
    ]);
}
