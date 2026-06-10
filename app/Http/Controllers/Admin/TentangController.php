<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TentangRequest;
use App\Models\ManajemenTentang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TentangController extends Controller
{
    public function edit(): View
    {
        $tentang = ManajemenTentang::getData();
        return view('admin.tentang.edit', compact('tentang'));
    }

    public function update(TentangRequest $request): RedirectResponse
    {
        $tentang = ManajemenTentang::getData();
        $data = $request->validated();

        if ($request->hasFile('gambar1')) {
            if ($tentang->gambar1) {
                Storage::disk('public')->delete($tentang->gambar1);
            }
            $data['gambar1'] = $request->file('gambar1')->store('tentang', 'public');
        } else {
            unset($data['gambar1']);
        }

        if ($request->hasFile('gambar2')) {
            if ($tentang->gambar2) {
                Storage::disk('public')->delete($tentang->gambar2);
            }
            $data['gambar2'] = $request->file('gambar2')->store('tentang', 'public');
        } else {
            unset($data['gambar2']);
        }

        $tentang->update($data);

        return redirect()->route('admin.tentang.edit')
            ->with('success', 'Data tentang berhasil diperbarui.');
    }
}
