<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Payment\MercadoPagoPayment;
use Illuminate\Http\Request;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;


class MercadoPagoController extends Controller
{
    public function show()
    {
        $servicios = Service::whereIn('id', [1,3])->get();

        $items = [];
        foreach ($servicios as $servicio) {
            $items[] = [
                'id' => $servicio->id,
                'title' => $servicio->title,
                'unit_price' => $servicio->price,
                'quantity' => 1,
            ];
        }

        try {
            MercadoPagoConfig::setAccessToken(config('mercadopago.acces_token'));

            $preferenceFactory = new PreferenceClient;

            $preference = $preferenceFactory->create([
                'items' => $items,
                'back_urls' => [
        'success' => route('mercadopago.success'),
        'pending' => route('mercadopago.pending'),
        'failure' => route('mercadopago.failure'),
    ],
                'auto_return' => 'approved',
            ]);
        } catch(\Throwable $e){
            dd($e);
        }

        return view('test.mercadopago',[
            'servicios' => $servicios,
            'preference' => $preference,
            'mpPublicKey' => config('mercadopago.public_key')
        ]);
    }

    public function showV2()
    {
        $servicios = Service::whereIn('id', [1, 3])->get();

        $items = [];

        foreach($servicios as $servicio) {
            $items[] = [
                'id' => $servicio->id,
                'title' => $servicio->title,
                'unit_price' => $servicio->price,
                'quantity' => 1,
            ];
        }

        try {
            $payment = new MercadoPagoPayment;
            $payment->setItems($items);
            $payment->setBackUrls(
                success: route('mercadopago.success'),
                pending: route('mercadopago.pending'),
                failure: route('mercadopago.failure')
            );
            $payment->withAutoReturn();

            $preference = $payment->createPreference();
        } catch(\Throwable $e) {
            dd($e);
        }

        return view('test.mercadopago', [
            'servicios' => $servicios,
            'preference' => $preference,
            'mpPublicKey' => $payment->getPublicKey(),
        ]);

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
