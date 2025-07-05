<x-layouts.public>
    <x-slot name="title">
        Selamat Datang - RRI Gorontalo
    </x-slot>

    {{-- Konten utama untuk landing page --}}
    <div class="flex flex-col items-center justify-center text-center" style="min-height: 60vh;">
        
        {{-- Logo Utama --}}
        <img src="{{ asset('images/rrilogo.svg') }}" alt="Logo RRI Gorontalo" class="w-32 h-auto mb-6">
        
        {{-- Judul dan Subjudul --}}
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-slate-900 tracking-tight">
            Portal Berita Internal
        </h1>
        <p class="mt-4 max-w-2xl text-lg text-slate-600">
            Sumber acuan terpusat untuk semua naskah dan materi siaran bagi para pembaca berita RRI Gorontalo.
        </p>

        {{-- Tombol Aksi (Call to Action) --}}
        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('berita.index') }}" 
               class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-blue-700 transition-all duration-300 transform hover:-translate-y-1">
                Lihat Berita Terbaru
            </a>
            <a href="{{ route('posts.archive') }}" 
               class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 bg-white text-slate-700 text-lg font-semibold rounded-lg shadow-md border border-slate-300 hover:bg-slate-50 hover:border-slate-400 transition-all duration-300">
                Buka Arsip
            </a>
        </div>
    </div>
</x-layouts.public>