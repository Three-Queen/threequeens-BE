<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portofolio_proyek', function (Blueprint $table) {
            $table->id();
            $table->string('nama_proyek');
            $table->string('lokasi');
            $table->string('lokasi_google_maps')->nullable();
            $table->string('dokumentasi_proyek')->nullable();
            $table->string('waktu_proyek')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portofolio_proyek');
    }
};
