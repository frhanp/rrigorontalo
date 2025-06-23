<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="space-y-8">
        {{-- Pesan Selamat Datang --}}
        <div class="p-4 sm:p-6 bg-white shadow-sm sm:rounded-lg">
            <h3 class="text-lg font-medium text-slate-900">
                Selamat datang kembali, {{ Auth::user()->name }}!
            </h3>
            <p class="mt-1 text-sm text-slate-600">
                Berikut adalah ringkasan aktivitas di Portal Berita RRI Gorontalo.
            </p>
        </div>

        {{-- Kartu Statistik Interaktif --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
            <!-- Total Berita -->
            <a href="{{ route('dashboard.posts.index') }}" class="group block">
                <div
                    class="bg-white p-6 rounded-lg shadow-sm flex items-start justify-between border border-transparent transition-all duration-300 ease-in-out hover:shadow-xl hover:-translate-y-1 hover:border-blue-300">
                    <div>
                        <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Total Berita</p>
                        <p class="text-3xl font-bold text-slate-900 mt-1">{{ $totalPosts }}</p>
                    </div>
                    <div
                        class="bg-blue-100 text-blue-600 p-3 rounded-full transition-colors duration-300 group-hover:bg-blue-600 group-hover:text-white">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v2.25H6V7.5z" />
                        </svg>
                    </div>
                </div>
            </a>
            <!-- Berita Terbit -->
            <a href="{{ route('dashboard.posts.index') }}" class="group block">
                <div
                    class="bg-white p-6 rounded-lg shadow-sm flex items-start justify-between border border-transparent transition-all duration-300 ease-in-out hover:shadow-xl hover:-translate-y-1 hover:border-green-300">
                    <div>
                        <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Berita Terbit</p>
                        <p class="text-3xl font-bold text-green-600 mt-1">{{ $publishedPosts }}</p>
                    </div>
                    <div
                        class="bg-green-100 text-green-600 p-3 rounded-full transition-colors duration-300 group-hover:bg-green-600 group-hover:text-white">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </a>
            <!-- Berita Draft -->
            <a href="{{ route('dashboard.posts.index') }}" class="group block">
                <div
                    class="bg-white p-6 rounded-lg shadow-sm flex items-start justify-between border border-transparent transition-all duration-300 ease-in-out hover:shadow-xl hover:-translate-y-1 hover:border-amber-300">
                    <div>
                        <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Draft Berita</p>
                        <p class="text-3xl font-bold text-amber-600 mt-1">{{ $draftPosts }}</p>
                    </div>
                    <div
                        class="bg-amber-100 text-amber-600 p-3 rounded-full transition-colors duration-300 group-hover:bg-amber-600 group-hover:text-white">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                        </svg>
                    </div>
                </div>
            </a>
            <!-- Total Komentar -->
            <a href="{{ route('dashboard.comments.index') }}" class="group block">
                <div class="bg-white p-6 rounded-lg shadow-sm flex items-start justify-between border border-transparent transition-all duration-300 ease-in-out hover:shadow-xl hover:-translate-y-1 hover:border-sky-300">
                    <div>
                        <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Total Komentar</p>
                        <p class="text-3xl font-bold text-slate-900 mt-1">{{ $totalComments }}</p>
                    </div>
                    <div class="bg-sky-100 text-sky-600 p-3 rounded-full transition-colors duration-300 group-hover:bg-sky-600 group-hover:text-white">
                        
                        {{-- SVG dikembalikan menjadi inline agar efek hover berfungsi --}}
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                        </svg>
            
                    </div>
                </div>
            </a>
            <!-- Total Pengguna (Hanya Admin) -->
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('admin.users.index') }}" class="group block">
                    <div
                        class="bg-white p-6 rounded-lg shadow-sm flex items-start justify-between border border-transparent transition-all duration-300 ease-in-out hover:shadow-xl hover:-translate-y-1 hover:border-indigo-300">
                        <div>
                            <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Total Pengguna</p>
                            <p class="text-3xl font-bold text-slate-900 mt-1">{{ $totalUsers }}</p>
                        </div>
                        <div
                            class="bg-indigo-100 text-indigo-600 p-3 rounded-full transition-colors duration-300 group-hover:bg-indigo-600 group-hover:text-white">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-4.67c.12-.241.253-.477.398-.702a8.998 8.998 0 01-1.152 4.243zM11.625 10.5a3.375 3.375 0 100-6.75 3.375 3.375 0 000 6.75z" />
                            </svg>
                        </div>
                    </div>
                </a>
            @endif
        </div>

        {{-- Aktivitas Terbaru --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
            <!-- Berita Terbaru -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-medium text-slate-900 mb-4">Berita Terbaru</h3>
                <div class="space-y-1">
                    @forelse ($latestPosts as $post)
                        <div
                            class="flex items-center space-x-4 p-2 -m-2 rounded-lg transition-colors duration-200 hover:bg-slate-50">
                            <div class="flex-shrink-0">
                                <span
                                    class="text-xs px-2 py-1 rounded-full font-semibold {{ $post->status == 'published' ? 'bg-green-100 text-green-800' : 'bg-amber-100 text-amber-800' }}">{{ $post->status }}</span>
                            </div>
                            <div class="flex-grow">
                                <a href="{{ route('dashboard.posts.edit', $post) }}"
                                    class="font-medium text-slate-800 hover:text-blue-600 hover:underline">{{ Str::limit($post->title, 40) }}</a>
                                <p class="text-sm text-slate-500">oleh {{ $post->user->name }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500">Belum ada berita yang dibuat.</p>
                    @endforelse
                </div>
            </div>

            <!-- Komentar Terbaru -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-medium text-slate-900 mb-4">Komentar Terbaru</h3>
                <div class="space-y-1">
                    @forelse ($latestComments as $comment)
                        <div
                            class="flex items-start space-x-4 p-2 -m-2 rounded-lg transition-colors duration-200 hover:bg-slate-50">
                            <div
                                class="flex-shrink-0 w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center font-bold text-slate-600 text-sm">
                                {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-slate-800">
                                    <span class="font-semibold">{{ $comment->user->name }}</span> mengomentari
                                    <a href="{{ route('posts.show', $comment->post->slug) }}#comments" target="_blank"
                                        class="font-semibold text-blue-600 hover:underline">"{{ Str::limit($comment->post->title, 20) }}"</a>
                                </p>
                                <p class="text-xs text-slate-500 italic mt-1">
                                    "{{ Str::limit($comment->content, 50) }}"</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500">Belum ada komentar.</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
