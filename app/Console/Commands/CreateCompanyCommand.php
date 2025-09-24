<?php

namespace App\Console\Commands;

use App\Models\Company;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CreateCompanyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:company';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new company';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Новая компания');

        $data = $this->getValidatedData();

        try {
            Company::create($data);
            $this->line("Новая компания добавлена.");
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->error('При выполнение операции произошла ошибка.');
        }
    }

    private function getValidatedData(): array
    {
        while (true) {
            $name = $this->ask('Введите название компании');

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
