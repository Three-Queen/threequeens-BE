<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PortofolioRequest;
use App\Models\PortofolioProyek;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
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
        return view('admin.portofolio.create');
    }

    public function store(PortofolioRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('dokumentasi_proyek')) {
            $data['dokumentasi_proyek'] = $request->file('dokumentasi_proyek')
                ->store('portofolio/dokumentasi', 'public');
        }

        PortofolioProyek::create($data);

        return redirect()->route('admin.portofolio.index')
            ->with('success', 'Proyek portofolio berhasil ditambahkan.');
    }

    public function show(PortofolioProyek $portofolio): View
    {
        return view('admin.portofolio.show', compact('portofolio'));
    }

    public function edit(PortofolioProyek $portofolio): View
    {
        return view('admin.portofolio.edit', compact('portofolio'));
    }

    public function update(PortofolioRequest $request, PortofolioProyek $portofolio): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('dokumentasi_proyek')) {
            if ($portofolio->dokumentasi_proyek) {
                Storage::disk('public')->delete($portofolio->dokumentasi_proyek);
            }
            $data['dokumentasi_proyek'] = $request->file('dokumentasi_proyek')
                ->store('portofolio/dokumentasi', 'public');
        } else {
            unset($data['dokumentasi_proyek']);
        }

        $portofolio->update($data);

        return redirect()->route('admin.portofolio.index')
            ->with('success', 'Proyek portofolio berhasil diperbarui.');
    }

    public function destroy(PortofolioProyek $portofolio): RedirectResponse
    {
        if ($portofolio->dokumentasi_proyek) {
            Storage::disk('public')->delete($portofolio->dokumentasi_proyek);
        }

        $portofolio->delete();

        return redirect()->route('admin.portofolio.index')
            ->with('success', 'Proyek portofolio berhasil dihapus.');
    }
}
