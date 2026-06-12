<!DOCTYPE html>
<html lang="id"
    x-data="adminLayout()"
    :class="{ 'dark': darkMode }"
    class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <title>@yield('title', 'Dashboard') - Three Queens Interior Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary:        '#472404',
                        'primary-dark': '#341a02',
                        'primary-light':'#6b3a0e',
                        secondary:      '#8B5E3C',
                        accent:         '#F5F0E6',
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/lucide@latest/dist/umd/lucide.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        [x-cloak] { display: none !important; }

        /* Tweak alignment for Lucide icons to match previous FontAwesome behavior */
        .lucide {
            display: inline-block;
            vertical-align: -0.125em; /* Aligns perfectly with text baseline */
            flex-shrink: 0;
        }
        
        /* Auto-add margin if icon is inside button/link and next to text without flex gap */
        button .lucide:not(:last-child), 
        a .lucide:not(:last-child) {
            margin-right: 0.375rem; /* ~6px */
        }
        
        /* Centering block icons automatically if they don't have mx-auto */
        .lucide.block {
            margin-left: auto;
            margin-right: auto;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #6b3a0e; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #472404; }

        /* Sidebar transition */
        .sidebar-transition { transition: width 0.3s ease, transform 0.3s ease; }

        /* Active menu glow */
        .menu-active {
            background: linear-gradient(135deg, #472404, #6b3a0e);
            box-shadow: 0 4px 15px rgba(71,36,4,0.4);
        }

        /* Card hover */
        .stat-card:hover { transform: translateY(-2px); }
        .stat-card { transition: all 0.2s ease; }

        /* Dark mode sidebar */
        .dark .sidebar-bg { background-color: #1a0f0a; }

        /* Notification dot */
        .notif-dot {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        /* Table row hover */
        tbody tr:hover { background-color: rgba(245,240,230,0.5); }
        .dark tbody tr:hover { background-color: rgba(71,36,4,0.2); }
    </style>

    @stack('styles')
</head>

<body class="h-full font-sans bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">

{{-- ===== MOBILE OVERLAY ===== --}}
<div x-show="sidebarOpen && isMobile"
     x-cloak
     @click="sidebarOpen = false"
     class="fixed inset-0 bg-black/50 z-30 lg:hidden backdrop-blur-sm"
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">
</div>

<div class="flex h-full">
    {{-- ===== SIDEBAR ===== --}}
    @include('layouts.sidebar')

    {{-- ===== MAIN CONTENT AREA ===== --}}
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden"
         :class="sidebarOpen && !isMobile ? 'ml-64' : (!sidebarOpen && !isMobile ? 'ml-16' : 'ml-0')"
         style="transition: margin-left 0.3s ease;">

        {{-- ===== TOP NAVBAR ===== --}}
        @include('layouts.navbar')

        {{-- ===== PAGE CONTENT ===== --}}
        <main class="flex-1 overflow-y-auto bg-gray-50 dark:bg-gray-900 p-4 lg:p-6">
            {{-- Breadcrumb --}}
            @hasSection('breadcrumb')
                <nav class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-4">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-primary transition-colors">
                    <i data-lucide="home" class="w-3.5 h-3.5"></i>
                    </a>
                    @yield('breadcrumb')
                </nav>
            @endif

            {{-- Flash Messages --}}
            @include('components.flash-message')

            {{-- Page Content --}}
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 px-6 py-3">
            <p class="text-xs text-gray-400 text-center">
                &copy; {{ date('Y') }} <span class="text-primary font-medium">Three Queens Interior</span>. All rights reserved.
            </p>
        </footer>
    </div>
</div>

{{-- ===== SWEETALERT FLASH ===== --}}
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
            toast: true,
            position: 'top-end',
        });
    });
</script>
@endif

@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            timer: 4000,
            timerProgressBar: true,
            showConfirmButton: false,
            toast: true,
            position: 'top-end',
        });
    });
</script>
@endif

<script>
function adminLayout() {
    return {
        sidebarOpen: window.innerWidth >= 1024,
        isMobile: window.innerWidth < 1024,
        darkMode: localStorage.getItem('darkMode') === 'true',
        notifOpen: false,

        init() {
            this.$watch('darkMode', val => localStorage.setItem('darkMode', val));
            window.addEventListener('resize', () => {
                this.isMobile = window.innerWidth < 1024;
                if (window.innerWidth >= 1024) {
                    this.sidebarOpen = true;
                }
            });
        },

        toggleSidebar() {
            this.sidebarOpen = !this.sidebarOpen;
        },

        toggleDark() {
            this.darkMode = !this.darkMode;
        }
    }
}

// Confirm Delete via SweetAlert2
function confirmDelete(formId, itemName = 'item ini') {
    Swal.fire({
        title: 'Hapus Data?',
        text: `Anda yakin ingin menghapus ${itemName}? Tindakan ini tidak dapat dibatalkan.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#472404',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}
</script>

<script>
    // Jalankan sekali saat DOM siap
    document.addEventListener('DOMContentLoaded', function () {
        lucide.createIcons();
    });
    // Jalankan lagi setelah Alpine.js selesai inisialisasi
    // (menangani icon di dalam x-show / x-cloak)
    document.addEventListener('alpine:initialized', function () {
        lucide.createIcons();
    });
</script>

@stack('scripts')
</body>
</html>
