<x-layouts.public>
    <x-slot name="title">
        Arsip Berita - RRI Gorontalo
    </x-slot>

    <div x-data="{ sidebarOpen: false }">
        <div class="lg:hidden mb-6">
            <button @click="sidebarOpen = true" class="w-full flex items-center justify-center px-4 py-2 bg-white border border-slate-300 rounded-md font-semibold text-slate-700 shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                Tampilkan Kategori
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">
            {{-- SIDEBAR KIRI --}}
            <div x-show="sidebarOpen" @click="sidebarOpen = false" x-cloak class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden"></div>
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed top-0 left-0 w-72 h-full bg-slate-50 shadow-xl z-50 transform transition-transform duration-300 ease-in-out lg:relative lg:w-auto lg:h-auto lg:translate-x-0 lg:shadow-none lg:col-span-1 lg:order-first lg:bg-transparent">
                <div class="p-4 h-full lg:sticky lg:top-10">
                    <button @click="sidebarOpen = false" class="absolute top-4 right-4 text-slate-500 hover:text-slate-800 lg:hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                    <div class="bg-white p-6 rounded-xl shadow-md border border-slate-200">
                        <h3 class="text-xl font-bold mb-4 text-slate-900 pb-2 border-b-2 border-slate-200">Kategori</h3>
                        @php
                            $priorityOrder = ['WARTA PAGI', 'WARTA SIANG', 'MAGOTA', 'PUASA ORANG SUSAH', 'PRO2 NEWS', 'PAS JAM', 'CEK FAKTA', 'ARUS MUDIK/BALIK'];
                            $sortedCategories = $nav_categories->partition(fn($c) => in_array($c->name, $priorityOrder));
                            $sortedCategories[0] = $sortedCategories[0]->sortBy(fn($c) => array_search($c->name, $priorityOrder));
                        @endphp
                        <ul class="space-y-2">
                            @foreach ($sortedCategories[0] as $category)
                                <li><a href="{{ route('categories.show', $category) }}" class="flex justify-between items-center p-2 rounded-md font-semibold text-slate-600 hover:bg-blue-100 hover:text-blue-700 transition-colors"><span>{{ $category->name }}</span><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a></li>
                            @endforeach
                            @foreach ($sortedCategories[1]->sortBy('name') as $category)
                                <li><a href="{{ route('categories.show', $category) }}" class="flex justify-between items-center p-2 rounded-md font-semibold text-slate-600 hover:bg-blue-100 hover:text-blue-700 transition-colors"><span>{{ $category->name }}</span><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a></li>
                            @endforeach
                            <li class="border-t pt-2 mt-2"><a href="{{ route('posts.archive') }}" class="flex justify-between items-center p-2 rounded-md font-semibold text-blue-700 bg-blue-100"><span>ARSIP</span><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a></li>
                        </ul>
                    </div>
                </div>
            </aside>

            {{-- KONTEN UTAMA (KANAN) --}}
            <div class="lg:col-span-3">
                <h2 class="text-3xl font-bold mb-8 text-slate-900 pb-2 border-b-4 border-blue-600 inline-block">Arsip Semua Berita</h2>
                <div class="space-y-10">
                    @forelse($posts as $post)
                        <article class="group bg-white rounded-xl shadow-md border border-slate-200 overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                            @if($post->media && $post->media_type == 'image')
                                <div class="overflow-hidden">
                                    <a href="{{ route('posts.show', $post->slug) }}"><img src="{{ asset('storage/' . $post->media) }}" alt="{{ $post->title }}" class="w-full h-72 object-cover transition-transform duration-500 group-hover:scale-105"></a>
                                </div>
                            @endif
                            <div class="p-6">
                                <a href="{{ route('categories.show', $post->category) }}" class="inline-block bg-blue-100 text-blue-700 text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full mb-3 hover:bg-blue-200 transition-colors">{{ $post->category->name }}</a>
                                <h3 class="text-2xl font-bold mb-3"><a href="{{ route('posts.show', $post->slug) }}" class="text-slate-900 group-hover:text-blue-700 transition duration-300">{{ $post->title }}</a></h3>
                                <div class="text-sm text-slate-500 mb-4">
                                    <span class="font-semibold">{{ $post->user->name }}</span>
                                    <span class="mx-2">&bull;</span>
                                    <span>{{ $post->created_at->format('d F Y') }}</span>
                                </div>
                                <p class="text-slate-600 text-base leading-relaxed">{{ Str::limit(strip_tags($post->content), 250) }}</p>
                            </div>
                        </article>
                    @empty
                        <div class="bg-white p-10 rounded-lg shadow-sm border border-slate-200"><p class="text-center text-slate-500">Arsip berita masih kosong.</p></div>
                    @endforelse
                </div>
                <div class="mt-10">
                    {{ $posts->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.public>