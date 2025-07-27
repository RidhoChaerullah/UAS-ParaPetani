{{-- resources/views/profile/partials/update-profile-information-form.blade.php --}}
<section>
    <header>
        <h2 class="text-lg font-medium text-foreground">
            {{ __('Informasi Profil') }}
        </h2>
        <p class="mt-1 text-sm text-muted-foreground">
            {{ __('Perbarui informasi profil dan alamat email akun Anda.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Nama --}}
        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
            {{-- ... (verifikasi email) ... --}}
        </div>

        {{-- BLOK LOKASI --}}
        <div class="mt-4">
            <x-input-label for="location" :value="__('Lokasi Anda (Wajib Diisi)')" />
            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location', $user->location)"
                required {{-- ✅ TAMBAHKAN 'required' DI SINI --}} autocomplete="street-address"
                placeholder="Contoh: Depok, Jakarta, Bandung" />
            <x-input-error class="mt-2" :messages="$errors->get('location')" />
            <p class="mt-1 text-sm text-muted-foreground">
                Digunakan untuk menampilkan data cuaca yang akurat.
            </p>
        </div>
        {{-- AKHIR BLOK BARU --}}

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-muted-foreground">{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>
