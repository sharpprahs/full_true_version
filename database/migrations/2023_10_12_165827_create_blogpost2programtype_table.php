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
        Schema::create('blogpost2programtype', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blogPost');
            $table->unsignedBigInteger('programType');
            $table->unique(['blogPost', 'programType']);
            $table->timestamps();

            // Здесь вы также можете добавить внешние ключи, если это необходимо.
            // Пример:
            // $table->foreign('blogPost')->references('id')->on('blogpost');
            // $table->foreign('programType')->references('id')->on('programtype');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogpost2programtype');
    }
};
