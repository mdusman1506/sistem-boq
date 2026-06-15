<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tb_laporan_harian')) {
            Schema::create('tb_laporan_harian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyek_id')->constrained('tb_proyek')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal');
            $table->enum('cuaca', ['Cerah', 'Berawan', 'Gerimis', 'Hujan Lebat']);
            $table->integer('jumlah_pekerja');
            $table->text('kegiatan');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_laporan_harian');
    }
};
