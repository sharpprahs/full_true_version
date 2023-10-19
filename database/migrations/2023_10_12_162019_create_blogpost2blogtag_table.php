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
        Schema::create('blogpost2blogtag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blogPost');
            $table->unsignedBigInteger('blogTag');

            // Создайте уникальный ключ
            $table->unique(['blogPost', 'blogTag']);
            $table->timestamps();

            // Добавьте внешние ключи, если необходимо
            // $table->foreign('blogPost')->references('id')->on('blogpost');
            // $table->foreign('blogTag')->references('id')->on('blogtag');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogpost2blogtag');
    }
};
