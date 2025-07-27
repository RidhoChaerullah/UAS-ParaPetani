{{-- resources/views/news/index.blade.php (Versi Profesional) --}}
<x-app-layout>
    {{-- Header Halaman --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-foreground leading-tight">
            {{ __('Berita Pertanian') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Bagian Judul dan Pencarian --}}
            <div class="text-center px-4">
                <h1 class="text-4xl font-bold text-foreground">Berita Terkini Seputar Pertanian</h1>
                <p class="mt-2 text-lg text-muted-foreground">Temukan informasi dan wawasan terbaru dari dunia
                    agrikultur.</p>
            </div>

            {{-- Form Pencarian yang sudah di-style --}}
            <div class="px-4 sm:px-0">
                <form action="{{ route('news.index') }}" method="GET"
                    class="flex flex-col sm:flex-row gap-3 max-w-2xl mx-auto">
                    <input type="text" name="search"
                        placeholder="Cari berita... (contoh: hidroponik, pupuk organik)" value="{{ $query ?? '' }}"
                        class="w-full px-4 py-2 border bg-transparent border-input rounded-md ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 transition-colors">
                    <button type="submit"
                        class="inline-flex items-center justify-center bg-primary text-primary-foreground font-semibold px-6 py-2 rounded-md hover:bg-primary/90 transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-search me-2" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.414 1.414l3.85 3.85a1 1 0 0 0 1.414-1.414l-3.85-3.85zM2 6.5a4.5 4.5 0 1 1 9 0a4.5 4.5 0 0 1-9 0z" />
                        </svg>
                        Cari
                    </button>
                </form>
            </div>

            {{-- Menampilkan Notifikasi Error --}}
            @if (isset($error))
                <div class="px-4 sm:px-0">
                    <div class="bg-destructive/10 border-l-4 border-destructive text-destructive-foreground p-4"
                        role="alert">
                        <p class="font-bold">Terjadi Masalah</p>
                        <p>{{ $error }}</p>
                    </div>
                </div>
            @endif

            {{-- Grid Berita (menggunakan komponen x-article-card) --}}
            @if (!empty($articles))
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($articles as $article)
                        {{-- Menggunakan kembali komponen yang sudah ada untuk konsistensi --}}
                        <x-article-card :article="$article" />
                    @endforeach
                </div>
            @elseif(!isset($error))
                {{-- Pesan Jika Tidak Ada Berita yang Ditemukan --}}
                <div class="text-center bg-muted/50 rounded-lg py-16">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor"
                        class="bi bi-journal-x mx-auto text-muted-foreground mb-4" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M6.146 6.146a.5.5 0 0 1 .708 0L8 7.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 8l1.147 1.146a.5.5 0 0 1-.708.708L8 8.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 8 6.146 6.854a.5.5 0 0 1 0-.708z" />
                        <path
                            d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                        <path
                            d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                    </svg>
                    <p class="text-muted-foreground">Tidak ada berita yang ditemukan untuk kata kunci <strong
                            class="text-foreground">"{{ $query }}"</strong>.</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
