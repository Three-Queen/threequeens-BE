{{-- ===================================================
     SIDEBAR
===================================================== --}}
<aside
    x-show="sidebarOpen || !isMobile"
    x-cloak
    :class="[
        'sidebar-transition fixed left-0 top-0 h-full z-40 flex flex-col overflow-hidden',
        isMobile ? (sidebarOpen ? 'w-64 translate-x-0' : 'w-64 -translate-x-full') : (sidebarOpen ? 'w-64' : 'w-16'),
        'bg-primary dark:bg-gray-950 shadow-2xl'
    ]"
>
    {{-- ===== Brand Header ===== --}}
    <div class="flex items-center justify-between px-4 py-5 border-b border-primary-light/30">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 min-w-0">
            <div class="flex-shrink-0 w-9 h-9 bg-white rounded-lg flex items-center justify-center shadow-inner overflow-hidden p-1">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="w-full h-full object-contain">
            </div>
            <div class="overflow-hidden"
                 :class="(sidebarOpen || isMobile) ? 'opacity-100 w-auto' : 'opacity-0 w-0'"
                 style="transition: opacity 0.2s, width 0.3s;">
                <p class="text-white font-bold text-sm leading-tight whitespace-nowrap">Three Queens</p>
                <p class="text-amber-200 text-xs whitespace-nowrap">Interior Admin</p>
            </div>
        </a>
        <button @click="toggleSidebar()" class="text-white/70 hover:text-white lg:flex hidden">
            <i data-lucide="chevron-left" x-show="sidebarOpen" class="w-4 h-4"></i>
            <i data-lucide="chevron-right" x-show="!sidebarOpen" class="w-4 h-4"></i>
        </button>
    </div>

    {{-- ===== Navigation Menu ===== --}}
    <nav class="flex-1 overflow-y-auto py-4 px-2 space-y-1">

        {{-- Dashboard --}}
        <x-sidebar-item
            route="admin.dashboard"
            icon="layout-dashboard"
            label="Dashboard"
        />

        {{-- Divider --}}
        <div :class="(sidebarOpen || isMobile) ? 'px-3 py-2' : 'py-2 flex justify-center'">
            <template x-if="sidebarOpen || isMobile">
                <p class="text-xs text-white/40 uppercase tracking-widest font-medium">Interior Produk</p>
            </template>
            <template x-if="!sidebarOpen && !isMobile">
                <div class="w-4 h-px bg-white/20"></div>
            </template>
        </div>

        {{-- Kategori --}}
        <x-sidebar-item
            route="admin.kategori.index"
            icon="tag"
            label="Kategori Interior"
        />

        {{-- Produk --}}
        <x-sidebar-item
            route="admin.produk.index"
            icon="sofa"
            label="Produk Interior"
        />

        {{-- Portofolio --}}
        <x-sidebar-item
            route="admin.portofolio.index"
            icon="folder-open"
            label="Portofolio Proyek"
        />

        {{-- Divider --}}
        <div :class="(sidebarOpen || isMobile) ? 'px-3 py-2' : 'py-2 flex justify-center'">
            <template x-if="sidebarOpen || isMobile">
                <p class="text-xs text-white/40 uppercase tracking-widest font-medium">Manajemen Konten</p>
            </template>
            <template x-if="!sidebarOpen && !isMobile">
                <div class="w-4 h-px bg-white/20"></div>
            </template>
        </div>

        {{-- Beranda --}}
        <x-sidebar-item
            route="admin.beranda.edit"
            icon="home"
            label="Manajemen Beranda"
        />

        {{-- Tentang --}}
        <x-sidebar-item
            route="admin.tentang.edit"
            icon="info"
            label="Manajemen Tentang"
        />

        {{-- Kontak --}}
        <x-sidebar-item
            route="admin.kontak.edit"
            icon="contact"
            label="Manajemen Kontak"
        />

        {{-- Divider --}}
        <div :class="(sidebarOpen || isMobile) ? 'px-3 py-2' : 'py-2 flex justify-center'">
            <template x-if="sidebarOpen || isMobile">
                <p class="text-xs text-white/40 uppercase tracking-widest font-medium">Komunikasi</p>
            </template>
            <template x-if="!sidebarOpen && !isMobile">
                <div class="w-4 h-px bg-white/20"></div>
            </template>
        </div>

        {{-- Pesan Masuk --}}
        <a href="{{ route('admin.pesan.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group relative
                  {{ request()->routeIs('admin.pesan.*') ? 'menu-active text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
            <div class="flex-shrink-0 w-5 h-5 flex items-center justify-center relative">
                <i data-lucide="mail" class="w-4 h-4"></i>
                @php $unread = \App\Models\PesanMasuk::belumDibaca()->count(); @endphp
                @if($unread > 0)
                    <span class="absolute -top-1.5 -right-1.5 bg-red-500 text-white text-xs w-4 h-4 rounded-full flex items-center justify-center notif-dot font-bold" style="font-size:9px;">
                        {{ $unread > 9 ? '9+' : $unread }}
                    </span>
                @endif
            </div>
            <span :class="(sidebarOpen || isMobile) ? 'opacity-100' : 'opacity-0 w-0'"
                  class="text-sm font-medium whitespace-nowrap overflow-hidden transition-all">
                Pesan Masuk
                @if($unread > 0)
                    <span class="ml-1 bg-red-500 text-white text-xs px-1.5 py-0.5 rounded-full">{{ $unread }}</span>
                @endif
            </span>
        </a>

        {{-- Divider --}}
        <div :class="(sidebarOpen || isMobile) ? 'px-3 py-2' : 'py-2 flex justify-center'">
            <template x-if="sidebarOpen || isMobile">
                <p class="text-xs text-white/40 uppercase tracking-widest font-medium">Akun</p>
            </template>
            <template x-if="!sidebarOpen && !isMobile">
                <div class="w-4 h-px bg-white/20"></div>
            </template>
        </div>

        {{-- Pengaturan --}}
        <x-sidebar-item
            route="admin.pengaturan.index"
            icon="settings"
            label="Pengaturan Akun"
        />

    </nav>

    {{-- ===== Sidebar Footer: User Info ===== --}}
    <div class="border-t border-primary-light/30 p-3">
        <div class="flex items-center gap-3">
            <img src="{{ Auth::user()->avatar_url }}"
                 alt="{{ Auth::user()->name }}"
                 class="w-9 h-9 rounded-full object-cover flex-shrink-0 ring-2 ring-accent/30">
            <div :class="(sidebarOpen || isMobile) ? 'opacity-100 flex-1 min-w-0' : 'opacity-0 w-0 overflow-hidden'"
                 style="transition: opacity 0.2s;">
                <p class="text-white text-sm font-medium truncate">{{ Auth::user()->name }}</p>
                <p class="text-amber-200 text-xs truncate">Admin</p>
            </div>
            <form method="POST" action="{{ route('logout') }}" data-turbo="false" :class="(sidebarOpen || isMobile) ? 'block' : 'hidden'">
                @csrf
                <button type="submit"
                    class="text-white/60 hover:text-red-400 transition-colors p-1 rounded-lg hover:bg-white/10"
                    title="Logout">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                </button>
            </form>
        </div>
    </div>
</aside>
