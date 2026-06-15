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
        if (!Schema::hasTable('tb_kendala_lapangan')) {
            Schema::create('tb_kendala_lapangan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyek_id')->constrained('tb_proyek')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('judul_kendala');
            $table->text('deskripsi');
            $table->string('foto_kendala')->nullable();
            $table->enum('status', ['Open', 'Resolved'])->default('Open');
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
        Schema::dropIfExists('tb_kendala_lapangan');
    }
};
