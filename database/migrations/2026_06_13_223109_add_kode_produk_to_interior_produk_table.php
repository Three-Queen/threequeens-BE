<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Helper to get initials.
     */
    private function getInitials($string)
    {
        if (!$string) return '';
        $words = explode(' ', $string);
        $initials = '';
        foreach ($words as $word) {
            $word = preg_replace('/[^A-Za-z0-9]/', '', $word);
            if ($word !== '') {
                $initials .= strtoupper(substr($word, 0, 1));
            }
        }
        return $initials;
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('interior_produk', function (Blueprint $table) {
            $table->string('kode_produk')->nullable()->unique()->after('id');
        });

        // Generate codes for existing products
        $produks = DB::table('interior_produk')
            ->join('kategori_interior', 'interior_produk.kategori_id', '=', 'kategori_interior.id')
            ->select('interior_produk.id', 'interior_produk.nama_produk', 'kategori_interior.tipe_layanan', 'kategori_interior.nama_kategori')
            ->orderBy('interior_produk.id')
            ->get();

        $index = 1;
        foreach ($produks as $produk) {
            $layananInit = $this->getInitials($produk->tipe_layanan);
            $kategoriInit = $this->getInitials($produk->nama_kategori);
            $produkInit = $this->getInitials($produk->nama_produk);
            
            $kode = sprintf('%s-%s-%s-%03d', $layananInit, $kategoriInit, $produkInit, $index);
            
            DB::table('interior_produk')
                ->where('id', $produk->id)
                ->update(['kode_produk' => $kode]);
                
            $index++;
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('interior_produk', function (Blueprint $table) {
            $table->dropColumn('kode_produk');
        });
    }
};
