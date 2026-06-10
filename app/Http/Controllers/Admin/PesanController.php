<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PesanMasuk;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PesanController extends Controller
{
    public function index(): View
    {
        $pesan = PesanMasuk::latest()->paginate(15);
        $belumDibaca = PesanMasuk::belumDibaca()->count();
        return view('admin.pesan.index', compact('pesan', 'belumDibaca'));
    }

    public function show(PesanMasuk $pesan): View
    {
        // Auto tandai sudah dibaca saat dibuka
        if ($pesan->isBelumDibaca()) {
            $pesan->tandaiSudahDibaca();
        }
        return view('admin.pesan.show', compact('pesan'));
    }

    public function tandai(PesanMasuk $pesan): RedirectResponse
    {
        $pesan->tandaiSudahDibaca();

        return redirect()->back()
            ->with('success', 'Pesan ditandai sebagai sudah dibaca.');
    }

    public function destroy(PesanMasuk $pesan): RedirectResponse
    {
        $pesan->delete();

        return redirect()->route('admin.pesan.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}
