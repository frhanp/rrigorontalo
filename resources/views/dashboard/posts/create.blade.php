<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Buat Berita Baru') }}
        </h2>
    </x-slot>

    {{-- Layout disederhanakan agar pas dengan layout sidebar --}}
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-slate-900">
            <form method="POST" action="{{ route('dashboard.posts.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Judul -->
                <div>
                    <x-input-label for="title" :value="__('Judul Berita')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <!-- Kategori -->
                <div class="mt-4">
                    <x-input-label for="category_id" :value="__('Kategori')" />
                    <select name="category_id" id="category_id" class="block mt-1 w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" required>
                        <option value="" disabled selected>-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                </div>

                <!-- Konten dengan Rich Text Editor -->
                <div class="mt-4">
                    <x-input-label for="content" :value="__('Konten Berita')" />
                    <textarea name="content" id="content" rows="20">{{ old('content') }}</textarea>
                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                </div>

                <!-- Media -->
                <div class="mt-4">
                    <x-input-label for="media" :value="__('Media (Gambar/Video/Audio)')" />
                    <input id="media" name="media" type="file" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                    <x-input-error :messages="$errors->get('media')" class="mt-2" />
                </div>

                <!-- Status -->
                 <div class="mt-4">
                    <x-input-label :value="__('Status')" />
                    <div class="flex items-center space-x-4 mt-1">
                        <label for="draft" class="flex items-center">
                            <input id="draft" name="status" type="radio" value="draft" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300" {{ old('status', 'draft') == 'draft' ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-slate-600">Draft</span>
                        </label>
                        <label for="published" class="flex items-center">
                            <input id="published" name="status" type="radio" value="published" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300" {{ old('status') == 'published' ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-slate-600">Published</span>
                        </label>
                    </div>
                     <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-6 border-t border-slate-200 pt-6">
                     <a href="{{ route('dashboard.posts.index') }}" class="text-sm text-slate-600 hover:text-slate-900 rounded-md">Batal</a>
                    <x-primary-button class="ml-4">
                        {{ __('Simpan Berita') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <!-- Muat script TinyMCE dengan API Key Anda -->
    <script src="https://cdn.tiny.cloud/1/ejxh47zrjpaubo8l13cinpj8b48s0lck0lw9ze8uvpyozp1b/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Inisialisasi editor untuk textarea Anda -->
    <script>
        tinymce.init({
            selector: 'textarea#content',
            plugins: 'code table lists image link fullscreen visualblocks wordcount media',
            toolbar: 'undo redo | blocks | bold italic underline | link image media | bullist numlist | code | fullscreen',
            height: 500,
            
            // === PERUBAHAN DI SINI: Memaksa tema terang ===
            skin: 'oxide',
            content_css: 'default'
        });
    </script>
@endpush
</x-app-layout>