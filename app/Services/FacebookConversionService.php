<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FacebookConversionService
{
    protected string $pixelId;
    protected string $accessToken;

    public function __construct()
    {
        $this->pixelId = env('FACEBOOK_PIXEL_ID');
        $this->accessToken = env('FACEBOOK_ACCESS_TOKEN');
    }

    public function sendEvent(array $eventData): array
    {
        $response = Http::post("https://graph.facebook.com/v18.0/{$this->pixelId}/events", [
            'data' => [$eventData],
            'access_token' => $this->accessToken,
            'test_event_code' => 'TEST86806'
        ]);
        info('FB RESPONSE', $response->json());

        return $response->json();
    }
}
