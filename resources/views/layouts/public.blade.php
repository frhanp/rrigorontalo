<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-t">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Ambil judul dari halaman spesifik, atau gunakan judul default --}}
    <title>@yield('title', 'Portal Berita Skripsi')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100 font-sans">
    <div class="container mx-auto px-4">
        {{-- HEADER UTAMA --}}
        <header class="flex justify-between items-center border-b pb-4 my-6">
            <a href="{{ route('home') }}" class="text-4xl font-bold text-gray-800">Portal Berita</a>
            <nav>
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900">Register</a>
                    @endif
                @endauth
            </nav>
        </header>

        {{-- NAVBAR KATEGORI --}}
        <nav class="bg-white shadow-md rounded-lg mb-8">
            <ul class="flex justify-center items-center p-2 space-x-2 overflow-x-auto">
                {{-- Variabel $nav_categories akan disediakan oleh View Composer --}}
                @foreach ($nav_categories as $category)
                    <li>
                        {{-- Tambahkan route untuk halaman kategori nantinya --}}
                        <a href="#" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200 rounded-md transition duration-300 whitespace-nowrap">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        {{-- KONTEN UTAMA DARI SETIAP HALAMAN --}}
        <main>
            @yield('content')
        </main>

        {{-- FOOTER --}}
        <footer class="text-center text-gray-500 py-6 mt-8">
            <p>&copy; {{ date('Y') }} Proyek Skripsi. Dibuat dengan Laravel.</p>
        </footer>
    </div>
</body>
</html>