<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortofolioProyek extends Model
{
    use HasFactory;

    protected $table = 'portofolio_proyek';

    protected $fillable = [
        'slug',
        'nama_proyek',
        'deskripsi',
        'lokasi',
        'lokasi_google_maps',
        'dokumentasi_proyek',
        'waktu_proyek',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getDokumentasiUrlAttribute(): ?string
    {
        return $this->dokumentasi_proyek ? asset('storage/'.$this->dokumentasi_proyek) : null;
    }
}
