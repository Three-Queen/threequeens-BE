<?php

namespace Database\Seeders;

use App\Models\ManajemenBeranda;
use App\Models\ManajemenKontak;
use App\Models\ManajemenTentang;
use App\Models\PortofolioProyek;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // =========================================
        // Super Admin User
        // =========================================
        User::updateOrCreate(
            ['email' => 'admin@threequeen.com'],
            [
                'name' => 'Super Admin',
                'email' => 'admin@threequeen.com',
                'password' => Hash::make('admin123'),
                'role' => 'super_admin',
            ]
        );

        $this->command->info('✅ Admin user berhasil dibuat:');
        $this->command->info('   Email    : admin@threequeen.com');
        $this->command->info('   Password : admin123');

        // =========================================
        // Default Data Beranda
        // =========================================
        ManajemenBeranda::firstOrCreate(['id' => 1], [
            'title' => 'Three Queen Interior',
            'deskripsi' => 'Hadirkan keindahan dan kenyamanan ke dalam setiap ruangan bersama Three Queen Interior. Kami menghadirkan solusi desain interior premium untuk hunian dan bisnis Anda.',
        ]);

        // =========================================
        // Default Data Tentang
        // =========================================
        ManajemenTentang::updateOrCreate(['id' => 1], [
            'title' => 'Kami Menciptakan Ruangan Impian Anda!',
            'deskripsi' => "Three Queens adalah perusahaan furniture custom dan desain interior yang berdiri sejak 2019. Kami berkomitmen menghadirkan solusi desain yang memadukan estetika dan fungsionalitas untuk setiap ruang yang kami kerjakan.\n\nDengan pengalaman lebih dari 5 tahun dan ratusan proyek yang telah selesai, kami memahami bahwa setiap klien memiliki kebutuhan yang unik. Oleh karena itu, kami menawarkan layanan fully custom dari tahap konsultasi hingga instalasi.",
            'visi' => 'Menjadi perusahaan interior dan furniture custom terpercaya yang menghadirkan solusi ruang berkualitas, inovatif, dan bernilai estetika tinggi.',
            'misi' => "• Memberikan layanan terbaik kepada setiap pelanggan.\n• Menghasilkan produk interior dan furniture yang berkualitas.\n• Mengutamakan kepuasan pelanggan dalam setiap proyek.\n• Mengembangkan desain yang inovatif dan fungsional.\n• Menjaga profesionalisme dan integritas dalam setiap pekerjaan.",
            'gambar1' => 'gambar1.png',
            'gambar2' => 'gambar2.png',
        ]);

        // =========================================
        // Default Data Kontak
        // =========================================
        ManajemenKontak::firstOrCreate(['id' => 1], [
            'lokasi' => 'Jl. Contoh No. 123, Jakarta Selatan, DKI Jakarta 12345',
            'whatsapp' => '081234567890',
            'email' => 'info@threequeen.com',
            'jam_kerja' => 'Senin - Sabtu: 08.00 - 17.00 WIB',
        ]);

        // =========================================
        // Default Data Portofolio
        // =========================================
        $portfolios = [
            [
                'nama_proyek' => 'Apartemen Studio Modern - Winduhaji',
                'lokasi' => 'Kuningan - 2026',
                'dokumentasi_proyek' => 'gambar3.png',
                'deskripsi' => 'Desain interior apartemen studio yang efisien dengan pemanfaatan ruang vertikal secara maksimal, bernuansa kayu hangat dan pencahayaan dramatis.',
            ],
            [
                'nama_proyek' => 'Kitchen Set L - Shape Premium - Kuningan',
                'lokasi' => 'Kuningan - 2026',
                'dokumentasi_proyek' => 'gambar1.png',
                'deskripsi' => 'Kitchen set minimalis bentuk L dengan island table berlapis kuarsa putih mewah dan kabinet bertekstur kayu alami.',
            ],
            [
                'nama_proyek' => 'Master Bedroom Scandinavian - Cirebon',
                'lokasi' => 'Cirebon - 2026',
                'dokumentasi_proyek' => 'gambar2.png',
                'deskripsi' => 'Desain kamar tidur utama bernuansa Scandinavian dengan paduan warna netral, kabinet wardrobe terintegrasi, dan headboard berbahan fabric lembut.',
            ],
            [
                'nama_proyek' => 'Luxury Bathroom Marble - Bandung',
                'lokasi' => 'Bandung - 2025',
                'dokumentasi_proyek' => 'gambar3.png',
                'deskripsi' => 'Interior kamar mandi mewah yang dibalut dinding marmer Carrara, cermin LED pintar, dan saniter bernuansa hitam matte.',
            ],
            [
                'nama_proyek' => 'Office Space Startup - Jakarta',
                'lokasi' => 'Jakarta - 2026',
                'dokumentasi_proyek' => 'gambar1.png',
                'deskripsi' => 'Ruang kantor kerja bersama dengan konsep open-space, dipadukan dengan tanaman indoor dan ruang meeting kedap suara untuk produktivitas maksimal.',
            ],
            [
                'nama_proyek' => 'Coffee Shop Industrial - Kuningan',
                'lokasi' => 'Kuningan - 2025',
                'dokumentasi_proyek' => 'gambar2.png',
                'deskripsi' => 'Desain cafe kopi industrial menggunakan ekspos bata merah, semen poles, furniture besi kustom, dan lampu gantung edison yang estetik.',
            ],
            [
                'nama_proyek' => 'Butik Fashion Minimalis - Cirebon',
                'lokasi' => 'Cirebon - 2026',
                'dokumentasi_proyek' => 'gambar3.png',
                'deskripsi' => 'Tata ruang butik pakaian premium dengan sistem gantungan kustom minimalis hitam, pencahayaan spotlight presisi, dan fitting room bergaya estetik.',
            ],
            [
                'nama_proyek' => 'Custom TV Cabinet - Winduhaji',
                'lokasi' => 'Kuningan - 2026',
                'dokumentasi_proyek' => 'gambar1.png',
                'deskripsi' => 'Pengerjaan furniture custom kabinet TV minimalis melayang dengan panel kisi-kisi kayu di bagian belakang dan lampu LED strip tersembunyi.',
            ],
            [
                'nama_proyek' => 'Custom Wardrobe Walk-in Closet',
                'lokasi' => 'Kuningan - 2026',
                'dokumentasi_proyek' => 'gambar2.png',
                'deskripsi' => 'Pembuatan lemari pakaian custom pintu kaca tempered dengan frame aluminium hitam gelap dan pencahayaan interior LED otomatis.',
            ],
            [
                'nama_proyek' => 'Living Room Cozy - Kuningan',
                'lokasi' => 'Kuningan - 2025',
                'dokumentasi_proyek' => 'gambar3.png',
                'deskripsi' => 'Desain ruang keluarga hangat dengan sofa modular abu-abu besar, karpet rajut, dan dekorasi dinding rak kustom multifungsi.',
            ],
            [
                'nama_proyek' => 'Dapur Kitchen Set HPL - Cirebon',
                'lokasi' => 'Cirebon - 2026',
                'dokumentasi_proyek' => 'gambar1.png',
                'deskripsi' => 'Kitchen set kompak untuk rumah minimalis dengan finishing HPL motif serat kayu gelap dan anti-fingerprint.',
            ],
            [
                'nama_proyek' => 'Kantor Kerja Eksekutif - Bandung',
                'lokasi' => 'Bandung - 2026',
                'dokumentasi_proyek' => 'gambar2.png',
                'deskripsi' => 'Desain meja kerja direksi custom berpola marmer, kursi ergonomis premium, dan rak berkas minimalis fungsional.',
            ],
        ];

        foreach ($portfolios as $p) {
            PortofolioProyek::firstOrCreate(
                ['nama_proyek' => $p['nama_proyek'], 'dokumentasi_proyek' => $p['dokumentasi_proyek']],
                ['lokasi' => $p['lokasi'], 'deskripsi' => $p['deskripsi']]
            );
        }

        $this->command->info('✅ Data default berhasil dibuat.');
    }
}
