@extends('layouts.admin')

@section('title', 'Kategori Interior')
@section('page-title', 'Kategori Interior')
@section('page-subtitle', 'Kelola kategori produk interior')

@section('breadcrumb')
    <span class="text-gray-400">/</span>
    <span class="text-primary font-medium">Kategori Interior</span>
@endsection

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 px-5 py-4 border-b border-gray-100 dark:border-gray-700">
        <div>
            <h3 class="font-semibold text-gray-800 dark:text-white">Daftar Kategori</h3>
            <p class="text-xs text-gray-400 mt-0.5">Total: {{ $kategori->total() }} kategori</p>
        </div>
        <a href="{{ route('admin.kategori.create') }}"
           class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white text-sm px-4 py-2.5 rounded-xl transition-colors shadow-sm">
            <i data-lucide="plus" class="w-3.5 h-3.5"></i>
            Tambah Kategori
        </a>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-accent/50 dark:bg-gray-700/30">
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide w-12">No</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Nama Kategori</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Jumlah Produk</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Dibuat</th>
                    <th class="text-center px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($kategori as $i => $item)
                    <tr class="transition-colors">
                        <td class="px-5 py-3 text-sm text-gray-500">{{ $kategori->firstItem() + $i }}</td>
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 bg-accent dark:bg-primary/20 rounded-lg flex items-center justify-center">
                                    <i data-lucide="tag" class="w-4 h-4 text-primary dark:text-amber-200"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ $item->nama_kategori }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3">
                            <span class="bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-300 text-xs px-2.5 py-1 rounded-full font-medium">
                                {{ $item->produk_count }} produk
                            </span>
                        </td>
                        <td class="px-5 py-3 text-xs text-gray-400">{{ $item->created_at->format('d M Y') }}</td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.kategori.edit', $item) }}"
                                   class="w-8 h-8 flex items-center justify-center bg-amber-50 hover:bg-amber-100 text-amber-600 dark:bg-amber-950/40 dark:hover:bg-amber-900/60 dark:text-amber-400 rounded-lg transition-colors" title="Edit">
                                    <i data-lucide="pencil" class="w-3.5 h-3.5"></i>
                                </a>
                                <form id="delete-kategori-{{ $item->id }}" method="POST"
                                      action="{{ route('admin.kategori.destroy', $item) }}">
                                    @csrf @method('DELETE')
                                    <button type="button"
                                        onclick="confirmDelete('delete-kategori-{{ $item->id }}', '{{ $item->nama_kategori }}')"
                                        class="w-8 h-8 flex items-center justify-center bg-red-50 hover:bg-red-100 text-red-500 dark:bg-red-950/40 dark:hover:bg-red-900/60 dark:text-red-400 rounded-lg transition-colors" title="Hapus">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-12 text-center">
                            <i data-lucide="tags" class="w-8 h-8 text-gray-200 dark:text-gray-600 mb-3 block"></i>
                            <p class="text-gray-400 text-sm mb-3">Belum ada kategori</p>
                            <a href="{{ route('admin.kategori.create') }}"
                               class="inline-flex items-center gap-2 bg-primary text-white text-sm px-4 py-2 rounded-xl">
                                <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Pertama
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($kategori->hasPages())
        <div class="px-5 py-4 border-t border-gray-100 dark:border-gray-700">
            {{ $kategori->links() }}
        </div>
    @endif
</div>
@endsection
