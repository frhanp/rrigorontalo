<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'RRI Gorontalo - Portal Berita Internal' }}</title>

    <!-- Menggunakan Font Inter yang profesional dan mudah dibaca -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc; /* slate-50 */
        }
        /* Custom styles untuk pagination agar sesuai tema */
        .pagination span, .pagination a {
            padding: 0.5rem 1rem;
            margin: 0 0.125rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease-in-out;
        }
        .pagination span.cursor-default {
            color: #94a3b8; /* slate-400 */
        }
        .pagination a:hover {
            background-color: #eff6ff; /* blue-50 */
            color: #1d4ed8; /* blue-700 */
        }
        .pagination .active span {
            background-color: #2563eb; /* blue-600 */
            color: white;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }
    </style>
</head>
<body class="antialiased text-slate-800 font-sans">
    <div class="container mx-auto px-4">
        {{-- HEADER UTAMA BARU YANG LEBIH DINAMIS --}}
        <header class="flex justify-between items-center py-6">
            <a href="{{ route('home') }}" class="transition-transform duration-300 hover:scale-105">
                <div class="flex items-center space-x-3">
                    <!-- Menggunakan SVG sebagai gambar biasa -->
                    <img src="{{ asset('images/rrilogo.svg') }}" alt="Logo RRI Gorontalo" class="w-12 h-auto">
                    
                    <div>
                        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">PORTAL BERITA</h1>
                        <p class="text-sm font-semibold text-blue-600 -mt-1">INTERN RRI GORONTALO</p>
                    </div>
                </div>
            </a>
             <nav class="hidden sm:flex items-center text-sm font-medium">
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 shadow-sm hover:shadow-lg transition-all">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-slate-600 hover:text-blue-600 font-semibold">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-900 transition-colors">Register</a>
                    @endif
                @endauth
            </nav>
        </header>

        {{-- NAVBAR KATEGORI DENGAN EFEK HOVER YANG LEBIH JELAS --}}
        <nav class="bg-white/70 backdrop-blur-lg sticky top-4 z-50 rounded-xl mb-10 border border-slate-200 shadow-md">
            <ul class="flex justify-center items-center p-2 space-x-1 overflow-x-auto">
                @foreach ($nav_categories as $category)
                    <li>
                        @php $isActive = request()->is('kategori/' . $category->slug); @endphp
                        <a href="{{ route('categories.show', $category) }}" 
                           class="block px-4 py-2 text-sm font-bold rounded-lg transition-all duration-200 whitespace-nowrap 
                                  {{ $isActive ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-blue-100 hover:text-blue-700' }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        {{-- KONTEN UTAMA DARI SETIAP HALAMAN --}}
        <main>
            {{ $slot }}
        </main>

        {{-- FOOTER BARU --}}
        <footer class="text-center text-slate-500 py-8 mt-12 border-t border-slate-200">
            <p>&copy; {{ date('Y') }} RRI Gorontalo. Semua Hak Cipta Dilindungi.</p>
        </footer>
    </div>
</body>
</html>