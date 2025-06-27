<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Buat Berita Baru') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-slate-900">
            {{-- Tambahkan x-data untuk Alpine.js --}}
            <form method="POST" action="{{ route('dashboard.posts.store') }}" enctype="multipart/form-data"
                x-data="{ status: '{{ old('status', 'draft') }}' }">
                @csrf

                <!-- Judul -->
                <div>
                    <x-input-label for="title" :value="__('Judul Berita')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                        :value="old('title')" required autofocus />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <!-- Kategori -->
                <div class="mt-4">
                    <x-input-label for="category_id" :value="__('Kategori')" />
                    <select name="category_id" id="category_id"
                        class="block mt-1 w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                        required>
                        <option value="" disabled selected>-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                </div>

                <!-- Konten -->
                <div class="mt-4">
                    <x-input-label for="content" :value="__('Konten Berita')" />
                    <textarea name="content" id="content" rows="20">{{ old('content') }}</textarea>
                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                </div>

                <!-- Media -->
                {{-- <div class="mt-4">
                    <x-input-label for="media" :value="__('Media Utama (Gambar/Video/Audio)')" />
                    <input id="media" name="media" type="file" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                    <x-input-error :messages="$errors->get('media')" class="mt-2" />
                </div> --}}

                <!-- Status dengan Pemicu Alpine.js -->
                <div class="mt-4">
                    <x-input-label :value="__('Status')" />
                    <div class="flex items-center space-x-4 mt-1">
                        <label for="draft" class="flex items-center">
                            <input @change="status = 'draft'" id="draft" name="status" type="radio"
                                value="draft" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300"
                                {{ old('status', 'draft') == 'draft' ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-slate-600">Draft</span>
                        </label>
                        <label for="published" class="flex items-center">
                            <input @change="status = 'published'" id="published" name="status" type="radio"
                                value="published" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300"
                                {{ old('status') == 'published' ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-slate-600">Published</span>
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>

                <!-- Input Jadwal Tayang (Hanya muncul jika status 'published') -->
                <div x-show="status === 'published'" x-transition class="mt-4">
                    <x-input-label for="published_at" :value="__('Jadwalkan Tayang (Opsional)')" />
                    <x-text-input id="published_at" class="block mt-1 w-full" type="datetime-local" name="published_at"
                        :value="old('published_at')" />
                    <p class="text-xs text-slate-500 mt-1">Kosongkan untuk langsung tayang saat disimpan.</p>
                    <x-input-error :messages="$errors->get('published_at')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-6 border-t border-slate-200 pt-6">
                    <a href="{{ route('dashboard.posts.index') }}"
                        class="text-sm text-slate-600 hover:text-slate-900 rounded-md">Batal</a>
                    <x-primary-button class="ml-4">
                        {{ __('Simpan Berita') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>



    @push('scripts')
        <!-- Muat script TinyMCE dengan API Key Anda -->
        <script src="https://cdn.tiny.cloud/1/ejxh47zrjpaubo8l13cinpj8b48s0lck0lw9ze8uvpyozp1b/tinymce/7/tinymce.min.js"
            referrerpolicy="origin"></script>

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
                                headers: {
                                    'X-CSRF-Token': token
                                },
                                body: formData
                            })
                            .then(response => response.json())
                            .then(result => {
                                cb(result.location, {
                                    title: file.name
                                });
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
