<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'RRI Gorontalo - Portal Berita Internal' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc; /* slate-50 */
        }
        /* Style pagination Anda dipertahankan */
        .pagination span, .pagination a { padding: 0.5rem 1rem; margin: 0 0.125rem; border-radius: 0.5rem; transition: all 0.2s ease-in-out; }
        .pagination span.cursor-default { color: #94a3b8; }
        .pagination a:hover { background-color: #eff6ff; color: #1d4ed8; }
        .pagination .active span { background-color: #2563eb; color: white; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1); }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="antialiased text-slate-800 font-sans">
    <div class="container mx-auto px-4">
        {{-- HEADER UTAMA (Tidak Berubah) --}}
        <header class="flex justify-between items-center py-6">
            <a href="{{ route('home') }}" class="transition-transform duration-300 hover:scale-105">
                <div class="flex items-center space-x-3">
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
                    <a href="{{ route('login') }}" class="text-slate-600 hover:text-blue-600 font-semibold">Masuk</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-900 transition-colors">Daftar</a>
                    @endif
                @endauth
            </nav>
        </header>

        {{-- NAVBAR KATEGORI ATAS SUDAH DIHAPUS DARI SINI --}}

        {{-- KONTEN UTAMA DARI SETIAP HALAMAN AKAN MASUK DI SINI --}}
        <main class="py-10">
            {{ $slot }}
        </main>

        {{-- FOOTER (Tidak Berubah) --}}
        <footer class="text-center py-10 mt-12 bg-white border-t border-slate-200">
            {{-- Isi footer Anda dari kode sebelumnya diletakkan di sini --}}
            <div class="container mx-auto px-4">
                <h3 class="text-xl font-bold text-slate-800 mb-2">Ikuti Kami di Media Sosial</h3>
                <p class="text-slate-500 mb-6">Dapatkan informasi terbaru langsung dari RRI Gorontalo.</p>
                <div class="flex justify-center items-center space-x-4">
                    <a href="https://www.youtube.com/@RRIGORONTALOSTREAMING" target="_blank" class="group inline-flex items-center justify-center px-5 py-3 bg-white border-2 border-slate-300 rounded-lg font-semibold text-slate-700 hover:border-red-500 hover:bg-red-500 hover:text-white transition-all duration-300 transform hover:-translate-y-1 shadow-sm hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2 transition-colors group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0C.887 3.427 0 4.926 0 8.75v6.5C0 19.074.887 20.573 4.385 20.816c3.6.245 11.626.246 15.23 0 3.5-.243 4.385-1.742 4.385-5.566v-6.5c0-3.823-.885-5.322-4.385-5.566zm-10.615 12.566v-9.132l7.92 4.566-7.92 4.566z"></path></svg>
                        <span>YouTube</span>
                    </a>
                    <a href="https://www.facebook.com/rri.gorontalo.5" target="_blank" class="group inline-flex items-center justify-center px-5 py-3 bg-white border-2 border-slate-300 rounded-lg font-semibold text-slate-700 hover:border-blue-700 hover:bg-blue-700 hover:text-white transition-all duration-300 transform hover:-translate-y-1 shadow-sm hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2 transition-colors group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path></svg>
                        <span>Facebook</span>
                    </a>
                </div>
                <p class="mt-8 text-sm text-slate-500">&copy; {{ date('Y') }} RRI Gorontalo. Semua Hak Cipta Dilindungi.</p>
            </div>
        </footer>
    </div>
</body>
</html>