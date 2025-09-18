<?php

namespace App\Console\Commands;

use App\Models\Income;
use App\Models\Order;
use App\Models\Sale;
use App\Models\Stock;
use App\Services\ApiService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class GetDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-data-command {target}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Getting api data (sales|orders|stocks|incomes).';

    private ApiService $apiService;

    public function __construct(ApiService $apiService)
    {
        parent::__construct();

        $this->apiService = $apiService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $target = $this->argument('target');

        switch ($target) {
            case 'sales':
                $this->salesHandler();
                break;

            case 'orders':
                $this->ordersHandler();
                break;

            case 'stocks':
                $this->stocksHandler();
                break;

            case 'incomes':
                $this->incomesHandler();
                break;

            default:
                $this->error("Unknown target: {$target}");
                $this->info('Available targets: sales, orders, stocks, incomes');
        }
    }

    private function salesHandler()
    {
        $page = 1;

        do {
            $this->info("Page: {$page}");

            $response = $this->apiService->getSales([
                'dateFrom' => '2000-01-01',
                'dateTo' => '2030-01-01',
                'page' => $page++,
            ]);

            $data = $response['data'];

            foreach ($data as $item) {
                Sale::create($item);
            }

            usleep(500000);
        } while ($page <= $response['meta']['last_page']);
    }

    private function ordersHandler()
    {
        $page = 1;

        do {
            $this->info("Page: {$page}");

            $response = $this->apiService->getOrders([
                'dateFrom' => '2000-01-01',
                'dateTo' => '2030-01-01',
                'page' => $page++,
            ]);

            $data = $response['data'];

            foreach ($data as $item) {
                Order::create($item);
            }

            usleep(250000);
        } while ($page <= $response['meta']['last_page']);
    }

    private function stocksHandler()
    {
        $page = 1;

        do {
            $this->info("Page: {$page}");

            $response = $this->apiService->getStocks([
                'dateFrom' => Carbon::today()->format('Y-m-d'),
                'page' => $page++,
            ]);

            $data = $response['data'];

            foreach ($data as $item) {
                Stock::create($item);
            }

            usleep(250000);
        } while ($page <= $response['meta']['last_page']);
    }

    private function incomesHandler()
    {
        $page = 1;

        do {
            $this->info("Page: {$page}");

            $response = $this->apiService->getIncomes([
                'dateFrom' => '2000-01-01',
                'dateTo' => '2030-01-01',
                'page' => $page++,
            ]);

            $data = $response['data'];

            foreach ($data as $item) {
                Income::create($item);
            }

            usleep(250000);
        } while ($page <= $response['meta']['last_page']);
    }
}
