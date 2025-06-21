<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Berita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- BAGIAN 1: FORM EDIT BERITA YANG LENGKAP --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('dashboard.posts.update', $post) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Judul -->
                        <div>
                            <x-input-label for="title" :value="__('Judul Berita')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $post->title)" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Kategori -->
                        <div class="mt-4">
                            <x-input-label for="category_id" :value="__('Kategori')" />
                            <select name="category_id" id="category_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <!-- Konten -->
                        <div class="mt-4">
                            <x-input-label for="content" :value="__('Konten Berita')" />
                            <textarea name="content" id="content" rows="10" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('content', $post->content) }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <!-- === BAGIAN MEDIA YANG DIPERBAIKI === -->
                        <div class="mt-4">
                            <x-input-label for="media" :value="__('Media (Gambar/Video)')" />
                            @if ($post->media)
                                <div class="my-2">
                                    <p class="text-sm text-gray-600">Media saat ini:</p>
                                    @if($post->media_type == 'image')
                                        <img src="{{ asset('storage/' . $post->media) }}" alt="media" class="h-40 rounded-md object-cover">
                                    @else
                                        <a href="{{ asset('storage/' . $post->media) }}" target="_blank" class="text-blue-500 hover:underline">Lihat Media</a>
                                    @endif
                                </div>
                            @endif
                            <input id="media" name="media" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100"/>
                            <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti media.</p>
                            <x-input-error :messages="$errors->get('media')" class="mt-2" />
                        </div>

                        <!-- === BAGIAN STATUS YANG DIPERBAIKI === -->
                         <div class="mt-4">
                            <x-input-label :value="__('Status')" />
                            <div class="flex items-center space-x-4 mt-1">
                                <label for="draft" class="flex items-center">
                                    <input id="draft" name="status" type="radio" value="draft" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300" {{ old('status', $post->status) == 'draft' ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">Draft</span>
                                </label>
                                <label for="published" class="flex items-center">
                                    <input id="published" name="status" type="radio" value="published" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300" {{ old('status', $post->status) == 'published' ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">Published</span>
                                </label>
                            </div>
                             <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                             <a href="{{ route('dashboard.posts.index') }}" class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Batal</a>
                            <x-primary-button class="ml-4">
                                {{ __('Update Berita') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- BAGIAN 2: KELOLA KOMENTAR (TETAP SAMA) --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        Komentar untuk Postingan Ini ({{ $post->comments->count() }})
                    </h3>

                    <form action="{{ route('comments.store') }}" method="POST" class="mb-6 border-b pb-6">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div>
                            <x-input-label for="comment_content" :value="__('Tambah Komentar Baru (sebagai '. Auth::user()->name .')')" />
                            <textarea name="content" id="comment_content" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Tulis balasan atau catatan Anda..." required></textarea>
                        </div>
                        <div class="mt-2">
                            <x-primary-button>Kirim Komentar</x-primary-button>
                        </div>
                    </form>

                    <div class="space-y-4 mt-6">
                        @forelse ($post->comments->sortByDesc('created_at') as $comment)
                            <div class="flex justify-between items-start">
                                <div class="flex space-x-3">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center font-bold">
                                        {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold">{{ $comment->user->name }} <span class="text-sm font-normal text-gray-500">- {{ $comment->created_at->diffForHumans() }}</span></p>
                                        <p class="text-gray-700">{{ $comment->content }}</p>
                                    </div>
                                </div>
                                <form action="{{ route('dashboard.comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Hapus komentar ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-red-500 hover:text-red-700">Hapus</button>
                                </form>
                            </div>
                        @empty
                            <p class="text-gray-500">Belum ada komentar di postingan ini.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>