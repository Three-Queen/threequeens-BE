@extends('layouts.admin')

@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk Interior')

@section('breadcrumb')
    <span class="text-gray-400">/</span>
    <a href="{{ route('admin.produk.index') }}" class="hover:text-primary">Produk Interior</a>
    <span class="text-gray-400">/</span>
    <span class="text-primary font-medium">Edit</span>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.produk.update', $produk) }}" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- LEFT: Main Info --}}
        <div class="lg:col-span-2 space-y-5">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                <h3 class="font-semibold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                    <i data-lucide="pencil" class="w-4 h-4 text-primary"></i> Edit Informasi Produk
                </h3>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Produk <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}"
                        class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors @error('nama_produk') border-red-400 @else border-gray-200 @enderror">
                    @error('nama_produk') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kategori <span class="text-red-500">*</span></label>
                    <select name="kategori_id"
                        class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors @error('kategori_id') border-red-400 @else border-gray-200 @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->id }}" {{ old('kategori_id', $produk->kategori_id) == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Harga Produk</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-medium">Rp</span>
                        <input type="number" name="harga_produk" value="{{ old('harga_produk', $produk->harga_produk) }}"
                            class="w-full pl-12 pr-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Deskripsi Produk</label>
                    <textarea name="deskripsi_produk" rows="4"
                        class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200">{{ old('deskripsi_produk', $produk->deskripsi_produk) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Detail Pengerjaan</label>
                    <textarea name="pengerjaan_produk" rows="3"
                        class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200">{{ old('pengerjaan_produk', $produk->pengerjaan_produk) }}</textarea>
                </div>
            </div>
        </div>

        {{-- RIGHT: Files --}}
        <div class="space-y-5">

            {{-- Gambar --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5"
                 x-data="{ previewUrl: '{{ $produk->gambar_url }}', fileName: '' }">
                <h3 class="font-semibold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                    <i data-lucide="image" class="w-4 h-4 text-primary"></i> Gambar Produk
                </h3>
                <div class="border-2 border-dashed border-gray-200 dark:border-gray-600 rounded-xl p-4 text-center cursor-pointer hover:border-primary transition-colors"
                     @click="$refs.gInput.click()">
                    <template x-if="previewUrl">
                        <img :src="previewUrl" class="w-full h-40 object-cover rounded-lg">
                    </template>
                    <template x-if="!previewUrl">
                        <div><i data-lucide="upload-cloud" class="w-8 h-8 text-gray-300 mb-2"></i><p class="text-sm text-gray-400">Klik ganti gambar</p></div>
                    </template>
                </div>
                <input type="file" name="gambar_produk" x-ref="gInput" accept="image/*" class="hidden"
                    @change="const f=event.target.files[0];if(f){fileName=f.name;const r=new FileReader();r.onload=e=>previewUrl=e.target.result;r.readAsDataURL(f)}">
                <p x-text="fileName || 'Kosongkan untuk mempertahankan gambar saat ini'" class="text-xs text-gray-400 mt-2 text-center truncate"></p>
            </div>

            {{-- File 2D --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5"
                 x-data="{ fileName: '' }">
                <h3 class="font-semibold text-gray-800 dark:text-white mb-3 flex items-center gap-2">
                    <i data-lucide="layout" class="w-4 h-4 text-blue-500"></i> Desain 2D
                </h3>
                @if($produk->desain_produk_2d)
                    <div class="flex items-center gap-2 bg-blue-50 dark:bg-blue-900/20 rounded-lg p-2 mb-2">
                        <i data-lucide="file-text" class="w-4 h-4 text-blue-500"></i>
                        <span class="text-xs text-blue-600 truncate">{{ basename($produk->desain_produk_2d) }}</span>
                        <a href="{{ $produk->desain2d_url }}" target="_blank" class="ml-auto text-xs text-blue-500 hover:underline">Lihat</a>
                    </div>
                @endif
                <div class="border-2 border-dashed border-gray-200 dark:border-gray-600 rounded-xl p-3 text-center cursor-pointer hover:border-blue-400 transition-colors"
                     @click="$refs.f2dI.click()">
                    <p class="text-sm text-gray-400">Ganti File 2D</p>
                </div>
                <input type="file" name="desain_produk_2d" x-ref="f2dI" accept=".pdf,.dwg,.jpg,.jpeg,.png,.zip" class="hidden"
                    @change="const f=event.target.files[0];if(f) fileName=f.name">
                <p x-text="fileName" class="text-xs text-gray-400 mt-1 text-center truncate"></p>
            </div>

            {{-- File 3D --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5"
                 x-data="{ fileName: '' }">
                <h3 class="font-semibold text-gray-800 dark:text-white mb-3 flex items-center gap-2">
                    <i data-lucide="box" class="w-4 h-4 text-purple-500"></i> Desain 3D
                </h3>
                @if($produk->desain_produk_3d)
                    <div class="flex items-center gap-2 bg-purple-50 dark:bg-purple-900/20 rounded-lg p-2 mb-2">
                        <i data-lucide="box" class="w-4 h-4 text-purple-500"></i>
                        <span class="text-xs text-purple-600 truncate">{{ basename($produk->desain_produk_3d) }}</span>
                        <a href="{{ $produk->desain3d_url }}" target="_blank" class="ml-auto text-xs text-purple-500 hover:underline">Lihat</a>
                    </div>
                @endif
                <div class="border-2 border-dashed border-gray-200 dark:border-gray-600 rounded-xl p-3 text-center cursor-pointer hover:border-purple-400 transition-colors"
                     @click="$refs.f3dI.click()">
                    <p class="text-sm text-gray-400">Ganti File 3D</p>
                    <p class="text-xs text-gray-300 mt-1">PDF, DWG, SKP, OBJ, GLB, ZIP (max 50MB)</p>
                </div>
                <input type="file" name="desain_produk_3d" x-ref="f3dI" accept=".pdf,.dwg,.skp,.3ds,.obj,.fbx,.zip,.glb,.gltf" class="hidden"
                    @change="const f=event.target.files[0];if(f) fileName=f.name">
                <p x-text="fileName" class="text-xs text-gray-400 mt-1 text-center truncate"></p>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="flex-1 flex items-center justify-center gap-2 bg-primary hover:bg-primary-dark text-white py-3 rounded-xl text-sm font-medium transition-colors shadow-sm">
                    <i data-lucide="save" class="w-4 h-4"></i> Perbarui
                </button>
                <a href="{{ route('admin.produk.index') }}"
                   class="flex items-center justify-center bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-4 py-3 rounded-xl text-sm transition-colors hover:bg-gray-200">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
    </div>
</form>
@endsection
