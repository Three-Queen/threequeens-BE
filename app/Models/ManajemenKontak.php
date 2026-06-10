<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManajemenKontak extends Model
{
    use HasFactory;

    protected $table = 'manajemen_kontak';

    protected $fillable = [
        'lokasi',
        'whatsapp',
        'email',
        'facebook',
        'tiktok',
        'instagram',
        'jam_kerja',
    ];

    public static function getData(): self
    {
        return static::firstOrCreate(['id' => 1], [
            'lokasi' => 'Jakarta, Indonesia',
            'jam_kerja' => 'Senin - Sabtu: 08.00 - 17.00 WIB',
        ]);
    }
}
