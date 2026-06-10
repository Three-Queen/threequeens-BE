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
        'gambar1',
        'gambar2',
    ];

    public function getGambar1UrlAttribute(): ?string
    {
        return $this->gambar1 ? asset('storage/' . $this->gambar1) : null;
    }

    public function getGambar2UrlAttribute(): ?string
    {
        return $this->gambar2 ? asset('storage/' . $this->gambar2) : null;
    }

    public static function getData(): self
    {
        return static::firstOrCreate(['id' => 1], [
            'title' => 'Tentang Three Queen Interior',
            'deskripsi' => 'Kami adalah perusahaan desain interior terpercaya.',
        ]);
    }
}
