<?php

namespace App\Http\Controllers;

use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Collections\Leads\LeadsCollection;
use AmoCRM\Models\LeadModel;
use Illuminate\Http\Request;
use League\OAuth2\Client\Token\AccessToken;

class AmoController extends Controller
{
    //
    protected AmoCRMApiClient $client;


    public function createLead($order)
    {
        $lead = new LeadModel();
        $lead->setName("Заказ №{$order->id}")
            ->setPrice($order->total_price);

        $leadsCollection = new LeadsCollection();
        $leadsCollection->add($lead);

        $leadsService = $this->client->leads();
        $leadsService->add($leadsCollection);
    }
    public function redirectToAmo()
    {
        $apiClient = new AmoCRMApiClient(
            config('services.amocrm.client_id'),
            config('services.amocrm.client_secret'),
            config('services.amocrm.redirect_uri')
        );

        $apiClient->setAccountBaseDomain(config('services.amocrm.base_domain'));

        $state = bin2hex(random_bytes(16));
        session()->put('oauth2state', $state);

        $authUrl = $apiClient->getOAuthClient()->getAuthorizeUrl([
            'state' => $state,
            'mode' => 'post_message',
        ]);

        return redirect($authUrl);
    }

    public function handleCallback(Request $request)
    {
        $state = session('oauth2state');
        if (empty($request->state) || $request->state !== $state) {
            abort(403, 'Invalid state');
        }

        $apiClient = new AmoCRMApiClient(
            config('services.amocrm.client_id'),
            config('services.amocrm.client_secret'),
            config('services.amocrm.redirect_uri')
        );

        $apiClient->setAccountBaseDomain(config('services.amocrm.base_domain'));

        $accessToken = $apiClient->getOAuthClient()->getAccessTokenByCode($request->code);

        // 📌 ВЫВЕДИ ТОКЕНЫ В КОНСОЛЬ ИЛИ СОХРАНИ В .env/.db
        dd([
            'access_token' => $accessToken->getToken(),
            'refresh_token' => $accessToken->getRefreshToken(),
            'expires' => $accessToken->getExpires(),
        ]);
    }

}
