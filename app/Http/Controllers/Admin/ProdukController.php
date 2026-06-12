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
    public function index(): View
    {
        $produk = InteriorProduk::with('kategori')->latest()->paginate(10);

        return view('admin.produk.index', compact('produk'));
    }

    public function create(): View
    {
        $kategori = KategoriInterior::orderBy('nama_kategori')->get();

        return view('admin.produk.create', compact('kategori'));
    }

    public function store(ProdukRequest $request): RedirectResponse
    {
        $data = $request->validated();

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

        return view('admin.produk.edit', compact('produk', 'kategori'));
    }

    public function update(ProdukRequest $request, InteriorProduk $produk): RedirectResponse
    {
        $data = $request->validated();

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
