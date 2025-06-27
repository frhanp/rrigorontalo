<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Edit Berita') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        {{-- BAGIAN 1: FORM EDIT BERITA --}}
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-slate-900">
                <form method="POST" action="{{ route('dashboard.posts.update', $post) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <!-- Judul -->
                    <div>
                        <x-input-label for="title" :value="__('Judul Berita')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $post->title)" required autofocus />
                    </div>

                    <!-- Kategori -->
                    <div class="mt-4">
                         <x-input-label for="category_id" :value="__('Kategori')" />
                         <select name="category_id" id="category_id" class="block mt-1 w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Konten dengan Rich Text Editor -->
                    <div class="mt-4">
                        <x-input-label for="content" :value="__('Konten Berita')" />
                        <textarea name="content" id="content" rows="20">{{ old('content', $post->content) }}</textarea>
                    </div>

                    <!-- Media -->
                    <div class="mt-4">
                        <x-input-label for="media" :value="__('Ganti Media Utama (Opsional)')" />
                        @if ($post->media)
                            <div class="my-2">
                                <p class="text-sm text-slate-600">Media utama saat ini:</p>
                                @if($post->media_type == 'image')
                                    <img src="{{ asset('storage/' . $post->media) }}" alt="media" class="h-40 rounded-md object-cover">
                                @else
                                    <a href="{{ asset('storage/' . $post->media) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Media</a>
                                @endif
                            </div>
                        @endif
                        <input id="media" name="media" type="file" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                        <p class="text-xs text-slate-500 mt-1">Kosongkan jika tidak ingin mengganti media utama.</p>
                    </div>

                    <!-- Status -->
                    <div class="mt-4">
                        <x-input-label :value="__('Status')" />
                        <div class="flex items-center space-x-4 mt-1">
                            <label for="draft" class="flex items-center">
                                <input id="draft" name="status" type="radio" value="draft" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300" {{ old('status', $post->status) == 'draft' ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-slate-600">Draft</span>
                            </label>
                            <label for="published" class="flex items-center">
                                <input id="published" name="status" type="radio" value="published" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300" {{ old('status', $post->status) == 'published' ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-slate-600">Published</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6 border-t border-slate-200 pt-6">
                        <a href="{{ route('dashboard.posts.index') }}" class="text-sm text-slate-600 hover:text-slate-900">Batal</a>
                        <x-primary-button class="ml-4">
                            {{ __('Update Berita') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>

        {{-- BAGIAN 2: KELOLA KOMENTAR --}}
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-slate-900">
                <h3 class="text-lg font-medium text-slate-900 mb-4">
                    Komentar untuk Postingan Ini ({{ $post->comments->count() }})
                </h3>
                <form action="{{ route('comments.store') }}" method="POST" class="mb-6 border-b border-slate-200 pb-6">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <div>
                        <x-input-label for="comment_content" :value="__('Tambah Komentar Baru (sebagai '. Auth::user()->name .')')" />
                        <textarea name="content" id="comment_content" rows="3" class="mt-1 block w-full border-slate-300 rounded-md shadow-sm" placeholder="Tulis balasan atau catatan Anda..." required></textarea>
                    </div>
                    <div class="mt-2">
                        <x-primary-button>Kirim Komentar</x-primary-button>
                    </div>
                </form>
                <div class="space-y-4 mt-6">
                    @forelse ($post->comments->sortByDesc('created_at') as $comment)
                        <div class="flex justify-between items-start">
                            <div class="flex space-x-3">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center font-bold">
                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold">{{ $comment->user->name }} <span class="text-sm font-normal text-slate-500">- {{ $comment->created_at->diffForHumans() }}</span></p>
                                    <p class="text-slate-700">{{ $comment->content }}</p>
                                </div>
                            </div>
                            <form action="{{ route('dashboard.comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Hapus komentar ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-red-500 hover:text-red-700">Hapus</button>
                            </form>
                        </div>
                    @empty
                        <p class="text-slate-500">Belum ada komentar di postingan ini.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <!-- Muat script TinyMCE dengan API Key Anda -->
        <script src="https://cdn.tiny.cloud/1/ejxh47zrjpaubo8l13cinpj8b48s0lck0lw9ze8uvpyozp1b/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

        <script>
            tinymce.init({
                selector: 'textarea#content',
                plugins: 'code table lists image link fullscreen visualblocks wordcount media',
                toolbar: 'undo redo | blocks | bold italic underline | link image media | bullist numlist | code | fullscreen',
                height: 500,
                skin: 'oxide',
                content_css: 'default',

                images_upload_handler: (blobInfo, progress) => new Promise((resolve, reject) => {
                    const xhr = new XMLHttpRequest();
                    xhr.withCredentials = false;
                    xhr.open('POST', "{{ route('dashboard.posts.upload') }}");
                    
                    const token = '{{ csrf_token() }}';
                    xhr.setRequestHeader("X-CSRF-Token", token);

                    xhr.upload.onprogress = (e) => {
                        progress(e.loaded / e.total * 100);
                    };
                
                    xhr.onload = () => {
                        if (xhr.status < 200 || xhr.status >= 300) {
                            return reject('HTTP Error: ' + xhr.status);
                        }
                
                        const json = JSON.parse(xhr.responseText);
                
                        if (!json || typeof json.location != 'string') {
                            return reject('Invalid JSON: ' + xhr.responseText);
                        }
                
                        resolve(json.location);
                    };

                    xhr.onerror = () => {
                      reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
                    };
                
                    const formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());
                
                    xhr.send(formData);
                }),

                file_picker_callback: (cb, value, meta) => {
                    const input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    if (meta.filetype === 'media' || meta.filetype === 'audio') {
                        input.setAttribute('accept', 'audio/*,video/*');
                    }
                     if (meta.filetype === 'image') {
                        input.setAttribute('accept', 'image/*');
                    }

                    input.addEventListener('change', (e) => {
                        const file = e.target.files[0];
                        
                        const formData = new FormData();
                        formData.append('file', file);
                        const token = '{{ csrf_token() }}';

                        fetch("{{ route('dashboard.posts.upload') }}", {
                            method: 'POST',
                            headers: { 'X-CSRF-Token': token },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(result => {
                            cb(result.location, { title: file.name });
                        })
                        .catch(error => {
                            console.error('Upload error:', error);
                        });
                    });

                    input.click();
                },
            });
        </script>
    @endpush
</x-app-layout>