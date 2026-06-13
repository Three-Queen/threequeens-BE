<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortofolioGaleri extends Model
{
    use HasFactory;

    protected $table = 'portofolio_galeri';

    protected $fillable = [
        'portofolio_proyek_id',
        'gambar_url',
    ];

    public function portofolio()
    {
        return $this->belongsTo(PortofolioProyek::class, 'portofolio_proyek_id');
    }

    public function getUrlAttribute(): ?string
    {
        return $this->gambar_url ? asset('storage/'.$this->gambar_url) : null;
    }
}
