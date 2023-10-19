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
        Schema::create('teachercertificate', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id');
            $table->string('image', 255);
            $table->enum('main', ['1', '0'])->default('0');
            $table->tinyInteger('pos');
            $table->string('title', 255);
            $table->tinyInteger('teacherCertificateType');
        });

        Schema::table('teachercertificate', function (Blueprint $table) {
            $table->foreign('teacher_id')->references('id')->on('teacher');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachercertificate');
    }
};
