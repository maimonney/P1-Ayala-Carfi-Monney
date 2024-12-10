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
            throw new \Exception('No está definido el token de acceso de Mercado Pago. Creá la clave access_token en el [.env].');
        if (strlen($this->publicKey) == 0)
            throw new \Exception('No está definida la clave pública de Mercado Pago. Creá la clave MERCADOPAGO_PUBLIC_KEY en el [.env].');

        MercadoPagoConfig::setAccessToken($this->accessToken);
    }

    private function getAccessToken(): string
    {
        if ($token = Cache::get('access_token')) {
            return $token;
        }
        $this->refreshAccessToken();
        return Cache::get('access_token');
    }

    private function refreshAccessToken()
    {
        $response = Http::asForm()->post('https://api.mercadopago.com/oauth/token', [
            'grant_type' => 'refresh_token',
            'client_id' => config('mercadopago.client_id'),
            'client_secret' => config('mercadopago.client_secret'),
            'refresh_token' => config('mercadopago.refresh_token'),
        ]);

        if ($response->failed()) {
            \Log::error('Error al renovar el token de acceso de Mercado Pago', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            throw new \Exception('Error al renovar el token de acceso de Mercado Pago. Por favor, revisa las credenciales o el refresh_token.');
        }

        $newAccessToken = $response->json()['access_token'];
        $newRefreshToken = $response->json()['refresh_token'];

        // Almacena los nuevos tokens en caché
        Cache::put('access_token', $newAccessToken, now()->addHour());
        Cache::put('refresh_token', $newRefreshToken, now()->addDays(30)); // Si aplica

        // Actualiza las variables locales
        $this->accessToken = $newAccessToken;

        // Actualiza los valores en el archivo .env
        $this->updateEnv('MERCADOPAGO_ACCESS_TOKEN', $newAccessToken);
        $this->updateEnv('MERCADOPAGO_REFRESH_TOKEN', $newRefreshToken);
    }

    private function updateEnv($key, $value)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            file_put_contents($path, preg_replace(
                "/^{$key}=.*/m",
                "{$key}={$value}",
                file_get_contents($path)
            ));
        }
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
