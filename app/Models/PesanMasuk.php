<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesanMasuk extends Model
{
    use HasFactory;

    protected $table = 'pesan_masuk';

    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'pesan',
        'status',
    ];

    const STATUS_BELUM = 'belum_dibaca';
    const STATUS_SUDAH = 'sudah_dibaca';

    public function scopeBelumDibaca($query)
    {
        return $query->where('status', self::STATUS_BELUM);
    }

    public function scopeSudahDibaca($query)
    {
        return $query->where('status', self::STATUS_SUDAH);
    }

    public function isBelumDibaca(): bool
    {
        return $this->status === self::STATUS_BELUM;
    }

    public function tandaiSudahDibaca(): void
    {
        $this->update(['status' => self::STATUS_SUDAH]);
    }

    public function getStatusBadgeAttribute(): string
    {
        return $this->status === self::STATUS_BELUM
            ? '<span class="badge-unread">Belum Dibaca</span>'
            : '<span class="badge-read">Sudah Dibaca</span>';
    }
}
