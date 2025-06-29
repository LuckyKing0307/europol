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
        Schema::create('excel_imports', function (Blueprint $t) {
            $t->id();
            $t->string('original_name');
            $t->string('path');
            $t->enum('status', ['queued', 'processing', 'completed', 'failed'])
                ->default('queued');
            $t->unsignedInteger('rows_processed')->default(0);
            $t->text('error')->nullable();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excel_imports');
    }
};
