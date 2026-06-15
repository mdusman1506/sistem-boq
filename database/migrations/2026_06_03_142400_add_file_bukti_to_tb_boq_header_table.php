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
        Schema::table('tb_boq_header', function (Blueprint $table) {
            $table->string('file_bukti_lapangan')->nullable()->after('status_approval')->comment('File PDF/Gambar bukti verifikasi lapangan');
            $table->text('catatan_sitemanager')->nullable()->after('file_bukti_lapangan')->comment('Catatan tambahan dari Site Manager saat verifikasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_boq_header', function (Blueprint $table) {
            $table->dropColumn('file_bukti_lapangan');
            $table->dropColumn('catatan_sitemanager');
        });
    }
};
