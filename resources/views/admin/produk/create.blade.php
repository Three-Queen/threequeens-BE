@extends('layouts.admin')

@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk Interior')

@section('breadcrumb')
    <span class="text-gray-400">/</span>
    <a href="{{ route('admin.produk.index') }}" class="hover:text-primary">Produk Interior</a>
    <span class="text-gray-400">/</span>
    <span class="text-primary font-medium">Tambah</span>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.produk.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6" x-data="produkForm({{ $kategori->toJson() }}, {{ $nextIndex }})">

        {{-- ===== LEFT: Main Info ===== --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Info Utama --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                <h3 class="font-semibold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                    <i data-lucide="info" class="w-4 h-4 text-primary dark:text-amber-200"></i> Informasi Produk
                </h3>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Kode Produk (Auto-Generated)
                    </label>
                    <input type="text" readonly :value="kode_produk"
                        placeholder="Pilih Kategori dan isi Nama Produk..."
                        class="w-full px-4 py-3 border-2 rounded-xl text-sm font-mono bg-gray-50 dark:bg-gray-800/50 dark:border-gray-600 dark:text-gray-400 focus:outline-none border-gray-200 text-gray-500 cursor-not-allowed">
                    <p class="text-xs text-gray-400 mt-1">Ter-generate otomatis dari tipe layanan, kategori, dan nama produk.</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Nama Produk <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" x-model="nama_produk"
                        placeholder="Nama produk interior..."
                        class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors @error('nama_produk') border-red-400 @else border-gray-200 @enderror">
                    @error('nama_produk')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kategori <span class="text-red-500">*</span></label>
                    <select name="kategori_id" x-model="kategori_id"
                        class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors @error('kategori_id') border-red-400 @else border-gray-200 @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Harga Produk</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-medium">Rp</span>
                        <input type="number" name="harga_produk" value="{{ old('harga_produk') }}"
                            placeholder="0"
                            class="w-full pl-12 pr-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors @error('harga_produk') border-red-400 @else border-gray-200 @enderror">
                    </div>
                    @error('harga_produk')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Deskripsi Produk</label>
                    <textarea name="deskripsi_produk" rows="4"
                        placeholder="Deskripsi lengkap produk..."
                        class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200">{{ old('deskripsi_produk') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Detail Pengerjaan</label>
                    <textarea name="pengerjaan_produk" rows="3"
                        placeholder="Proses dan detail pengerjaan produk..."
                        class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200">{{ old('pengerjaan_produk') }}</textarea>
                </div>
            </div>
        </div>

        {{-- ===== RIGHT: File Uploads ===== --}}
        <div class="space-y-5">

            {{-- Gambar Produk --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                <h3 class="font-semibold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                    <i data-lucide="image" class="w-4 h-4 text-primary dark:text-amber-200"></i> Gambar Produk
                </h3>
                <x-file-dropzone
                    name="gambar_produk"
                    label=""
                    accept="image/jpeg,image/png,image/webp,image/heic,image/heif"
                    hint="JPG, PNG, WEBP, HEIC (max 5MB)"
                    :is-image="true"
                    color="primary"
                />
            </div>

            {{-- File 2D --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                <h3 class="font-semibold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                    <i data-lucide="layout" class="w-4 h-4 text-blue-500"></i> Desain 2D
                </h3>
                <x-file-dropzone
                    name="desain_produk_2d"
                    label=""
                    accept=".pdf,.dwg,.jpg,.jpeg,.png,.zip"
                    hint="PDF, DWG, PNG, ZIP (max 50MB)"
                    :is-image="false"
                    color="blue"
                />
            </div>

            {{-- File 3D --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                <h3 class="font-semibold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                    <i data-lucide="box" class="w-4 h-4 text-purple-500"></i> Desain 3D
                </h3>
                <x-file-dropzone
                    name="desain_produk_3d"
                    label=""
                    accept=".pdf,.dwg,.skp,.3ds,.obj,.fbx,.zip,.glb,.gltf"
                    hint="PDF, DWG, SKP, OBJ, GLB, ZIP (max 50MB)"
                    :is-image="false"
                    color="purple"
                />
            </div>

            {{-- Actions --}}
            <div class="flex gap-3">
                <button type="submit"
                    class="flex-1 flex items-center justify-center gap-2 bg-primary hover:bg-primary-dark text-white py-3 rounded-xl text-sm font-medium transition-colors shadow-sm">
                    <i data-lucide="save" class="w-4 h-4"></i> Simpan
                </button>
                <a href="{{ route('admin.produk.index') }}"
                   class="flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300 px-4 py-3 rounded-xl text-sm font-medium transition-colors">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
function produkForm(categories, index) {
    return {
        nama_produk: '{{ old('nama_produk') }}',
        kategori_id: '{{ old('kategori_id') }}',
        get kode_produk() {
            if (!this.nama_produk || !this.kategori_id) return '';
            
            let cat = categories.find(c => c.id == this.kategori_id);
            if (!cat) return '';
            
            let getInit = (str) => {
                if(!str) return '';
                return str.split(' ')
                    .map(w => w.replace(/[^a-zA-Z0-9]/g, ''))
                    .filter(w => w.length > 0)
                    .map(w => w.charAt(0).toUpperCase())
                    .join('');
            };
            
            let lInit = getInit(cat.tipe_layanan);
            let cInit = getInit(cat.nama_kategori);
            let pInit = getInit(this.nama_produk);
            let idxStr = index.toString().padStart(3, '0');
            
            return `${lInit}-${cInit}-${pInit}-${idxStr}`;
        }
    }
}
</script>
@endpush
