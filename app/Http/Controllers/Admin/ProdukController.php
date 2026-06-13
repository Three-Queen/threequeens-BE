<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\StorageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProdukRequest;
use App\Models\InteriorProduk;
use App\Models\KategoriInterior;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProdukController extends Controller
{
    private function getInitials($string)
    {
        if (!$string) return '';
        $words = explode(' ', $string);
        $initials = '';
        foreach ($words as $word) {
            $word = preg_replace('/[^A-Za-z0-9]/', '', $word);
            if ($word !== '') {
                $initials .= strtoupper(substr($word, 0, 1));
            }
        }
        return $initials;
    }

    private function generateKodeProduk($namaProduk, $kategoriId, $index)
    {
        $kategori = KategoriInterior::find($kategoriId);
        $layananInit = $kategori ? $this->getInitials($kategori->tipe_layanan) : '';
        $kategoriInit = $kategori ? $this->getInitials($kategori->nama_kategori) : '';
        $produkInit = $this->getInitials($namaProduk);
        
        return sprintf('%s-%s-%s-%03d', $layananInit, $kategoriInit, $produkInit, $index);
    }

    private function getNextIndex()
    {
        $lastProduct = InteriorProduk::orderBy('id', 'desc')->first();
        if ($lastProduct && $lastProduct->kode_produk) {
            $parts = explode('-', $lastProduct->kode_produk);
            return (int) end($parts) + 1;
        }
        return InteriorProduk::count() + 1;
    }

    public function index(): View
    {
        $produk = InteriorProduk::with('kategori')->latest()->paginate(10);

        return view('admin.produk.index', compact('produk'));
    }

    public function create(): View
    {
        $kategori = KategoriInterior::orderBy('nama_kategori')->get();
        $nextIndex = $this->getNextIndex();

        return view('admin.produk.create', compact('kategori', 'nextIndex'));
    }

    public function store(ProdukRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['kode_produk'] = $this->generateKodeProduk($data['nama_produk'], $data['kategori_id'], $this->getNextIndex());

        // Upload gambar produk
        if ($request->hasFile('gambar_produk')) {
            $file = $request->file('gambar_produk');
            $filename = pathinfo($file->hashName(), PATHINFO_FILENAME).'.'.$file->getClientOriginalExtension();
            $data['gambar_produk'] = $file->storeAs('produk/gambar', $filename, 'public');
        }

        // Upload desain 3D
        if ($request->hasFile('desain_produk_3d')) {
            $file = $request->file('desain_produk_3d');
            $filename = pathinfo($file->hashName(), PATHINFO_FILENAME).'.'.$file->getClientOriginalExtension();
            $data['desain_produk_3d'] = $file->storeAs('produk/3d', $filename, 'public');
        }

        // Upload desain 2D
        if ($request->hasFile('desain_produk_2d')) {
            $file = $request->file('desain_produk_2d');
            $filename = pathinfo($file->hashName(), PATHINFO_FILENAME).'.'.$file->getClientOriginalExtension();
            $data['desain_produk_2d'] = $file->storeAs('produk/2d', $filename, 'public');
        }

        InteriorProduk::create($data);

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(InteriorProduk $produk): View
    {
        $produk->load('kategori');

        return view('admin.produk.show', compact('produk'));
    }

    public function edit(InteriorProduk $produk): View
    {
        $kategori = KategoriInterior::orderBy('nama_kategori')->get();
        
        $currentIndex = 1;
        if ($produk->kode_produk) {
            $parts = explode('-', $produk->kode_produk);
            $currentIndex = (int) end($parts);
        }

        return view('admin.produk.edit', compact('produk', 'kategori', 'currentIndex'));
    }

    public function update(ProdukRequest $request, InteriorProduk $produk): RedirectResponse
    {
        $data = $request->validated();

        // Preserve original index
        $currentIndex = 1;
        if ($produk->kode_produk) {
            $parts = explode('-', $produk->kode_produk);
            $currentIndex = (int) end($parts);
        }
        $data['kode_produk'] = $this->generateKodeProduk($data['nama_produk'], $data['kategori_id'], $currentIndex);

        // Upload gambar produk
        if ($request->hasFile('gambar_produk')) {
            if ($produk->gambar_produk) {
                StorageHelper::deleteSafe($produk->gambar_produk);
            }
            $file = $request->file('gambar_produk');
            $filename = pathinfo($file->hashName(), PATHINFO_FILENAME).'.'.$file->getClientOriginalExtension();
            $data['gambar_produk'] = $file->storeAs('produk/gambar', $filename, 'public');
        } else {
            unset($data['gambar_produk']);
        }

        // Upload desain 3D
        if ($request->hasFile('desain_produk_3d')) {
            if ($produk->desain_produk_3d) {
                StorageHelper::deleteSafe($produk->desain_produk_3d);
            }
            $file = $request->file('desain_produk_3d');
            $filename = pathinfo($file->hashName(), PATHINFO_FILENAME).'.'.$file->getClientOriginalExtension();
            $data['desain_produk_3d'] = $file->storeAs('produk/3d', $filename, 'public');
        } else {
            unset($data['desain_produk_3d']);
        }

        // Upload desain 2D
        if ($request->hasFile('desain_produk_2d')) {
            if ($produk->desain_produk_2d) {
                StorageHelper::deleteSafe($produk->desain_produk_2d);
            }
            $file = $request->file('desain_produk_2d');
            $filename = pathinfo($file->hashName(), PATHINFO_FILENAME).'.'.$file->getClientOriginalExtension();
            $data['desain_produk_2d'] = $file->storeAs('produk/2d', $filename, 'public');
        } else {
            unset($data['desain_produk_2d']);
        }

        $produk->update($data);

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(InteriorProduk $produk): RedirectResponse
    {
        // Hapus file terkait
        if ($produk->gambar_produk) {
            StorageHelper::deleteSafe($produk->gambar_produk);
        }
        if ($produk->desain_produk_3d) {
            StorageHelper::deleteSafe($produk->desain_produk_3d);
        }
        if ($produk->desain_produk_2d) {
            StorageHelper::deleteSafe($produk->desain_produk_2d);
        }

        $produk->delete();

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
