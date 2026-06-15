<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tb_change_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyek_id');
            $table->unsignedBigInteger('klien_id');
            $table->unsignedBigInteger('diajukan_oleh');
            $table->string('subjek');
            $table->text('deskripsi_perubahan');
            $table->string('lampiran')->nullable();
            $table->enum('status', ['Pending', 'Diproses', 'Selesai', 'Ditolak'])->default('Pending');
            $table->timestamps();

            $table->foreign('proyek_id')->references('id')->on('tb_proyek')->onDelete('cascade');
            $table->foreign('klien_id')->references('id')->on('tb_klien')->onDelete('cascade');
            $table->foreign('diajukan_oleh')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_change_requests');
    }
};
