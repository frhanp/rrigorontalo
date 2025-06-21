<x-layouts.public>
    <x-slot name="title">
        Kategori: {{ $category->name }}
    </x-slot>

    <div class="max-w-4xl mx-auto">
        {{-- Judul halaman yang dinamis sesuai nama kategori --}}
        <h2 class="text-3xl font-bold mb-8 text-slate-900 pb-2 border-b-4 border-blue-600 inline-block">
            Kategori: {{ $category->name }}
        </h2>
        
        <div class="space-y-10">
            {{-- Menggunakan gaya kartu berita yang sama persis dengan homepage untuk konsistensi --}}
            @forelse($posts as $post)
                <article class="group bg-white rounded-xl shadow-md border border-slate-200 overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                    @if($post->media && $post->media_type == 'image')
                        <div class="overflow-hidden">
                            <a href="{{ route('posts.show', $post->slug) }}">
                                <img src="{{ asset('storage/' . $post->media) }}" alt="{{ $post->title }}" 
                                     class="w-full h-72 object-cover transition-transform duration-500 group-hover:scale-105">
                            </a>
                        </div>
                    @endif
                    <div class="p-6">
                        {{-- Badge Kategori --}}
                        <a href="{{ route('categories.show', $post->category) }}" class="inline-block bg-blue-100 text-blue-700 text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full mb-3 hover:bg-blue-200 transition-colors">
                            {{ $post->category->name }}
                        </a>
                        {{-- Judul Berita --}}
                        <h3 class="text-2xl font-bold mb-3">
                            <a href="{{ route('posts.show', $post->slug) }}" class="text-slate-900 group-hover:text-blue-700 transition duration-300">
                                {{ $post->title }}
                            </a>
                        </h3>
                         {{-- Meta Info --}}
                        <div class="text-sm text-slate-500 mb-4">
                            <span class="font-semibold">{{ $post->user->name }}</span>
                            <span class="mx-2">&bull;</span>
                            <span>{{ $post->created_at->format('d F Y') }}</span>
                        </div>
                        {{-- Excerpt / Ringkasan --}}
                        <p class="text-slate-600 text-base leading-relaxed">
                            {{ Str::limit(strip_tags($post->content), 250) }}
                        </p>
                    </div>
                </article>
            @empty
                <div class="bg-white p-10 rounded-lg shadow-sm border border-slate-200">
                    <p class="text-center text-slate-500">Belum ada berita yang ditemukan dalam kategori ini.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination dengan style baru --}}
        <div class="mt-10">
            {{ $posts->links('pagination::tailwind') }}
        </div>
    </div>
</x-layouts.public>