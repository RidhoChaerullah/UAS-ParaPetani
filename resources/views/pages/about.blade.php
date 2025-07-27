<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-foreground leading-tight">
            Tentang Tim Kami
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Bagian Header Halaman --}}
            <div class="bg-card p-8 rounded-lg border border-border shadow-sm text-center mb-8">
                <h1 class="text-4xl font-bold text-foreground">Mengenal Tim di Balik Para Petani</h1>
                <p class="mt-4 text-lg text-muted-foreground max-w-3xl mx-auto">
                    Kami adalah sekelompok individu yang bersemangat dalam menggabungkan teknologi dan pertanian untuk
                    masa depan yang lebih hijau.
                </p>
            </div>

            {{-- Grid untuk Anggota Tim --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($team as $member)
                    <div
                        class="bg-card border border-border rounded-lg text-center p-6 shadow-sm transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <div class="mx-auto h-32 w-32 rounded-full mb-4 overflow-hidden">
                            <img class="object-cover h-full w-full" src="{{ $member['imageUrl'] }}"
                                alt="Foto {{ $member['name'] }}">
                        </div>
                        <h3 class="text-xl font-bold text-foreground">{{ $member['name'] }}</h3>
                        <p class="text-md text-primary font-semibold">{{ $member['role'] }}</p>
                        <div class="mt-4">
                            <a href="{{ $member['linkedinUrl'] }}" target="_blank"
                                class="text-muted-foreground hover:text-primary">
                                <span class="sr-only">LinkedIn</span>
                                {{-- Ikon LinkedIn --}}
                                <svg class="h-6 w-6 mx-auto" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path
                                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="bg-card p-8 rounded-lg border border-border shadow-sm text-center mt-12">
                <h2 class="text-3xl font-bold text-foreground">Dikembangkan oleh Mahasiswa dan Mahasiswi dari kampus ITPLN</h2>
                <p class="mt-4 text-lg text-muted-foreground max-w-3xl mx-auto">
                    Kami adalah Regu Mawar dari matakuliah pemrograman web lanjutan di Institut Teknologi PLN.
                </p>
                <a href="https://itpln.ac.id/" target="_blank"
                    class="inline-block bg-primary text-primary-foreground font-bold py-3 px-6 rounded-md mt-6 hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ring transition-all duration-300 transform hover:scale-105">
                    Kunjungi Kampus Kami
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
