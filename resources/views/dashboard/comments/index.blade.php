<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Komentar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Komentar</th>
                                    <th scope="col" class="px-6 py-3">Penulis</th>
                                    <th scope="col" class="px-6 py-3">Di Postingan</th>
                                    <th scope="col" class="px-6 py-3">Waktu</th>
                                    <th scope="col" class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($comments as $comment)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ Str::limit($comment->content, 50) }}</td>
                                    <td class="px-6 py-4">{{ $comment->user->name ?? 'User Dihapus' }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('posts.show', $comment->post->slug) }}" target="_blank" class="text-blue-600 hover:underline">
                                            {{ Str::limit($comment->post->title, 30) }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">{{ $comment->created_at->diffForHumans() }}</td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('dashboard.comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus komentar ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center">Tidak ada komentar untuk dikelola.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                     <div class="mt-4">
                        {{ $comments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>