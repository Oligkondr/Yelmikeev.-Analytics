<?php

namespace App\Console\Commands;

use App\Models\ApiService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CreateApiServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:api-service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new API service';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line('Новый API сервис');

        $data = $this->getValidatedData();

        try {
            ApiService::create($data);
            $this->line("Новая API сервис \"{$data['name']}\" создан.");
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->error('При выполнение операции произошла ошибка.');
        }
    }

    private function getValidatedData(): array
    {
        while (true) {
            $name = $this->ask('Введите название API сервиса');

            $validator = Validator::make([
                'name' => $name,
            ], [
                'name' => 'required|string',
            ], [
                'name.required' => 'Название обязательно!',
            ]);

            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $error) {
                    $this->error($error);
                }
                $this->warn('Пожалуйста, исправьте ошибки.');
                continue;
            }

            return $validator->validated();
        }
    }

}
