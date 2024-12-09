<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Payment\MercadoPagoPayment;
use Illuminate\Http\Request;

class MercadoPagoController extends Controller
{
    public function createPayment($serviceId)
    {
        $mercadoPago = new MercadoPagoPayment();
        
        $service = Service::findOrFail($serviceId);
        
        $item = [
            [
                'id' => $service->id,
                'title' => $service->title,
                'quantity' => 1,
                'unit_price' => $service->price,
                'currency_id' => 'ARS',
            ]
        ];
    
        $mercadoPago->setItems($item);
        $mercadoPago->setBackUrls(
            route('mercadopago.success'), 
            route('mercadopago.pending'), 
            route('mercadopago.failure')  
        );
    
        $preference = $mercadoPago->createPreference();
    
        return view('pago.mercadopago', [
            'servicios' => [$service],
            'preference' => $preference,
            'mpPublicKey' => $mercadoPago->getPublicKey(),
        ]);
    }

    public function successProcess(Request $request)
    {
        dd($request->query);
    }

    // Procesar el pago pendiente
    public function pendingProcess(Request $request)
    {
        dd($request->query);
    }

    public function failureProcess(Request $request)
    {
        dd($request->query);
    }
}
