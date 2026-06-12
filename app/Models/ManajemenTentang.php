<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManajemenTentang extends Model
{
    use HasFactory;

    protected $table = 'manajemen_tentang';

    protected $fillable = [
        'title',
        'deskripsi',
        'visi',
        'misi',
        'gambar1',
        'gambar2',
    ];

    public function getGambar1UrlAttribute(): ?string
    {
        return $this->gambar1 ? asset('storage/'.$this->gambar1) : null;
    }

    public function getGambar2UrlAttribute(): ?string
    {
        return $this->gambar2 ? asset('storage/'.$this->gambar2) : null;
    }

    public static function getData(): self
    {
        return static::firstOrCreate(['id' => 1], [
            'title' => 'Tentang Three Queens Interior',
            'deskripsi' => 'Kami adalah perusahaan desain interior terpercaya.',
            'visi' => 'Menjadi perusahaan interior dan furniture custom terpercaya yang menghadirkan solusi ruang berkualitas, inovatif, dan bernilai estetika tinggi.',
            'misi' => "• Memberikan layanan terbaik kepada setiap pelanggan.\n• Menghasilkan produk interior dan furniture yang berkualitas.\n• Mengutamakan kepuasan pelanggan dalam setiap proyek.\n• Mengembangkan desain yang inovatif dan fungsional.\n• Menjaga profesionalisme dan integritas dalam setiap pekerjaan.",
        ]);
    }
}
