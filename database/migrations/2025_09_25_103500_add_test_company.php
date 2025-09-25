<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $company = \App\Models\Company::create([
            'name' => 'Test company',
        ]);
        $tokenType = \App\Models\TokenType::create([
            'name' => 'api-key',
        ]);
        $apiService = \App\Models\ApiService::create([
            'name' => 'Api service',
            'url' => '',
        ]);
        $apiServiceTokenType = \App\Models\ApiServiceTokenType::create([
            'token_type_id' => $tokenType->id,
            'api_service_id' => $apiService->id,
        ]);
        \App\Models\Account::create([
            'company_id' => $company->id,
            'api_service_token_type_id' => $apiServiceTokenType->id,
            'name' => 'Test account',
            'token' => '',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
