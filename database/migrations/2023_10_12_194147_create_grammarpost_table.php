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
        Schema::create('grammarpost', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('pos');
            $table->string('color', 6);
            $table->string('title', 255)->default('');
            $table->string('title_en', 255);
            $table->text('content');
            $table->string('image', 100);
            $table->string('metaTitle', 255)->default('');
            $table->text('metaDescription');
            $table->text('metaKeywords');
            $table->string('ogTitle', 255);
            $table->text('ogDescription');
            $table->string('ogSiteName', 255);
            $table->string('url', 255)->default('');
            $table->string('urlShort', 50)->default('');
            $table->unsignedBigInteger('grammarLevel'); // Изменено на unsignedBigInteger
            $table->string('titleTest', 255);
            $table->string('ogImage', 50)->nullable();
            $table->timestamps();

            // Внешний ключ
            $table->foreign('grammarLevel')->references('id')->on('grammarlevel');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grammarpost');
    }
};
