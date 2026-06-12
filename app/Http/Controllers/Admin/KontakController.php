<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KontakRequest;
use App\Models\ManajemenKontak;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KontakController extends Controller
{
    public function edit(): View
    {
        $kontak = ManajemenKontak::getData();

        return view('admin.kontak.edit', compact('kontak'));
    }

    public function update(KontakRequest $request): RedirectResponse
    {
        $kontak = ManajemenKontak::getData();
        $kontak->update($request->validated());

        return redirect()->route('admin.kontak.edit')
            ->with('success', 'Data kontak berhasil diperbarui.');
    }
}
