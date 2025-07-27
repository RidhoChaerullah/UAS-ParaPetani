<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-foreground leading-tight">
            Tanaman Saya
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Form Tambah Tanaman --}}
            <div class="bg-card p-6 rounded-lg border border-border shadow-sm">
                <h3 class="text-lg font-medium text-foreground mb-4">Tambah Tanaman Baru</h3>
                <form action="{{ route('plants.store') }}" method="POST"
                    class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                    @csrf
                    <div class="space-y-1">
                        <x-input-label for="name" :value="__('Nama/Label Tanaman')" />
                        <x-text-input type="text" name="name" id="name" class="w-full"
                            placeholder="Contoh: Padi Sawah Belakang" required />
                    </div>
                    <div class="space-y-1">
                        <x-input-label for="type" :value="__('Tipe Tanaman')" />
                        <select name="type" id="type"
                            class="w-full border-input bg-transparent ring-offset-background focus-visible:ring-2 focus-visible:ring-ring rounded-md transition-colors">
                            <option value="padi">Padi (Estimasi 90 Hari)</option>
                            <option value="jagung">Jagung (Estimasi 85 Hari)</option>
                        </select>
                    </div>
                    <div>
                        <x-primary-button class="w-full md:w-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-plus-lg mr-2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                            </svg>
                            Tambah
                        </x-primary-button>
                    </div>
                </form>
            </div>

            {{-- KOMPONEN CUACA INTERAKTIF BARU --}}
            @if ($weather)
                <details class="bg-card border border-border rounded-lg shadow-sm group" open>
                    {{-- Bagian Ringkasan yang Selalu Terlihat --}}
                    <summary class="p-4 flex items-center justify-between cursor-pointer list-none">
                        <div class="flex items-center gap-4">
                            @if ($weather['summary']['dominant_weather'])
                                <x-weather-icon :code="$weather['summary']['dominant_weather']['icon']" size="48" />
                            @endif
                            <div>
                                <h4 class="font-bold text-lg text-foreground">Cuaca 24 Jam di
                                    {{ $weather['city_name'] }}</h4>
                                {{-- ✅ PENAMBAHAN JAM REAL-TIME --}}
                                <div class="flex items-center gap-2 text-muted-foreground text-sm">
                                    <span>Suhu: {{ $weather['summary']['min_temp'] }}°C -
                                        {{ $weather['summary']['max_temp'] }}°C</span>
                                    <span class="font-bold">·</span>
                                    <span id="current-time-display" class="font-semibold text-foreground"></span>
                                </div>
                                <span class="text-primary font-medium">Klik untuk detail.</span>
                            </div>
                        </div>
                        <div class="transition-transform duration-300 group-open:rotate-180">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-chevron-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </div>
                    </summary>

                    {{-- Bagian Detail yang Bisa Dibuka-Tutup --}}
                    <div class="border-t border-border p-4">
                        <div class="mb-4 bg-accent/50 text-accent-foreground p-3 rounded-md">
                            <p class="font-bold">💡 Saran Umum:</p>
                            @if ($weather['summary']['will_rain'])
                                <p>Potensi hujan hari ini, pertama sekitar pukul
                                    {{ \Carbon\Carbon::parse($weather['summary']['rain_time'])->format('H:i') }}.
                                    Sebaiknya tunda penyiraman.</p>
                            @elseif ($weather['summary']['max_temp'] > 32)
                                <p>Suhu akan cukup terik. Pastikan tanaman tidak kekeringan, pertimbangkan penyiraman
                                    ekstra sore nanti.</p>
                            @else
                                <p>Cuaca tampak ideal untuk pertumbuhan. Pantau terus kelembapan tanah.</p>
                            @endif
                        </div>
                        <h5 class="font-bold text-foreground mb-2">Prakiraan Per 3 Jam (Arahkan kursor untuk saran):
                        </h5>
                        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-8 gap-2 text-center">
                            @foreach ($weather['list'] as $forecast)
                                {{-- ✅ BLOK INTERAKTIF PER JAM DENGAN TOOLTIP & BG IKON --}}
                                <div class="relative bg-muted/50 p-2 rounded-md forecast-block">
                                    <p class="font-bold text-sm text-foreground">
                                        {{ \Carbon\Carbon::parse($forecast['dt_txt'])->format('H:i') }}</p>
                                    <div
                                        class="mx-auto my-1 w-12 h-12 flex items-center justify-center bg-background/50 rounded-full">
                                        <x-weather-icon :code="$forecast['weather'][0]['icon']" size="48" />
                                    </div>
                                    <p class="text-sm text-muted-foreground">{{ round($forecast['main']['temp']) }}°C
                                    </p>

                                    {{-- Tooltip yang muncul saat hover --}}
                                    <div
                                        class="forecast-tooltip absolute bottom-full mb-2 w-48 left-1/2 -translate-x-1/2 p-2 bg-foreground text-background text-xs rounded-md shadow-lg opacity-0 invisible transition-opacity duration-300 pointer-events-none z-10">
                                        @if (str_starts_with($forecast['weather'][0]['id'], '5'))
                                            Saatnya bikin teh hangat! 🍵
                                        @elseif ($forecast['weather'][0]['icon'] === '01n')
                                            Langitnya bersih, coba lihat bintang! ✨
                                        @elseif ($forecast['weather'][0]['icon'] === '01d')
                                            Cuaca sempurna untuk berjemur sebentar! ☀️
                                        @elseif (round($forecast['main']['temp']) > 32)
                                            Panas banget! Jangan lupa minum ya. 💧
                                        @elseif (str_starts_with($forecast['weather'][0]['id'], '2'))
                                            Ada petir! Sebaiknya tetap di dalam. ⚡
                                        @else
                                            Mendung belum tentu hujan~ ☁️
                                        @endif
                                        <div
                                            class="absolute top-full left-1/2 -translate-x-1/2 w-0 h-0 border-x-4 border-x-transparent border-t-4 border-t-foreground">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </details>
            @endif

            {{-- Grid Tanaman --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($plants as $plant)
                    <x-plant-card :plant="$plant" />
                @empty
                    <div class="md:col-span-3 text-center bg-muted/50 rounded-lg py-16">
                        <p class="text-muted-foreground">Anda belum memiliki tanaman. Silakan tambahkan!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @push('scripts')
        {{-- ✅ SEMUA SCRIPT DIGABUNGKAN DI SINI --}}
        <script>
            // Script untuk menghitung umur tanaman dan progress bar
            document.addEventListener('DOMContentLoaded', function() {
                const plantCards = document.querySelectorAll('[data-planted-at]');

                plantCards.forEach(card => {
                    const plantedAt = new Date(card.dataset.plantedAt);
                    const totalDays = parseInt(card.dataset.totalDays, 10);
                    const now = new Date();

                    const diffTime = Math.abs(now - plantedAt);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                    const ageEl = card.querySelector('.plant-age');
                    if (ageEl) {
                        ageEl.textContent = diffDays;
                    }

                    const progressBar = card.querySelector('.progress-bar');
                    if (progressBar) {
                        let progressPercentage = (diffDays / totalDays) * 100;
                        if (progressPercentage > 100) {
                            progressPercentage = 100;
                        }
                        progressBar.style.width = progressPercentage + '%';
                    }
                });

                // Script untuk jam real-time
                const timeDisplay = document.getElementById('current-time-display');

                function updateTime() {
                    if (timeDisplay) {
                        const now = new Date();
                        const timeString = now.toLocaleTimeString('id-ID', {
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit',
                            hour12: false
                        });
                        timeDisplay.textContent = `Jam: ${timeString}`;
                    }
                }

                updateTime();
                setInterval(updateTime, 1000);

                // ✅ TAMBAHKAN BLOK BARU INI DI BAWAHNYA
                // --- Script untuk Tooltip Interaktif ---
                const forecastBlocks = document.querySelectorAll('.forecast-block');
                forecastBlocks.forEach(block => {
                    const tooltip = block.querySelector('.forecast-tooltip');

                    block.addEventListener('mouseenter', () => {
                        if (tooltip) {
                            tooltip.classList.remove('invisible', 'opacity-0');
                            tooltip.classList.add('opacity-100');
                        }
                    });

                    block.addEventListener('mouseleave', () => {
                        if (tooltip) {
                            tooltip.classList.remove('opacity-100');
                            tooltip.classList.add('invisible', 'opacity-0');
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
