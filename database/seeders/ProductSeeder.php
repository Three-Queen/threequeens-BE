<?php

namespace Database\Seeders;

use App\Models\InteriorProduk;
use App\Models\KategoriInterior;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
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

    private function generateKodeProduk($namaProduk, $kategoriId, $index)
    {
        $kategori = KategoriInterior::find($kategoriId);
        $layananInit = $kategori ? $this->getInitials($kategori->tipe_layanan) : '';
        $kategoriInit = $kategori ? $this->getInitials($kategori->nama_kategori) : '';
        $produkInit = $this->getInitials($namaProduk);
        
        return sprintf('%s-%s-%s-%03d', $layananInit, $kategoriInit, $produkInit, $index);
    }

    public function run(): void
    {
        // =========================================
        // Seed Categories
        // =========================================
        $categories = [
            // Residential
            ['id' => 1, 'nama_kategori' => 'Kitchen Set', 'tipe_layanan' => 'Residential'],
            ['id' => 2, 'nama_kategori' => 'Living Room', 'tipe_layanan' => 'Residential'],
            ['id' => 3, 'nama_kategori' => 'Bedroom', 'tipe_layanan' => 'Residential'],
            ['id' => 5, 'nama_kategori' => 'Bathroom', 'tipe_layanan' => 'Residential'],
            // Komersial
            ['id' => 4, 'nama_kategori' => 'Office', 'tipe_layanan' => 'Komersial'],
            ['id' => 6, 'nama_kategori' => 'Cafe & Restaurant', 'tipe_layanan' => 'Komersial'],
            ['id' => 7, 'nama_kategori' => 'Retail & Store', 'tipe_layanan' => 'Komersial'],
            // Kustom
            ['id' => 8, 'nama_kategori' => 'Custom Cabinet', 'tipe_layanan' => 'Kustom'],
            ['id' => 9, 'nama_kategori' => 'Custom Wardrobe', 'tipe_layanan' => 'Kustom'],
        ];

        foreach ($categories as $cat) {
            KategoriInterior::updateOrCreate(
                ['id' => $cat['id']],
                [
                    'nama_kategori' => $cat['nama_kategori'],
                    'tipe_layanan' => $cat['tipe_layanan'],
                ]
            );
        }

        // =========================================
        // Seed Products
        // =========================================
        $products = [
            // --- Kitchen Set (Kategori ID: 1) ---
            [
                'nama_produk' => 'Kitchen Set L-Shape Modern Oak',
                'deskripsi_produk' => 'Kitchen set dengan tata letak L-shape modern berbahan dasar kayu oak pilihan, dilengkapi cabinet drawer dengan rel soft-close premium dan countertop kuarsa anti gores.',
                'harga_produk' => 15000000.00,
                'gambar_produk' => 'gambar1.png',
                'desain_produk_3d' => 'produk/3d/ACC7dtDyQ8yMdfnh98ElWJ3QrICGk5JTWcfpXLDO.glb',
                'desain_produk_2d' => 'produk/2d/HfGBA2atke21Wn8gC0HNn66mluyEQZEVVjEZesva.jpeg',
                'pengerjaan_produk' => 'Estimasi pengerjaan 14-21 hari kerja, meliputi pengukuran lokasi, fabrikasi di workshop kami, hingga proses instalasi akhir.',
                'kategori_id' => 1,
            ],
            [
                'nama_produk' => 'Kitchen Set Island Monokrom',
                'deskripsi_produk' => 'Kitchen set monokrom abu-abu gelap dengan meja island marmer putih premium, tempat penyimpanan oven tanam, dan rak display gantung berpencahayaan LED.',
                'harga_produk' => 22500000.00,
                'gambar_produk' => 'gambar2.png',
                'desain_produk_3d' => 'produk/3d/9SGVZFDNJJAbvrw68kSUcBjTWqdNHebZXBvlcHCN.glb',
                'desain_produk_2d' => 'produk/2d/3Y7lBEyzHxyrPIw5VhoF7kQfj78l9Zb0HMjEPr9C.png',
                'pengerjaan_produk' => 'Estimasi pengerjaan 20-30 hari kerja termasuk penyelarasan instalasi kelistrikan dan plumbing meja island.',
                'kategori_id' => 1,
            ],
            [
                'nama_produk' => 'Kitchen Set Minimalis Putih',
                'deskripsi_produk' => 'Kitchen set minimalis mungil serba putih untuk memaksimalkan ruangan dapur kecil atau apartemen studio. Menggunakan finishing HPL high-gloss anti air.',
                'harga_produk' => 9500000.00,
                'gambar_produk' => 'gambar3.png',
                'desain_produk_3d' => null,
                'desain_produk_2d' => 'produk/2d/HfGBA2atke21Wn8gC0HNn66mluyEQZEVVjEZesva.jpeg',
                'pengerjaan_produk' => 'Estimasi pengerjaan 10-14 hari kerja.',
                'kategori_id' => 1,
            ],
           
        ];

        $index = 1;
        foreach ($products as $prod) {
            InteriorProduk::updateOrCreate(
                ['nama_produk' => $prod['nama_produk']],
                [
                    'kode_produk' => $this->generateKodeProduk($prod['nama_produk'], $prod['kategori_id'], $index++),
                    'deskripsi_produk' => $prod['deskripsi_produk'],
                    'harga_produk' => $prod['harga_produk'],
                    'gambar_produk' => $prod['gambar_produk'],
                    'desain_produk_3d' => $prod['desain_produk_3d'],
                    'desain_produk_2d' => $prod['desain_produk_2d'],
                    'pengerjaan_produk' => $prod['pengerjaan_produk'],
                    'kategori_id' => $prod['kategori_id'],
                ]
            );
        }
    }
}
