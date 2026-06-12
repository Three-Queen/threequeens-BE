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
                'nama_proyek' => 'Appartemen Studio - Winduhaji',
                'lokasi' => 'Kuningan - 2026',
                'dokumentasi_proyek' => 'gambar3.png',
                'deskripsi' => 'Desain interior apartemen studio yang efisien dengan pemanfaatan ruang vertikal secara maksimal, bernuansa kayu hangat dan pencahayaan dramatis.',
            ],
            [
                'nama_proyek' => 'Appartemen Studio - Winduhaji',
                'lokasi' => 'Kuningan - 2026',
                'dokumentasi_proyek' => 'gambar1.png',
                'deskripsi' => 'Konsep tata ruang apartemen dengan furniture multifungsi terintegrasi untuk menciptakan kesan luas pada area terbatas.',
            ],
            [
                'nama_proyek' => 'Appartemen Studio Band - Winduhaji',
                'lokasi' => 'Kuningan - 2026',
                'dokumentasi_proyek' => 'gambar2.png',
                'deskripsi' => 'Studio latihan musik pribadi bernuansa akustik premium dengan penataan kedap suara dan pencahayaan panggung minimalis.',
            ],
            [
                'nama_proyek' => 'Kitchen Set L - Shape Premium',
                'lokasi' => 'Kuningan - 2026',
                'dokumentasi_proyek' => 'gambar3.png',
                'deskripsi' => 'Kitchen set minimalis bentuk L dengan island table berlapis kuarsa putih mewah dan kabinet bertekstur kayu alami.',
            ],
            [
                'nama_proyek' => 'Kitchen Set L - Shape Premium',
                'lokasi' => 'Kuningan - 2026',
                'dokumentasi_proyek' => 'gambar1.png',
                'deskripsi' => 'Kitchen set modern berteknologi soft-close dengan ruang penyimpanan luas untuk memaksimalkan fungsionalitas dapur.',
            ],
            [
                'nama_proyek' => 'Kitchen Set L - Shape Premium',
                'lokasi' => 'Kuningan - 2026',
                'dokumentasi_proyek' => 'gambar2.png',
                'deskripsi' => 'Kitchen set elegan bernuansa monokromatik abu-abu gelap dengan backsplash marmer dan pencahayaan strip LED tersembunyi.',
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
