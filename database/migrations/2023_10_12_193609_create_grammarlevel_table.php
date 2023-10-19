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
        Schema::create('grammarlevel', function (Blueprint $table) {
            $table->id(); // Автоматически создает столбец 'id' как первичный ключ
            $table->unsignedInteger('pos')->default(22);
            $table->string('title', 250)->default('');
            $table->string('url', 250);
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
        Schema::dropIfExists('grammarlevel');
    }
};
