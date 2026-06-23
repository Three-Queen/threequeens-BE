<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <title>Reset Password - Three Queens Interior Admin</title>
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
                        accent: '#F5F5DC',
                    },
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #FAFAFA; }
        [x-cloak] { display: none !important; }
        .lucide {
            display: inline-block;
            vertical-align: -0.125em;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] bg-repeat">
    
    <div class="w-full max-w-4xl">
        
        {{-- Card Landscape (2 Columns on md+) --}}
        <div class="bg-white rounded-none border border-gray-200 shadow-2xl flex flex-col md:flex-row overflow-hidden">
            
            {{-- Kiri: Logo & Brand Info --}}
            <div class="bg-white border-b md:border-b-0 md:border-r border-gray-100 p-8 md:p-10 flex flex-col justify-center items-center md:items-start text-center md:text-left md:w-5/12">
                <img src="{{ asset('logo.png') }}" alt="Three Queens Logo" class="w-64 mb-2 mix-blend-multiply object-contain">
                <p class="text-gray-500 text-sm leading-relaxed max-w-xs mt-1">
                    Silakan atur password baru Anda untuk memulihkan akses penuh ke panel administrator.
                </p>
            </div>

            {{-- Kanan: Form Reset Password --}}
            <div class="p-8 md:p-10 md:w-7/12 flex flex-col justify-center" x-data="{ showPass: false, showConfirmPass: false }">
                
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-1">Atur Password Baru</h2>
                    <p class="text-gray-500 text-sm">Gunakan kombinasi password yang kuat dan aman</p>
                </div>

                {{-- Alert Error --}}
                @if ($errors->any())
                    <div class="mb-5 p-3 rounded-none bg-red-50 border-l-4 border-red-500 text-sm text-red-700">
                        <div class="flex items-start mb-1">
                            <i data-lucide="alert-circle" class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0"></i>
                            <span class="font-semibold">Ada kesalahan saat mereset password:</span>
                        </div>
                        <ul class="list-disc list-inside pl-6">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    
                    {{-- Hidden Token --}}
                    <input type="hidden" name="token" value="{{ $token }}">
                    
                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5 flex items-center">
                            <i data-lucide="mail" class="w-4 h-4 mr-1.5 text-primary"></i> Email
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email', $email) }}" required
                            placeholder="admin@threequeens.com" readonly
                            class="w-full px-4 py-2.5 border border-gray-200 bg-gray-50 rounded-none text-sm text-gray-500 focus:outline-none cursor-not-allowed">
                    </div>

                    {{-- Password Baru --}}
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5 flex items-center">
                            <i data-lucide="lock" class="w-4 h-4 mr-1.5 text-primary"></i> Password Baru
                        </label>
                        <div class="relative">
                            <input :type="showPass ? 'text' : 'password'" name="password" id="password" required autofocus
                                placeholder="Minimal 6 karakter"
                                class="w-full px-4 py-2.5 pr-12 border rounded-none text-sm text-gray-700 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors @error('password') border-red-400 bg-red-50 @else border-gray-300 @enderror">
                            <button type="button" @click="showPass = !showPass"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary transition-colors flex items-center justify-center">
                                <i data-lucide="eye-off" x-show="showPass" class="w-4 h-4" x-cloak></i>
                                <i data-lucide="eye" x-show="!showPass" class="w-4 h-4" x-cloak></i>
                            </button>
                        </div>
                    </div>

                    {{-- Konfirmasi Password Baru --}}
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5 flex items-center">
                            <i data-lucide="shield-check" class="w-4 h-4 mr-1.5 text-primary"></i> Konfirmasi Password Baru
                        </label>
                        <div class="relative">
                            <input :type="showConfirmPass ? 'text' : 'password'" name="password_confirmation" id="password_confirmation" required
                                placeholder="Ulangi password baru"
                                class="w-full px-4 py-2.5 pr-12 border rounded-none text-sm text-gray-700 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors border-gray-300">
                            <button type="button" @click="showConfirmPass = !showConfirmPass"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary transition-colors flex items-center justify-center">
                                <i data-lucide="eye-off" x-show="showConfirmPass" class="w-4 h-4" x-cloak></i>
                                <i data-lucide="eye" x-show="!showConfirmPass" class="w-4 h-4" x-cloak></i>
                            </button>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full bg-primary hover:bg-primary-dark text-white text-sm font-medium py-3 px-6 rounded-none transition-colors flex items-center justify-center gap-2 shadow-sm hover:shadow mb-4">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        Simpan Password Baru
                    </button>
                </form>

                <div class="mt-6 pt-5 border-t border-gray-100">
                    <p class="text-center md:text-left text-xs text-gray-400">
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
