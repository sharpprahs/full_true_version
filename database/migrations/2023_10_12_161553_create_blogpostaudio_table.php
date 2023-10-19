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
        Schema::create('blogpostaudio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blogPost')->default(1);
            $table->string('path', 100)->default('');
            $table->string('title', 100)->default('');
            // Добавьте другие столбцы по вашей структуре

            $table->timestamps();
            $table->foreign('blogPost')->references('id')->on('blogpost')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogpostaudio');
    }
};
