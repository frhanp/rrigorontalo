<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Media') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                        @forelse ($postsWithMedia as $post)
                            <div class="border rounded-lg overflow-hidden shadow-sm">
                                @if ($post->media_type == 'image')
                                    <img src="{{ asset('storage/' . $post->media) }}" alt="Media"
                                        class="w-full h-32 object-cover">
                                @elseif($post->media_type == 'audio')
                                    <div class="w-full h-32 bg-sky-100 flex items-center justify-center">
                                        {{-- Ikon Musik --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-sky-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z" />
                                        </svg>
                                    </div>
                                @else
                                    <div class="w-full h-32 bg-slate-200 flex items-center justify-center">
                                        {{-- Ikon Video --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 10l4.55a2 2 0 01.95 1.7V17a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h7.05a2 2 0 011.7.95L15 10z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="p-2">
                                    <p class="text-xs text-gray-600 truncate" title="Post: {{ $post->title }}">
                                        Post: <a href="{{ route('dashboard.posts.edit', $post) }}"
                                            class="text-blue-500 hover:underline">{{ Str::limit($post->title, 15) }}</a>
                                    </p>
                                    <form action="{{ route('dashboard.media.destroy') }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus media ini? Ini tidak bisa dikembalikan.');">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="media_path" value="{{ $post->media }}">
                                        <button type="submit" class="text-xs text-red-500 hover:underline mt-1">Hapus
                                            Media</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-500">Tidak ada media yang ditemukan.</p>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $postsWithMedia->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
