@extends('layouts.admin')

@section('title', 'Detail Pesan')
@section('page-title', 'Detail Pesan')

@section('breadcrumb')
    <span class="text-gray-400">/</span>
    <a href="{{ route('admin.pesan.index') }}" class="hover:text-primary">Pesan Masuk</a>
    <span class="text-gray-400">/</span>
    <span class="text-primary font-medium">Detail</span>
@endsection

@section('content')
<div class="max-w-2xl">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-primary to-secondary p-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center">
                    <i data-lucide="user" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <h2 class="text-white text-xl font-bold">{{ $pesan->nama }}</h2>
                    <p class="text-amber-100 text-sm">{{ $pesan->created_at->format('d F Y, H:i') }} WIB</p>
                </div>
                <div class="ml-auto">
                    @if($pesan->isBelumDibaca())
                        <span class="bg-red-500 text-white text-xs px-3 py-1 rounded-full">Belum Dibaca</span>
                    @else
                        <span class="bg-white/20 text-white text-xs px-3 py-1 rounded-full">Sudah Dibaca</span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Contact Info --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-5 border-b border-gray-100 dark:border-gray-700">
            <div class="flex items-center gap-3 p-3 bg-accent/50 dark:bg-gray-700/50 rounded-xl">
                <div class="w-9 h-9 bg-blue-50 dark:bg-blue-900/20 rounded-lg flex items-center justify-center">
                    <i data-lucide="mail" class="w-4 h-4 text-blue-500"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-400">Email</p>
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ $pesan->email ?? '-' }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3 p-3 bg-accent/50 dark:bg-gray-700/50 rounded-xl">
                <div class="w-9 h-9 bg-green-50 dark:bg-green-900/20 rounded-lg flex items-center justify-center">
                    <i data-lucide="phone" class="w-4 h-4 text-green-500"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-400">No. HP</p>
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ $pesan->no_hp ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- Message --}}
        <div class="p-5">
            <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">Isi Pesan</h4>
            <div class="bg-accent/50 dark:bg-gray-700/30 rounded-xl p-4">
                <p class="text-gray-700 dark:text-gray-200 text-sm leading-relaxed whitespace-pre-wrap">{{ $pesan->pesan }}</p>
            </div>
        </div>

        {{-- Quick Reply via WA --}}
        @if($pesan->no_hp)
            <div class="px-5 pb-4">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pesan->no_hp) }}" target="_blank"
                   class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2.5 rounded-xl transition-colors">
                    <i class="fab fa-whatsapp"></i>
                    Balas via WhatsApp
                </a>
            </div>
        @endif

        {{-- Actions --}}
        <div class="px-5 pb-5 flex items-center gap-3 border-t border-gray-100 dark:border-gray-700 pt-4">
            <a href="{{ route('admin.pesan.index') }}"
               class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300 px-5 py-2.5 rounded-xl text-sm font-medium transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
            </a>

            @if($pesan->isBelumDibaca())
                <form method="POST" action="{{ route('admin.pesan.tandai', $pesan) }}">
                    @csrf @method('PATCH')
                    <button type="submit"
                        class="flex items-center gap-2 bg-green-50 hover:bg-green-100 text-green-600 px-5 py-2.5 rounded-xl text-sm font-medium transition-colors">
                        <i data-lucide="check" class="w-4 h-4"></i> Tandai Dibaca
                    </button>
                </form>
            @endif

            <form id="del-pesan-detail" method="POST" action="{{ route('admin.pesan.destroy', $pesan) }}" class="ml-auto">
                @csrf @method('DELETE')
                <button type="button" onclick="confirmDelete('del-pesan-detail', 'pesan dari {{ $pesan->nama }}')"
                    class="flex items-center gap-2 bg-red-50 hover:bg-red-100 text-red-600 px-5 py-2.5 rounded-xl text-sm font-medium transition-colors">
                    <i data-lucide="trash-2" class="w-4 h-4"></i> Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
