{{-- resources/views/home.blade.php (Versi Profesional) --}}
<x-app-layout>
    {{-- Bagian Hero/Jumbotron --}}
    <div class="bg-card border border-border rounded-lg p-6 md:p-8 text-center">
        @auth
            <h2 class="text-3xl font-bold text-foreground">Selamat Datang kembali, {{ Auth::user()->name }}! 🌱</h2>
            <p class="mt-2 text-muted-foreground">Lanjutkan progres Anda dan capai hasil panen terbaik.</p>
            <a href="{{ route('plants.index') }}"
                class="inline-block bg-primary text-primary-foreground font-bold py-3 px-6 rounded-md mt-6 hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ring transition-all duration-300 transform hover:scale-105">
                Tanam Sekarang! 🌾
            </a>
        @else
            <h2 class="text-3xl font-bold text-foreground">Selamat Datang di Sistem Pertanian Modern! 🌱</h2>
            <p class="mt-2 text-muted-foreground max-w-2xl mx-auto">
                Pantau cuaca, baca berita terbaru, dan kelola tanaman Anda dengan lebih baik.
            </p>
            <a href="{{ route('login') }}"
                class="inline-block bg-primary text-primary-foreground font-bold py-3 px-6 rounded-md mt-6 hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ring transition-all duration-300 transform hover:scale-105">
                Mulai Sekarang! 🌾
            </a>
        @endauth
    </div>

    {{-- Bagian Berita Unggulan --}}
    <div class="mt-12">
        <h3 class="text-2xl font-bold text-foreground mb-6">Berita Pertanian Unggulan Hari Ini</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($articles as $article)
                {{-- Memanggil komponen article-card --}}
                <x-article-card :article="$article" />
            @empty
                {{-- Tampilan jika tidak ada berita --}}
                <div class="md:col-span-3 text-center bg-muted text-muted-foreground p-10 rounded-lg">
                    <p>Tidak dapat memuat berita saat ini. Silakan coba lagi nanti.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
