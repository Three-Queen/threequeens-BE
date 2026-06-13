{{--
    File Dropzone Component
    Props:
        $name        : nama field input (required)
        $label       : label yang tampil di atas dropzone
        $accept      : MIME/extensions yang diterima (default: image/*)
        $hint        : teks kecil format file
        $previewUrl  : URL gambar existing untuk preview (default: null)
        $existingName: nama file existing (default: null)
        $existingUrl : URL file existing untuk link "Lihat" (default: null)
        $isImage     : apakah field ini berupa gambar (tampilkan preview) (default: true)
        $color       : warna aksen border saat hover (primary|blue|purple, default: primary)
        $error       : nama field untuk @error (default: sama dengan $name)
--}}

@php
    $isImage      = $isImage      ?? true;
    $previewUrl   = $previewUrl   ?? null;
    $existingName = $existingName ?? null;
    $existingUrl  = $existingUrl  ?? null;
    $accept       = $accept       ?? 'image/*';
    $hint         = $hint         ?? 'JPG, PNG, WEBP, HEIC (max 5MB)';
    $color        = $color        ?? 'primary';
    $error        = $error        ?? $name;

    $hoverBorder = match($color) {
        'blue'   => 'hover:border-blue-400',
        'purple' => 'hover:border-purple-400',
        default  => 'hover:border-primary',
    };
    $dragBorder = match($color) {
        'blue'   => 'border-blue-400 bg-blue-50 dark:bg-blue-900/10',
        'purple' => 'border-purple-400 bg-purple-50 dark:bg-purple-900/10',
        default  => 'border-primary bg-amber-50 dark:bg-amber-900/10',
    };
    $iconColorClass = match($color) {
        'blue'   => 'text-blue-500',
        'purple' => 'text-purple-500',
        default  => 'text-primary',
    };
    $badgeBg = match($color) {
        'blue'   => 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-300',
        'purple' => 'bg-purple-50 dark:bg-purple-900/20 text-purple-600 dark:text-purple-300',
        default  => 'bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-300',
    };
    $badgeLinkColor = match($color) {
        'blue'   => 'text-blue-500',
        'purple' => 'text-purple-500',
        default  => 'text-primary',
    };
@endphp

<div
    x-data="{
        previewUrl: {{ $previewUrl ? '\'' . addslashes($previewUrl) . '\'' : 'null' }},
        fileName: '',
        isDragging: false,
        handleFiles(files) {
            const file = files[0];
            if (!file) return;
            this.fileName = file.name;
            @if($isImage)
            const reader = new FileReader();
            reader.onload = (e) => { this.previewUrl = e.target.result; };
            reader.readAsDataURL(file);
            @endif
            const dt = new DataTransfer();
            dt.items.add(file);
            this.$refs.fileInput.files = dt.files;
        },
        onDrop(e) {
            this.isDragging = false;
            this.handleFiles(e.dataTransfer.files);
        },
        removeFile() {
            this.previewUrl = null;
            this.fileName = '';
            this.$refs.fileInput.value = '';
        }
    }"
>
    {{-- Label --}}
    @if($label)
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
        {{ $label }}
    </label>
    @endif

    {{-- Existing non-image file badge --}}
    @if(!$isImage && $existingName)
    <div class="flex items-center gap-2 rounded-lg p-2 mb-2 {{ $badgeBg }}">
        {{-- File icon SVG --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0 {{ $iconColorClass }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        <span class="text-xs truncate flex-1">{{ $existingName }}</span>
        @if($existingUrl)
        <a href="{{ $existingUrl }}" target="_blank" class="ml-auto text-xs {{ $badgeLinkColor }} hover:underline whitespace-nowrap">Lihat</a>
        @endif
    </div>
    @endif

    {{-- Drop Zone --}}
    <div
        class="relative border-2 border-dashed rounded-xl transition-all duration-200 {{ $hoverBorder }} {{ $isImage ? 'overflow-hidden' : 'p-4' }}"
        :class="isDragging ? '{{ $dragBorder }}' : 'border-gray-200 dark:border-gray-600'"
        @dragover.prevent="isDragging = true"
        @dragleave.prevent="isDragging = false"
        @drop.prevent="onDrop($event)"
        @click="$refs.fileInput.click()"
        style="cursor: pointer;"
    >
        @if($isImage)
        {{-- === IMAGE MODE === --}}

        {{-- Preview Image (x-show: selalu ada di DOM, cukup show/hide) --}}
        <div x-show="previewUrl" style="display:none;">
            <div class="relative">
                <img :src="previewUrl" class="w-full h-44 object-cover" alt="Preview">
                {{-- Hover overlay --}}
                <div class="absolute inset-0 bg-black/40 opacity-0 hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-2 pointer-events-none">
                    {{-- Upload cloud SVG inline --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <polyline points="16 16 12 12 8 16"/>
                        <line x1="12" y1="12" x2="12" y2="21"/>
                        <path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/>
                    </svg>
                    <span class="text-white text-xs font-semibold">Klik atau seret untuk ganti</span>
                </div>
                {{-- Remove button --}}
                <button type="button"
                    @click.stop="removeFile()"
                    class="absolute top-2 right-2 w-7 h-7 bg-red-500 hover:bg-red-600 rounded-full flex items-center justify-center text-white shadow z-10 transition-colors pointer-events-auto">
                    {{-- X icon SVG inline --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Empty State (x-show) --}}
        <div x-show="!previewUrl" class="flex flex-col items-center justify-center py-8 px-4 text-center">
            {{-- Icon container --}}
            <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-3 transition-transform duration-200"
                 :class="isDragging ? 'scale-110' : 'scale-100'">
                {{-- Upload cloud SVG inline --}}
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-6 h-6 transition-colors duration-200"
                     :class="isDragging ? '{{ $iconColorClass }}' : 'text-gray-400'"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <polyline points="16 16 12 12 8 16"/>
                    <line x1="12" y1="12" x2="12" y2="21"/>
                    <path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/>
                </svg>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium"
               x-text="isDragging ? 'Lepaskan file di sini!' : 'Klik atau seret file ke sini'"></p>
            <p class="text-xs text-gray-300 dark:text-gray-500 mt-1">{{ $hint }}</p>
        </div>

        @else
        {{-- === FILE MODE (non-image) === --}}
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center flex-shrink-0 transition-colors duration-200"
                 :class="isDragging ? 'bg-opacity-80' : ''">
                {{-- File-plus SVG inline --}}
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 transition-colors duration-200"
                     :class="isDragging ? '{{ $iconColorClass }}' : 'text-gray-400'"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="12" y1="18" x2="12" y2="12"/>
                    <line x1="9" y1="15" x2="15" y2="15"/>
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm text-gray-500 dark:text-gray-400 font-medium truncate"
                   x-text="fileName || (isDragging ? 'Lepaskan file di sini!' : '{{ $existingName ? 'Ganti — seret atau klik' : 'Seret file atau klik untuk pilih' }}')"></p>
                <p class="text-xs text-gray-300 dark:text-gray-500 mt-0.5">{{ $hint }}</p>
            </div>
            {{-- Upload cloud SVG inline --}}
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5 ml-auto flex-shrink-0 transition-colors duration-200"
                 :class="isDragging ? '{{ $iconColorClass }}' : 'text-gray-300'"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <polyline points="16 16 12 12 8 16"/>
                <line x1="12" y1="12" x2="12" y2="21"/>
                <path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/>
            </svg>
        </div>
        @endif
    </div>

    {{-- Hidden file input --}}
    <input
        type="file"
        name="{{ $name }}"
        x-ref="fileInput"
        accept="{{ $accept }}"
        class="hidden"
        @change="handleFiles($event.target.files)"
    >

    {{-- File name display (image mode only) --}}
    @if($isImage)
    <p x-show="fileName" x-text="fileName" class="text-xs text-gray-400 mt-1.5 text-center truncate" style="display:none;"></p>
    @endif

    {{-- Validation error --}}
    @error($error)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
