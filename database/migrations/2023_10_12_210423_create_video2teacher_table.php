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
        Schema::create('video2teacher', function (Blueprint $table) {
            $table->unsignedBigInteger('video');
            $table->unsignedBigInteger('teacher');
            $table->unique(['video', 'teacher']);

            // Если вы хотите добавить внешние ключи, вы можете сделать это так:
            // $table->foreign('video')->references('id')->on('videos');
            // $table->foreign('teacher')->references('id')->on('teachers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video2teacher');
    }
};
