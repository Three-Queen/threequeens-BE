<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BerandaRequest;
use App\Models\ManajemenBeranda;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BerandaController extends Controller
{
    public function edit(): View
    {
        $beranda = ManajemenBeranda::getData();
        return view('admin.beranda.edit', compact('beranda'));
    }

    public function update(BerandaRequest $request): RedirectResponse
    {
        $beranda = ManajemenBeranda::getData();
        $data = $request->validated();

        if ($request->hasFile('background')) {
            if ($beranda->background) {
                Storage::disk('public')->delete($beranda->background);
            }
            $data['background'] = $request->file('background')
                ->store('beranda', 'public');
        } else {
            unset($data['background']);
        }

        $beranda->update($data);

        return redirect()->route('admin.beranda.edit')
            ->with('success', 'Data beranda berhasil diperbarui.');
    }
}
