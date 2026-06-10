@extends('layouts.admin')

@section('title', 'Pesan Masuk')
@section('page-title', 'Pesan Masuk')
@section('page-subtitle', 'Kelola pesan dari pengunjung website')

@section('breadcrumb')
    <span class="text-gray-400">/</span>
    <span class="text-primary font-medium">Pesan Masuk</span>
@endsection

@section('content')

{{-- Stats row --}}
<div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-5">
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 border border-gray-100 dark:border-gray-700 shadow-sm">
        <p class="text-xs text-gray-400 mb-1">Total Pesan</p>
        <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $pesan->total() }}</p>
    </div>
    <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-2xl p-4 shadow-sm">
        <p class="text-xs text-red-100 mb-1">Belum Dibaca</p>
        <p class="text-2xl font-bold text-white">{{ $belumDibaca }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 border border-gray-100 dark:border-gray-700 shadow-sm col-span-2 sm:col-span-1">
        <p class="text-xs text-gray-400 mb-1">Sudah Dibaca</p>
        <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $pesan->total() - $belumDibaca }}</p>
    </div>
</div>

<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">

    <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-700">
        <h3 class="font-semibold text-gray-800 dark:text-white">Daftar Pesan</h3>
    </div>

    <div class="divide-y divide-gray-100 dark:divide-gray-700">
        @forelse($pesan as $item)
            <div class="flex items-start gap-4 px-5 py-4 hover:bg-accent/30 dark:hover:bg-gray-700/30 transition-colors
                        {{ $item->isBelumDibaca() ? 'bg-amber-50/30 dark:bg-amber-900/5' : '' }}">

                {{-- Avatar --}}
                <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center
                            {{ $item->isBelumDibaca() ? 'bg-primary' : 'bg-gray-200 dark:bg-gray-700' }}">
                    <i data-lucide="user" class="w-4 h-4 {{ $item->isBelumDibaca() ? 'text-white' : 'text-gray-500' }}"></i>
                </div>

                {{-- Content --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1">
                        <p class="text-sm font-semibold text-gray-800 dark:text-white">{{ $item->nama }}</p>
                        @if($item->isBelumDibaca())
                            <span class="bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">Baru</span>
                        @else
                            <span class="bg-gray-100 dark:bg-gray-700 text-gray-500 text-xs px-2 py-0.5 rounded-full">Dibaca</span>
                        @endif
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-0.5">
                        <i data-lucide="mail" class="w-4 h-4 mr-1"></i>{{ $item->email ?? '-' }}
                        @if($item->no_hp) · <i data-lucide="phone" class="w-4 h-4 mr-1"></i>{{ $item->no_hp }} @endif
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-300 truncate">{{ Str::limit($item->pesan, 80) }}</p>
                    <p class="text-xs text-gray-300 dark:text-gray-500 mt-1">
                        <i data-lucide="clock" class="w-4 h-4 mr-1"></i>{{ $item->created_at->format('d M Y H:i') }}
                        ({{ $item->created_at->diffForHumans() }})
                    </p>
                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-2 flex-shrink-0">
                    <a href="{{ route('admin.pesan.show', $item) }}"
                       class="w-8 h-8 flex items-center justify-center bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg transition-colors" title="Baca">
                        <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                    </a>
                    @if($item->isBelumDibaca())
                        <form method="POST" action="{{ route('admin.pesan.tandai', $item) }}">
                            @csrf @method('PATCH')
                            <button type="submit" title="Tandai dibaca"
                                class="w-8 h-8 flex items-center justify-center bg-green-50 hover:bg-green-100 text-green-600 rounded-lg transition-colors">
                                <i data-lucide="check" class="w-3.5 h-3.5"></i>
                            </button>
                        </form>
                    @endif
                    <form id="del-pesan-{{ $item->id }}" method="POST" action="{{ route('admin.pesan.destroy', $item) }}">
                        @csrf @method('DELETE')
                        <button type="button" onclick="confirmDelete('del-pesan-{{ $item->id }}', 'pesan dari {{ $item->nama }}')"
                            class="w-8 h-8 flex items-center justify-center bg-red-50 hover:bg-red-100 text-red-500 rounded-lg transition-colors" title="Hapus">
                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="py-16 text-center">
                <i data-lucide="inbox" class="w-10 h-10 text-gray-200 dark:text-gray-600 mb-4 block"></i>
                <p class="text-gray-400">Tidak ada pesan masuk</p>
            </div>
        @endforelse
    </div>

    @if($pesan->hasPages())
        <div class="px-5 py-4 border-t border-gray-100 dark:border-gray-700">
            {{ $pesan->links() }}
        </div>
    @endif
</div>
@endsection
