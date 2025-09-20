<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Postingan') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-slate-900">

            {{-- === AWAL FORM FILTER DINAMIS === --}}
            <div class="mb-6 pb-6 border-b border-slate-200">
                <div class="flex justify-end items-center">
                     <a href="{{ route('dashboard.posts.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                          Tambah Postingan Baru
                     </a>
                </div>
           </div>
            {{-- === AKHIR FORM FILTER DINAMIS === --}}

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-slate-500">
                    <thead class="text-xs text-slate-700 uppercase bg-slate-100">
                        <tr>
                            <th scope="col" class="px-6 py-3">Judul</th>
                            <th scope="col" class="px-6 py-3">Kategori</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Penulis</th>
                            <th scope="col" class="px-6 py-3">Tanggal Dibuat</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                        <tr class="bg-white border-b hover:bg-slate-50">
                            <td class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap">{{ Str::limit($post->title, 40) }}</td>
                            <td class="px-6 py-4">{{ $post->category->name }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $post->status == 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $post->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $post->user->name }}</td>
                            <td class="px-6 py-4">{{ $post->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 flex items-center space-x-3">
                                <a href="{{ route('dashboard.posts.edit', $post) }}" class="font-medium text-blue-600 hover:underline">Edit</a>
                                <a href="{{ route('dashboard.posts.exportPdf', $post) }}" class="font-medium text-purple-600 hover:underline">PDF</a>
                                <form action="{{ route('dashboard.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center">
                                <p class="font-semibold">Tidak ada berita yang ditemukan.</p>
                                <p class="text-xs text-slate-500 mt-1">Coba ganti filter Anda atau <a href="{{ route('dashboard.posts.index') }}" class="text-blue-600 hover:underline">reset filter</a>.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             <div class="mt-4">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>