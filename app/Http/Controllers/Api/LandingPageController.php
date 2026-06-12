<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InteriorProduk;
use App\Models\KategoriInterior;
use App\Models\ManajemenBeranda;
use App\Models\ManajemenKontak;
use App\Models\ManajemenTentang;
use App\Models\PesanMasuk;
use App\Models\PortofolioProyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LandingPageController extends Controller
{
    public function index()
    {
        $beranda = ManajemenBeranda::getData();
        $berandaData = [
            'title' => $beranda->title,
            'deskripsi' => $beranda->deskripsi,
            'background' => $beranda->background_url,
        ];

        $tentang = ManajemenTentang::getData();
        $tentangData = [
            'title' => $tentang->title,
            'deskripsi' => $tentang->deskripsi,
            'visi' => $tentang->visi,
            'misi' => $tentang->misi,
            'gambar1' => $tentang->gambar1_url,
            'gambar2' => $tentang->gambar2_url,
        ];

        $kontak = ManajemenKontak::getData();
        $kontakData = [
            'lokasi' => $kontak->lokasi,
            'whatsapp' => $kontak->whatsapp,
            'email' => $kontak->email,
            'facebook' => $kontak->facebook,
            'tiktok' => $kontak->tiktok,
            'instagram' => $kontak->instagram,
            'jam_kerja' => $kontak->jam_kerja,
        ];

        $categories = KategoriInterior::select('id', 'nama_kategori')->get();

        $products = InteriorProduk::with('kategori')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama_produk' => $item->nama_produk,
                    'deskripsi_produk' => $item->deskripsi_produk,
                    'harga_produk' => $item->harga_produk,
                    'harga_format' => $item->harga_format,
                    'gambar_url' => $item->gambar_url,
                    'desain_2d_url' => $item->desain_2d_url,
                    'desain_3d_url' => $item->desain_3d_url,
                    'pengerjaan_produk' => $item->pengerjaan_produk,
                    'kategori' => $item->kategori ? $item->kategori->nama_kategori : null,
                ];
            });

        $portfolios = PortofolioProyek::get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama_proyek' => $item->nama_proyek,
                    'deskripsi' => $item->deskripsi,
                    'lokasi' => $item->lokasi,
                    'lokasi_google_maps' => $item->lokasi_google_maps,
                    'dokumentasi_url' => $item->dokumentasi_url,
                    'waktu_proyek' => $item->waktu_proyek,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => [
                'beranda' => $berandaData,
                'tentang' => $tentangData,
                'kontak' => $kontakData,
                'categories' => $categories,
                'products' => $products,
                'portfolios' => $portfolios,
            ],
        ]);
    }

    public function submitMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $pesan = PesanMasuk::create([
            'nama' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->phone,
            'pesan' => $request->message,
            'status' => PesanMasuk::STATUS_BELUM,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dikirim dan disimpan!',
            'data' => $pesan,
        ], 201);
    }
}
