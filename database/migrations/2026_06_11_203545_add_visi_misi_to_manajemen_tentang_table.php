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
        Schema::table('manajemen_tentang', function (Blueprint $table) {
            $table->text('visi')->nullable()->after('deskripsi');
            $table->text('misi')->nullable()->after('visi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('manajemen_tentang', function (Blueprint $table) {
            $table->dropColumn(['visi', 'misi']);
        });
    }
};
