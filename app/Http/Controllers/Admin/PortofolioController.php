<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\StorageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PortofolioRequest;
use App\Models\PortofolioProyek;
use App\Models\KategoriInterior;
use App\Models\InteriorProduk;
use App\Models\PortofolioGaleri;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class PortofolioController extends Controller
{
    public function index(): View
    {
        $portofolio = PortofolioProyek::latest()->paginate(10);

        return view('admin.portofolio.index', compact('portofolio'));
    }

    public function create(): View
    {
        $kategoris = KategoriInterior::all();
        $produks = InteriorProduk::all();
        return view('admin.portofolio.create', compact('kategoris', 'produks'));
    }

    public function store(PortofolioRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = \Illuminate\Support\Str::random(10);

        if ($request->hasFile('dokumentasi_proyek')) {
            $data['dokumentasi_proyek'] = $request->file('dokumentasi_proyek')
                ->store('portofolio/dokumentasi', 'public');
        }

        $portofolio = PortofolioProyek::create($data);

        if ($request->filled('produk_ids')) {
            $portofolio->produk()->sync($request->produk_ids);
        }

        if ($request->hasFile('galeri')) {
            foreach ($request->file('galeri') as $file) {
                $path = $file->store('portofolio/galeri', 'public');
                $portofolio->galeri()->create(['gambar_url' => $path]);
            }
        }

        return redirect()->route('admin.portofolio.index')
            ->with('success', 'Proyek portofolio berhasil ditambahkan.');
    }

    public function show(PortofolioProyek $portofolio): View
    {
        return view('admin.portofolio.show', compact('portofolio'));
    }

    public function edit(PortofolioProyek $portofolio): View
    {
        $kategoris = KategoriInterior::all();
        $produks = InteriorProduk::all();
        $selectedProduks = $portofolio->produk->pluck('id')->toArray();
        return view('admin.portofolio.edit', compact('portofolio', 'kategoris', 'produks', 'selectedProduks'));
    }

    public function update(PortofolioRequest $request, PortofolioProyek $portofolio): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('dokumentasi_proyek')) {
            if ($portofolio->dokumentasi_proyek) {
                StorageHelper::deleteSafe($portofolio->dokumentasi_proyek);
            }
            $data['dokumentasi_proyek'] = $request->file('dokumentasi_proyek')
                ->store('portofolio/dokumentasi', 'public');
        } else {
            unset($data['dokumentasi_proyek']);
        }

        $portofolio->update($data);

        if ($request->has('produk_ids')) {
            $portofolio->produk()->sync($request->produk_ids);
        } else {
            $portofolio->produk()->detach();
        }

        if ($request->hasFile('galeri')) {
            foreach ($request->file('galeri') as $file) {
                $path = $file->store('portofolio/galeri', 'public');
                $portofolio->galeri()->create(['gambar_url' => $path]);
            }
        }

        return redirect()->route('admin.portofolio.index')
            ->with('success', 'Proyek portofolio berhasil diperbarui.');
    }

    public function destroy(PortofolioProyek $portofolio): RedirectResponse
    {
        if ($portofolio->dokumentasi_proyek) {
            StorageHelper::deleteSafe($portofolio->dokumentasi_proyek);
        }

        foreach ($portofolio->galeri as $galeri) {
            StorageHelper::deleteSafe($galeri->gambar_url);
        }

        $portofolio->delete();

        return redirect()->route('admin.portofolio.index')
            ->with('success', 'Proyek portofolio berhasil dihapus.');
    }

    public function destroyGaleri($id): JsonResponse
    {
        $galeri = PortofolioGaleri::findOrFail($id);
        StorageHelper::deleteSafe($galeri->gambar_url);
        $galeri->delete();

        return response()->json([
            'success' => true,
            'message' => 'Foto galeri berhasil dihapus'
        ]);
    }
}
