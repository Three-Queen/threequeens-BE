@extends('layouts.admin')

@section('title', 'Edit Proyek')
@section('page-title', 'Edit Proyek Portofolio')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css">
<style>
    .flatpickr-calendar { font-family: inherit; border-radius: 1rem; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1); border: none; }
    .flatpickr-input[readonly] { background-color: transparent; }
</style>
@endpush

@section('breadcrumb')
    <span class="text-gray-400">/</span>
    <a href="{{ route('admin.portofolio.index') }}" class="hover:text-primary">Portofolio</a>
    <span class="text-gray-400">/</span>
    <span class="text-primary font-medium">Edit</span>
@endsection

@section('content')
<div class="max-w-2xl">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
        <h3 class="font-semibold text-gray-800 dark:text-white mb-5 flex items-center gap-2">
            <i data-lucide="pencil" class="w-4 h-4 text-primary"></i> Edit Proyek
        </h3>

        <form method="POST" action="{{ route('admin.portofolio.update', $portofolio) }}" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Proyek <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_proyek" value="{{ old('nama_proyek', $portofolio->nama_proyek) }}"
                        class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors @error('nama_proyek') border-red-400 @else border-gray-200 @enderror">
                    @error('nama_proyek') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Lokasi <span class="text-red-500">*</span></label>
                    <input type="text" name="lokasi" value="{{ old('lokasi', $portofolio->lokasi) }}"
                        class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors @error('lokasi') border-red-400 @else border-gray-200 @enderror">
                    @error('lokasi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Deskripsi Proyek</label>
                <textarea name="deskripsi" rows="4"
                    placeholder="Ceritakan detail proyek, konsep desain, material yang digunakan, dsb..."
                    class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200 resize-none">{{ old('deskripsi', $portofolio->deskripsi) }}</textarea>
                @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Link Google Maps</label>
                <input type="text" name="lokasi_google_maps" value="{{ old('lokasi_google_maps', $portofolio->lokasi_google_maps) }}"
                    class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Waktu Proyek</label>
                <div class="relative">
                    <i data-lucide="calendar" class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                    <input type="date" name="waktu_proyek" value="{{ old('waktu_proyek', $portofolio->waktu_proyek) }}" placeholder="Pilih tanggal..."
                        class="datepicker w-full pl-11 pr-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200 cursor-pointer">
                </div>
            </div>

            <div class="mb-5" x-data="{ previewUrl: '{{ $portofolio->dokumentasi_url }}', fileName: '' }">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Dokumentasi Proyek</label>
                <div class="border-2 border-dashed border-gray-200 dark:border-gray-600 rounded-xl p-4 text-center cursor-pointer hover:border-primary transition-colors"
                     @click="$refs.dI.click()">
                    <template x-if="previewUrl">
                        <img :src="previewUrl" class="w-full h-40 object-cover rounded-lg">
                    </template>
                    <template x-if="!previewUrl">
                        <div><i data-lucide="camera" class="w-8 h-8 text-gray-300 mb-2"></i><p class="text-sm text-gray-400">Upload foto baru</p></div>
                    </template>
                </div>
                <input type="file" name="dokumentasi_proyek" x-ref="dI" accept="image/*" class="hidden"
                    @change="const f=event.target.files[0];if(f){fileName=f.name;const r=new FileReader();r.onload=e=>previewUrl=e.target.result;r.readAsDataURL(f)}">
                <p x-text="fileName || 'Biarkan kosong untuk mempertahankan foto saat ini'" class="text-xs text-gray-400 mt-2 text-center truncate"></p>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit"
                    class="flex items-center gap-2 bg-primary hover:bg-primary-dark text-white px-5 py-2.5 rounded-xl text-sm font-medium transition-colors shadow-sm">
                    <i data-lucide="save" class="w-4 h-4"></i> Perbarui
                </button>
                <a href="{{ route('admin.portofolio.index') }}"
                   class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-5 py-2.5 rounded-xl text-sm font-medium transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
<script>
    flatpickr(".datepicker", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F Y",
        locale: "id",
        disableMobile: "true"
    });
</script>
@endpush
