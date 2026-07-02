<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('interior_produk', function (Blueprint $table) {
            $table->string('panjang', 100)->nullable()->after('deskripsi_produk');
            $table->string('lebar', 100)->nullable()->after('panjang');
            $table->string('tinggi', 100)->nullable()->after('lebar');
            $table->string('bahan', 255)->nullable()->after('tinggi');
            $table->string('ketebalan', 100)->nullable()->after('bahan');
        });
    }

    public function down(): void
    {
        Schema::table('interior_produk', function (Blueprint $table) {
            $table->dropColumn(['panjang', 'lebar', 'tinggi', 'bahan', 'ketebalan']);
        });
    }
};
