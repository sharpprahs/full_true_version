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
        Schema::create('teacherimage', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher');
            $table->string('image', 40);
            $table->string('image_thumb', 40);
            $table->tinyInteger('pos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacherimage');
    }
};
