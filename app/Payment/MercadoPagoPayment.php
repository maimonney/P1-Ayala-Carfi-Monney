<?php

namespace App\Payment;

use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Resources\Preference;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class MercadoPagoPayment
{
    private string $accessToken;
    private string $publicKey;
    private array $items = [];
    private array $backUrls = [];
    private bool $autoReturn = false;

    public function __construct()
    {
        $this->accessToken = $this->getAccessToken();
        $this->publicKey = config('mercadopago.public_key');

        if (strlen($this->accessToken) == 0)
            throw new \Exception('No está definido el token de acceso de Mercado Pago. Creá la clave MERCADOPAGO_ACCESS_TOKEN en el [.env].');
        if (strlen($this->publicKey) == 0)
            throw new \Exception('No está definida la clave pública de Mercado Pago. Creá la clave MERCADOPAGO_PUBLIC_KEY en el [.env].');

        MercadoPagoConfig::setAccessToken($this->accessToken);
    }

    private function getAccessToken(): string
    {
        // Verificar si el token está en caché y si aún es válido
        if ($token = Cache::get('mercadopago_access_token')) {
            return $token;
        }

        // Si no está en caché o es inválido, renovarlo
        $this->refreshAccessToken();
        return Cache::get('mercadopago_access_token'); // Regresar el token recién renovado
    }

    private function refreshAccessToken()
    {
        // Realizar la solicitud para renovar el token utilizando el refresh_token
        $response = Http::asForm()->post('https://api.mercadopago.com/v1/oauth/token', [
            'grant_type' => 'refresh_token',
            'client_id' => config('mercadopago.client_id'),
            'client_secret' => config('mercadopago.client_secret'),
            'refresh_token' => config('mercadopago.refresh_token'),  // Asegúrate de tener el refresh_token en el .env
        ]);

        if ($response->failed()) {
            throw new \Exception('Error al renovar el token de acceso de Mercado Pago: ' . $response->body());
        }

        // Obtener el nuevo access_token y almacenarlo en caché
        $newAccessToken = $response->json()['access_token'];
        Cache::put('mercadopago_access_token', $newAccessToken, now()->addHour());  // Guardar en cache por 1 hora

        $this->accessToken = $newAccessToken;  // Asignar el nuevo token
    }

    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    public function setItems(array $items)
    {
        $this->items = $items;
    }

    public function setBackUrls(
        ?string $success = null,
        ?string $pending = null,
        ?string $failure = null
    ) {
        if (is_string($success))
            $this->backUrls['success'] = $success;
        if (is_string($pending))
            $this->backUrls['pending'] = $pending;
        if (is_string($failure))
            $this->backUrls['failure'] = $failure;
    }

    public function withAutoReturn()
    {
        $this->autoReturn = true;
    }

    public function createPreference(): Preference
    {
        if (count($this->items) == 0)
            throw new \Exception('Hay que definir los items del cobro. Usá el método setItems() para asignarlos.');

        $config = [
            'items' => $this->items,
        ];
        if (count($this->backUrls))
            $config['back_urls'] = $this->backUrls;
        if ($this->autoReturn)
            $config['auto_return'] = 'approved';

        $preferenceFactory = new PreferenceClient();
        return $preferenceFactory->create($config);
    }
}
