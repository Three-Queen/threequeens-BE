@extends('layouts.admin')

@section('title', 'Portofolio Proyek')
@section('page-title', 'Portofolio Proyek')
@section('page-subtitle', 'Kelola proyek portofolio')

@section('breadcrumb')
    <span class="text-gray-400">/</span>
    <span class="text-primary font-medium">Portofolio Proyek</span>
@endsection

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 px-5 py-4 border-b border-gray-100 dark:border-gray-700">
        <div>
            <h3 class="font-semibold text-gray-800 dark:text-white">Daftar Proyek</h3>
            <p class="text-xs text-gray-400 mt-0.5">Total: {{ $portofolio->total() }} proyek</p>
        </div>
        <a href="{{ route('admin.portofolio.create') }}"
           class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white text-sm px-4 py-2.5 rounded-xl transition-colors shadow-sm">
            <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Proyek
        </a>
    </div>

    {{-- Grid Cards --}}
    <div class="p-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($portofolio as $item)
            <div class="bg-white dark:bg-gray-700 border border-gray-100 dark:border-gray-600 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                {{-- Dokumentasi --}}
                @if($item->dokumentasi_proyek)
                    <img src="{{ $item->dokumentasi_url }}" alt="{{ $item->nama_proyek }}"
                         class="w-full h-44 object-cover">
                @else
                    <div class="w-full h-44 bg-accent dark:bg-gray-600 flex items-center justify-center">
                        <i data-lucide="building" class="w-8 h-8 text-gray-300"></i>
                    </div>
                @endif

                <div class="p-4">
                    <h4 class="font-semibold text-gray-800 dark:text-white mb-1">{{ $item->nama_proyek }}</h4>
                    <p class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1 mb-1">
                        <i data-lucide="map-pin" class="w-4 h-4 text-primary dark:text-amber-200"></i> {{ $item->lokasi }}
                    </p>
                    @if($item->waktu_proyek)
                        <p class="text-xs text-gray-400 flex items-center gap-1 mb-3">
                            <i data-lucide="calendar" class="w-4 h-4 text-gray-300 dark:text-gray-500"></i> {{ $item->waktu_proyek }}
                        </p>
                    @endif

                    <div class="flex items-center gap-2 pt-3 border-t border-gray-100 dark:border-gray-600">
                        <a href="{{ route('admin.portofolio.show', $item) }}"
                           class="flex-1 text-center text-xs bg-blue-50 hover:bg-blue-100 text-blue-600 dark:bg-blue-950/40 dark:hover:bg-blue-900/60 dark:text-blue-400 py-1.5 rounded-lg transition-colors">
                            <i data-lucide="eye" class="w-4 h-4 mr-1"></i> Detail
                        </a>
                        <a href="{{ route('admin.portofolio.edit', $item) }}"
                           class="flex-1 text-center text-xs bg-amber-50 hover:bg-amber-100 text-amber-600 dark:bg-amber-950/40 dark:hover:bg-amber-900/60 dark:text-amber-400 py-1.5 rounded-lg transition-colors">
                            <i data-lucide="pencil" class="w-4 h-4 mr-1"></i> Edit
                        </a>
                        <form id="del-porto-{{ $item->id }}" method="POST" action="{{ route('admin.portofolio.destroy', $item) }}">
                            @csrf @method('DELETE')
                            <button type="button" onclick="confirmDelete('del-porto-{{ $item->id }}', '{{ $item->nama_proyek }}')"
                                class="text-xs bg-red-50 hover:bg-red-100 text-red-500 dark:bg-red-950/40 dark:hover:bg-red-900/60 dark:text-red-400 py-1.5 px-2 rounded-lg transition-colors">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center">
                <i data-lucide="folder-open" class="w-10 h-10 text-gray-200 dark:text-gray-600 mb-4 block"></i>
                <p class="text-gray-400 mb-4">Belum ada proyek portofolio</p>
                <a href="{{ route('admin.portofolio.create') }}"
                   class="inline-flex items-center gap-2 bg-primary text-white text-sm px-5 py-2.5 rounded-xl">
                    <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Pertama
                </a>
            </div>
        @endforelse
    </div>

    @if($portofolio->hasPages())
        <div class="px-5 pb-5">{{ $portofolio->links() }}</div>
    @endif
</div>
@endsection
