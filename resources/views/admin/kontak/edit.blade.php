@extends('layouts.admin')

@section('title', 'Manajemen Kontak')
@section('page-title', 'Manajemen Kontak')
@section('page-subtitle', 'Edit informasi kontak website')

@section('breadcrumb')
    <span class="text-gray-400">/</span>
    <span class="text-primary font-medium">Manajemen Kontak</span>
@endsection

@section('content')
<div class="max-w-3xl">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
        <div class="flex items-center gap-3 mb-5 pb-4 border-b border-gray-100 dark:border-gray-700">
            <div class="w-10 h-10 bg-primary/10 dark:bg-primary/20 rounded-xl flex items-center justify-center">
                <i data-lucide="contact" class="w-4 h-4 text-primary dark:text-amber-200"></i>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800 dark:text-white">Informasi Kontak</h3>
                <p class="text-xs text-gray-400">Tampil di halaman kontak website</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.kontak.update') }}">
            @csrf @method('PUT')

            {{-- Alamat --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    <i data-lucide="map-pin" class="w-4 h-4 text-red-400 mr-1"></i> Alamat / Lokasi
                </label>
                <textarea name="lokasi" rows="2"
                    placeholder="Alamat lengkap..."
                    class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200">{{ old('lokasi', $kontak->lokasi) }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                {{-- WhatsApp --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fab fa-whatsapp text-green-500 mr-1"></i> WhatsApp
                    </label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp', $kontak->whatsapp) }}"
                        placeholder="08xxxxxxxxxx"
                        class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200">
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i data-lucide="mail" class="w-4 h-4 text-blue-400 mr-1"></i> Email
                    </label>
                    <input type="email" name="email" value="{{ old('email', $kontak->email) }}"
                        placeholder="info@example.com"
                        class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors @error('email') border-red-400 @else border-gray-200 @enderror">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
                {{-- Facebook --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fab fa-facebook text-blue-600 mr-1"></i> Facebook
                    </label>
                    <input type="text" name="facebook" value="{{ old('facebook', $kontak->facebook) }}"
                        placeholder="URL/username"
                        class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200">
                </div>

                {{-- Instagram --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fab fa-instagram text-pink-500 mr-1"></i> Instagram
                    </label>
                    <input type="text" name="instagram" value="{{ old('instagram', $kontak->instagram) }}"
                        placeholder="@username"
                        class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200">
                </div>

                {{-- TikTok --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fab fa-tiktok text-gray-800 dark:text-gray-300 mr-1"></i> TikTok
                    </label>
                    <input type="text" name="tiktok" value="{{ old('tiktok', $kontak->tiktok) }}"
                        placeholder="@username"
                        class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200">
                </div>
            </div>

            {{-- Jam Kerja --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    <i data-lucide="clock" class="w-4 h-4 text-amber-400 mr-1"></i> Jam Operasional
                </label>
                <input type="text" name="jam_kerja" value="{{ old('jam_kerja', $kontak->jam_kerja) }}"
                    placeholder="Senin - Sabtu: 08.00 - 17.00 WIB"
                    class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200">
            </div>

            <button type="submit"
                class="flex items-center gap-2 bg-primary hover:bg-primary-dark text-white px-6 py-2.5 rounded-xl text-sm font-medium transition-colors shadow-sm">
                <i data-lucide="save" class="w-4 h-4"></i> Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection
