@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan data Three Queens Interior')

@section('breadcrumb')
    <span class="text-gray-400">/</span>
    <span class="text-primary font-medium">Dashboard</span>
@endsection

@section('content')

{{-- ===== STAT CARDS ===== --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-4 mb-6">

    {{-- Total Produk --}}
    <div class="stat-card bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 bg-amber-50 dark:bg-amber-900/20 rounded-xl flex items-center justify-center">
                <i data-lucide="sofa" class="w-5 h-5 text-amber-600"></i>
            </div>
            <span class="text-xs text-gray-400 bg-gray-50 dark:bg-gray-700 px-2 py-1 rounded-full">Produk</span>
        </div>
        <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $stats['total_produk'] }}</p>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Total Produk Interior</p>
    </div>

    {{-- Total Kategori --}}
    <div class="stat-card bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 bg-primary/10 rounded-xl flex items-center justify-center">
                <i data-lucide="tag" class="w-5 h-5 text-primary"></i>
            </div>
            <span class="text-xs text-gray-400 bg-gray-50 dark:bg-gray-700 px-2 py-1 rounded-full">Kategori</span>
        </div>
        <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $stats['total_kategori'] }}</p>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kategori Interior</p>
    </div>

    {{-- Total Portofolio --}}
    <div class="stat-card bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 bg-blue-50 dark:bg-blue-900/20 rounded-xl flex items-center justify-center">
                <i data-lucide="folder-open" class="w-5 h-5 text-blue-600"></i>
            </div>
            <span class="text-xs text-gray-400 bg-gray-50 dark:bg-gray-700 px-2 py-1 rounded-full">Proyek</span>
        </div>
        <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $stats['total_portofolio'] }}</p>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Proyek Portofolio</p>
    </div>

    {{-- Total Pesan --}}
    <div class="stat-card bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 bg-green-50 dark:bg-green-900/20 rounded-xl flex items-center justify-center">
                <i data-lucide="mail" class="w-5 h-5 text-green-600"></i>
            </div>
            <span class="text-xs text-gray-400 bg-gray-50 dark:bg-gray-700 px-2 py-1 rounded-full">Pesan</span>
        </div>
        <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $stats['total_pesan'] }}</p>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Total Pesan Masuk</p>
    </div>

    {{-- Pesan Belum Dibaca --}}
    <div class="stat-card bg-gradient-to-br from-red-500 to-red-600 rounded-2xl p-5 shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 bg-white/20 rounded-xl flex items-center justify-center">
                <i data-lucide="bell" class="w-5 h-5 text-white"></i>
            </div>
            <span class="text-xs text-white/80 bg-white/20 px-2 py-1 rounded-full">Baru</span>
        </div>
        <p class="text-3xl font-bold text-white">{{ $stats['pesan_belum_dibaca'] }}</p>
        <p class="text-sm text-red-100 mt-1">Pesan Belum Dibaca</p>
    </div>
</div>

