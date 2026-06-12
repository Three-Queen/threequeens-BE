<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManajemenBeranda extends Model
{
    use HasFactory;

    protected $table = 'manajemen_beranda';

    protected $fillable = [
        'title',
        'deskripsi',
        'background',
    ];

    public function getBackgroundUrlAttribute(): ?string
    {
        return $this->background ? asset('storage/'.$this->background) : null;
    }

    public static function getData(): self
    {
        return static::firstOrCreate(['id' => 1], [
            'title' => 'Three Queen Interior',
            'deskripsi' => 'Solusi desain interior terbaik untuk hunian dan bisnis Anda.',
        ]);
    }
}
