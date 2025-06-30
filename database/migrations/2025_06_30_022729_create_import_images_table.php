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
        Schema::create('import_images', function (Blueprint $table) {
            $table->id();
            $table->string('zip_path');      // путь к архиву в storage
            $table->string('status')->default('queued'); // queued | processing | done | failed
            $table->integer('processed')->default(0);    // сколько картинок обработано
            $table->text('log')->nullable();             // полезные сообщения/ошибки
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_images');
    }
};
