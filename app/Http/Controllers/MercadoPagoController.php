<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Payment\MercadoPagoPayment;
use Illuminate\Http\Request;

class MercadoPagoController extends Controller
{
    // Método para crear el pago
    public function createPayment($serviceId)
    {
        // Crear instancia de MercadoPagoPayment
        $mercadoPago = new MercadoPagoPayment();
        
        // Obtener el servicio seleccionado
        $service = Service::findOrFail($serviceId);
        
        // Configuración de los items para la preferencia
        $item = [
            [
                'id' => $service->id,
                'title' => $service->title,
                'quantity' => 1,
                'unit_price' => $service->price,
                'currency_id' => 'ARS',
            ]
        ];
    
        // Configurar los items y las URLs de retorno
        $mercadoPago->setItems($item);
        $mercadoPago->setBackUrls(
            route('mercadopago.success'), // URL de éxito
            route('mercadopago.pending'), // URL de pendiente
            route('mercadopago.failure')  // URL de fallo
        );
    
        // Crear la preferencia de pago
        $preference = $mercadoPago->createPreference();
    
        // Pasar los datos a la vista
        return view('pago.mercadopago', [
            'servicios' => [$service],  // Solo pasar el servicio seleccionado
            'preference' => $preference,
            'mpPublicKey' => $mercadoPago->getPublicKey(),
        ]);
    }

    // Procesar el éxito del pago
    public function successProcess(Request $request)
    {
        // Aquí se procesan los datos enviados por Mercado Pago en caso de éxito
        dd($request->query); // Puedes hacer un dump de la respuesta o registrar los datos.
        // También puedes actualizar el estado del pago en la base de datos
        // Ejemplo:
        // Payment::where('id', $request->query['payment_id'])->update(['status' => 'approved']);
    }

    // Procesar el pago pendiente
    public function pendingProcess(Request $request)
    {
        // Aquí se procesan los datos enviados por Mercado Pago en caso de que el pago esté pendiente
        dd($request->query);
        // Actualizar el estado del pago en la base de datos como "pendiente"
    }

    // Procesar el fallo del pago
    public function failureProcess(Request $request)
    {
        // Aquí se procesan los datos enviados por Mercado Pago en caso de fallo
        dd($request->query);
        // Puedes actualizar el estado del pago como "fallido"
    }
}
