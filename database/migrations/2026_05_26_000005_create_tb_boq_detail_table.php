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
        Schema::create('tb_boq_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('boq_header_id')->constrained('tb_boq_header')->cascadeOnDelete();
            $table->foreignId('barang_jasa_id')->constrained('tb_master_barang_jasa')->restrictOnDelete();
            $table->string('lokasi_lantai', 50)->nullable();
            $table->string('lokasi_zona', 50)->nullable();
            $table->decimal('qty_kontrak', 10, 2)->default(0);
            $table->decimal('qty_aktual', 10, 2)->nullable();
            $table->decimal('harga_material_satuan', 15, 2)->nullable();
            $table->decimal('harga_jasa_satuan', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_boq_detail');
    }
};
