@extends('layouts.admin')

@section('title', 'Manajemen Tentang')
@section('page-title', 'Manajemen Tentang')
@section('page-subtitle', 'Edit konten halaman tentang kami')

@section('breadcrumb')
    <span class="text-gray-400">/</span>
    <span class="text-primary font-medium">Manajemen Tentang</span>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.tentang.update') }}" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Left --}}
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                <h3 class="font-semibold text-gray-800 dark:text-white mb-5 flex items-center gap-2">
                    <i data-lucide="info" class="w-4 h-4 text-primary dark:text-amber-200"></i> Konten Halaman Tentang
                </h3>

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Judul <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" value="{{ old('title', $tentang->title) }}"
                        class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors @error('title') border-red-400 @else border-gray-200 @enderror">
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="6"
                        class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200">{{ old('deskripsi', $tentang->deskripsi) }}</textarea>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Visi</label>
                    <textarea name="visi" rows="3"
                        class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200">{{ old('visi', $tentang->visi) }}</textarea>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Misi</label>
                    <textarea name="misi" rows="6"
                        class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200">{{ old('misi', $tentang->misi) }}</textarea>
                </div>

                <button type="submit"
                    class="flex items-center gap-2 bg-primary hover:bg-primary-dark text-white px-6 py-2.5 rounded-xl text-sm font-medium transition-colors shadow-sm">
                    <i data-lucide="save" class="w-4 h-4"></i> Simpan Perubahan
                </button>
            </div>
        </div>

        {{-- Right: Gambar --}}
        <div class="space-y-5">

            {{-- Gambar 1 --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                <h4 class="font-medium text-gray-700 dark:text-white mb-3 flex items-center gap-2">
                    <i data-lucide="image" class="w-4 h-4 text-primary dark:text-amber-200"></i> Gambar 1
                </h4>
                <x-file-dropzone
                    name="gambar1"
                    label=""
                    accept="image/jpeg,image/png,image/webp,image/heic,image/heif"
                    hint="JPG, PNG, WEBP, HEIC (max 5MB)"
                    :is-image="true"
                    :preview-url="$tentang->gambar1_url"
                    color="primary"
                    error="gambar1"
                />
            </div>

            {{-- Gambar 2 --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                <h4 class="font-medium text-gray-700 dark:text-white mb-3 flex items-center gap-2">
                    <i data-lucide="image" class="w-4 h-4 text-secondary dark:text-amber-300"></i> Gambar 2
                </h4>
                <x-file-dropzone
                    name="gambar2"
                    label=""
                    accept="image/jpeg,image/png,image/webp,image/heic,image/heif"
                    hint="JPG, PNG, WEBP, HEIC (max 5MB)"
                    :is-image="true"
                    :preview-url="$tentang->gambar2_url"
                    color="primary"
                    error="gambar2"
                />
            </div>
        </div>
    </div>
</form>
@endsection
