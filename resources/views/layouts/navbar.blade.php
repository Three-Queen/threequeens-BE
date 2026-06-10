{{-- ===================================================
     TOP NAVBAR
===================================================== --}}
<header class="sticky top-0 z-20 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-sm">
    <div class="flex items-center justify-between h-16 px-4 lg:px-6">

        {{-- Left: Toggle + Page Title --}}
        <div class="flex items-center gap-4">
            {{-- Menu Toggle --}}
            <button @click="toggleSidebar()"
                class="flex items-center justify-center w-10 h-10 rounded-xl text-gray-500 dark:text-gray-400 hover:bg-accent dark:hover:bg-gray-700 transition-colors">
                <i data-lucide="menu" class="w-5 h-5"></i>
            </button>

            {{-- Page Title --}}
            <div class="hidden sm:block">
                <h1 class="text-lg font-bold text-gray-800 dark:text-white">@yield('page-title', 'Dashboard')</h1>
                <p class="text-xs text-gray-400 dark:text-gray-500">@yield('page-subtitle', 'Three Queens Interior')</p>
            </div>
        </div>

        {{-- Right: Actions --}}
        <div class="flex items-center gap-2">

            {{-- Dark Mode Toggle --}}
            <button @click="toggleDark()"
                class="flex items-center justify-center w-10 h-10 rounded-xl text-gray-500 dark:text-gray-400 hover:bg-accent dark:hover:bg-gray-700 transition-colors">
                <i data-lucide="sun" x-show="darkMode" class="w-5 h-5 text-amber-400"></i>
                <i data-lucide="moon" x-show="!darkMode" class="w-5 h-5"></i>
            </button>

            {{-- Notifications --}}
            <div class="relative" @click.outside="notifOpen = false">
                <button @click="notifOpen = !notifOpen"
                    class="relative flex items-center justify-center w-10 h-10 rounded-xl text-gray-500 dark:text-gray-400 hover:bg-accent dark:hover:bg-gray-700 transition-colors">
                    <i data-lucide="bell" class="w-5 h-5"></i>
                    @php $unread = \App\Models\PesanMasuk::belumDibaca()->count(); @endphp
                    @if($unread > 0)
                        <span class="absolute top-1.5 right-1.5 w-4 h-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center notif-dot font-bold" style="font-size:9px;">
                            {{ $unread > 9 ? '9+' : $unread }}
                        </span>
                    @endif
                </button>

                {{-- Dropdown Notification --}}
                <div x-show="notifOpen" x-cloak
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">

                    <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="font-semibold text-gray-800 dark:text-white text-sm">Notifikasi</h3>
                        @if($unread > 0)
                            <span class="bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $unread }} baru</span>
                        @endif
                    </div>

                    <div class="max-h-72 overflow-y-auto">
                        @php
                            $recentMessages = \App\Models\PesanMasuk::belumDibaca()->latest()->take(5)->get();
                        @endphp

                        @forelse($recentMessages as $msg)
                            <a href="{{ route('admin.pesan.show', $msg) }}"
                               class="flex items-start gap-3 px-4 py-3 hover:bg-accent dark:hover:bg-gray-700 transition-colors border-b border-gray-50 dark:border-gray-700/50 last:border-0">
                                <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i data-lucide="mail" class="w-3.5 h-3.5 text-primary"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-200 truncate">{{ $msg->nama }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Str::limit($msg->pesan, 50) }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ $msg->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="w-2 h-2 bg-primary rounded-full flex-shrink-0 mt-1.5"></span>
                            </a>
                        @empty
                            <div class="px-4 py-8 text-center">
                                <i data-lucide="bell-off" class="w-8 h-8 text-gray-300 dark:text-gray-600 mx-auto mb-2"></i>
                                <p class="text-sm text-gray-400 dark:text-gray-500">Tidak ada pesan baru</p>
                            </div>
                        @endforelse
                    </div>

                    @if($unread > 0)
                        <div class="border-t border-gray-100 dark:border-gray-700 p-3">
                            <a href="{{ route('admin.pesan.index') }}"
                               class="block text-center text-sm text-primary hover:text-primary-dark font-medium transition-colors">
                                Lihat Semua Pesan
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- User Dropdown --}}
            <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                <button @click="open = !open"
                    class="flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-accent dark:hover:bg-gray-700 transition-colors">
                    <img src="{{ Auth::user()->avatar_url }}"
                         alt="{{ Auth::user()->name }}"
                         class="w-8 h-8 rounded-full object-cover ring-2 ring-primary/20">
                    <div class="hidden sm:block text-left">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-200 leading-tight">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500">Admin</p>
                    </div>
                    <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400 hidden sm:block"></i>
                </button>

                {{-- Dropdown --}}
                <div x-show="open" x-cloak
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">

                    <a href="{{ route('admin.pengaturan.index') }}"
                       class="flex items-center gap-2 px-4 py-3 text-sm text-gray-700 dark:text-gray-200 hover:bg-accent dark:hover:bg-gray-700 transition-colors">
                        <i data-lucide="settings" class="w-4 h-4 text-primary"></i>
                        Pengaturan Akun
                    </a>

                    <hr class="border-gray-100 dark:border-gray-700">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-2 px-4 py-3 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
