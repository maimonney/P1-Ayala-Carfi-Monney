<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Payment\MercadoPagoPayment;
use Illuminate\Http\Request;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Resources\Preference;
use MercadoPago\Resources\Item;

class MercadoPagoController extends Controller
{

    //Pruebas
    public function show()
    {
        $services = Service::whereIn('id', [1, 3])->get();
        $items = [];
        foreach($services as $service) {
            $items[] = [
                'id' => $service->id,
                'title' => $service->title,
                'unit_price' => round($service->price, 2),
                'quantity' => 1,
                'currency_id' => 'ARS',
            ];
        }

        try {
            MercadoPagoConfig::setAccessToken(config('mercadopago.access_token'));
            $preferenceFactory = new PreferenceClient;
            $preference = $preferenceFactory->create([
                'items' => $items,
                'back_urls' => [
                    'success' => route('test.mercadopago.successProcess'),
                    'pending' => route('test.mercadopago.pendingProcess'),
                    'failure' => route('test.mercadopago.failureProcess'),
                ],
                'auto_return' => 'approved',
            ]);
        } catch (\Throwable $e) {
            dd($e);
        }

        return view('test.mercadopago', [
            'servicios' => $services,
            'preference' => $preference,
            'mpPublicKey' => config('mercadopago.public_key') 
        ]);
    }

    public function showV2()
    {
        $services = Service::whereIn('id', [1, 3])->get();

        $items = [];

        foreach($services as $service) {
            $items[] = [
                'id' => $service->Service_id,
                'title' => $service->title,
                'unit_price' => $service->price,
                'quantity' => 1,
            ];
        }

        try {
            $payment = new MercadoPagoPayment;
            $payment->setItems($items);
            $payment->setBackUrls(
                success: route('test.mercadopago.successProcess'),
                pending: route('test.mercadopago.pendingProcess'),
                failure: route('test.mercadopago.failureProcess'),
            );
            $payment->withAutoReturn();

            $preference = $payment->createPreference();
        } catch (\Throwable $e) {
            dd($e);
        }

        return view('test.mercadopago', [
            'Services' => $services,
            'preference' => $preference,
            'mpPublicKey' => $payment->getPublicKey(),
        ]);
    }

    //Crear el pago para un servicio específico
    public function createPayment($serviceId)
    {
        // Obtener el servicio por su ID
        $service = Service::findOrFail($serviceId);
    
        // Crear el item para Mercado Pago
        $item = new Item();
        $item->id = $service->id;
        $item->title = $service->title;
        $item->quantity = 1;
        $item->unit_price = $service->price;
        $item->currency_id = 'ARS';
    
        // Crear la preferencia de pago
        $preference = new Preference();
        $preference->items = [$item];
        $preference->back_urls = [
            'success' => route('mercadopago.success'),
            'pending' => route('mercadopago.pending'),
            'failure' => route('mercadopago.failure')
        ];
        $preference->auto_return = "approved"; 
        $preference->save();
    
        // Redirigir al usuario a Mercado Pago
        return redirect()->to($preference->init_point);
    }

    public function successProcess(Request $request)
    {
        dd($request->query);
    }

    public function pendingProcess(Request $request)
    {
        dd($request->query);
    }

    public function failureProcess(Request $request)
    {
        dd($request->query);
    }
}


