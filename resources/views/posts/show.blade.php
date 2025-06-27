<x-layouts.public>
    <x-slot name="title">
        {{ $post->title }}
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <article class="bg-white p-6 sm:p-10 rounded-xl shadow-xl border border-slate-200">
            {{-- Badge Kategori --}}
            <a href="{{ route('categories.show', $post->category) }}" class="inline-block bg-blue-100 text-blue-700 text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full mb-4 hover:bg-blue-200 transition-colors">
                {{ $post->category->name }}
            </a>
            {{-- Judul dan Meta Info --}}
            <h1 class="text-3xl sm:text-5xl font-extrabold text-slate-900 mb-4 leading-tight">{{ $post->title }}</h1>
            <div class="text-base text-slate-500 mb-6 border-b border-slate-200 pb-6">
                Oleh <span class="font-semibold text-slate-800">{{ $post->user->name }}</span>
                <span class="mx-2">&bull;</span>
                <span>Diterbitkan pada {{ $post->created_at->format('d F Y, H:i') }}</span>
            </div>
            {{-- === AWAL PERUBAHAN URUTAN === --}}
            {{-- 1. KONTEN UTAMA DITAMPILKAN TERLEBIH DAHULU --}}
            <div class="prose prose-lg max-w-none text-slate-800 leading-relaxed prose-a:text-blue-600 hover:prose-a:text-blue-800 mb-8">
                {!! $post->content !!}
            </div>
        
            {{-- 2. MEDIA (GAMBAR/VIDEO/AUDIO) DIPINDAHKAN KE BAGIAN AKHIR --}}
            @if($post->media && $post->media_type == 'image')
                <img src="{{ asset('storage/' . $post->media) }}" alt="{{ $post->title }}" class="rounded-lg w-full object-cover">
            @elseif($post->media && $post->media_type == 'video')
                <video controls class="w-full rounded-lg">
                    <source src="{{ asset('storage/' . $post->media) }}" type="video/mp4">
                    Browser Anda tidak mendukung tag video.
                </video>
            @elseif($post->media && $post->media_type == 'audio')
                <div>
                    <p class="text-sm font-semibold text-slate-600 mb-2">Dengarkan Audio:</p>
                    <audio controls class="w-full">
                        <source src="{{ asset('storage/' . $post->media) }}" type="audio/mpeg">
                        Browser Anda tidak mendukung elemen audio.
                    </audio>
                </div>
            @endif
            
            {{-- === AKHIR PERUBAHAN URUTAN === --}}
        </article>

        {{-- Bagian Komentar --}}
        <section id="comments" class="bg-white p-6 sm:p-10 rounded-xl shadow-xl border border-slate-200 mt-10">
            <h2 class="text-2xl font-bold mb-6 text-slate-900">Komentar ({{ $post->comments->count() }})</h2>

            @auth
                <form action="{{ route('comments.store') }}" method="POST" class="mb-8">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <div>
                        <textarea name="content" rows="4" class="w-full bg-slate-100 border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" placeholder="Tulis komentar Anda sebagai {{ Auth::user()->name }}..." required>{{ old('content') }}</textarea>
                    </div>
                    <div class="mt-4">
                        <x-primary-button>Kirim Komentar</x-primary-button>
                    </div>
                </form>
            @else
                <p class="mb-8 text-center text-slate-500"><a href="{{ route('login') }}" class="text-blue-600 hover:underline font-semibold">Login</a> untuk berkomentar.</p>
            @endauth

            <div class="space-y-6">
                @forelse($post->comments->sortByDesc('created_at') as $comment)
                    <div class="flex space-x-4 border-t border-slate-200 pt-6">
                        <div class="flex-shrink-0">
                            <div class="w-11 h-11 rounded-full bg-slate-200 flex items-center justify-center font-bold text-slate-600 text-lg">
                                {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                            </div>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">{{ $comment->user->name }} <span class="text-xs font-normal text-slate-500">- {{ $comment->created_at->diffForHumans() }}</span></p>
                            <p class="mt-1 text-slate-700">{{ $comment->content }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-500 pt-6 border-t border-slate-200">Jadilah yang pertama berkomentar.</p>
                @endforelse
            </div>
        </section>
    </div>
</x-layouts.public>