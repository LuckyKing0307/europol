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
        Schema::create('market_talons', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('phone_number');
            $table->string('customer_name');
            $table->string('order_id');
            $table->date('bought_date');
            $table->string('warranty_period');
            $table->json('warranty_types');
            $table->string('some_letter');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('market_talons');
    }
};
