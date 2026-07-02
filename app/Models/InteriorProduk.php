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
        'panjang',
        'lebar',
        'tinggi',
        'bahan',
        'ketebalan',
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
        if (!$this->desain_produk_3d) return null;

        // Jika tersimpan sebagai tag HTML <iframe ... src="URL" ...>, ekstrak URL-nya
        if (preg_match('/src=["\']([^"\']+)["\']/i', $this->desain_produk_3d, $matches)) {
            return $matches[1];
        }

        if (str_starts_with($this->desain_produk_3d, 'http://') || str_starts_with($this->desain_produk_3d, 'https://')) {
            return $this->desain_produk_3d;
        }

        return asset('storage/'.$this->desain_produk_3d);
    }

    public function getDesain3dTypeAttribute(): ?string
    {
        if (!$this->desain_produk_3d) return null;

        if (str_contains($this->desain_produk_3d, '<iframe') || str_starts_with($this->desain_produk_3d, 'http://') || str_starts_with($this->desain_produk_3d, 'https://')) {
            return 'embed';
        }

        return 'file';
    }

    public function getDesain2dUrlAttribute(): ?string
    {
        if (!$this->desain_produk_2d) return null;
        
        $val = trim($this->desain_produk_2d);
        if (str_starts_with($val, '[') && str_ends_with($val, ']')) {
            $decoded = json_decode($val, true);
            if (is_array($decoded)) {
                $urls = array_map(function($path) {
                    return asset('storage/'.$path);
                }, $decoded);
                return implode(',', $urls);
            }
        }
        
        if (str_contains($val, ',')) {
            $paths = array_filter(array_map('trim', explode(',', $val)));
            $urls = array_map(function($path) {
                return asset('storage/'.$path);
            }, $paths);
            return implode(',', $urls);
        }
        
        return asset('storage/'.$this->desain_produk_2d);
    }

    public function getDesain2dFilesAttribute(): array
    {
        if (!$this->desain_produk_2d) return [];
        
        $val = trim($this->desain_produk_2d);
        if (str_starts_with($val, '[') && str_ends_with($val, ']')) {
            $decoded = json_decode($val, true);
            if (is_array($decoded)) {
                return array_map(function($path) {
                    return [
                        'name' => basename($path),
                        'url' => asset('storage/'.$path)
                    ];
                }, $decoded);
            }
        }
        
        if (str_contains($val, ',')) {
            $paths = array_filter(array_map('trim', explode(',', $val)));
            return array_map(function($path) {
                return [
                    'name' => basename($path),
                    'url' => asset('storage/'.$path)
                ];
            }, $paths);
        }

        return [[
            'name' => basename($this->desain_produk_2d),
            'url' => asset('storage/'.$this->desain_produk_2d)
        ]];
    }

    public function getHargaFormatAttribute(): string
    {
        return 'Rp '.number_format($this->harga_produk, 0, ',', '.');
    }
}
