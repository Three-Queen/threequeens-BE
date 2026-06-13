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
        'kategori_id',
        'nama_proyek',
        'deskripsi',
        'lokasi',
        'lokasi_google_maps',
        'dokumentasi_proyek',
        'waktu_proyek',
        'durasi_pengerjaan',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriInterior::class, 'kategori_id');
    }

    public function produk()
    {
        return $this->belongsToMany(InteriorProduk::class, 'portofolio_produk', 'portofolio_proyek_id', 'interior_produk_id');
    }

    public function galeri()
    {
        return $this->hasMany(PortofolioGaleri::class, 'portofolio_proyek_id');
    }

    public function getDokumentasiUrlAttribute(): ?string
    {
        return $this->dokumentasi_proyek ? asset('storage/'.$this->dokumentasi_proyek) : null;
    }
}
