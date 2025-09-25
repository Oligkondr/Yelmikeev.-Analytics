<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Models\ApiService;
use App\Models\Company;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CreateAccountCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:account';

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
        $this->info('Новый аккаунт');

        $data = $this->getValidatedData();

        try {
            Account::create($data);
            $this->line("Новый аккаунт создан.");
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->error('При выполнение операции произошла ошибка.');
        }
    }

    private function getValidatedData(): array
    {
        while (true) {
            $companies = Company::pluck('name', 'id')->toArray();
            $companyName = $this->anticipate('Введите название компании', $companies);

            $name = $this->ask('Введите название аккаунта');

            $services = ApiService::pluck('name', 'id')->toArray();
            $service = $this->choice('Выберите API сервис', $services);

            dd($service);

            $validator = Validator::make([
                'name' => $name,
                'company_name' => $companyName,
            ], [
                'name' => 'required|string',
                'company_name' => 'required|string',
            ]);

            $company = Company::query()
                ->where('name', $companyName)
                ->first();

            if (!$company) {
                $validator->errors()->add('company', "Компания '{$companyName}' не найдена.");
            }


            if ($validator->errors()->isNotEmpty()) {
                foreach ($validator->errors()->all() as $error) {
                    $this->error($error);
                }
                $this->warn('Пожалуйста, исправьте ошибки.');
                continue;
            }

            $validated = $validator->validated();

            return [
                'name' => $validated['name'],
                'company_id' => $company->id,
            ];
        }
    }

}
