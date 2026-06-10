<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interior_produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->text('deskripsi_produk')->nullable();
            $table->decimal('harga_produk', 15, 2)->nullable();
            $table->string('gambar_produk')->nullable();
            $table->string('desain_produk_3d')->nullable();
            $table->string('desain_produk_2d')->nullable();
            $table->text('pengerjaan_produk')->nullable();
            $table->foreignId('kategori_id')->constrained('kategori_interior')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interior_produk');
    }
};
