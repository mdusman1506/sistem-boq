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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('klien_id')->nullable()->after('role');
            $table->softDeletes();
            
            $table->foreign('klien_id')->references('id')->on('tb_klien')->onDelete('set null');
            
            // Note: Since role is enum, modifying enum in some DBs requires raw statement or string replacement.
            // We will just use string column or handle validation at application level. 
            // In Laravel, enum modification can be tricky. We'll leave the DB enum as is if it's string, 
            // but if it's enum('Admin','Site Manager'), we might need a raw query.
            // Let's change the role column to a simple string to be safe and flexible.
        });
        
        // Changing ENUM to VARCHAR to support new roles easily
        DB::statement("ALTER TABLE users MODIFY COLUMN role VARCHAR(50) DEFAULT 'Site Manager'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['klien_id']);
            $table->dropColumn('klien_id');
            $table->dropSoftDeletes();
        });
    }
};
