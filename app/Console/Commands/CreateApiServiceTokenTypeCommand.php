<?php

namespace App\Console\Commands;

use App\Models\ApiService;
use App\Models\ApiServiceTokenType;
use App\Models\TokenType;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CreateApiServiceTokenTypeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:api-service-token-type';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new API service token type';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Новый тип токена для API сервиса');

        $data = $this->getValidatedData();

        try {
            ApiServiceTokenType::create($data);
            $this->line("Тип токена привязан к API сервису.");
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->error('При выполнение операции произошла ошибка.');
        }
    }

    private function getValidatedData(): array
    {
        while (true) {
            $services = ApiService::pluck('name', 'id')->toArray();
            $servicesId = $this->choice('Выберите API сервис', [
                    '' => 'API сервисы:',
                ] + $services);

            $tokenTypes = TokenType::pluck('name', 'id')->toArray();
            $tokenTypeId = $this->choice('Выберите тип токена', [
                    '' => 'Типы токенов:',
                ] + $tokenTypes);


            $validator = Validator::make([
                'api_service_id' => (int)$servicesId,
                'token_type_id' => (int)$tokenTypeId,
            ], [
                'api_service_id' => 'required|exists:api_services,id',
                'token_type_id' => 'required|exists:token_types,id',
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
