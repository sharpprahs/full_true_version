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
        Schema::create('grammarpost2grammarlevel', function (Blueprint $table) {
            $table->id(); // Добавьте идентификатор, если необходимо
            $table->unsignedBigInteger('grammarPost');
            $table->unsignedBigInteger('grammarLevel');

            // Внешние ключи для связи с таблицами grammarpost и grammarlevel
            $table->foreign('grammarPost')->references('id')->on('grammarpost');
            $table->foreign('grammarLevel')->references('id')->on('grammarlevel');

            $table->unique(['grammarPost', 'grammarLevel']); // Добавьте уникальный ключ, если это необходимо

            // Дополнительные столбцы, если необходимо
            $table->timestamps(); // Добавьте created_at и updated_at, если это необходимо

            // Дополнительные столбцы, если необходимо
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grammarpost2grammarlevel');
    }
};
