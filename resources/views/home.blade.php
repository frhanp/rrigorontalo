@extends('layouts.public')

@section('title', 'Halaman Utama - Portal Berita')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-2">
            <h2 class="text-2xl font-bold mb-4 text-gray-700">Berita Terbaru</h2>
            @forelse($posts as $post)
                <article class="bg-white p-6 rounded-lg shadow-md mb-6">
                    @if ($post->media && $post->media_type == 'image')
                        <img src="{{ asset('storage/' . $post->media) }}" alt="{{ $post->title }}"
                            class="rounded-lg w-full h-64 object-cover mb-4">
                    @endif
                    <h3 class="text-xl font-bold mb-2">
                        <a href="{{ route('posts.show', $post->slug) }}"
                            class="text-gray-800 hover:text-blue-600 transition duration-300">
                            {{ $post->title }}
                        </a>
                    </h3>
                    <div class="text-sm text-gray-500 mb-2">
                        Ditulis oleh {{ $post->user->name }} di kategori <a href="#"
                            class="font-semibold text-blue-500">{{ $post->category->name }}</a>
                        <span class="mx-2">&bull;</span>
                        {{ $post->created_at->diffForHumans() }}
                    </div>
                    <p class="text-gray-600">
                        {{ Str::limit(strip_tags($post->content), 200) }}
                    </p>
                    <a href="{{ route('posts.show', $post->slug) }}"
                        class="text-blue-600 hover:underline mt-4 inline-block">Baca Selengkapnya &rarr;</a>
                </article>
            @empty
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <p class="text-center text-gray-500">Belum ada berita yang dipublikasikan.</p>
                </div>
            @endforelse

            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        </div>
        <aside class="md:col-span-1">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold mb-4 text-gray-700">Tentang Situs</h3>
                <p class="text-gray-600">Ini adalah website portal berita yang dibangun sebagai proyek skripsi menggunakan
                    Laravel 12 dan Breeze.</p>
            </div>
        </aside>
    </div>
@endsection
