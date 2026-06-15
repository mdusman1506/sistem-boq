<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tb_tiket_pemeliharaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyek_id');
            $table->unsignedBigInteger('pelapor_id');
            $table->string('subjek');
            $table->text('deskripsi');
            $table->string('foto_kerusakan')->nullable();
            $table->string('foto_perbaikan')->nullable();
            $table->enum('status', ['Open', 'On Progress', 'Resolved'])->default('Open');
            $table->timestamps();

            $table->foreign('proyek_id')->references('id')->on('tb_proyek')->onDelete('cascade');
            $table->foreign('pelapor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_tiket_pemeliharaan');
    }
};
