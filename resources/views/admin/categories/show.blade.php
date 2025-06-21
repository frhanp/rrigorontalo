<x-layouts.public>
    <x-slot name="title">
        Kategori: {{ $category->name }}
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-2">
            {{-- Judulnya sekarang dinamis sesuai nama kategori --}}
            <h2 class="text-2xl font-bold mb-4 text-gray-700">
                Berita dalam Kategori: <span class="text-blue-600">{{ $category->name }}</span>
            </h2>

            {{-- Logika looping postingannya sama persis dengan homepage --}}
            @forelse($posts as $post)
                <article class="bg-white p-6 rounded-lg shadow-md mb-6">
                    @if($post->media && $post->media_type == 'image')
                        <img src="{{ asset('storage/' . $post->media) }}" alt="{{ $post->title }}" class="rounded-lg w-full h-64 object-cover mb-4">
                    @endif
                    <h3 class="text-xl font-bold mb-2">
                        <a href="{{ route('posts.show', $post->slug) }}" class="text-gray-800 hover:text-blue-600 transition duration-300">
                            {{ $post->title }}
                        </a>
                    </h3>
                    <div class="text-sm text-gray-500 mb-2">
                        Ditulis oleh {{ $post->user->name }}
                        <span class="mx-2">&bull;</span>
                        {{ $post->created_at->diffForHumans() }}
                    </div>
                    <p class="text-gray-600">
                        {{ Str::limit(strip_tags($post->content), 200) }}
                    </p>
                    <a href="{{ route('posts.show', $post->slug) }}" class="text-blue-600 hover:underline mt-4 inline-block">Baca Selengkapnya &rarr;</a>
                </article>
            @empty
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <p class="text-center text-gray-500">Belum ada berita yang ditemukan dalam kategori ini.</p>
                </div>
            @endforelse

            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        </div>
        {{-- <aside class="md:col-span-1">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold mb-4 text-gray-700">Tentang Situs</h3>
                <p class="text-gray-600">Ini adalah website portal berita yang dibangun sebagai proyek skripsi.</p>
            </div>
        </aside> --}}
    </div>
</x-layouts.public>