<?php

namespace App\Console\Commands;

use App\Models\Account;
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
    protected $signature = 'data:get {target} {--acc-id=} {--yesterday}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Getting API data (sales|orders|stocks|incomes).';

    private ApiService $apiService;
    private Account $account;
    private string $dateFrom;
    private string $dateTo;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $accountId = $this->option('acc-id');

        try {
            $this->account = Account::findOrFail($accountId);
            $this->apiService = new ApiService($this->account);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            exit();
        }

        $this->apiService->setOutput($this->getOutput());

        $target = $this->argument('target');

        $this->dateFrom = $this->option('yesterday')
            ? Carbon::yesterday()->format('Y-m-d')
            : Carbon::today()->format('Y-m-d');
        $this->dateTo = Carbon::tomorrow()->format('Y-m-d');

        switch ($target) {
            case 'sales':
                $this->processSales();
                break;
            case 'orders':
                $this->processOrders();
                break;
            case 'stocks':
                $this->processStocks();
                break;
            case 'incomes':
                $this->processIncomes();
                break;
            default:
                $this->error("Unknown target: {$target}");
                $this->info('Available targets: sales, orders, stocks, incomes');
                break;
        }
    }

    private function processSales()
    {
        $page = 1;

        do {
            $this->info("Processing sales - Page: {$page}");

            $params = [
                'dateFrom' => $this->dateFrom,
                'dateTo' => $this->dateTo,
                'page' => $page++,
            ];

            $response = $this->apiService->getSales($params);
            $data = $response['data'];

            foreach ($data as $item) {
                $sale = Sale::query()
                    ->where('sale_id', $item['sale_id'])
                    ->where('account_id', $this->account->id)
                    ->first();

                if (!$sale) {
                    Sale::create($item + [
                            'account_id' => $this->account->id,
                        ]);
                }
            }

        } while ($page <= $response['meta']['last_page']);
    }

    private function processOrders()
    {
        $dateFrom = $this->option('yesterday')
            ? Carbon::yesterday()->format('Y-m-d 12:00:00')
            : Carbon::today()->format('Y-m-d 00:00:00');
        $dateTo = $this->option('yesterday')
            ? Carbon::today()->format('Y-m-d 00:00:00')
            : Carbon::today()->format('Y-m-d 12:00:00');

        $page = 1;

        do {
            $this->info("Processing orders - Page: {$page}");

            $params = [
                'dateFrom' => $this->dateFrom,
                'dateTo' => $this->dateTo,
                'page' => $page++,
            ];

            $response = $this->apiService->getOrders($params);
            $data = $response['data'];

            foreach ($data as $item) {
                $date = Carbon::createFromTimeString($item['date']);

                if ($date->gt($dateFrom) && $date->lte($dateTo)) {
                    Order::create($item + [
                            'account_id' => $this->account->id,
                        ]);
                }
            }

        } while ($page <= $response['meta']['last_page']);
    }

    private function processStocks()
    {
        $page = 1;

        do {
            $this->info("Processing stocks - Page: {$page}");

            $params = [
                'dateFrom' => $this->dateFrom,
                'page' => $page++,
            ];

            $response = $this->apiService->getStocks($params);
            $data = $response['data'];

            foreach ($data as $item) {
                $stock = Stock::query()
                    ->where('supplier_article', $item['supplier_article'])
                    ->where('warehouse_name', $item['warehouse_name'])
                    ->where('last_change_date', $item['last_change_date'])
                    ->where('account_id', $this->account->id)
                    ->first();

                if (!$stock) {
                    Stock::create($item + [
                            'account_id' => $this->account->id,
                        ]);
                }
            }

        } while ($page <= $response['meta']['last_page']);
    }

    private function processIncomes()
    {
        $page = 1;

        do {
            $this->info("Processing incomes - Page: {$page}");

            $params = [
                'dateFrom' => $this->dateFrom,
                'dateTo' => $this->dateTo,
                'page' => $page++,
            ];

            $response = $this->apiService->getIncomes($params);
            $data = $response['data'];

            foreach ($data as $item) {
                $income = Income::query()
                    ->where('income_id', $item['income_id'])
                    ->where('account_id', $this->account->id)
                    ->first();

                if (!$income) {
                    Income::create($item + [
                            'account_id' => $this->account->id,
                        ]);
                }
            }

        } while ($page <= $response['meta']['last_page']);
    }
}
