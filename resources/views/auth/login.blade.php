<!DOCTYPE html>
<html lang="id" x-data="{ darkMode: false }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <title>Login - Three Queens Interior Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#472404',
                        'primary-dark': '#341a02',
                        'primary-light': '#6b3a0e',
                        secondary: '#8B5E3C',
                        accent: '#F5F0E6',
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        [x-cloak] { display: none !important; }
        .lucide {
            display: inline-block;
            vertical-align: -0.125em;
        }
    </style>
</head>
<body class="bg-white min-h-screen flex items-center justify-center p-4 font-sans text-gray-800">

    <div class="w-full max-w-4xl">
        
        {{-- Card Landscape (2 Columns on md+) --}}
        <div class="bg-white rounded-none border border-gray-200 shadow-2xl flex flex-col md:flex-row overflow-hidden">
            
            {{-- Kiri: Logo & Brand Info --}}
            <div class="bg-white border-b md:border-b-0 md:border-r border-gray-100 p-8 md:p-10 flex flex-col justify-center items-center md:items-start text-center md:text-left md:w-5/12">
                <img src="{{ asset('logo.png') }}" alt="Three Queens Logo" class="w-64 mb-2 mix-blend-multiply object-contain">
                <p class="text-gray-500 text-sm leading-relaxed max-w-xs mt-1">
                    Masuk ke panel administrasi untuk mengelola portofolio, produk interior, dan pengaturan website.
                </p>
            </div>

            {{-- Kanan: Form Login --}}
            <div class="p-8 md:p-10 md:w-7/12 flex flex-col justify-center">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-1">Selamat Datang</h2>
                    <p class="text-gray-500 text-sm">Silakan masukkan email dan password Anda.</p>
                </div>

                {{-- Alert Error --}}
                @if(session('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-3 rounded-none mb-5 flex items-center gap-3">
                        <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0"></i>
                        <span class="text-sm">{{ session('error') }}</span>
                    </div>
                @endif

                {{-- Alert Success --}}
                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-3 rounded-none mb-5 flex items-center gap-3">
                        <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
                        <span class="text-sm">{{ session('success') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}" x-data="{ showPass: false }">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5 flex items-center">
                            <i data-lucide="mail" class="w-4 h-4 mr-1.5 text-primary"></i> Email
                        </label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="admin@threequeen.com"
                            class="w-full px-4 py-2.5 border rounded-none text-sm text-gray-700 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors @error('email') border-red-400 bg-red-50 @else border-gray-300 @enderror"
                            autocomplete="email"
                            autofocus
                        >
                        @error('email')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <i data-lucide="alert-triangle" class="w-3.5 h-3.5"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5 flex items-center">
                            <i data-lucide="lock" class="w-4 h-4 mr-1.5 text-primary"></i> Password
                        </label>
                        <div class="relative">
                            <input
                                :type="showPass ? 'text' : 'password'"
                                name="password"
                                placeholder="Masukkan password"
                                class="w-full px-4 py-2.5 pr-12 border rounded-none text-sm text-gray-700 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors @error('password') border-red-400 bg-red-50 @else border-gray-300 @enderror"
                                autocomplete="current-password"
                            >
                            <button type="button" @click="showPass = !showPass"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary transition-colors flex items-center justify-center">
                                <i data-lucide="eye-off" x-show="showPass" class="w-4 h-4" x-cloak></i>
                                <i data-lucide="eye" x-show="!showPass" class="w-4 h-4" x-cloak></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <i data-lucide="alert-triangle" class="w-3.5 h-3.5"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Remember Me & Forgot Password --}}
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <input type="checkbox" name="remember" id="remember"
                                class="w-4 h-4 accent-primary rounded-none border-gray-300 cursor-pointer">
                            <label for="remember" class="ml-2 text-sm text-gray-600 cursor-pointer">
                                Ingat saya
                            </label>
                        </div>
                        <a href="{{ route('password.request') }}" class="text-sm text-primary hover:underline transition-colors">
                            Lupa password?
                        </a>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full bg-primary hover:bg-primary-dark text-white text-sm font-medium py-3 px-6 rounded-none transition-colors flex items-center justify-center gap-2 shadow-sm hover:shadow">
                        <i data-lucide="log-in" class="w-4 h-4"></i>
                        Masuk ke Dashboard
                    </button>
                </form>

                <div class="mt-6 pt-5 border-t border-gray-100">
                    <p class="text-left text-xs text-gray-400">
                        &copy; {{ date('Y') }} Three Queens Interior
                    </p>
                </div>
            </div>
            
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });
        document.addEventListener('alpine:initialized', () => {
            lucide.createIcons();
        });
    </script>
</body>
</html>
