@extends('layouts.admin')

@section('title', 'Manajemen Beranda')
@section('page-title', 'Manajemen Beranda')
@section('page-subtitle', 'Edit konten halaman beranda website')

@section('breadcrumb')
    <span class="text-gray-400">/</span>
    <span class="text-primary font-medium">Manajemen Beranda</span>
@endsection

@section('content')
<div class="w-full">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
        <div class="flex items-center gap-3 mb-5 pb-4 border-b border-gray-100 dark:border-gray-700">
            <div class="w-10 h-10 bg-primary/10 dark:bg-primary/20 rounded-xl flex items-center justify-center">
                <i data-lucide="home" class="w-4 h-4 text-primary dark:text-amber-200"></i>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800 dark:text-white">Konten Halaman Beranda</h3>
                <p class="text-xs text-gray-400">Perubahan akan langsung muncul di website</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.beranda.update') }}" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Judul Beranda <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title', $beranda->title) }}"
                    placeholder="Judul utama beranda..."
                    class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors @error('title') border-red-400 @else border-gray-200 @enderror">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Deskripsi Beranda</label>
                <textarea name="deskripsi" rows="4"
                    placeholder="Deskripsi singkat beranda..."
                    class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200">{{ old('deskripsi', $beranda->deskripsi) }}</textarea>
            </div>

            {{-- Background Image --}}
            <div class="mb-6">
                <x-file-dropzone
                    name="background"
                    label="Background Beranda"
                    accept="image/jpeg,image/png,image/webp,image/heic,image/heif"
                    hint="JPG, PNG, WEBP, HEIC (max 10MB) — kosongkan untuk pertahankan"
                    :is-image="true"
                    :preview-url="$beranda->background_url"
                    color="primary"
                    error="background"
                />
            </div>

            <div class="flex items-center gap-3">
                <button type="submit"
                    class="flex items-center gap-2 bg-primary hover:bg-primary-dark text-white px-6 py-2.5 rounded-xl text-sm font-medium transition-colors shadow-sm">
                    <i data-lucide="save" class="w-4 h-4"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
