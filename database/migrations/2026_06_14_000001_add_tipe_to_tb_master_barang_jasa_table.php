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
        Schema::table('tb_master_barang_jasa', function (Blueprint $table) {
            $table->string('tipe')->nullable()->after('satuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_master_barang_jasa', function (Blueprint $table) {
            $table->dropColumn('tipe');
        });
    }
};
