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
        Schema::table('tb_klien', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('tb_master_barang_jasa', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('tb_proyek', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_klien', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('tb_master_barang_jasa', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('tb_proyek', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
