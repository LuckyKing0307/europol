<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FacebookConversionService
{
    protected string $pixelId;
    protected string $accessToken;

    public function __construct()
    {
        $this->pixelId = config('services.facebook.pixel_id');
        $this->accessToken = config('services.facebook.access_token');
    }

    public function sendEvent(array $eventData): array
    {
        $response = Http::post("https://graph.facebook.com/v18.0/{$this->pixelId}/events", [
            'data' => [$eventData],
            'access_token' => $this->accessToken,
        ]);

        return $response->json();
    }
}
