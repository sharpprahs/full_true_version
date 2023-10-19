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
        Schema::create('videocategory', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->tinyInteger('pos');
            $table->string('url', 255);
            $table->string('metaTitle', 250);
            $table->text('metaDescription');
            $table->text('metaKeywords');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videocategory');
    }
};
