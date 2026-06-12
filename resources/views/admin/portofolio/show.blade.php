@extends('layouts.admin')

@section('title', $portofolio->nama_proyek)
@section('page-title', 'Detail Proyek')

@section('breadcrumb')
    <span class="text-gray-400">/</span>
    <a href="{{ route('admin.portofolio.index') }}" class="hover:text-primary">Portofolio</a>
    <span class="text-gray-400">/</span>
    <span class="text-primary font-medium">{{ $portofolio->nama_proyek }}</span>
@endsection

@section('content')
<div class="max-w-3xl">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        @if($portofolio->dokumentasi_proyek)
            <img src="{{ $portofolio->dokumentasi_url }}" alt="{{ $portofolio->nama_proyek }}"
                 class="w-full h-72 object-cover">
        @else
            <div class="w-full h-72 bg-accent dark:bg-gray-700 flex items-center justify-center">
                <i data-lucide="building" class="w-10 h-10 text-gray-300"></i>
            </div>
        @endif

        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">{{ $portofolio->nama_proyek }}</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5">
                <div class="flex items-center gap-3 p-3 bg-accent/50 dark:bg-gray-700/50 rounded-xl">
                    <div class="w-9 h-9 bg-primary/10 rounded-lg flex items-center justify-center">
                        <i data-lucide="map-pin" class="w-4 h-4 text-primary"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide">Lokasi</p>
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ $portofolio->lokasi }}</p>
                    </div>
                </div>

                @if($portofolio->waktu_proyek)
                    <div class="flex items-center gap-3 p-3 bg-accent/50 dark:bg-gray-700/50 rounded-xl">
                        <div class="w-9 h-9 bg-primary/10 rounded-lg flex items-center justify-center">
                            <i data-lucide="calendar" class="w-4 h-4 text-primary"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Waktu</p>
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ $portofolio->waktu_proyek }}</p>
                        </div>
                    </div>
                @endif
            </div>

            @if($portofolio->deskripsi)
                <div class="mb-5">
                    <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-2">Deskripsi Proyek</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed whitespace-pre-line">{{ $portofolio->deskripsi }}</p>
                </div>
            @endif

            @if($portofolio->lokasi_google_maps)
                <div class="mb-5">
                    <a href="{{ $portofolio->lokasi_google_maps }}" target="_blank"
                       class="inline-flex items-center gap-2 text-sm text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 px-4 py-2.5 rounded-xl transition-colors">
                        <i data-lucide="map" class="w-4 h-4"></i>
                        Lihat di Google Maps
                    </a>
                </div>
            @endif

            <div class="flex items-center gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                <a href="{{ route('admin.portofolio.edit', $portofolio) }}"
                   class="flex items-center gap-2 bg-primary hover:bg-primary-dark text-white px-5 py-2.5 rounded-xl text-sm font-medium transition-colors shadow-sm">
                    <i data-lucide="pencil" class="w-4 h-4"></i> Edit
                </a>
                <a href="{{ route('admin.portofolio.index') }}"
                   class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-5 py-2.5 rounded-xl text-sm font-medium transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
                </a>
                <form id="del-porto-show" method="POST" action="{{ route('admin.portofolio.destroy', $portofolio) }}" class="ml-auto">
                    @csrf @method('DELETE')
                    <button type="button" onclick="confirmDelete('del-porto-show', '{{ $portofolio->nama_proyek }}')"
                        class="flex items-center gap-2 bg-red-50 hover:bg-red-100 text-red-600 px-5 py-2.5 rounded-xl text-sm font-medium transition-colors">
                        <i data-lucide="trash-2" class="w-4 h-4"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
