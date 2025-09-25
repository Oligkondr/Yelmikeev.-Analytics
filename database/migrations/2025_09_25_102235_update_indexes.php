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
        Schema::table('sales', function (Blueprint $table) {
            $table->dropUnique('sales_sale_id_unique');
            $table->index('sale_id');
        });

        Schema::table('stocks', function (Blueprint $table) {
            $table->dropUnique('stocks_supplier_article_warehouse_name_last_change_date_unique');
            $table->index([
                'supplier_article',
                'warehouse_name',
                'last_change_date',
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
