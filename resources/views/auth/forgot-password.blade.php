<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <title>Lupa Password - Three Queens Interior Admin</title>
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
                    Lupa password Anda? Masukkan email yang terdaftar dan kami akan mengirimkan instruksi pemulihan.
                </p>
            </div>

            {{-- Kanan: Form Lupa Password --}}
            <div class="p-8 md:p-10 md:w-7/12 flex flex-col justify-center">
                
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-1">Lupa Password</h2>
                    <p class="text-gray-500 text-sm">Pemulihan akses akun administrator</p>
                </div>

                {{-- Alert / Session Messages --}}
                @if (session('status'))
                    <div class="mb-6 p-4 rounded-none bg-green-50 border-l-4 border-green-500 text-sm text-green-700 flex items-start">
                        <i data-lucide="check-circle" class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0"></i>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif
                
                @if (session('error'))
                    <div class="mb-6 p-4 rounded-none bg-red-50 border-l-4 border-red-500 text-sm text-red-700 flex items-start">
                        <i data-lucide="alert-circle" class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <form method="POST" action="#">
                    @csrf
                    
                    {{-- Email --}}
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                            <i data-lucide="mail" class="w-4 h-4 mr-1.5 text-primary"></i> Email
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                            placeholder="contoh@threequeens.com"
                            class="w-full px-4 py-2.5 border rounded-none text-sm text-gray-700 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors @error('email') border-red-400 bg-red-50 @else border-gray-300 @enderror">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <i data-lucide="alert-triangle" class="w-3.5 h-3.5"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <button type="button" onclick="alert('Fitur pengiriman email reset password sedang dalam tahap pengembangan.')"
                        class="w-full bg-primary hover:bg-primary-dark text-white text-sm font-medium py-3 px-6 rounded-none transition-colors flex items-center justify-center gap-2 shadow-sm hover:shadow mb-4">
                        <i data-lucide="send" class="w-4 h-4"></i>
                        Kirim Link Reset Password
                    </button>
                    
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-primary transition-colors inline-flex items-center gap-1">
                            <i data-lucide="arrow-left" class="w-3 h-3"></i> Kembali ke Halaman Login
                        </a>
                    </div>
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
    </script>
</body>
</html>
