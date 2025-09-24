<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('api_service_token_types', function (Blueprint $table) {
            $table->foreign('token_type_id')
                ->references('id')
                ->on('token_types');

            $table->foreign('api_service_id')
                ->references('id')
                ->on('api_services');
        });

        Schema::table('accounts', function (Blueprint $table) {
            $table->foreign('company_id')
                ->references('id')
                ->on('companies');
        });

        Schema::table('account_tokens', function (Blueprint $table) {
            $table->foreign('account_id')
                ->references('id')
                ->on('accounts');

            $table->foreign('api_service_token_type_id')
                ->references('id')
                ->on('api_service_token_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
