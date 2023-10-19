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
        Schema::create('blogpost', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id');
            $table->string('title', 255)->default('');
            $table->text('content');
            $table->unsignedBigInteger('date')->default(21);
            $table->string('image', 100);
            $table->string('metaTitle', 255)->default('');
            $table->text('metaDescription');
            $table->text('metaKeywords');
            $table->string('ogTitle', 255);
            $table->text('ogDescription');
            $table->string('ogSiteName', 255);
            $table->string('url', 255)->default('');
            $table->string('urlShort', 50);
            $table->enum('footerNative', ['1', '0'])->default('0');
            $table->enum('footerRussian', ['1', '0'])->default('0');

            $table->foreign('teacher_id')->references('id')->on('teacher');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogpost');
    }
};
