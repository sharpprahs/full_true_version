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
        Schema::create('podcast2teacher', function (Blueprint $table) {
            $table->unsignedInteger('podcast');
            $table->unsignedInteger('teacher');

            // Индексы
            $table->unique(['podcast', 'teacher']);

            // Внешние ключи, если необходимо
            // $table->foreign('podcast')->references('id')->on('podcasts');
            // $table->foreign('teacher')->references('id')->on('teachers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('podcast2teacher');
    }
};
