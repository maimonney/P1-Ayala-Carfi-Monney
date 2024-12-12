<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Payment\MercadoPagoPayment;
use Illuminate\Http\Request;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;


class MercadoPagoController extends Controller
{
    public function show(Request $request)
    {
        $serviceIds = $request->input('ids', []);
        $services = Service::whereIn('id', $serviceIds)->get();

        $items = [];
        foreach ($services as $service) {
            $items[] = [
                'id' => $service->id,
                'title' => $service->title,
                'unit_price' => floatval($service->price),
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
                    'success' => route('mercadopago.success'),
                    'pending' => route('mercadopago.pending'),
                    'failure' => route('mercadopago.failure'),
                ],
                'auto_return' => 'approved',
            ]);
        } catch (\Throwable $e) {
            dd($e);
        }

        return view('pago.mercadopago', [
            'servicios' => $services,
            'preference' => $preference,
            'mpPublicKey' => config('mercadopago.public_key'),
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
