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
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- === KARTU STATISTIK BARU: TOTAL BERITA === --}}
            <!-- Berita Hari Ini (Diperbaiki dengan link dan hover) -->
            <a href="{{ route('dashboard.posts.index', ['start_date' => now()->toDateString(), 'end_date' => now()->toDateString()]) }}"
                class="group block">
                <div
                    class="bg-white p-6 rounded-lg shadow-sm flex items-start justify-between border border-transparent transition-all duration-300 ease-in-out hover:shadow-xl hover:-translate-y-1 hover:border-blue-300">
                    <div>
                        <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Berita Hari Ini</p>
                        <p class="text-3xl font-bold text-slate-900 mt-1">{{ $todayPostsCount }}</p>
                        @if ($dailyChange > 0)
                            <p class="text-xs font-medium text-green-500 mt-1">+{{ $dailyChange }} dari kemarin</p>
                        @elseif ($dailyChange < 0)
                            <p class="text-xs font-medium text-red-500 mt-1">{{ $dailyChange }} dari kemarin</p>
                        @else
                            <p class="text-xs font-medium text-slate-500 mt-1">Sama seperti kemarin</p>
                        @endif
                    </div>
                    <div
                        class="bg-blue-100 text-blue-600 p-3 rounded-full transition-colors duration-300 group-hover:bg-blue-600 group-hover:text-white">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0h18M12 12.75h.008v.008H12v-.008z" />
                          </svg>
                    </div>
                </div>
            </a>
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
                <div
                    class="bg-white p-6 rounded-lg shadow-sm flex items-start justify-between border border-transparent transition-all duration-300 ease-in-out hover:shadow-xl hover:-translate-y-1 hover:border-sky-300">
                    <div>
                        <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Total Komentar</p>
                        <p class="text-3xl font-bold text-slate-900 mt-1">{{ $totalComments }}</p>
                    </div>
                    <div
                        class="bg-sky-100 text-sky-600 p-3 rounded-full transition-colors duration-300 group-hover:bg-sky-600 group-hover:text-white">

                        {{-- SVG dikembalikan menjadi inline agar efek hover berfungsi --}}
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                        </svg>

                    </div>
                </div>
            </a>
                    <div
                       
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
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
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
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
                                    <a href="{{ route('posts.show', $comment->post->slug) }}#comments"
                                        target="_blank"
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

        <div class="container mt-5">
 <h2 class="mb-4 text-base font-semibold text-slate-800">Filter Bulan & Tahun Untuk Melihat Rekapan Berita </h2>

<form method="GET" action="" class="flex flex-wrap items-end gap-2 md:gap-3 mb-6">
    <div>
        <label for="month" class="block mb-1 text-xs font-medium text-slate-700">Bulan</label>
        <select name="month" id="month" class="block w-28 border border-gray-300 rounded-md shadow-sm text-sm py-1 px-2 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            @foreach (range(1, 12) as $m)
                <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="year" class="block mb-1 text-xs font-medium text-slate-700">Tahun</label>
        <select name="year" id="year" class="block w-24 border border-gray-300 rounded-md shadow-sm text-sm py-1 px-2 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            @foreach (range(date('Y') - 3, date('Y')) as $y)
                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                    {{ $y }}
                </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="px-3 py-1 bg-blue-600 text-white text-sm rounded-md shadow hover:bg-blue-700 transition">
        Filter
    </button>
</form>

{{-- ========================== --}}
{{-- Warta Pagi --}}
<h2 class="mb-4 text-base font-semibold text-slate-800">Rekap Jumlah Berita Warta Pagi per Reporter</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @php
        $reporters_pagi = [
            'Diandra' => $report_pagi->jumlah_diandra,
            'Budi Akantu' => $report_pagi->jumlah_budi_akantu,
            'Fery Apantu' => $report_pagi->jumlah_fery_apantu,
            'Hendra Rauf' => $report_pagi->jumlah_hendra_rauf,
            'Andi Sanga' => $report_pagi->jumlah_andi_sanga,
            'Bobi Irawan' => $report_pagi->jumlah_bobi_irawan,
            'Taufik Usman' => $report_pagi->jumlah_taufik_usman,
            'Rusdi Aneta' => $report_pagi->jumlah_rusdi_aneta,
        ];
    @endphp

    @foreach ($reporters_pagi as $name => $jumlah)
        <div class="bg-white p-4 rounded-xl shadow hover:shadow-md transition">
            <h3 class="text-xs font-medium text-slate-600">{{ $name }}</h3>
            <p class="text-xl font-bold text-slate-900 mt-1">{{ $jumlah }}</p>
        </div>
    @endforeach
</div>

{{-- ========================== --}}
{{-- Warta Siang --}}
<h2 class="mt-8 mb-4 text-base font-semibold text-slate-800">Rekap Jumlah Berita Warta Siang per Reporter</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @php
        $reporters_siang = [
            'Diandra' => $report_siang->jumlah_diandra,
            'Budi Akantu' => $report_siang->jumlah_budi_akantu,
            'Fery Apantu' => $report_siang->jumlah_fery_apantu,
            'Hendra Rauf' => $report_siang->jumlah_hendra_rauf,
            'Andi Sanga' => $report_siang->jumlah_andi_sanga,
            'Bobi Irawan' => $report_siang->jumlah_bobi_irawan,
            'Taufik Usman' => $report_siang->jumlah_taufik_usman,
            'Rusdi Aneta' => $report_siang->jumlah_rusdi_aneta,
        ];
    @endphp

    @foreach ($reporters_siang as $name => $jumlah)
        <div class="bg-white p-4 rounded-xl shadow hover:shadow-md transition">
            <h3 class="text-xs font-medium text-slate-600">{{ $name }}</h3>
            <p class="text-xl font-bold text-slate-900 mt-1">{{ $jumlah }}</p>
        </div>
    @endforeach
</div>
 
<!-- Card total berita -->

</div>

</div>

    </div>
</x-app-layout>
