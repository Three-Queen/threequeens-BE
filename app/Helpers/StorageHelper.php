<?php

namespace App\Helpers;

use App\Models\InteriorProduk;
use App\Models\ManajemenBeranda;
use App\Models\ManajemenTentang;
use App\Models\PortofolioProyek;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class StorageHelper
{
    /**
     * Delete a file from public storage only if it is not referenced by other records.
     */
    public static function deleteSafe(?string $path): bool
    {
        if (empty($path)) {
            return false;
        }

        // Count references across all models storing file paths
        $produkCount = InteriorProduk::where('gambar_produk', $path)
            ->orWhere('desain_produk_3d', $path)
            ->orWhere('desain_produk_2d', $path)
            ->count();

        $portoCount = PortofolioProyek::where('dokumentasi_proyek', $path)->count();

        $tentangCount = ManajemenTentang::where('gambar1', $path)
            ->orWhere('gambar2', $path)
            ->count();

        $berandaCount = ManajemenBeranda::where('background', $path)->count();

        $userCount = User::where('avatar', $path)->count();

        $totalReferences = $produkCount + $portoCount + $tentangCount + $berandaCount + $userCount;

        // If referenced by 1 or fewer database records, it is safe to delete
        if ($totalReferences <= 1) {
            return Storage::disk('public')->delete($path);
        }

        return false;
    }
}
