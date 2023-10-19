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
        Schema::create('podcastguest', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('podcast');
            $table->string('name', 255)->default('');
            $table->string('place', 255)->default('');
            $table->string('vk', 255)->default('');
            $table->tinyInteger('pos');
            $table->tinyInteger('sex');
            $table->string('image', 250);
        });

        Schema::table('podcastguest', function (Blueprint $table) {
            $table->foreign('podcast')->references('id')->on('podcast');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('podcastguest');
    }
};
