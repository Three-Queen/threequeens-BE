<?php

namespace Database\Seeders;

use App\Models\ManajemenBeranda;
use App\Models\ManajemenKontak;
use App\Models\ManajemenTentang;
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
                'name'     => 'Super Admin',
                'email'    => 'admin@threequeen.com',
                'password' => Hash::make('admin123'),
                'role'     => 'super_admin',
            ]
        );

        $this->command->info('✅ Admin user berhasil dibuat:');
        $this->command->info('   Email    : admin@threequeen.com');
        $this->command->info('   Password : admin123');

        // =========================================
        // Default Data Beranda
        // =========================================
        ManajemenBeranda::firstOrCreate(['id' => 1], [
            'title'     => 'Three Queen Interior',
            'deskripsi' => 'Hadirkan keindahan dan kenyamanan ke dalam setiap ruangan bersama Three Queen Interior. Kami menghadirkan solusi desain interior premium untuk hunian dan bisnis Anda.',
        ]);

        // =========================================
        // Default Data Tentang
        // =========================================
        ManajemenTentang::firstOrCreate(['id' => 1], [
            'title'     => 'Tentang Three Queen Interior',
            'deskripsi' => 'Three Queen Interior adalah perusahaan desain interior terpercaya yang telah berpengalaman dalam menciptakan ruangan indah dan fungsional. Kami berkomitmen untuk memberikan solusi terbaik bagi setiap klien kami dengan mengutamakan kualitas, estetika, dan kepuasan pelanggan.',
        ]);

        // =========================================
        // Default Data Kontak
        // =========================================
        ManajemenKontak::firstOrCreate(['id' => 1], [
            'lokasi'    => 'Jl. Contoh No. 123, Jakarta Selatan, DKI Jakarta 12345',
            'whatsapp'  => '081234567890',
            'email'     => 'info@threequeen.com',
            'jam_kerja' => 'Senin - Sabtu: 08.00 - 17.00 WIB',
        ]);

        $this->command->info('✅ Data default berhasil dibuat.');
    }
}
