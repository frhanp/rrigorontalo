<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $post->title }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <header class="flex justify-between items-center border-b pb-4 mb-8">
            <h1 class="text-2xl font-bold text-gray-800">
                <a href="{{ route('home') }}">Portal Berita</a>
            </h1>
            <nav>
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900">Log in</a>
                @endauth
            </nav>
        </header>

        <main>
            <article class="bg-white p-8 rounded-lg shadow-md">
                <h1 class="text-4xl font-extrabold text-gray-900 mb-3">{{ $post->title }}</h1>
                <div class="text-base text-gray-500 mb-6">
                    Ditulis oleh {{ $post->user->name }} di kategori <a href="#" class="font-semibold text-blue-500">{{ $post->category->name }}</a>
                    <span class="mx-2">&bull;</span>
                    {{ $post->created_at->format('d F Y') }}
                </div>

                @if($post->media && $post->media_type == 'image')
                    <img src="{{ asset('storage/' . $post->media) }}" alt="{{ $post->title }}" class="rounded-lg w-full object-cover mb-6">
                @elseif($post->media && $post->media_type == 'video')
                    <video controls class="w-full rounded-lg mb-6">
                        <source src="{{ asset('storage/' . $post->media) }}" type="video/mp4">
                        Browser Anda tidak mendukung tag video.
                    </video>
                @endif
                
                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </article>

            <!-- Bagian Komentar -->
            <section id="comments" class="bg-white p-8 rounded-lg shadow-md mt-8">
                <h2 class="text-2xl font-bold mb-6">Komentar ({{ $post->comments->count() }})</h2>

                @auth
                    <form action="{{ route('comments.store') }}" method="POST" class="mb-6">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div>
                            <textarea name="content" rows="4" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Tulis komentar Anda..." required></textarea>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">Kirim Komentar</button>
                        </div>
                    </form>
                @else
                    <p class="mb-6 text-center"><a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a> atau <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register</a> untuk meninggalkan komentar.</p>
                @endauth

                <div class="space-y-6">
                    @forelse($post->comments as $comment)
                        <div class="flex space-x-4">
                            <div class="flex-shrink-0">
                                <!-- Placeholder for user avatar -->
                                <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center font-bold text-gray-600">
                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                </div>
                            </div>
                            <div>
                                <div class="font-bold text-gray-800">{{ $comment->user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</div>
                                <p class="mt-2 text-gray-700">{{ $comment->content }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">Belum ada komentar.</p>
                    @endforelse
                </div>
            </section>
        </main>
    </div>
</body>
</html>