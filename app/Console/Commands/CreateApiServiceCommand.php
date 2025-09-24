<?php

namespace App\Console\Commands;

use App\Models\ApiService;
use Illuminate\Console\Command;
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
    protected $description = 'Create a new api service';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line('Новый api сервис');

        $data = $this->getValidatedData();

        ApiService::create($data);
        $this->line("Новая api сервис \"{$data['name']}\" создан.");

    }

    private function getValidatedData(): array
    {
        while (true) {
            $name = $this->ask('Введите название api сервиса');

            $validator = Validator::make([
                'name' => $name,
            ], [
                'name' => 'required|string',
            ], [
                'name.required' => 'Название обязательно!'
            ]);

            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $error) {
                    $this->error($error);
                }
                $this->warn('Пожалуйста, исправьте ошибки.');
                continue;
            }

            return [
                'name' => $name,
            ];
        }
    }

}
