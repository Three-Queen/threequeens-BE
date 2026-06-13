@extends('layouts.admin')

@section('title', 'Produk Interior')
@section('page-title', 'Produk Interior')
@section('page-subtitle', 'Kelola semua produk interior')

@section('breadcrumb')
    <span class="text-gray-400">/</span>
    <span class="text-primary font-medium">Produk Interior</span>
@endsection

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 px-5 py-4 border-b border-gray-100 dark:border-gray-700">
        <div>
            <h3 class="font-semibold text-gray-800 dark:text-white">Daftar Produk</h3>
            <p class="text-xs text-gray-400 mt-0.5">Total: {{ $produk->total() }} produk</p>
        </div>
        <a href="{{ route('admin.produk.create') }}"
           class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white text-sm px-4 py-2.5 rounded-xl transition-colors shadow-sm">
            <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Produk
        </a>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-accent/50 dark:bg-gray-700/30">
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Kode Produk</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Produk</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Kategori</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Harga</th>
                    <th class="text-center px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">File</th>
                    <th class="text-center px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($produk as $i => $item)
                    <tr class="transition-colors">
                        <td class="px-5 py-3 text-sm font-mono font-medium text-primary dark:text-amber-200">{{ $item->kode_produk }}</td>
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                @if($item->gambar_produk)
                                    <img src="{{ $item->gambar_url }}" alt="{{ $item->nama_produk }}"
                                         class="w-12 h-12 rounded-xl object-cover shadow-sm">
                                @else
                                    <div class="w-12 h-12 bg-accent dark:bg-gray-700 rounded-xl flex items-center justify-center">
                                        <i data-lucide="image" class="w-5 h-5 text-gray-300"></i>
                                    </div>
                                @endif
                                <div>
                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ $item->nama_produk }}</p>
                                    <p class="text-xs text-gray-400 truncate max-w-xs">{{ Str::limit($item->deskripsi_produk, 50) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3">
                            <span class="bg-accent dark:bg-primary/20 text-primary dark:text-amber-200 text-xs px-2.5 py-1 rounded-full font-medium">
                                {{ $item->kategori->nama_kategori ?? '-' }}
                            </span>
                        </td>
                        <td class="px-5 py-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ $item->harga_format }}
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-center gap-1.5">
                                @if($item->desain_produk_2d)
                                    <span class="bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-300 text-xs px-2 py-0.5 rounded-full" title="File 2D">2D</span>
                                @endif
                                @if($item->desain_produk_3d)
                                    <span class="bg-purple-50 dark:bg-purple-950/40 text-purple-600 dark:text-purple-300 text-xs px-2 py-0.5 rounded-full" title="File 3D">3D</span>
                                @endif
                                @if(!$item->desain_produk_2d && !$item->desain_produk_3d)
                                    <span class="text-gray-300 dark:text-gray-600 text-xs">-</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.produk.show', $item) }}"
                                   class="w-8 h-8 flex items-center justify-center bg-blue-50 hover:bg-blue-100 text-blue-600 dark:bg-blue-950/40 dark:hover:bg-blue-900/60 dark:text-blue-400 rounded-lg transition-colors" title="Detail">
                                    <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                </a>
                                <a href="{{ route('admin.produk.edit', $item) }}"
                                   class="w-8 h-8 flex items-center justify-center bg-amber-50 hover:bg-amber-100 text-amber-600 dark:bg-amber-950/40 dark:hover:bg-amber-900/60 dark:text-amber-400 rounded-lg transition-colors" title="Edit">
                                    <i data-lucide="pencil" class="w-3.5 h-3.5"></i>
                                </a>
                                <form id="delete-produk-{{ $item->id }}" method="POST"
                                      action="{{ route('admin.produk.destroy', $item) }}">
                                    @csrf @method('DELETE')
                                    <button type="button"
                                        onclick="confirmDelete('delete-produk-{{ $item->id }}', '{{ $item->nama_produk }}')"
                                        class="w-8 h-8 flex items-center justify-center bg-red-50 hover:bg-red-100 text-red-500 dark:bg-red-950/40 dark:hover:bg-red-900/60 dark:text-red-400 rounded-lg transition-colors" title="Hapus">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-12 text-center">
                            <i data-lucide="sofa" class="w-8 h-8 text-gray-200 dark:text-gray-600 mb-3 block"></i>
                            <p class="text-gray-400 text-sm mb-3">Belum ada produk</p>
                            <a href="{{ route('admin.produk.create') }}"
                               class="inline-flex items-center gap-2 bg-primary text-white text-sm px-4 py-2 rounded-xl">
                                <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Pertama
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($produk->hasPages())
        <div class="px-5 py-4 border-t border-gray-100 dark:border-gray-700">
            {{ $produk->links() }}
        </div>
    @endif
</div>
@endsection
