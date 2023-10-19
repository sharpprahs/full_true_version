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
        Schema::create('teacher', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('titleRuSecondname', 50)->default('');
            $table->string('titleRuFirstname', 50)->default('');
            $table->string('title4', 50);
            $table->string('title3', 50)->default('');
            $table->string('title2', 50)->default('');
            $table->string('video', 255)->default('');
            $table->text('content');
            $table->string('imageHeader', 50)->default('');
            $table->string('imageSlider', 40);
            $table->string('imageSlider@2x', 40);
            $table->string('imageSlider@3x', 40);
            $table->unsignedTinyInteger('active')->default(1);
            $table->unsignedInteger('pos');
            $table->unsignedInteger('posBlog')->default(10);
            $table->string('link', 512);
            $table->string('place', 40);
            $table->unsignedBigInteger('country');
            $table->string('soundfile', 40);
            $table->string('imageBanner', 40);
            $table->string('imageBanner@2x', 40);
            $table->string('imageBanner@3x', 40);
            $table->unsignedTinyInteger('teacherType');
            $table->enum('visible', ['1', '0'])->default('0');
            $table->enum('hiddenInSlider', ['1', '0'])->default('0');
            $table->enum('writer', ['1', '0'])->default('0');
            $table->enum('podcaster', ['1', '0'])->default('0');
            $table->string('imageBlogPreview', 255)->default('');
            $table->string('imageBlogHeader', 255)->default('');
            $table->string('imageBlogHeaderTeacher', 255)->default('');
            $table->string('imageFooter', 66)->default('');
            $table->string('imageFooterSm', 66)->default('');
            $table->string('imageFooterMd', 66)->default('');
            $table->string('imageTest', 50)->default('');
            $table->string('ogImage', 100);
            $table->string('ogImagePost', 100);
            $table->string('url', 250)->default('');
            $table->text('blogDescription');
            $table->text('blogDescriptionShort');
            $table->string('homeland', 100);
            $table->string('color', 6);
            $table->unsignedTinyInteger('podcastHost')->default(0);
            $table->unsignedTinyInteger('podcastPos')->default(255);
            $table->string('metaTitle', 255)->default('');
            $table->text('metaDescription');
            $table->text('metaKeywords');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher');
    }
};
