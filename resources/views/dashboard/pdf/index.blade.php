<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Export dan Unduh PDF Postingan') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-slate-900">
            
            <div class="mb-6 pb-6 border-b border-slate-200">
                <h3 class="text-lg font-medium text-slate-800">Filter Berita</h3>
                <p class="text-sm text-slate-500 mt-1">Hasil akan diperbarui secara otomatis saat Anda mengubah filter.</p>
                
                <form id="filter-form" method="GET" action="{{ route('dashboard.pdf.index') }}">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-4 items-center">
                        
                        {{-- Filter Bulan --}}
                        <div>
                            <x-input-label for="month" :value="__('Bulan')" />
                            <select name="month" id="month" onchange="this.form.submit()" class="block mt-1 w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                                <option value="">Semua Bulan</option>
                                @for ($i = 0; $i < 24; $i++)
                                    @php
                                        $date = now()->subMonths($i);
                                        $value = $date->format('Y-m');
                                        $label = $date->format('F Y');
                                    @endphp
                                    <option value="{{ $value }}" {{ $selectedMonth == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        {{-- Filter Kategori --}}
                        <div>
                            <x-input-label for="category_id" :value="__('Kategori')" />
                            <select name="category_id" id="category_id" onchange="this.form.submit()" class="block mt-1 w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                                <option value="">Semua Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $selectedCategoryId == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="author_id" :value="__('Penulis')" />
                            <select name="author_id" id="author_id" onchange="this.form.submit()" class="block mt-1 w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                                <option value="">Semua Penulis</option>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}" {{ $selectedAuthorId == $author->id ? 'selected' : '' }}>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tombol Rekap & Reset --}}
                        <div class="flex items-center space-x-2 pt-5">
                            <a href="{{ route('dashboard.pdf.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 rounded-md font-semibold text-xs text-slate-700 uppercase tracking-widest shadow-sm hover:bg-slate-50">
                                Reset
                            </a>
                            <a href="{{ route('dashboard.pdf.recap', request()->query()) }}" target="_blank" class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-green-700">
                                Rekap ke PDF
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-500">
                    <thead class="text-xs text-slate-700 uppercase bg-slate-100">
                        <tr>
                            <th scope="col" class="px-6 py-3">Judul Berita</th>
                            <th scope="col" class="px-6 py-3">Kategori</th>
                            <th scope="col" class="px-6 py-3">Penulis</th>
                            <th scope="col" class="px-6 py-3">Tanggal</th>
                            <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                        <tr class="bg-white border-b hover:bg-slate-50">
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $post->title }}</td>
                            <td class="px-6 py-4">{{ $post->category->name }}</td>
                            <td class="px-6 py-4">{{ $post->user->name }}</td>
                            <td class="px-6 py-4">{{ $post->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('dashboard.posts.exportPdf', $post) }}" target="_blank" class="inline-block bg-blue-600 text-white text-xs font-semibold px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors shadow-sm hover:shadow-md">
                                    Unduh PDF
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center">
                                <p class="font-semibold">Tidak ada berita yang ditemukan.</p>
                                <p class="text-xs text-slate-500 mt-1">Coba ganti filter Anda atau <a href="{{ route('dashboard.pdf.index') }}" class="text-blue-600 hover:underline">reset filter</a>.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>