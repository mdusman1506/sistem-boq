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
        Schema::create('tb_proyek', function (Blueprint $table) {
            $table->id();
            $table->foreignId('klien_id')->constrained('tb_klien')->cascadeOnDelete();
            $table->string('nama_proyek');
            $table->enum('status_proyek', ['Berjalan', 'Selesai'])->default('Berjalan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_proyek');
    }
};
