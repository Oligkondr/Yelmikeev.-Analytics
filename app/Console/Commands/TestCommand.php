<?php

namespace App\Console\Commands;

use App\Services\ApiService;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $apiService = new ApiService();

        $this->salesHandler([$apiService, 'getSales'], [
            'dateFrom' => '2000-01-01',
            'dateTo' => '2030-01-01',
            'page' => 1,
        ]);
    }

    public function salesHandler(callable $function, array $params)
    {
        $this->info('Test command');

        do {
            $this->info("Page: {$params['page']}");

            $response = $function($params);

            $params['page']++;

            $data = $response['data'];

            foreach ($data as $item) {
                dd($item);
            }

            usleep(500000);
        } while ($params['page'] <= $response['meta']['last_page']);
    }
}
