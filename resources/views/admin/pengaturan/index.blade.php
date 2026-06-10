@extends('layouts.admin')

@section('title', 'Pengaturan Akun')
@section('page-title', 'Pengaturan Akun')
@section('page-subtitle', 'Kelola profil dan keamanan akun')

@section('breadcrumb')
    <span class="text-gray-400">/</span>
    <span class="text-primary font-medium">Pengaturan Akun</span>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Profile Card --}}
    <div class="lg:col-span-1">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 text-center">
            <div class="relative inline-block mb-4" x-data="avatarPreview()">
                <img :src="previewUrl || '{{ $user->avatar_url }}'"
                     src="{{ $user->avatar_url }}"
                     alt="{{ $user->name }}"
                     id="avatarPreview"
                     class="w-24 h-24 rounded-full object-cover mx-auto ring-4 ring-primary/20 shadow-lg">
                <button type="button" @click="$refs.avatarInput.click()"
                    class="absolute bottom-0 right-0 w-8 h-8 bg-primary hover:bg-primary-dark rounded-full flex items-center justify-center text-white shadow-md transition-colors">
                    <i data-lucide="camera" class="w-3.5 h-3.5"></i>
                </button>
                <input type="file" x-ref="avatarInput" id="avatarFileInput" accept="image/*" class="hidden"
                    @change="handleFile($event)">
            </div>
            <h3 class="font-bold text-gray-800 dark:text-white text-lg">{{ $user->name }}</h3>
            <p class="text-gray-400 text-sm">{{ $user->email }}</p>
            <span class="mt-2 inline-block bg-accent dark:bg-primary/20 text-primary text-xs px-3 py-1 rounded-full">
                Admin
            </span>
        </div>
    </div>

    {{-- Forms --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- Update Profil --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
            <h3 class="font-semibold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                <i data-lucide="user" class="w-4 h-4 -edit text-primary"></i> Update Profil
            </h3>

            <form method="POST" action="{{ route('admin.pengaturan.profil') }}" enctype="multipart/form-data" id="formProfil">
                @csrf @method('PUT')

                {{-- Hidden avatar input --}}
                <input type="file" name="avatar" id="avatarHidden" accept="image/*" class="hidden">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors @error('name') border-red-400 @else border-gray-200 @enderror">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="w-full px-4 py-3 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors @error('email') border-red-400 @else border-gray-200 @enderror">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i data-lucide="image" class="w-4 h-4 text-primary mr-1"></i> Foto Profil
                    </label>
                    <div class="flex items-center gap-3 p-3 border-2 border-dashed border-gray-200 dark:border-gray-600 rounded-xl cursor-pointer hover:border-primary transition-colors"
                         onclick="document.getElementById('avatarFileInput').click()">
                        <i data-lucide="upload-cloud" class="w-6 h-6 text-gray-300"></i>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Klik untuk ganti foto profil</p>
                            <p class="text-xs text-gray-300">JPG, PNG, WEBP (max 2MB)</p>
                        </div>
                    </div>
                    @error('avatar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" id="submitProfil"
                    class="flex items-center gap-2 bg-primary hover:bg-primary-dark text-white px-5 py-2.5 rounded-xl text-sm font-medium transition-colors shadow-sm">
                    <i data-lucide="save" class="w-4 h-4"></i> Simpan Profil
                </button>
            </form>
        </div>

        {{-- Update Password --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
            <h3 class="font-semibold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                <i data-lucide="lock" class="w-4 h-4 text-primary"></i> Ubah Password
            </h3>

            <form method="POST" action="{{ route('admin.pengaturan.password') }}" x-data="{ show1: false, show2: false, show3: false }">
                @csrf @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password Lama</label>
                    <div class="relative">
                        <input :type="show1 ? 'text' : 'password'" name="password_lama"
                            placeholder="Masukkan password lama"
                            class="w-full px-4 py-3 pr-12 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors @error('password_lama') border-red-400 @else border-gray-200 @enderror">
                        <button type="button" @click="show1=!show1" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary">
                            <i data-lucide="eye-off" x-show="show1" class="w-4 h-4"></i>
                            <i data-lucide="eye" x-show="!show1" class="w-4 h-4"></i>
                        </button>
                    </div>
                    @error('password_lama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password Baru</label>
                    <div class="relative">
                        <input :type="show2 ? 'text' : 'password'" name="password_baru"
                            placeholder="Min. 8 karakter"
                            class="w-full px-4 py-3 pr-12 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors @error('password_baru') border-red-400 @else border-gray-200 @enderror">
                        <button type="button" @click="show2=!show2" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary">
                            <i data-lucide="eye-off" x-show="show2" class="w-4 h-4"></i>
                            <i data-lucide="eye" x-show="!show2" class="w-4 h-4"></i>
                        </button>
                    </div>
                    @error('password_baru') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Konfirmasi Password Baru</label>
                    <div class="relative">
                        <input :type="show3 ? 'text' : 'password'" name="password_baru_confirmation"
                            placeholder="Ulangi password baru"
                            class="w-full px-4 py-3 pr-12 border-2 rounded-xl text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:border-primary transition-colors border-gray-200">
                        <button type="button" @click="show3=!show3" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary">
                            <i data-lucide="eye-off" x-show="show3" class="w-4 h-4"></i>
                            <i data-lucide="eye" x-show="!show3" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>

                <button type="submit"
                    class="flex items-center gap-2 bg-primary hover:bg-primary-dark text-white px-5 py-2.5 rounded-xl text-sm font-medium transition-colors shadow-sm">
                    <i data-lucide="key" class="w-4 h-4"></i> Ubah Password
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function avatarPreview() {
    return {
        previewUrl: null,
        handleFile(e) {
            const file = e.target.files[0];
            if (!file) return;
            // Sync to hidden input in form
            const dt = new DataTransfer();
            dt.items.add(file);
            document.getElementById('avatarHidden').files = dt.files;
            const r = new FileReader();
            r.onload = e => { this.previewUrl = e.target.result; };
            r.readAsDataURL(file);
        }
    }
}
</script>
@endpush
