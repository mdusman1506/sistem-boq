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
        Schema::create('tb_boq_header', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyek_id')->constrained('tb_proyek')->cascadeOnDelete();
            $table->string('nomor_surat', 100);
            $table->string('versi_revisi', 10)->default('Rev 0');
            $table->enum('status_approval', ['Draft', 'Pending', 'Approved', 'Rejected'])->default('Draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_boq_header');
    }
};
