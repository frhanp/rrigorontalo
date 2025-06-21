<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Lupa Password?</h2>
    </div>

    <div class="mb-4 text-sm text-slate-600">
        {{ __('Tidak masalah. Cukup beritahu kami alamat email Anda dan kami akan mengirimkan link untuk mereset password Anda.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full text-center">
                {{ __('Kirim Link Reset Password') }}
            </x-primary-button>
        </div>
        
        <div class="text-center mt-4 text-sm text-slate-600">
            <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:underline">Kembali ke Login</a>
        </div>
    </form>
</x-guest-layout>