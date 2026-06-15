<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tb_boq_header', function (Blueprint $table) {
            $table->boolean('is_client_approved')->default(false);
            $table->timestamp('client_approved_at')->nullable();
            $table->unsignedBigInteger('client_approved_by')->nullable();

            $table->foreign('client_approved_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('tb_boq_header', function (Blueprint $table) {
            $table->dropForeign(['client_approved_by']);
            $table->dropColumn(['is_client_approved', 'client_approved_at', 'client_approved_by']);
        });
    }
};
