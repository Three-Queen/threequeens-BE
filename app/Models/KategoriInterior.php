<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriInterior extends Model
{
    use HasFactory;

    protected $table = 'kategori_interior';

    protected $fillable = [
        'nama_kategori',
    ];

    public function produk(): HasMany
    {
        return $this->hasMany(InteriorProduk::class, 'kategori_id');
    }

    public function getProdukCountAttribute(): int
    {
        return $this->produk()->count();
    }
}
