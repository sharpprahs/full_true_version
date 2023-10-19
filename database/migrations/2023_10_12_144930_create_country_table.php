<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('country', function (Blueprint $table) {
            $table->id();
            $table->string('image', 255);
            $table->tinyInteger('pos', false, true);
            $table->string('title', 255);
            $table->timestamps();
        });

        // Установка начального значения AUTO_INCREMENT
        DB::statement('ALTER TABLE country AUTO_INCREMENT = 15');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('country');
    }
};
