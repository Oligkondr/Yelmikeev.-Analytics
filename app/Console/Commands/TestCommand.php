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
        $this->info('Test');

        $apiService = new ApiService();
        $response = $apiService->getStocks([
            'dateFrom' => '2025-09-18',
            'page' => 1,
        ]);


        dd($response);
    }
}
