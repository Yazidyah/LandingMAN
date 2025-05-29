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
        Schema::create('achievement', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable(); // NAMA GURU / SISWA / NAMA TIM
            $table->string('kelas_jabatan')->nullable(); // KELAS / Jabatan
            $table->string('kejuaraan')->nullable(); // KEJUARAAN
            $table->string('bidang')->nullable(); // BIDANG
            $table->string('tingkat')->nullable(); // TINGKAT
            $table->text('keterangan')->nullable(); // KETERANGAN
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievement');
    }
};
