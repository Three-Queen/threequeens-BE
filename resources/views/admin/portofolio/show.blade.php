@extends('layouts.admin')

@section('title', $portofolio->nama_proyek)
@section('page-title', 'Detail Project')

@section('breadcrumb')
    <span class="text-gray-400">/</span>
    <a href="{{ route('admin.portofolio.index') }}" class="hover:text-primary">Portofolio</a>
    <span class="text-gray-400">/</span>
    <span class="text-primary font-medium">{{ $portofolio->nama_proyek }}</span>
@endsection

@section('content')
<div class="w-full">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        @if($portofolio->dokumentasi_url)
            <img src="{{ $portofolio->dokumentasi_url }}" alt="{{ $portofolio->nama_proyek }}" class="w-full h-96 object-cover">
        @else
            <div class="w-full h-96 bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                <i data-lucide="image" class="w-12 h-12 text-gray-300 dark:text-gray-600"></i>
            </div>
        @endif

        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">{{ $portofolio->nama_proyek }}</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-5">
                <div class="flex items-center gap-3 p-3 bg-accent/50 dark:bg-gray-700/50 rounded-xl">
                    <div class="w-9 h-9 bg-primary/10 dark:bg-primary/20 rounded-lg flex items-center justify-center shrink-0">
                        <i data-lucide="map-pin" class="w-4 h-4 text-primary dark:text-amber-200"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase tracking-wider text-gray-500 dark:text-gray-400 font-semibold mb-0.5">Lokasi</p>
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200 line-clamp-1">{{ $portofolio->lokasi }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 p-3 bg-accent/50 dark:bg-gray-700/50 rounded-xl">
                    <div class="w-9 h-9 bg-primary/10 dark:bg-primary/20 rounded-lg flex items-center justify-center shrink-0">
                        <i data-lucide="calendar" class="w-4 h-4 text-primary dark:text-amber-200"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase tracking-wider text-gray-500 dark:text-gray-400 font-semibold mb-0.5">Waktu Project</p>
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200 line-clamp-1">
                            {{ $portofolio->waktu_proyek ? \Carbon\Carbon::parse($portofolio->waktu_proyek)->translatedFormat('d F Y') : '-' }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3 p-3 bg-accent/50 dark:bg-gray-700/50 rounded-xl">
                    <div class="w-9 h-9 bg-primary/10 dark:bg-primary/20 rounded-lg flex items-center justify-center shrink-0">
                        <i data-lucide="clock" class="w-4 h-4 text-primary dark:text-amber-200"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase tracking-wider text-gray-500 dark:text-gray-400 font-semibold mb-0.5">Durasi Pengerjaan</p>
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200 line-clamp-1">{{ $portofolio->durasi_pengerjaan ?? '-' }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 p-3 bg-accent/50 dark:bg-gray-700/50 rounded-xl">
                    <div class="w-9 h-9 bg-primary/10 dark:bg-primary/20 rounded-lg flex items-center justify-center shrink-0">
                        <i data-lucide="tag" class="w-4 h-4 text-primary dark:text-amber-200"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase tracking-wider text-gray-500 dark:text-gray-400 font-semibold mb-0.5">Kategori</p>
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200 line-clamp-1">{{ $portofolio->kategori->nama_kategori ?? '-' }}</p>
                    </div>
                </div>
            </div>

            @if($portofolio->lokasi_google_maps)
                <div class="mb-5">
                    <a href="{{ $portofolio->lokasi_google_maps }}" target="_blank"
                       class="inline-flex items-center gap-2 text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 bg-blue-50 hover:bg-blue-100 dark:bg-blue-950/40 dark:hover:bg-blue-900/60 px-4 py-2.5 rounded-xl transition-colors">
                        <i data-lucide="map" class="w-4 h-4"></i>
                        Lihat di Google Maps
                    </a>
                </div>
            @endif

            @if($portofolio->deskripsi)
            <div class="mt-8">
                <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-4 border-b border-gray-100 dark:border-gray-700 pb-2">Deskripsi Project</h4>
                <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                    {!! nl2br(e($portofolio->deskripsi)) !!}
                </div>
            </div>
            @endif

            @if($portofolio->galeri && $portofolio->galeri->count() > 0)
            <div class="mt-8">
                <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-4 border-b border-gray-100 dark:border-gray-700 pb-2">Galeri Tambahan</h4>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @foreach($portofolio->galeri as $galeri)
                        <a href="{{ $galeri->url }}" target="_blank" class="block rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow group">
                            <img src="{{ $galeri->url }}" alt="Galeri" class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

            @if($portofolio->produk && $portofolio->produk->count() > 0)
                <div class="mb-8 mt-8">
                    <h4 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Produk yang Digunakan</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach($portofolio->produk as $produk)
                            <div class="bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700 rounded-2xl overflow-hidden hover:shadow-md transition-shadow group flex flex-col">
                                <div class="relative h-40 overflow-hidden bg-white dark:bg-gray-800">
                                    <img src="{{ $produk->gambar_url }}" alt="{{ $produk->nama_produk }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                                <div class="p-4 flex-1 flex flex-col">
                                    <h5 class="font-semibold text-gray-800 dark:text-white mb-1 line-clamp-1">{{ $produk->nama_produk }}</h5>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-4 line-clamp-2">{{ $produk->deskripsi_produk }}</p>
                                    <div class="mt-auto">
                                        @if($produk->kode_produk)
                                        <a href="{{ route('admin.produk.show', $produk->kode_produk) }}" class="flex items-center justify-center gap-2 w-full py-2 bg-white hover:bg-gray-100 dark:bg-gray-600 dark:hover:bg-gray-500 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-200 rounded-xl text-xs font-medium transition-colors">
                                            <span>Detail Produk</span>
                                            <i data-lucide="arrow-right" class="w-3 h-3"></i>
                                        </a>
                                        @else
                                        <span class="flex items-center justify-center gap-2 w-full py-2 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-400 dark:text-gray-500 rounded-xl text-xs font-medium cursor-not-allowed" title="Kode produk belum tersedia">
                                            <span>Detail Produk</span>
                                            <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
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
                        class="flex items-center gap-2 bg-red-50 hover:bg-red-100 text-red-600 dark:bg-red-950/40 dark:hover:bg-red-900/60 dark:text-red-400 px-5 py-2.5 rounded-xl text-sm font-medium transition-colors">
                        <i data-lucide="trash-2" class="w-4 h-4"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
