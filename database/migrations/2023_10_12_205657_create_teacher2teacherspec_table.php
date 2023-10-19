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
        Schema::create('teacher2teacherspec', function (Blueprint $table) {
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('teacherSpec');

            // Устанавливаем внешние ключи
            $table->foreign('teacher_id')->references('id')->on('teacher');
            $table->foreign('teacherSpec')->references('id')->on('teacherspec');

            $table->primary(['teacher_id', 'teacherSpec']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher2teacherspec');
    }
};
