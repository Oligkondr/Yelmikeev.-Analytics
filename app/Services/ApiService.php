<?php

namespace App\Services;

use App\Models\Account;
use Exception;
use Illuminate\Console\OutputStyle;
use Illuminate\Support\Facades\Http;

class ApiService
{
    protected string $baseUrl;
    protected string $apiKey;

    private ?OutputStyle $output;

    /**
     * @throws Exception
     */
    public function __construct(Account $account)
    {
        if ($account->exists) {
            if ($account->apiServiceTokenType->tokenType->name != 'api-key') {
                throw new Exception('Тип токена должен быть api-key');
            }

            $this->baseUrl = $account->apiServiceTokenType->apiService->url;
            $this->apiKey = $account->token;
        }
    }

    public function setOutput(OutputStyle $output): void
    {
        $this->output = $output;
    }

    /**
     * @throws Exception
     */
    public function getSales(array $params = []): array
    {
        return $this->makeRequest('api/sales', $params);
    }

    /**
     * @throws Exception
     */
    public function getOrders(array $params = []): array
    {
        return $this->makeRequest('api/orders', $params);
    }

    /**
     * @throws Exception
     */
    public function getStocks(array $params = []): array
    {
        return $this->makeRequest('api/stocks', $params);
    }

    /**
     * @throws Exception
     */
    public function getIncomes(array $params = []): array
    {
        return $this->makeRequest('api/incomes', $params);
    }

    /**
     * @throws Exception
     */
    protected function makeRequest(string $endpoint, array $params = []): array
    {
        $params['key'] = $this->apiKey;

        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])
            ->retry(5, function ($exception) {
                if ($exception->response->hasHeader('Retry-After')) {
                    return $exception->response->header('Retry-After') * 1000;
                }
                return 5000;
            }, function ($exception) {

                $this->output?->warning("Code: {$exception->response->status()}. Retrying...");

                return $exception->response->status() === 429;
            })
            ->get("{$this->baseUrl}/{$endpoint}", $params);

        $json = $response->json();

        if ($response->successful()) {
            return $json;
        }

        throw new Exception($json['message'] ?? "Request failed with status: {$response->status()}");
//        dd($response->headers());
    }
}
