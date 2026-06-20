@extends('layouts.admin')

@section('title', 'Edit Project')
@section('page-title', 'Edit Project Portofolio')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css">
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<style>
    .flatpickr-calendar { font-family: inherit; border-radius: 1rem; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1); border: none; }
    .flatpickr-input[readonly] { background-color: transparent; }
    .ts-control { border: 2px solid #e5e7eb; border-radius: 0.75rem; padding: 0.75rem 1rem; }
    .ts-control.focus { border-color: #fca311; box-shadow: none; }
    .dark .ts-control { background-color: #374151; border-color: #4b5563; color: #e5e7eb; }
    .dark .ts-control input { color: #e5e7eb; }
</style>
@endpush

@section('breadcrumb')
    <span class="text-gray-400">/</span>
    <a href="{{ route('admin.portofolio.index') }}" class="hover:text-primary">Portofolio</a>
    <span class="text-gray-400">/</span>
    <span class="text-primary font-medium">Edit</span>
@endsection

@section('content')
<div class="w-full">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
        <h3 class="font-semibold text-gray-800 dark:text-white mb-5 flex items-center gap-2">
            <i data-lucide="pencil" class="w-4 h-4 text-primary"></i> Edit Project
        </h3>

        <form method="POST" action="{{ route('admin.portofolio.update', $portofolio) }}" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Project <span class="text-red-500">*</span></label>
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

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kategori Project <span class="text-red-500">*</span></label>
                    <select name="kategori_id" id="kategori_id" required
                        class="w-full text-sm">
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id', $portofolio->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Produk Terkait</label>
                    <select name="produk_ids[]" id="produk_ids" multiple placeholder="Pilih produk..."
                        class="w-full text-sm">
                        @foreach($produks as $produk)
                            <option value="{{ $produk->id }}" {{ (is_array(old('produk_ids')) && in_array($produk->id, old('produk_ids'))) || (empty(old('produk_ids')) && in_array($produk->id, $selectedProduks)) ? 'selected' : '' }}>
                                {{ $produk->nama_produk }}
                            </option>
                        @endforeach
                    </select>
                    @error('produk_ids') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Deskripsi Project</label>
                <textarea name="deskripsi" rows="4"
                    placeholder="Ceritakan detail project, konsep desain, material yang digunakan, dsb..."
                    class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200 resize-none">{{ old('deskripsi', $portofolio->deskripsi) }}</textarea>
                @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Link Google Maps</label>
                <input type="text" name="lokasi_google_maps" value="{{ old('lokasi_google_maps', $portofolio->lokasi_google_maps) }}"
                    class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Waktu Project</label>
                <div class="relative">
                    <i data-lucide="calendar" class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                    <input type="date" name="waktu_proyek" value="{{ old('waktu_proyek', $portofolio->waktu_proyek) }}" placeholder="Pilih tanggal..."
                        class="datepicker w-full pl-11 pr-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200 cursor-pointer">
                </div>
            </div>

            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Durasi Pengerjaan</label>
                <div class="relative">
                    <i data-lucide="clock" class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                    <input type="text" name="durasi_pengerjaan" value="{{ old('durasi_pengerjaan', $portofolio->durasi_pengerjaan) }}" placeholder="Contoh: 2 Bulan, 14 Hari..."
                        class="w-full pl-11 pr-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200">
                </div>
            </div>

            <div class="mb-5">
                <x-file-dropzone
                    name="dokumentasi_proyek"
                    label="Cover Project (Foto Utama)"
                    accept="image/jpeg,image/png,image/webp,image/heic,image/heif"
                    hint="JPG, PNG, WEBP, HEIC (max 10MB) — kosongkan untuk pertahankan"
                    :is-image="true"
                    :preview-url="$portofolio->dokumentasi_url"
                    color="primary"
                    error="dokumentasi_proyek"
                />
            </div>

            {{-- Galeri --}}
            <div class="mb-8" x-data="galleryUpload()">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Galeri Tambahan (Multiple)</label>
                
                {{-- Preview File Existing --}}
                @if($portofolio->galeri->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                    @foreach($portofolio->galeri as $galeri)
                    <div class="relative group rounded-xl overflow-hidden bg-gray-100 dark:bg-gray-800" id="galeri-{{ $galeri->id }}">
                        <img src="{{ $galeri->url }}" alt="Galeri" class="w-full h-24 object-cover">
                        <button type="button" onclick="hapusGaleri({{ $galeri->id }})" class="absolute top-2 right-2 w-7 h-7 bg-red-500 hover:bg-red-600 rounded-full flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity shadow-sm">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Preview File Baru (Alpine) --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4" x-show="files.length > 0" style="display: none;">
                    <template x-for="(file, index) in files" :key="index">
                        <div class="relative group rounded-xl overflow-hidden bg-gray-100 dark:bg-gray-800 border border-primary dark:border-amber-400 border-2">
                            <img :src="file.preview" class="w-full h-24 object-cover">
                            <button type="button" @click.prevent="removeFile(index)" class="absolute top-2 right-2 w-7 h-7 bg-red-500 hover:bg-red-600 rounded-full flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity shadow-sm z-10">
                                <i data-lucide="x" class="w-4 h-4"></i>
                            </button>
                            <div class="absolute bottom-0 inset-x-0 bg-primary text-white text-[10px] py-0.5 text-center font-medium">BARU</div>
                        </div>
                    </template>
                </div>

                <div class="relative border-2 border-dashed border-gray-200 dark:border-gray-600 rounded-xl p-4 hover:border-primary transition-colors bg-gray-50 dark:bg-gray-800/50"
                     @dragover.prevent="$el.classList.add('border-primary', 'bg-primary/5')"
                     @dragleave.prevent="$el.classList.remove('border-primary', 'bg-primary/5')"
                     @drop.prevent="$el.classList.remove('border-primary', 'bg-primary/5'); handleFiles($event.dataTransfer.files)">
                     
                    <input type="file" name="galeri[]" x-ref="galleryInput" multiple accept="image/jpeg,image/png,image/webp,image/heic,image/heif"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                        @change="handleFiles($event.target.files)">
                    <div class="text-center pointer-events-none">
                        <div class="w-10 h-10 bg-primary/10 dark:bg-primary/20 text-primary dark:text-amber-200 rounded-full flex items-center justify-center mx-auto mb-2">
                            <i data-lucide="images" class="w-5 h-5"></i>
                        </div>
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Klik atau seret foto tambahan ke sini</p>
                        <p class="text-xs text-gray-400 mt-1" x-text="files.length > 0 ? files.length + ' file ditambahkan' : 'Anda bisa mengupload lebih dari 1 file'"></p>
                    </div>
                </div>
                @error('galeri') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                @error('galeri.*') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
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
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<script>
    flatpickr(".datepicker", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F Y",
        locale: "id",
        disableMobile: "true"
    });

    new TomSelect("#kategori_id",{
        create: false,
        placeholder: "Pilih Kategori...",
        sortField: {
            field: "text",
            direction: "asc"
        }
    });

    new TomSelect("#produk_ids",{
        plugins: ['remove_button'],
        placeholder: "Ketik atau pilih beberapa produk sekaligus...",
        create: false,
    });

    function hapusGaleri(id) {
        fetch(`/admin/portofolio/galeri/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('galeri-' + id).remove();
            } else {
                alert('Gagal menghapus foto.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus foto.');
        });
    }

    document.addEventListener('alpine:init', () => {
        Alpine.data('galleryUpload', () => ({
            files: [],
            handleFiles(newFiles) {
                if (!newFiles || newFiles.length === 0) return;
                
                // Copy array of files FIRST
                const filesArray = Array.from(newFiles);
                
                // Clear the real input's value temporarily so selecting the same file works
                this.$refs.galleryInput.value = '';

                filesArray.forEach(file => {
                    // Check if file is image
                    if (!file.type.startsWith('image/')) return;
                    
                    // Generate preview
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.files.push({
                            file: file,
                            preview: e.target.result
                        });
                        this.updateInput();
                    };
                    reader.readAsDataURL(file);
                });
            },
            removeFile(index) {
                this.files.splice(index, 1);
                this.updateInput();
            },
            updateInput() {
                const dt = new DataTransfer();
                this.files.forEach(item => dt.items.add(item.file));
                this.$refs.galleryInput.files = dt.files;
                
                // Refresh lucide icons for new elements
                setTimeout(() => { if (window.lucide) window.lucide.createIcons(); }, 50);
            }
        }));
    });
</script>
@endpush
