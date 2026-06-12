@extends('layouts.admin')

@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori')

@section('breadcrumb')
    <span class="text-gray-400">/</span>
    <a href="{{ route('admin.kategori.index') }}" class="hover:text-primary transition-colors">Kategori Interior</a>
    <span class="text-gray-400">/</span>
    <span class="text-primary font-medium">Tambah</span>
@endsection

@section('content')
<div class="max-w-lg">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
        <h3 class="font-semibold text-gray-800 dark:text-white mb-5">Form Tambah Kategori</h3>

        <form method="POST" action="{{ route('admin.kategori.store') }}">
            @csrf

            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}"
                    placeholder="Contoh: Ruang Tamu, Kamar Tidur..."
                    class="w-full px-4 py-3 border-2 rounded-xl text-sm text-gray-700 dark:text-gray-200 dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:border-primary transition-colors @error('nama_kategori') border-red-400 @else border-gray-200 @enderror">
                @error('nama_kategori')
                    <p class="text-red-500 text-xs mt-1"><i data-lucide="alert-triangle" class="w-4 h-4 mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Tipe Layanan <span class="text-red-500">*</span>
                </label>
                <select name="tipe_layanan" 
                    class="w-full px-4 py-3 border-2 rounded-xl text-sm text-gray-700 dark:text-gray-200 dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:border-primary transition-colors @error('tipe_layanan') border-red-400 @else border-gray-200 @enderror">
                    <option value="Residential" {{ old('tipe_layanan') === 'Residential' ? 'selected' : '' }}>Residential (Hunian)</option>
                    <option value="Komersial" {{ old('tipe_layanan') === 'Komersial' ? 'selected' : '' }}>Komersial (Bisnis/Kantor)</option>
                    <option value="Kustom" {{ old('tipe_layanan') === 'Kustom' ? 'selected' : '' }}>Kustom (Custom Furniture)</option>
                </select>
                @error('tipe_layanan')
                    <p class="text-red-500 text-xs mt-1"><i data-lucide="alert-triangle" class="w-4 h-4 mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3">
                <button type="submit"
                    class="flex items-center gap-2 bg-primary hover:bg-primary-dark text-white px-5 py-2.5 rounded-xl text-sm font-medium transition-colors shadow-sm">
                    <i data-lucide="save" class="w-4 h-4"></i> Simpan Kategori
                </button>
                <a href="{{ route('admin.kategori.index') }}"
                   class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300 px-5 py-2.5 rounded-xl text-sm font-medium transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
