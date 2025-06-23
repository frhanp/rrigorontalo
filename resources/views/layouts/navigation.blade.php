<div class="flex flex-col h-full">
    <!-- Logo di atas Sidebar -->
    <div class="shrink-0 flex items-center justify-center p-4 border-b border-slate-200">
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-10 w-auto" />
        </a>
    </div>

    <!-- Menu Navigasi Utama -->
    <nav class="flex-grow p-4 space-y-2">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h7.5" /></svg>
            <span>{{ __('Dashboard') }}</span>
        </x-nav-link>

        <p class="px-4 pt-4 pb-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">Konten</p>
        
        <x-nav-link :href="route('dashboard.posts.index')" :active="request()->routeIs('dashboard.posts.*')">
             <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v2.25H6V7.5z" /></svg>
            <span>{{ __('Postingan') }}</span>
        </x-nav-link>
        
        <x-nav-link :href="route('dashboard.comments.index')" :active="request()->routeIs('dashboard.comments.*')">
            <img src="{{ asset('images/comment.png') }}" alt="Ikon Kelola Berita" class="w-5 h-5 mr-3">
            <span>{{ __('Komentar') }}</span>
        </x-nav-link>

        <p class="px-4 pt-4 pb-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">Manajemen</p>

        <x-nav-link :href="route('dashboard.media.index')" :active="request()->routeIs('dashboard.media.*')">
            <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
            <span>{{ __('Media') }}</span>
        </x-nav-link>
        
        <x-nav-link :href="route('dashboard.pdf.index')" :active="request()->routeIs('dashboard.pdf.*')">
             <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
            <span>{{ __('Export PDF') }}</span>
        </x-nav-link>

        <!-- Menu Khusus Admin -->
        @if (Auth::user()->role === 'admin')
            <p class="px-4 pt-4 pb-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">Admin</p>
            <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')">
                <img src="{{ asset('images/kategori.png') }}" alt="Ikon Kelola Berita" class="w-4 h-4 mr-3">
                <span>{{ __('Kategori') }}</span>
            </x-nav-link>
            <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                <img src="{{ asset('images/users.png') }}" alt="Ikon Kelola Berita" class="w-5 h-5 mr-3">
                <span>{{ __('Hak Akses') }}</span>
            </x-nav-link>
        @endif
    </nav>

    <!-- Menu User di bawah Sidebar -->
    <div class="mt-auto p-4 border-t border-slate-200">
        <x-dropdown align="top" width="48">
            <x-slot name="trigger">
                <button class="w-full flex items-center justify-between px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-slate-500 bg-white hover:text-slate-700 hover:bg-slate-50 focus:outline-none transition ease-in-out duration-150">
                    <div>{{ Auth::user()->name }}</div>
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</div>