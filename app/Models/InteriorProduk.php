<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InteriorProduk extends Model
{
    use HasFactory;

    protected $table = 'interior_produk';

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'deskripsi_produk',
        'harga_produk',
        'gambar_produk',
        'desain_produk_3d',
        'desain_produk_2d',
        'pengerjaan_produk',
        'kategori_id',
    ];

    protected $casts = [
        'harga_produk' => 'decimal:2',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'kode_produk';
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriInterior::class, 'kategori_id');
    }

    public function portofolios()
    {
        return $this->belongsToMany(PortofolioProyek::class, 'portofolio_produk', 'interior_produk_id', 'portofolio_proyek_id');
    }

    public function getGambarUrlAttribute(): ?string
    {
        return $this->gambar_produk ? asset('storage/'.$this->gambar_produk) : null;
    }

    public function getDesain3dUrlAttribute(): ?string
    {
        return $this->desain_produk_3d ? asset('storage/'.$this->desain_produk_3d) : null;
    }

    public function getDesain2dUrlAttribute(): ?string
    {
        return $this->desain_produk_2d ? asset('storage/'.$this->desain_produk_2d) : null;
    }

    public function getHargaFormatAttribute(): string
    {
        return 'Rp '.number_format($this->harga_produk, 0, ',', '.');
    }
}