{{-- ===== CHART + RECENT MESSAGES ===== --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

    {{-- Chart --}}
    <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="font-semibold text-gray-800 dark:text-white">Produk per Kategori</h3>
                <p class="text-xs text-gray-400 mt-0.5">Distribusi produk berdasarkan kategori</p>
            </div>
            <div class="w-8 h-8 bg-accent rounded-lg flex items-center justify-center">
                <i data-lucide="bar-chart-2" class="w-4 h-4 text-primary"></i>
            </div>
        </div>
        <div class="relative h-64">
            <canvas id="chartProduk"></canvas>
        </div>
    </div>

    {{-- Pesan Terbaru --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-semibold text-gray-800 dark:text-white">Pesan Terbaru</h3>
            <a href="{{ route('admin.pesan.index') }}" class="text-xs text-primary hover:text-primary-dark transition-colors">
                Lihat semua →
            </a>
        </div>

        <div class="space-y-3">
            @forelse($pesanTerbaru as $pesan)
                <a href="{{ route('admin.pesan.show', $pesan) }}"
                   class="flex items-start gap-3 p-3 rounded-xl hover:bg-accent dark:hover:bg-gray-700/50 transition-colors group">
                    <div class="w-9 h-9 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i data-lucide="user" class="w-3.5 h-3.5 text-primary"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-200 truncate">{{ $pesan->nama }}</p>
                            @if($pesan->isBelumDibaca())
                                <span class="w-2 h-2 bg-red-500 rounded-full flex-shrink-0"></span>
                            @endif
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Str::limit($pesan->pesan, 45) }}</p>
                        <p class="text-xs text-gray-300 dark:text-gray-600 mt-0.5">{{ $pesan->created_at->diffForHumans() }}</p>
                    </div>
                </a>
            @empty
                <div class="text-center py-8">
                    <i data-lucide="inbox" class="w-8 h-8 text-gray-300 dark:text-gray-600 mx-auto mb-2"></i>
                    <p class="text-sm text-gray-400">Belum ada pesan masuk</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

{{-- ===== PRODUK TERBARU ===== --}}
<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100 dark:border-gray-700">
        <div>
            <h3 class="font-semibold text-gray-800 dark:text-white">Produk Terbaru</h3>
            <p class="text-xs text-gray-400 mt-0.5">5 produk terakhir ditambahkan</p>
        </div>
        <a href="{{ route('admin.produk.create') }}"
           class="flex items-center gap-2 bg-primary hover:bg-primary-dark text-white text-sm px-4 py-2 rounded-xl transition-colors shadow-sm">
            <i data-lucide="plus" class="w-3.5 h-3.5"></i>
            Tambah Produk
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-accent/50 dark:bg-gray-700/30">
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">#</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Produk</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Kategori</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Harga</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($produkTerbaru as $i => $item)
                    <tr class="transition-colors">
                        <td class="px-5 py-3 text-sm text-gray-500 dark:text-gray-400">{{ $i + 1 }}</td>
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                @if($item->gambar_produk)
                                    <img src="{{ $item->gambar_url }}" alt="{{ $item->nama_produk }}"
                                         class="w-10 h-10 rounded-lg object-cover">
                                @else
                                    <div class="w-10 h-10 bg-accent dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                        <i data-lucide="image" class="w-4 h-4 text-gray-300"></i>
                                    </div>
                                @endif
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ $item->nama_produk }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3">
                            <span class="bg-accent dark:bg-primary/20 text-primary text-xs px-2.5 py-1 rounded-full font-medium">
                                {{ $item->kategori->nama_kategori ?? '-' }}
                            </span>
                        </td>
                        <td class="px-5 py-3 text-sm text-gray-600 dark:text-gray-300">
                            {{ $item->harga_format }}
                        </td>
                        <td class="px-5 py-3 text-xs text-gray-400 dark:text-gray-500">
                            {{ $item->created_at->format('d M Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-10 text-center text-gray-400 text-sm">
                            <i data-lucide="package-open" class="w-8 h-8 mb-2 mx-auto text-gray-200"></i>
                            Belum ada produk
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('chartProduk');
    if (!ctx) return;

    const labels = @json($chartData->pluck('label'));
    const data   = @json($chartData->pluck('count'));

    const colors = [
        '#472404', '#6b3a0e', '#8B5E3C', '#a3723d', '#C4956A',
        '#341a02', '#7d4820', '#9E7A5A', '#5a3010', '#d4a574'
    ];

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Produk',
                data: data,
                backgroundColor: colors.slice(0, data.length),
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#472404',
                    titleColor: '#F5F0E6',
                    bodyColor: '#F5F0E6',
                    padding: 12,
                    cornerRadius: 8,
                    callbacks: {
                        label: ctx => ` ${ctx.raw} produk`
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, color: '#9ca3af' },
                    grid: { color: 'rgba(0,0,0,0.05)' }
                },
                x: {
                    ticks: { color: '#9ca3af' },
                    grid: { display: false }
                }
            }
        }
    });
});
</script>
@endpush
