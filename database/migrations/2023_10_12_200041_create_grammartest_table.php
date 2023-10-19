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
        Schema::create('grammartest', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grammarPost');
            $table->string('question', 255)->default('');
            $table->string('answer', 255)->default('');
            $table->unsignedTinyInteger('pos')->default(1);
            $table->string('image', 100);

            // Добавьте внешний ключ для связи с таблицей grammarpost
            $table->foreign('grammarPost')->references('id')->on('grammarpost');

            // Дополнительные столбцы, если необходимо

            // Добавьте primary key, если это необходимо
            // $table->primary('id');

            // Дополнительные индексы, если необходимо
            // $table->index('column_name');

            // Дополнительные уникальные индексы, если необходимо
            // $table->unique('column_name');

            // Дополнительные столбцы, если необходимо
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grammartest');
    }
};
