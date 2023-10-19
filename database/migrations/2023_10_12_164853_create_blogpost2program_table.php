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
        Schema::create('blogpost2program', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blogPost');
            $table->unsignedBigInteger('program');
            $table->timestamps();

            // Установите внешние ключи, если это необходимо
            // $table->foreign('blogPost')->references('id')->on('blogpost');
            // $table->foreign('program')->references('id')->on('program');

            $table->unique(['blogPost', 'program']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogpost2program');
    }
};
