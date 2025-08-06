<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Mockery\Exception;

class MoySkladOrderController extends Controller
{
    protected string $login;
    protected string $password;
    protected string $baseUrl = 'https://api.moysklad.ru/api/remap/1.2';

    public function __construct()
    {
        $this->login = env('MOY_SKLAD_LOGIN');
        $this->password = env('MOY_SKLAD_PASSWORD');
    }
    public function create(Request $request)
    {
        $client = new Client();

        $productName = $request->input('product_name');
        $quantity = $request->input('quantity', 1);

        // 1. Контрагент
        $counterpartyMeta = $this->getOrCreateCounterparty($client, $request);

        // 2. Поиск товара по названию
        $product = $this->findProductMeta($client, $productName);

        // 3. Создание заказа
        $orderData = [
            'name' => 'Заказ с сайта',
            'agent' => ['meta' => $counterpartyMeta],
            'positions' => [[
                'quantity' => (int)$quantity,
                'price' => $product['salePrices'][0]['value'] ?? 0,
                'assortment' => ['meta' => $product['meta']],
            ]]
        ];

        $response = $client->post("{$this->baseUrl}/entity/customerorder", [
            'headers' => $this->headers(),
            'json' => $orderData,
        ]);

        return response()->json([
            'message' => 'Заказ создан',
            'order' => json_decode($response->getBody(), true)
        ]);
    }
    public function createFromCart($shipping, $cartLines)
    {
        $client = new Client();

        $counterpartyMeta = $this->getOrCreateCounterpartyFromShipping($client, $shipping);
        $positions = [];

        foreach ($cartLines as $line) {
            $productName = $line->purchasable->getDescription();
            $quantity = $line->quantity;

            $product = Product::find($line->purchasable->product_id);

            $product = $this->findProductByName($client, $product->external_id);

            if (!$product) continue;

            $positions[] = [
                'quantity' => $quantity,
                'price' => $product['salePrices'][0]['value'] ?? 0,
                'assortment' => ['meta' => $product['meta']],
            ];
        }

        if (!empty($positions)) {
            try {
                $client->post("{$this->baseUrl}/entity/customerorder", [
                    'headers' => $this->headers(),
                    'json' => [
                        'name' => 'Заказ с сайта -'.now(),
                        'agent' => [
                            'meta' => $counterpartyMeta,
                        ],
                        'organization' => [
                            'meta' => [
                                'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/organization/13df5922-72a7-11f0-0a80-0411001478bc',
                                'type' => 'organization',
                                'mediaType' => 'application/json',
                            ]
                        ],
                        'positions' => $positions,
                        'attributes' => [
                            [
                                'meta' => [
                                    'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/customerorder/metadata/attributes/5ae32197-137c-11f0-0a80-0f430028acd1',
                                    'type' => 'attributemetadata',
                                    'mediaType' => 'application/json',
                                ],
                                'value' => [
                                    'meta' => [
                                        'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/customentity/e036d1dd-137b-11f0-0a80-0c530028d051/78a5a618-1389-11f0-0a80-18d6002a1b29',
                                        'metadataHref' => 'https://api.moysklad.ru/api/remap/1.2/context/companysettings/metadata/customEntities/e036d1dd-137b-11f0-0a80-0c530028d051',
                                        'type' => 'customentity',
                                        'mediaType' => 'application/json',
                                        'uuidHref' => 'https://online.moysklad.ru/app/#custom_e036d1dd-137b-11f0-0a80-0c530028d051/edit?id=78a5a618-1389-11f0-0a80-18d6002a1b29',
                                    ]
                                ]
                            ],
                            [
                                'meta' => [
                                    'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/customerorder/metadata/attributes/5ae32449-137c-11f0-0a80-0f430028acd2',
                                    'type' => 'attributemetadata',
                                    'mediaType' => 'application/json',
                                ],
                                'value' => [
                                    'meta' => [
                                        'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/customentity/09dc706b-137c-11f0-0a80-08fb00281b12/7f618277-137d-11f0-0a80-092100294f01',
                                        'metadataHref' => 'https://api.moysklad.ru/api/remap/1.2/context/companysettings/metadata/customEntities/09dc706b-137c-11f0-0a80-08fb00281b12',
                                        'type' => 'customentity',
                                        'mediaType' => 'application/json',
                                        'uuidHref' => 'https://online.moysklad.ru/app/#custom_09dc706b-137c-11f0-0a80-08fb00281b12/edit?id=7f618277-137d-11f0-0a80-092100294f01',
                                    ]
                                ]
                            ],
                            [
                                'meta' => [
                                    'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/customerorder/metadata/attributes/cf475876-1eb0-11f0-0a80-1aa7001fa5b1',
                                    'type' => 'attributemetadata',
                                    'mediaType' => 'application/json',
                                ],
                                'value' => [
                                    'meta' => [
                                        'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/customentity/cdb3f595-1eb0-11f0-0a80-0edf001e85e8/d97f45a1-1eb0-11f0-0a80-0676001f34aa',
                                        'metadataHref' => 'https://api.moysklad.ru/api/remap/1.2/context/companysettings/metadata/customEntities/cdb3f595-1eb0-11f0-0a80-0edf001e85e8',
                                        'type' => 'customentity',
                                        'mediaType' => 'application/json',
                                        'uuidHref' => 'https://online.moysklad.ru/app/#custom_cdb3f595-1eb0-11f0-0a80-0edf001e85e8/edit?id=d97f45a1-1eb0-11f0-0a80-0676001f34aa',
                                    ]
                                ]
                            ],
                            [
                                'meta' => [
                                    'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/customerorder/metadata/attributes/b2dee3c5-20ff-11f0-0a80-001d000d7a4d',
                                    'type' => 'attributemetadata',
                                    'mediaType' => 'application/json',
                                ],
                                'value' => [
                                    'meta' => [
                                        'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/customentity/4e5c9294-20ff-11f0-0a80-02b9000dd53e/faa7088f-3589-11f0-0a80-0b2c00134d20',
                                        'metadataHref' => 'https://api.moysklad.ru/api/remap/1.2/context/companysettings/metadata/customEntities/4e5c9294-20ff-11f0-0a80-02b9000dd53e',
                                        'type' => 'customentity',
                                        'mediaType' => 'application/json',
                                        'uuidHref' => 'https://online.moysklad.ru/app/#custom_4e5c9294-20ff-11f0-0a80-02b9000dd53e/edit?id=faa7088f-3589-11f0-0a80-0b2c00134d20',
                                    ]
                                ]
                            ],
                            [
                                'meta' => [
                                    'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/customerorder/metadata/attributes/b2dee6f3-20ff-11f0-0a80-001d000d7a4e',
                                    'type' => 'attributemetadata',
                                    'mediaType' => 'application/json',
                                ],
                                'value' => [
                                    'meta' => [
                                        'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/customentity/59b321cd-20ff-11f0-0a80-068700076658/f46e8f61-3589-11f0-0a80-03f60013e918',
                                        'metadataHref' => 'https://api.moysklad.ru/api/remap/1.2/context/companysettings/metadata/customEntities/59b321cd-20ff-11f0-0a80-068700076658',
                                        'type' => 'customentity',
                                        'mediaType' => 'application/json',
                                        'uuidHref' => 'https://online.moysklad.ru/app/#custom_59b321cd-20ff-11f0-0a80-068700076658/edit?id=f46e8f61-3589-11f0-0a80-03f60013e918',
                                    ]
                                ]
                            ],
                            [
                                'meta' => [
                                    'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/customerorder/metadata/attributes/b2dee826-20ff-11f0-0a80-001d000d7a4f',
                                    'type' => 'attributemetadata',
                                    'mediaType' => 'application/json',
                                ],
                                'value' => [
                                    'meta' => [
                                        'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/customentity/b081372d-20ff-11f0-0a80-1092000d4c92/cd299498-3589-11f0-0a80-00e00013e5f5',
                                        'metadataHref' => 'https://api.moysklad.ru/api/remap/1.2/context/companysettings/metadata/customEntities/b081372d-20ff-11f0-0a80-1092000d4c92',
                                        'type' => 'customentity',
                                        'mediaType' => 'application/json',
                                        'uuidHref' => 'https://online.moysklad.ru/app/#custom_b081372d-20ff-11f0-0a80-1092000d4c92/edit?id=cd299498-3589-11f0-0a80-00e00013e5f5',
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]);
            }catch (Exception $e){
                info($e->getMessage());
            }
        }
    }

    protected function getOrCreateCounterpartyFromShipping(Client $client, $shipping)
    {
        $search = $client->get("{$this->baseUrl}/entity/counterparty", [
            'headers' => $this->headers(),
            'query' => ['search' => $shipping->contact_phone]
        ]);

        $data = json_decode($search->getBody(), true);
        if (!empty($data['rows'][0]['meta'])) {
            return $data['rows'][0]['meta'];
        }

        $create = $client->post("{$this->baseUrl}/entity/counterparty", [
            'headers' => $this->headers(),
            'json' => [
                'name' => $shipping->first_name . ' ' . $shipping->last_name,
                'email' => '',
                'phone' => $shipping->contact_phone,
            ]
        ]);

        $created = json_decode($create->getBody(), true);
        return $created['meta'];
    }

    protected function findProductByName(Client $client, $name)
    {
        $response = $client->get("{$this->baseUrl}/entity/product", [
            'headers' => $this->headers(),
            'query' => ['search' => $name],
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['rows'][0] ?? null;
    }
    protected function findProductMeta(Client $client, string $productName)
    {
        $response = $client->get("{$this->baseUrl}/entity/product", [
            'headers' => $this->headers(),
            'query' => ['search' => $productName]
        ]);

        $data = json_decode($response->getBody(), true);

        if (empty($data['rows'])) {
            abort(404, 'Товар не найден в МойСклад');
        }

        return $data['rows'][0]; // первый найденный товар
    }
    protected function getOrCreateCounterparty(Client $client, Request $request)
    {
        $email = $request->input('email');
        $phone = $request->input('phone');
        $name = $request->input('name');

        // Поиск по email
        $search = $client->get($this->baseUrl . '/entity/counterparty', [
            'headers' => $this->headers(),
            'query' => ['search' => $email],
        ]);

        $data = json_decode($search->getBody(), true);
        if (!empty($data['rows'][0]['meta'])) {
            return $data['rows'][0]['meta'];
        }

        // Если не найден — создать
        $create = $client->post($this->baseUrl . '/entity/counterparty', [
            'headers' => $this->headers(),
            'json' => [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
            ],
        ]);

        $created = json_decode($create->getBody(), true);
        return $created['meta'];
    }

    protected function getProductMeta(Client $client, string $productId)
    {
        $response = $client->get($this->baseUrl . '/entity/product/' . $productId, [
            'headers' => $this->headers(),
        ]);

        return json_decode($response->getBody(), true);
    }

    protected function headers(): array
    {
        return [
            'Authorization' => 'Basic ' . base64_encode("{$this->login}:{$this->password}"),
            'Content-Type' => 'application/json;charset=utf-8',
            'Accept-Encoding' => 'gzip',
        ];
    }
}
