<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService
{
    protected string $baseUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.api.url');
        $this->apiKey = config('services.api.key');
    }

    /**
     * @throws \Exception
     */
    public function getSales(array $params = []): array
    {
        return $this->makeRequest('api/sales', $params);
    }

    /**
     * @throws \Exception
     */
    public function getOrders(array $params = []): array
    {
        return $this->makeRequest('api/orders', $params);
    }

    /**
     * @throws \Exception
     */
    public function getStocks(array $params = []): array
    {
        return $this->makeRequest('api/stocks', $params);
    }

    /**
     * @throws \Exception
     */
    public function getIncomes(array $params = []): array
    {
        return $this->makeRequest('api/incomes', $params);
    }

    /**
     * @throws \Exception
     */
    protected function makeRequest(string $endpoint, array $params = []): array
    {
        $params['key'] = $this->apiKey;
        $params['limit'] = 100;

        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->get("{$this->baseUrl}/{$endpoint}", $params);

        $json = $response->json();

        if ($response->successful()) {
            return $json;
        }

        throw new \Exception($json['message']);
    }
}
