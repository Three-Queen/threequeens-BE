<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KategoriRequest;
use App\Models\KategoriInterior;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KategoriController extends Controller
{
    public function index(): View
    {
        $kategori = KategoriInterior::withCount('produk')->latest()->paginate(10);

        return view('admin.kategori.index', compact('kategori'));
    }

    public function create(): View
    {
        return view('admin.kategori.create');
    }

    public function store(KategoriRequest $request): RedirectResponse
    {
        KategoriInterior::create($request->validated());

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(KategoriInterior $kategori): View
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(KategoriRequest $request, KategoriInterior $kategori): RedirectResponse
    {
        $kategori->update($request->validated());

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(KategoriInterior $kategori): RedirectResponse
    {
        if ($kategori->produk()->count() > 0) {
            return redirect()->route('admin.kategori.index')
                ->with('error', 'Kategori tidak dapat dihapus karena memiliki produk terkait.');
        }

        $kategori->delete();

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
