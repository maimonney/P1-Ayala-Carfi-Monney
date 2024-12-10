<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Payment\MercadoPagoPayment;
use Illuminate\Http\Request;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;


class MercadoPagoController extends Controller
{
    public function show()
    {
        //buscamos un par de peliculas, para "cobrar" en mercadopago
        $movies = Movie::whereIn('movie_id', [1,3])->get();

        //Integracion con mercadopago
        //preparamos el array con los de los items que pide mercado pago

        $items = [];
        foreach ($movies as $movie) {
            $items[] = [
                'id' => $movie->movie_id,
                'title' => $movie->title,
                'unit_price' => $movie->price,
                'quantity' => 1,
            ];
        }

        try {
            // Definimos el token de acceso de nuestra cuenta.
            // MercadoPagoConfig::setAccessToken('TEST-7052259735376127-062318-5ee062a572d7bded73a78db9156f7488-489709238');
            // MercadoPagoConfig::setAccessToken('APP_USR-5043631339098900-051021-96b2d63bb61cedb1ee7ef3ccfe23cdea-1806163993');
            // MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));
            MercadoPagoConfig::setAccessToken(config('mercadopago.acces_token'));

            //iniciamos nuestro "factory" de preferencia de (cobros)
            $preferenceFactory = new PreferenceClient;

            // Creamos la preferencia usando el método create() del factory.
            // Este método recibe un array de configuración.
            // Este array de configuración debe tener al menos una clave "items" que contenga
            // un array con los datos de los ítems a facturar.
            // Cada ítem debe tener al menos 3 claves: 'title', 'unit_price', 'quantity'.
            $preference = $preferenceFactory->create([
                'items' => $items,
                // Configuramos las back_urls
                'back_urls' => [
                    'success' => route('test.mercadopago.successProcess'),
                    'pending' => route('test.mercadopago.pendingProcess'),
                    'failure' => route('test.mercadopago.failureProcess'),
                ],
                'auto_return' => 'approved',
            ]);
        } catch(\Throwable $e){
            dd($e);
        }

        return view('test.mercadopago',[
            'movies' => $movies,
            'preference' => $preference,
            //pasamos la clavepublica para poder agregarla en la conexion con JS.
            'mpPublicKey' => config('mercadopago.public_key')
        ]);
    }

    public function showV2()
    {

        // Buscamos un par de películas simulando un carrito de compras. Esto es lo que vamos
        // para "cobrar" con Mercado Pago.
        $movies = Movie::whereIn('movie_id', [1, 3])->get();

        // Integración con Mercado Pago.
        // Preparamos un array con los datos de los ítems con el formato que pide Mercado Pago.
        $items = [];

        foreach($movies as $movie) {
            $items[] = [
                'id' => $movie->movie_id,
                'title' => $movie->title,
                'unit_price' => $movie->price,
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
        } catch(\Throwable $e) {
            dd($e);
        }

        return view('test.mercadopago', [
            'movies' => $movies,
            'preference' => $preference,
            // Pasamos la clave pública para poder agregarla en la conexión de JS.
            'mpPublicKey' => $payment->getPublicKey(),
        ]);

    }

    public function successProcess(Request $request)
    {
        // En esta ruta podríamos mostrar un mensaje de éxito al usuario de que su compra
        // fue realizada con éxito.
        // Vamos a recibir en el query string varios datos sobre la operación en Mercado Pago,
        // como id de operación.
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
