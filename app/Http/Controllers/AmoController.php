<?php

namespace App\Http\Controllers;

use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Collections\Leads\LeadsCollection;
use AmoCRM\Models\LeadModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\OAuth2\Client\Token\AccessToken;

class AmoController extends Controller
{
    protected AmoCRMApiClient $client;

    public function __construct()
    {
        $this->client = new AmoCRMApiClient(
            config('services.amocrm.client_id'),        // можно любой, если не используется
            config('services.amocrm.client_secret'),    // можно любой
            config('services.amocrm.redirect_uri')      // можно любой
        );

        $token = new AccessToken([
            'access_token'  => config('services.amocrm.access_token'),
            'expires'       => time() + 3600 * 24 * 365, // фиктивный срок, например 1 год
            'refresh_token' => '',                       // не нужен
            'baseDomain'    => config('services.amocrm.base_domain'),
        ]);

        $this->client->setAccountBaseDomain(config('services.amocrm.base_domain'));
        $this->client->setAccessToken($token);
    }

    public function createLead(string $name, int $price = 0): void
    {
        $lead = new LeadModel();
        $lead->setName($name)->setPrice($price)->setPipelineId(9737022)->setStatusId(77583890);


        $leads = new LeadsCollection();
        $leads->add($lead);

        $this->client->leads()->add($leads);
    }
    public function pipes()
    {
        $pipelines = $this->client->pipelines()->get();

        foreach ($pipelines as $pipeline) {
            echo "PIPELINE: " . $pipeline->getName() . " | ID: " . $pipeline->getId() . PHP_EOL;

            foreach ($pipeline->getStatuses() as $status) {
                echo "- STAGE: " . $status->getName() . " | ID: " . $status->getId() . PHP_EOL;
            }
        }

    }

}
