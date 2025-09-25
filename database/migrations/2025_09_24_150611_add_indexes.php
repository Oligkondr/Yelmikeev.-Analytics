<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->unique('name');
        });

        Schema::table('api_service_token_types', function (Blueprint $table) {
            $table->unique([
                'token_type_id',
                'api_service_id',
            ]);
        });

        Schema::table('accounts', function (Blueprint $table) {
            $table->unique([
                'company_id',
                'api_service_token_type_id',
            ]);
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
