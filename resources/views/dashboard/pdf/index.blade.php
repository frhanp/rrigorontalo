<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Export dan Unduh PDF Postingan') }}
        </h2>
    </x-slot>

    {{-- Struktur container disederhanakan, tidak ada lagi py-12, max-w-7xl, dll. --}}
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-slate-900">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-500">
                    <thead class="text-xs text-slate-700 uppercase bg-slate-100">
                        <tr>
                            <th scope="col" class="px-6 py-3">Judul Berita</th>
                            <th scope="col" class="px-6 py-3">Kategori</th>
                            <th scope="col" class="px-6 py-3">Penulis</th>
                            <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                        <tr class="bg-white border-b hover:bg-slate-50">
                            <td class="px-6 py-4 font-medium text-slate-900">
                                {{ $post->title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $post->category->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $post->user->name }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{-- Tombol di-styling ulang agar lebih konsisten dan tidak tumpang tindih --}}
                                <a href="{{ route('dashboard.posts.exportPdf', $post) }}" class="inline-block bg-blue-600 text-white text-xs font-semibold px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors shadow-sm hover:shadow-md">
                                    Unduh PDF
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center">Tidak ada berita yang ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination diletakkan di luar div tabel agar rapi --}}
            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>