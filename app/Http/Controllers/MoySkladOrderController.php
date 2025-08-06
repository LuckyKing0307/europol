<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;

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
            $client->post("{$this->baseUrl}/entity/customerorder", [
                'headers' => $this->headers(),
                'json' => [
                    'name' => 'Заказ с сайта',
                    'agent' => ['meta' => $counterpartyMeta],
                    'positions' => $positions,
                ]
            ]);
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
