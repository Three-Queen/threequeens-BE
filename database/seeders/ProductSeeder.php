<?php

namespace Database\Seeders;

use App\Models\KategoriInterior;
use App\Models\InteriorProduk;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // =========================================
        // Seed Categories
        // =========================================
        $categories = [
            ['id' => 1, 'nama_kategori' => 'Kitchen Set'],
            ['id' => 2, 'nama_kategori' => 'Living Room'],
            ['id' => 3, 'nama_kategori' => 'Bedroom'],
            ['id' => 4, 'nama_kategori' => 'Office'],
            ['id' => 5, 'nama_kategori' => 'Bathroom'],
        ];

        foreach ($categories as $cat) {
            KategoriInterior::updateOrCreate(
                ['id' => $cat['id']],
                ['nama_kategori' => $cat['nama_kategori']]
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

            // --- Living Room (Kategori ID: 2) ---
            [
                'nama_produk' => 'Sofa Minimalis Cozy 3-Seater',
                'deskripsi_produk' => 'Sofa minimalis berlapis kain linen premium berkapasitas 3 orang dengan rangka kayu jati kokoh dan busa kepadatan tinggi yang tidak mudah kempes.',
                'harga_produk' => 6500000.00,
                'gambar_produk' => 'gambar2.png',
                'desain_produk_3d' => 'produk/3d/ACC7dtDyQ8yMdfnh98ElWJ3QrICGk5JTWcfpXLDO.glb',
                'desain_produk_2d' => null,
                'pengerjaan_produk' => 'Ready-stock atau custom kain sekitar 7 hari kerja.',
                'kategori_id' => 2,
            ],
            [
                'nama_produk' => 'Meja TV Credenza Klasik',
                'deskripsi_produk' => 'Credenza TV dengan sentuhan kayu klasik beraksen kuningan mewah, memiliki 3 laci penyimpanan lapang dan lubang manajemen kabel tersembunyi di bagian belakang.',
                'harga_produk' => 4200000.00,
                'gambar_produk' => 'gambar1.png',
                'desain_produk_3d' => null,
                'desain_produk_2d' => 'produk/2d/HfGBA2atke21Wn8gC0HNn66mluyEQZEVVjEZesva.jpeg',
                'pengerjaan_produk' => 'Estimasi pengerjaan 7-10 hari kerja.',
                'kategori_id' => 2,
            ],
            [
                'nama_produk' => 'Coffee Table Marmer Bulat',
                'deskripsi_produk' => 'Meja kopi bundar dengan permukaan marmer Carrara asli yang tahan panas dan goresan, disangga kaki besi kuat berlapis cat emas anti karat.',
                'harga_produk' => 2800000.00,
                'gambar_produk' => 'gambar3.png',
                'desain_produk_3d' => 'produk/3d/9SGVZFDNJJAbvrw68kSUcBjTWqdNHebZXBvlcHCN.glb',
                'desain_produk_2d' => null,
                'pengerjaan_produk' => 'Estimasi pengerjaan 5-7 hari kerja.',
                'kategori_id' => 2,
            ],

            // --- Bedroom (Kategori ID: 3) ---
            [
                'nama_produk' => 'Tempat Tidur Divan King Size',
                'deskripsi_produk' => 'Divan tempat tidur ukuran King (180x200) berlapis kulit sintetis mewah dengan sandaran kepala empuk yang nyaman untuk bersandar saat membaca buku.',
                'harga_produk' => 8500000.00,
                'gambar_produk' => 'gambar3.png',
                'desain_produk_3d' => 'produk/3d/9SGVZFDNJJAbvrw68kSUcBjTWqdNHebZXBvlcHCN.glb',
                'desain_produk_2d' => 'produk/2d/3Y7lBEyzHxyrPIw5VhoF7kQfj78l9Zb0HMjEPr9C.png',
                'pengerjaan_produk' => 'Estimasi pengerjaan 10-14 hari kerja.',
                'kategori_id' => 3,
            ],
            [
                'nama_produk' => 'Lemari Pakaian Slide 3 Pintu',
                'deskripsi_produk' => 'Lemari pakaian dengan pintu geser 3 pintu dilengkapi kaca full-body di bagian tengah dan kompartemen gantungan baju ganda serta laci perhiasan bermotor.',
                'harga_produk' => 11000000.00,
                'gambar_produk' => 'gambar1.png',
                'desain_produk_3d' => null,
                'desain_produk_2d' => 'produk/2d/3Y7lBEyzHxyrPIw5VhoF7kQfj78l9Zb0HMjEPr9C.png',
                'pengerjaan_produk' => 'Estimasi pengerjaan 14-20 hari kerja.',
                'kategori_id' => 3,
            ],
            [
                'nama_produk' => 'Meja Rias Floating Minimalis',
                'deskripsi_produk' => 'Meja rias gantung hemat ruang dengan cermin bulat berdiameter 60cm berpencahayaan ring LED sentuh dan laci khusus kosmetik.',
                'harga_produk' => 2500000.00,
                'gambar_produk' => 'gambar2.png',
                'desain_produk_3d' => 'produk/3d/ACC7dtDyQ8yMdfnh98ElWJ3QrICGk5JTWcfpXLDO.glb',
                'desain_produk_2d' => null,
                'pengerjaan_produk' => 'Estimasi pengerjaan 5-7 hari kerja.',
                'kategori_id' => 3,
            ],

            // --- Office (Kategori ID: 4) ---
            [
                'nama_produk' => 'Meja Kerja Direktur Premium',
                'deskripsi_produk' => 'Meja kerja direktur berbahan dasar kayu jati solid berlapis melamine doff dengan tempat kabel terintegrasi dan laci berkeamanan sidik jari.',
                'harga_produk' => 7200000.00,
                'gambar_produk' => 'gambar1.png',
                'desain_produk_3d' => 'produk/3d/ACC7dtDyQ8yMdfnh98ElWJ3QrICGk5JTWcfpXLDO.glb',
                'desain_produk_2d' => 'produk/2d/HfGBA2atke21Wn8gC0HNn66mluyEQZEVVjEZesva.jpeg',
                'pengerjaan_produk' => 'Estimasi pengerjaan 10-15 hari kerja.',
                'kategori_id' => 4,
            ],
            [
                'nama_produk' => 'Rak Buku Partisi Minimalis',
                'deskripsi_produk' => 'Rak buku sekaligus pembatas ruangan dengan desain asimetris modern berbahan kayu lapis tebal berkualitas tinggi dengan finishing HPL anti rayap.',
                'harga_produk' => 3500000.00,
                'gambar_produk' => 'gambar3.png',
                'desain_produk_3d' => null,
                'desain_produk_2d' => null,
                'pengerjaan_produk' => 'Estimasi pengerjaan 7-10 hari kerja.',
                'kategori_id' => 4,
            ],
            [
                'nama_produk' => 'Kursi Kerja Ergonomis Mesh',
                'deskripsi_produk' => 'Kursi kantor ergonomis dengan sandaran jaring/mesh sirkulasi udara optimal, penyangga pinggang lumbar-support, dan handrest 3D yang fleksibel.',
                'harga_produk' => 1800000.00,
                'gambar_produk' => 'gambar2.png',
                'desain_produk_3d' => 'produk/3d/9SGVZFDNJJAbvrw68kSUcBjTWqdNHebZXBvlcHCN.glb',
                'desain_produk_2d' => null,
                'pengerjaan_produk' => 'Barang ready stok.',
                'kategori_id' => 4,
            ],

            // --- Bathroom (Kategori ID: 5) ---
            [
                'nama_produk' => 'Kabinet Wastafel Teak Waterproof',
                'deskripsi_produk' => 'Lemari wastafel gantung dari kayu jati tua berlapis coating waterproof anti lembab dengan keran wastafel kuningan elegan.',
                'harga_produk' => 4800000.00,
                'gambar_produk' => 'gambar2.png',
                'desain_produk_3d' => 'produk/3d/9SGVZFDNJJAbvrw68kSUcBjTWqdNHebZXBvlcHCN.glb',
                'desain_produk_2d' => 'produk/2d/HfGBA2atke21Wn8gC0HNn66mluyEQZEVVjEZesva.jpeg',
                'pengerjaan_produk' => 'Estimasi pengerjaan 8-12 hari kerja.',
                'kategori_id' => 5,
            ],
            [
                'nama_produk' => 'Cermin Wastafel Smart LED',
                'deskripsi_produk' => 'Cermin kamar mandi pintar dengan bezel-less minimalis, lampu LED belakang bersensor sentuh untuk merubah warna cahaya (Warm/Cool) dan anti-kabut otomatis.',
                'harga_produk' => 1950000.00,
                'gambar_produk' => 'gambar3.png',
                'desain_produk_3d' => null,
                'desain_produk_2d' => null,
                'pengerjaan_produk' => 'Estimasi pengerjaan 5-7 hari kerja.',
                'kategori_id' => 5,
            ],
            [
                'nama_produk' => 'Lemari Gantung Kamar Mandi',
                'deskripsi_produk' => 'Lemari gantung minimalis bertingkat untuk menyimpan handuk bersih dan sabun, dilengkapi pintu cermin kaca buram.',
                'harga_produk' => 1200000.00,
                'gambar_produk' => 'gambar1.png',
                'desain_produk_3d' => null,
                'desain_produk_2d' => null,
                'pengerjaan_produk' => 'Estimasi pengerjaan 5-7 hari kerja.',
                'kategori_id' => 5,
            ],
        ];

        foreach ($products as $prod) {
            InteriorProduk::updateOrCreate(
                ['nama_produk' => $prod['nama_produk']],
                [
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
