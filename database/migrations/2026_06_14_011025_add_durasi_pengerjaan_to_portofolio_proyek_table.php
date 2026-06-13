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
        Schema::table('portofolio_proyek', function (Blueprint $table) {
            $table->string('durasi_pengerjaan')->nullable()->after('waktu_proyek');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portofolio_proyek', function (Blueprint $table) {
            //
        });
    }
};
