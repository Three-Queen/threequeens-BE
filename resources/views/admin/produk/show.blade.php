@extends('layouts.admin')

@section('title', $produk->nama_produk)
@section('page-title', 'Detail Produk')

@section('breadcrumb')
    <span class="text-gray-400">/</span>
    <a href="{{ route('admin.produk.index') }}" class="hover:text-primary">Produk Interior</a>
    <span class="text-gray-400">/</span>
    <span class="text-primary font-medium">{{ $produk->nama_produk }}</span>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Left: Gambar + Files --}}
    <div class="space-y-5">
        {{-- Gambar --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            @if($produk->gambar_produk)
                <img src="{{ $produk->gambar_url }}" alt="{{ $produk->nama_produk }}"
                     class="w-full h-64 object-cover">
            @else
                <div class="w-full h-64 bg-accent dark:bg-gray-700 flex items-center justify-center">
                    <div class="text-center">
                        <i data-lucide="image" class="w-10 h-10 text-gray-300 mb-2"></i>
                        <p class="text-sm text-gray-400">Belum ada gambar</p>
                    </div>
                </div>
            @endif
        </div>

        {{-- File Downloads --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
            <h3 class="font-semibold text-gray-800 dark:text-white mb-3">File Desain</h3>
            <div class="space-y-2">
                @if(!empty($produk->desain2d_files))
                    @foreach($produk->desain2d_files as $idx => $file)
                        <a href="{{ $file['url'] }}" target="_blank"
                           class="flex items-center gap-3 p-3 bg-blue-50 dark:bg-blue-950/40 rounded-xl hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-colors">
                            <div class="w-9 h-9 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                                <i data-lucide="layout" class="w-4 h-4 text-blue-500"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-blue-700 dark:text-blue-300">File Desain 2D #{{ $idx + 1 }}</p>
                                <p class="text-xs text-gray-400 truncate">{{ $file['name'] }}</p>
                            </div>
                            <i data-lucide="download" class="w-4 h-4 text-blue-500"></i>
                        </a>
                    @endforeach
                @endif
                @if($produk->desain_produk_3d)
                    <a href="{{ $produk->desain3d_url }}" target="_blank"
                       class="flex items-center gap-3 p-3 bg-purple-50 dark:bg-purple-950/40 rounded-xl hover:bg-purple-100 dark:hover:bg-purple-900/40 transition-colors">
                        <div class="w-9 h-9 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                            <i data-lucide="box" class="w-4 h-4 text-purple-500"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-purple-700 dark:text-purple-300">File Desain 3D</p>
                            <p class="text-xs text-gray-400 truncate">{{ basename($produk->desain_produk_3d) }}</p>
                        </div>
                        <i data-lucide="download" class="w-4 h-4 text-purple-500"></i>
                    </a>
                @endif
                @if(!$produk->desain_produk_2d && !$produk->desain_produk_3d)
                    <p class="text-sm text-gray-400 text-center py-4">Tidak ada file desain</p>
                @endif
            </div>
        </div>

        {{-- Preview 2D --}}
        @php
            $previewableFiles = array_filter($produk->desain2d_files, function($file) {
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                return in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'pdf']);
            });
        @endphp

        @if(!empty($previewableFiles))
            @foreach($previewableFiles as $idx => $file)
                @php
                    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                @endphp
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden flex flex-col mb-4">
                    <div class="p-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i data-lucide="layout" class="w-5 h-5 text-blue-500"></i>
                            <h3 class="font-semibold text-gray-800 dark:text-white text-sm">Preview 2D #{{ $idx + 1 }}</h3>
                        </div>
                        <span class="text-xs text-gray-400 truncate max-w-[150px] sm:max-w-xs">{{ $file['name'] }}</span>
                    </div>
                    <div class="w-full h-64 bg-gray-50 dark:bg-gray-900 relative flex-1">
                        @if($ext === 'pdf')
                            <iframe src="{{ $file['url'] }}" class="w-full h-full border-none"></iframe>
                        @else
                            <img src="{{ $file['url'] }}" alt="2D Preview" class="w-full h-full object-contain p-4">
                        @endif
                    </div>
                </div>
            @endforeach
        @endif

    </div>

    {{-- Right: Info --}}
    <div class="lg:col-span-2 space-y-5">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
            <div class="flex items-start justify-between mb-5">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $produk->nama_produk }}</h2>
                    <span class="mt-1 inline-block bg-accent dark:bg-primary/20 text-primary dark:text-amber-200 text-sm px-3 py-1 rounded-full">
                        {{ $produk->kategori->nama_kategori ?? '-' }}
                    </span>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-bold text-primary dark:text-amber-400">{{ $produk->harga_format }}</p>
                </div>
            </div>

            @if($produk->deskripsi_produk)
                <div class="mb-5">
                    <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Deskripsi</h4>
                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">{{ $produk->deskripsi_produk }}</p>
                </div>
            @endif

            @if($produk->pengerjaan_produk)
                <div class="mb-5">
                    <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Detail Pengerjaan</h4>
                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">{{ $produk->pengerjaan_produk }}</p>
                </div>
            @endif

            <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-100 dark:border-gray-700 text-sm">
                <div>
                    <p class="text-gray-400 text-xs uppercase tracking-wide">Ditambahkan</p>
                    <p class="font-medium text-gray-700 dark:text-gray-300 mt-1">{{ $produk->created_at->format('d F Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-xs uppercase tracking-wide">Terakhir Diperbarui</p>
                    <p class="font-medium text-gray-700 dark:text-gray-300 mt-1">{{ $produk->updated_at->format('d F Y') }}</p>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.produk.edit', $produk) }}"
               class="flex items-center gap-2 bg-primary hover:bg-primary-dark text-white px-5 py-2.5 rounded-xl text-sm font-medium transition-colors shadow-sm">
                <i data-lucide="pencil" class="w-4 h-4"></i> Edit Produk
            </a>
            <a href="{{ route('admin.produk.index') }}"
               class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300 px-5 py-2.5 rounded-xl text-sm font-medium transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
            </a>
            <form id="delete-show" method="POST" action="{{ route('admin.produk.destroy', $produk) }}" class="ml-auto">
                @csrf @method('DELETE')
                <button type="button" onclick="confirmDelete('delete-show', '{{ $produk->nama_produk }}')"
                    class="flex items-center gap-2 bg-red-50 hover:bg-red-100 text-red-600 dark:bg-red-950/40 dark:hover:bg-red-900/60 dark:text-red-400 px-5 py-2.5 rounded-xl text-sm font-medium transition-colors">
                    <i data-lucide="trash-2" class="w-4 h-4"></i> Hapus
                </button>
            </form>
        </div>
    </div>
</div>

{{-- 3D Preview (Sketchfab Style Full Width Bottom) --}}
@php
    $ext3d = $produk->desain_produk_3d ? strtolower(pathinfo($produk->desain_produk_3d, PATHINFO_EXTENSION)) : '';
    $is3dPreviewable = in_array($ext3d, ['glb', 'gltf']);
@endphp

@if($is3dPreviewable)
<div class="mt-8 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
    <div class="p-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <i data-lucide="box" class="w-5 h-5 text-primary dark:text-amber-200"></i>
            <h3 class="font-semibold text-gray-800 dark:text-white text-base">3D Interactive Viewer</h3>
        </div>
        <div class="text-xs text-gray-500 bg-gray-100 dark:bg-gray-700 px-3 py-1 rounded-full flex items-center gap-1.5 hidden md:flex">
            <i data-lucide="mouse-pointer-click" class="w-3.5 h-3.5"></i> Scroll to zoom, Drag to rotate
        </div>
    </div>
    <div class="w-full h-[600px] md:h-[75vh] bg-gradient-to-b from-gray-50 to-gray-200 dark:from-gray-900 dark:to-gray-800 relative">
        <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.4.0/model-viewer.min.js"></script>
        <model-viewer 
            src="{{ $produk->desain3d_url }}" 
            alt="3D Model Preview" 
            auto-rotate 
            camera-controls 
            class="w-full h-full outline-none"
            shadow-intensity="1"
            environment-image="neutral"
            exposure="1.0">
        </model-viewer>
    </div>
</div>
@endif

@endsection
