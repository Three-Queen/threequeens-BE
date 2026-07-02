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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6" x-data="produkForm({{ $kategori->toJson() }}, {{ $currentIndex }})">

        {{-- LEFT: Main Info --}}
        <div class="lg:col-span-2 space-y-5">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                <h3 class="font-semibold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                    <i data-lucide="pencil" class="w-4 h-4 text-primary dark:text-amber-200"></i> Edit Informasi Produk
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
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Produk <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" x-model="nama_produk"
                        class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors @error('nama_produk') border-red-400 @else border-gray-200 @enderror">
                    @error('nama_produk') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kategori <span class="text-red-500">*</span></label>
                    <select name="kategori_id" x-model="kategori_id"
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

                {{-- Spesifikasi Ukuran & Bahan --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-1.5">
                        <i data-lucide="ruler" class="w-3.5 h-3.5 text-primary dark:text-amber-200"></i>
                        Spesifikasi Ukuran
                    </label>
                    <div class="grid grid-cols-3 gap-2 mb-2">
                        <div>
                            <p class="text-xs text-gray-400 mb-1">Panjang</p>
                            <div class="relative">
                                <input type="number" name="panjang" value="{{ old('panjang', $produk->panjang) }}"
                                    placeholder="0" min="0" step="0.1"
                                    class="w-full pl-3 pr-10 py-2.5 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200">
                                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs font-medium pointer-events-none">cm</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-1">Lebar</p>
                            <div class="relative">
                                <input type="number" name="lebar" value="{{ old('lebar', $produk->lebar) }}"
                                    placeholder="0" min="0" step="0.1"
                                    class="w-full pl-3 pr-10 py-2.5 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200">
                                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs font-medium pointer-events-none">cm</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-1">Tinggi</p>
                            <div class="relative">
                                <input type="number" name="tinggi" value="{{ old('tinggi', $produk->tinggi) }}"
                                    placeholder="0" min="0" step="0.1"
                                    class="w-full pl-3 pr-10 py-2.5 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200">
                                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs font-medium pointer-events-none">cm</span>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <p class="text-xs text-gray-400 mb-1">Bahan yang Digunakan</p>
                            <input type="text" name="bahan" value="{{ old('bahan', $produk->bahan) }}"
                                placeholder="Cth: Kayu Jati, HPL, MDF"
                                class="w-full px-3 py-2.5 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200">
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-1">Ketebalan</p>
                            <div class="relative">
                                <input type="number" name="ketebalan" value="{{ old('ketebalan', $produk->ketebalan) }}"
                                    placeholder="0" min="0" step="0.1"
                                    class="w-full pl-3 pr-10 py-2.5 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200">
                                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs font-medium pointer-events-none">mm</span>
                            </div>
                        </div>
                    </div>
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
                    <textarea name="deskripsi_produk" rows="3"
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
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                <h3 class="font-semibold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                    <i data-lucide="image" class="w-4 h-4 text-primary dark:text-amber-200"></i> Gambar Produk
                </h3>
                <x-file-dropzone
                    name="gambar_produk"
                    label=""
                    accept="image/jpeg,image/png,image/webp,image/heic,image/heif"
                    hint="JPG, PNG, WEBP, HEIC (max 5MB) — kosongkan untuk pertahankan"
                    :is-image="true"
                    :preview-url="$produk->gambar_url"
                    color="primary"
                />
            </div>

            {{-- File 2D --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                <h3 class="font-semibold text-gray-800 dark:text-white mb-3 flex items-center gap-2">
                    <i data-lucide="layout" class="w-4 h-4 text-blue-500"></i> Desain 2D
                </h3>
                <x-file-dropzone
                    name="desain_produk_2d[]"
                    label=""
                    accept=".pdf,.dwg,.jpg,.jpeg,.png,.zip"
                    hint="PDF, DWG, PNG, ZIP (max 50MB) — Bisa pilih lebih dari 1 file (kosongkan untuk pertahankan)"
                    :is-image="false"
                    :existing-files="$produk->desain2d_files"
                    :multiple="true"
                    color="blue"
                    error="desain_produk_2d"
                />
            </div>

            {{-- Desain 3D (File atau Embed) --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5"
                 x-data="{ tab3d: '{{ old('desain_produk_3d_embed', $produk->desain_3d_type === 'embed' ? 'embed' : 'file') }}', embedUrl: '{{ old('desain_produk_3d_embed', $produk->desain_3d_type === 'embed' ? $produk->desain_produk_3d : '') }}', get cleanUrl() { return window.parseEmbedInput ? window.parseEmbedInput(this.embedUrl) : ''; }, get isValid() { return !!this.cleanUrl; } }">
                
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-semibold text-gray-800 dark:text-white flex items-center gap-2 text-sm">
                        <i data-lucide="box" class="w-4 h-4 text-purple-500"></i> Desain 3D
                    </h3>
                    
                    {{-- Tabs Toggle --}}
                    <div class="flex bg-gray-100 dark:bg-gray-700 p-0.5 rounded-lg text-xs font-medium">
                        <button type="button" @click="tab3d = 'file'"
                            :class="tab3d === 'file' ? 'bg-white dark:bg-gray-600 text-purple-600 dark:text-purple-300 shadow-sm' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700'"
                            class="px-2.5 py-1 rounded-md transition-all">
                            Upload File (.glb)
                        </button>
                        <button type="button" @click="tab3d = 'embed'"
                            :class="tab3d === 'embed' ? 'bg-white dark:bg-gray-600 text-purple-600 dark:text-purple-300 shadow-sm' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700'"
                            class="px-2.5 py-1 rounded-md transition-all">
                            Embed Code / URL
                        </button>
                    </div>
                </div>

                {{-- Tab 1: Upload File --}}
                <div x-show="tab3d === 'file'" x-transition>
                    <x-file-dropzone
                        name="desain_produk_3d_file"
                        label=""
                        accept=".glb,.gltf"
                        hint="Format GLB atau GLTF (max 200MB) — kosongkan untuk pertahankan"
                        :is-image="false"
                        :existing-name="($produk->desain_produk_3d && $produk->desain_3d_type === 'file') ? basename($produk->desain_produk_3d) : null"
                        :existing-url="($produk->desain_produk_3d && $produk->desain_3d_type === 'file') ? $produk->desain3d_url : null"
                        color="purple"
                    />
                </div>

                {{-- Tab 2: Embed URL --}}
                <div x-show="tab3d === 'embed'" x-transition>
                    <p class="text-xs text-gray-400 mb-3">Tempelkan URL embed dari <a href="https://sketchfab.com" target="_blank" class="text-purple-500 hover:underline font-medium">Sketchfab</a> atau web 3D warehouse lainnya.</p>

                    <div class="mb-3">
                        <input type="text" name="desain_produk_3d_embed"
                            x-model="embedUrl"
                            placeholder="Paste link atau kode <iframe src='...'></iframe> di sini"
                            class="w-full px-3 py-2.5 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-purple-400 transition-colors @error('desain_produk_3d_embed') border-red-400 @else border-gray-200 @enderror">
                        @error('desain_produk_3d_embed')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Preview iframe --}}
                    <div x-show="isValid" x-transition class="rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-900">
                        <div class="flex items-center justify-between px-3 py-1.5 bg-gray-200 dark:bg-gray-700">
                            <span class="text-xs text-gray-500 dark:text-gray-400 font-medium">Preview 3D</span>
                            <i data-lucide="eye" class="w-3.5 h-3.5 text-gray-400"></i>
                        </div>
                        <iframe x-bind:src="cleanUrl" width="100%" height="240"
                            frameborder="0" allow="autoplay; fullscreen; xr-spatial-tracking"
                            allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true"
                            class="block">
                        </iframe>
                    </div>

                    {{-- Placeholder kosong --}}
                    <div x-show="!isValid" class="rounded-xl border-2 border-dashed border-gray-200 dark:border-gray-700 p-5 text-center">
                        <i data-lucide="box" class="w-8 h-8 text-gray-300 dark:text-gray-600 mx-auto mb-2"></i>
                        <p class="text-xs text-gray-400">Preview 3D akan muncul di sini</p>
                        <p class="text-[11px] text-gray-300 dark:text-gray-600 mt-1">Cara: Sketchfab → Share → Embed → copy URL di src="..."</p>
                    </div>
                </div>
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

@push('scripts')
<script>
function produkForm(categories, index) {
    return {
        nama_produk: '{!! addslashes(old('nama_produk', $produk->nama_produk)) !!}',
        kategori_id: '{{ old('kategori_id', $produk->kategori_id) }}',
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

window.parseEmbedInput = function(val) {
    if (!val) return '';
    let m = val.match(/src=["']([^"']+)["']/i);
    let u = (m && m[1]) ? m[1] : val.trim();
    u = u.replace(/&amp;/g, '&');
    return (u.startsWith('http://') || u.startsWith('https://')) ? u : '';
};
</script>
@endpush
