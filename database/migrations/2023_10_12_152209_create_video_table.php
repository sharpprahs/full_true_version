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
        Schema::create('video', function (Blueprint $table) {
            // Определите структуру таблицы здесь
            $table->id();
            $table->unsignedBigInteger('date');
            $table->unsignedBigInteger('videoCategory');
            $table->unsignedBigInteger('teacher__');
            $table->string('videoId', 100);
            $table->string('title', 255);
            $table->tinyInteger('pos', false, true);
            $table->string('urlAuthor', 255)->default('');
            $table->string('name', 255)->default('');
            $table->string('image', 255)->default('');
            $table->string('imageYoutube', 255)->default('');
            $table->string('comment', 255);
            $table->text('content');
            $table->enum('teacherPage', ['1', '0'])->default('1');
            $table->string('metaTitle', 255);
            $table->text('metaDescription');
            $table->text('metaKeywords');
            $table->string('ogTitle', 255);
            $table->text('ogDescription');
            $table->string('ogSiteName', 255);
            $table->string('url', 255)->default('');
            $table->string('urlShort', 50)->default('');
            // Добавьте остальные столбцы согласно вашей структуре
            $table->timestamps();
            $table->index('date');
            $table->index('videoCategory');
            $table->index('teacher__');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video');
    }
};
