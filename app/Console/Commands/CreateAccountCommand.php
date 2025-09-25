<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Models\ApiService;
use App\Models\ApiServiceTokenType;
use App\Models\Company;
use App\Models\TokenType;
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

            $token = $this->ask('Введите токен');

            $apiServices = ApiService::pluck('name', 'id')->toArray();
            $apiServiceId = $this->choice('Выберите API сервис', [
                    '' => 'Доступные API сервисы:',
                ] + $apiServices);

            $validator = Validator::make([
                'name' => $name,
                'token' => $token,
                'company_name' => $companyName,
                'api_service_id' => (int)$apiServiceId,
            ], [
                'name' => 'required|string',
                'token' => 'required|string',
                'company_name' => 'required|string',
                'api_service_id' => 'required|exists:api_services,id',
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

            $apiService = ApiService::find($validated['api_service_id']);

            $tokenTypeId = $this->choice('Выберите тип токена', [
                    '' => 'Доступные типы:',
                ] + $apiService->tokenTypes->pluck('name', 'id')->toArray());

            if (!TokenType::find($tokenTypeId)) {
                $this->error('Тип токен не найден.');
                $this->warn('Пожалуйста, исправьте ошибки.');
                continue;
            }

            /** @var ApiServiceTokenType $apiServiceTokenType */
            $apiServiceTokenType = $apiService
                ->apiServiceTokenTypes()
                ->where('token_type_id', $tokenTypeId)
                ->first();

            return [
                'name' => $validated['name'],
                'token' => $validated['token'],
                'company_id' => $company->id,
                'api_service_token_type_id' => $apiServiceTokenType->id,
            ];
        }
    }
}
