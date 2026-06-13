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
        Schema::create('portofolio_galeri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portofolio_proyek_id')->constrained('portofolio_proyek')->cascadeOnDelete();
            $table->string('gambar_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portofolio_galeris');
    }
};
