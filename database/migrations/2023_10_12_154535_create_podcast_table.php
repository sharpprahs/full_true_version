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
        Schema::create('podcast', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('podcastLanguage')->default(1);
            $table->unsignedInteger('number');
            $table->string('title', 255)->default('');
            $table->text('content');
            $table->text('contentTiming');
            $table->text('contentLinks');
            $table->string('file', 255)->default('');
            $table->string('videoId', 100)->default('');
            $table->unsignedBigInteger('date')->default(0);
            $table->string('image', 100);
            $table->string('image_thumb', 250);
            $table->string('metaTitle', 255)->default('');
            $table->text('metaDescription');
            $table->text('metaKeywords');
            $table->string('ogTitle', 255);
            $table->text('ogDescription');
            $table->string('ogSiteName', 255);
            $table->string('url', 255)->default('');
            $table->string('urlShort', 50);
            $table->string('urlShortNew', 50)->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('podcast');
    }
};
