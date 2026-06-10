<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InteriorProduk;
use App\Models\KategoriInterior;
use App\Models\PesanMasuk;
use App\Models\PortofolioProyek;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_produk'       => InteriorProduk::count(),
            'total_kategori'     => KategoriInterior::count(),
            'total_portofolio'   => PortofolioProyek::count(),
            'total_pesan'        => PesanMasuk::count(),
            'pesan_belum_dibaca' => PesanMasuk::belumDibaca()->count(),
        ];

        // Data chart: produk per kategori
        $chartData = KategoriInterior::withCount('produk')
            ->orderBy('produk_count', 'desc')
            ->get()
            ->map(fn($k) => [
                'label' => $k->nama_kategori,
                'count' => $k->produk_count,
            ]);

        // Pesan terbaru
        $pesanTerbaru = PesanMasuk::latest()->take(5)->get();

        // Produk terbaru
        $produkTerbaru = InteriorProduk::with('kategori')->latest()->take(5)->get();

        return view('admin.dashboard.index', compact(
            'stats',
            'chartData',
            'pesanTerbaru',
            'produkTerbaru'
        ));
    }
}
