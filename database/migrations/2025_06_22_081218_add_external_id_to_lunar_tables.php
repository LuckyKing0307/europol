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
        Schema::table('lunar_collection_groups', function (Blueprint $table) {
            $table->uuid('external_id')->nullable()->unique()->index();
        });

        Schema::table('lunar_collections', function (Blueprint $table) {
            $table->uuid('external_id')->nullable()->unique()->index();
        });
        Schema::table('lunar_products', function (Blueprint $table) {
            $table->uuid('external_id')->nullable()->unique()->index();
            $table->string('sku')->nullable()->index();   // удобнее ловить дубль
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lunar_collection_groups', function (Blueprint $table) {
            $table->dropColumn('external_id');
        });
        Schema::table('lunar_collections', function (Blueprint $table) {
            $table->dropColumn('external_id');
        });

        Schema::table('lunar_products', function (Blueprint $table) {
            $table->dropColumn(['external_id', 'sku']);
        });
    }
};
