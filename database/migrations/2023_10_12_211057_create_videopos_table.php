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
        Schema::create('videopos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('video');
            $table->unsignedBigInteger('videoCategory');
            $table->unsignedBigInteger('pos');

            $table->unique(['video', 'videoCategory']);

            $table->timestamps(); // Добавьте поля created_at и updated_at, если необходимо
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videopos');
    }
};
