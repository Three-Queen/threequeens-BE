<?php

namespace App\Console\Commands;

use App\Models\InteriorProduk;
use App\Models\KategoriInterior;
use App\Models\PortofolioProyek;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class FixMissingRouteKeys extends Command
{
    protected $signature = 'admin:fix-route-keys';

    protected $description = 'Generate kode_produk and slug yang masih kosong/null di database';

    public function handle(): int
    {
        $this->fixProdukKode();
        $this->fixPortofolioSlug();

        $this->info('✅ Selesai! Semua route key berhasil diperbaiki.');

        return self::SUCCESS;
    }

    // -------------------------------------------------------
    // Fix: kode_produk null di tabel interior_produk
    // -------------------------------------------------------
    private function fixProdukKode(): void
    {
        $produkTanpaKode = InteriorProduk::whereNull('kode_produk')
            ->orWhere('kode_produk', '')
            ->get();

        if ($produkTanpaKode->isEmpty()) {
            $this->line('  [Produk] Tidak ada produk tanpa kode_produk. ✓');
            return;
        }

        $this->warn("  [Produk] Ditemukan {$produkTanpaKode->count()} produk tanpa kode_produk. Memperbaiki...");

        // Ambil index terakhir
        $lastKode = InteriorProduk::whereNotNull('kode_produk')
            ->where('kode_produk', '!=', '')
            ->orderBy('id', 'desc')
            ->value('kode_produk');

        $lastIndex = 0;
        if ($lastKode) {
            $parts = explode('-', $lastKode);
            $lastIndex = (int) end($parts);
        }

        foreach ($produkTanpaKode as $produk) {
            $lastIndex++;
            $kategori = KategoriInterior::find($produk->kategori_id);
            $layananInit = $kategori ? $this->getInitials($kategori->tipe_layanan) : 'XX';
            $kategoriInit = $kategori ? $this->getInitials($kategori->nama_kategori) : 'XX';
            $produkInit = $this->getInitials($produk->nama_produk);
            $kode = sprintf('%s-%s-%s-%03d', $layananInit, $kategoriInit, $produkInit, $lastIndex);

            // Pastikan kode unik
            while (InteriorProduk::where('kode_produk', $kode)->where('id', '!=', $produk->id)->exists()) {
                $lastIndex++;
                $kode = sprintf('%s-%s-%s-%03d', $layananInit, $kategoriInit, $produkInit, $lastIndex);
            }

            $produk->update(['kode_produk' => $kode]);
            $this->line("  [Produk] ID #{$produk->id} \"{$produk->nama_produk}\" → <fg=green>{$kode}</>");
        }
    }

    // -------------------------------------------------------
    // Fix: slug null di tabel portofolio_proyek
    // -------------------------------------------------------
    private function fixPortofolioSlug(): void
    {
        $portofolioTanpaSlug = PortofolioProyek::whereNull('slug')
            ->orWhere('slug', '')
            ->get();

        if ($portofolioTanpaSlug->isEmpty()) {
            $this->line('  [Portofolio] Tidak ada portofolio tanpa slug. ✓');
            return;
        }

        $this->warn("  [Portofolio] Ditemukan {$portofolioTanpaSlug->count()} portofolio tanpa slug. Memperbaiki...");

        foreach ($portofolioTanpaSlug as $porto) {
            $slug = Str::random(10);

            // Pastikan slug unik
            while (PortofolioProyek::where('slug', $slug)->where('id', '!=', $porto->id)->exists()) {
                $slug = Str::random(10);
            }

            $porto->update(['slug' => $slug]);
            $this->line("  [Portofolio] ID #{$porto->id} \"{$porto->nama_proyek}\" → <fg=green>{$slug}</>");
        }
    }

    private function getInitials(string $string): string
    {
        if (!$string) return 'XX';
        $words = explode(' ', $string);
        $initials = '';
        foreach ($words as $word) {
            $word = preg_replace('/[^A-Za-z0-9]/', '', $word);
            if ($word !== '') {
                $initials .= strtoupper(substr($word, 0, 1));
            }
        }
        return $initials ?: 'XX';
    }
}
