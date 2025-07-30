<x-layouts.public>
    <x-slot name="title">
        Selamat Datang - RRI Gorontalo
    </x-slot>

    {{-- State untuk buka/tutup sidebar di mobile --}}
    <div x-data="{ sidebarOpen: false }">

        {{-- Tombol untuk membuka sidebar di mobile --}}
        <div class="lg:hidden mb-6">
            <button @click="sidebarOpen = true" class="w-full flex items-center justify-center px-4 py-2 bg-white border border-slate-300 rounded-md font-semibold text-slate-700 shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                Tampilkan Kategori
            </button>
        </div>

        {{-- Layout utama dengan Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">

            {{-- SIDEBAR KIRI (order-first untuk diletakkan di kiri pada layar besar) --}}
            <div x-show="sidebarOpen" @click="sidebarOpen = false" x-cloak class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden"></div>
            <aside 
                :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
                class="fixed top-0 left-0 w-72 h-full bg-slate-50 shadow-xl z-50 transform transition-transform duration-300 ease-in-out 
                       lg:relative lg:w-auto lg:h-auto lg:translate-x-0 lg:shadow-none lg:col-span-1 lg:order-first lg:bg-transparent"
            >
                <div class="p-4 h-full lg:sticky lg:top-10">
                    <button @click="sidebarOpen = false" class="absolute top-4 right-4 text-slate-500 hover:text-slate-800 lg:hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                    <div class="bg-white p-6 rounded-xl shadow-md border border-slate-200">
                        <h3 class="text-xl font-bold mb-4 text-slate-900 pb-2 border-b-2 border-slate-200">Kategori Berita</h3>
                        
                        {{-- === AWAL LOGIKA URUTAN BARU === --}}
                        @php
                            $priorityOrder = ['WARTA PAGI', 'WARTA SIANG', 'MAGOTA', 'PUASA ORANG SUSAH', 'PRO2 NEWS', 'PAS JAM', 'CEK FAKTA', 'ARUS MUDIK/BALIK'];
                            $sortedCategories = $nav_categories->partition(fn($c) => in_array($c->name, $priorityOrder));
                            $sortedCategories[0] = $sortedCategories[0]->sortBy(fn($c) => array_search($c->name, $priorityOrder));
                        @endphp

                        <ul class="space-y-2">
                            {{-- Loop untuk kategori prioritas --}}
                            @foreach ($sortedCategories[0] as $category)
                                <li>
                                    <a href="{{ route('categories.show', $category) }}" class="flex justify-between items-center p-2 rounded-md font-semibold text-slate-600 hover:bg-blue-100 hover:text-blue-700 transition-colors">
                                        <span>{{ $category->name }}</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                </li>
                            @endforeach
                            
                            {{-- Loop untuk sisa kategori (diurutkan abjad) --}}
                            @foreach ($sortedCategories[1]->sortBy('name') as $category)
                                <li>
                                    <a href="{{ route('categories.show', $category) }}" class="flex justify-between items-center p-2 rounded-md font-semibold text-slate-600 hover:bg-blue-100 hover:text-blue-700 transition-colors">
                                        <span>{{ $category->name }}</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                </li>
                            @endforeach

                            {{-- Link Arsip di paling bawah --}}
                            <li class="border-t pt-2 mt-2">
                                <a href="{{ route('posts.archive') }}" class="flex justify-between items-center p-2 rounded-md font-semibold text-slate-600 hover:bg-blue-100 hover:text-blue-700 transition-colors">
                                    <span>ARSIP</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </li>
                        </ul>
                        {{-- === AKHIR LOGIKA URUTAN BARU === --}}
                    </div>
                </div>
            </aside>

            {{-- KONTEN UTAMA (KANAN) - Area Sambutan Statis --}}
            <div class="lg:col-span-3">
                <div class="flex flex-col items-center justify-center text-center bg-white rounded-xl shadow-md border border-slate-200 p-10" style="min-height: 70vh;">
                    <img src="{{ asset('images/logorri.png') }}" alt="Logo RRI Gorontalo" class="w-72 h-auto mb-6">
                    <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 tracking-tight">
                        Selamat Datang
                    </h1>
                    <p class="mt-4 max-w-2xl text-lg text-slate-600">
                        Ini adalah Portal Berita Internal RRI Gorontalo. Silakan gunakan menu kategori di samping untuk menavigasi berita atau buka arsip untuk melihat semua postingan.
                    </p>
                </div>
            </div>

        </div>
    </div>
</x-layouts.public>