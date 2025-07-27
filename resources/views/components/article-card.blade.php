{{-- resources/views/components/article-card.blade.php --}}
@props(['article'])

<div
    {{ $attributes->merge(['class' => 'bg-card border border-border rounded-lg overflow-hidden flex flex-col group transition-all duration-300 hover:shadow-xl hover:-translate-y-1']) }}>

    {{-- Gambar Artikel --}}
    <a href="{{ $article['url'] }}" target="_blank">
        <img src="{{ $article['urlToImage'] ?? 'https://via.placeholder.com/400x250/e2e8f0/111827?text=Gambar+Tidak+Tersedia' }}"
            alt="Gambar berita tentang {{ $article['title'] }}"
            class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">
    </a>

    {{-- Konten Teks Artikel --}}
    <div class="p-6 flex flex-col flex-grow">
        <h4 class="font-bold text-lg text-foreground leading-tight">
            <a href="{{ $article['url'] }}" target="_blank" class="hover:underline">
                {{ $article['title'] }}
            </a>
        </h4>

        <p class="text-muted-foreground text-sm mt-2 flex-grow">
            {{ \Illuminate\Support\Str::limit($article['description'], 120) }}
        </p>

        <div class="mt-4 pt-4 border-t border-border/60">
            <a href="{{ $article['url'] }}" target="_blank"
                class="text-sm text-primary hover:underline font-semibold inline-flex items-center group">
                Baca Selengkapnya <span
                    class="transition-transform duration-200 group-hover:translate-x-1 ml-1">&rarr;</span>
            </a>
        </div>
    </div>
</div>
