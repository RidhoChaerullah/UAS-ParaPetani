{{-- resources/views/auth/login.blade.php (Versi Final) --}}
<x-guest-layout>
    {{-- Menambahkan judul spesifik untuk halaman login --}}
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-foreground">
            Login ke Para Petani
        </h2>
        <p class="text-muted-foreground">Selamat datang kembali!</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-input text-primary shadow-sm focus:ring-ring" name="remember">
                <span class="ms-2 text-sm text-muted-foreground">{{ __('Ingat saya') }}</span>
            </label>

        </div>

        <div class="flex flex-col items-center mt-6">
            <x-primary-button class="w-full">
                {{ __('Log in') }}
            </x-primary-button>

            <a class="underline text-sm text-muted-foreground hover:text-foreground mt-4" href="{{ route('register') }}">
                {{ __('Belum punya akun? Daftar') }}
            </a>
        </div>
    </form>
    
    {{-- Divider dan Tombol Kembali --}}
    <div class="relative flex py-5 items-center">
        <div class="flex-grow border-t border-border"></div>
        <span class="flex-shrink mx-4 text-muted-foreground text-xs">ATAU</span>
        <div class="flex-grow border-t border-border"></div>
    </div>
    
    <a href="{{ route('home') }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-background border border-input rounded-md font-semibold text-xs text-foreground uppercase tracking-widest shadow-sm hover:bg-accent hover:text-accent-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:opacity-50 transition-colors">
        Kembali ke Halaman Utama
    </a>

</x-guest-layout>