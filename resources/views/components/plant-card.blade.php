{{-- resources/views/components/plant-card.blade.php --}}
@props(['plant'])

@php
    $totalDays = $plant->getMaturityDays();
@endphp

<div class="bg-card border border-border rounded-lg shadow-sm p-6 flex flex-col justify-between transition-all duration-300 hover:shadow-lg hover:border-primary/50"
    data-planted-at="{{ $plant->planted_at->toIso8601String() }}" data-total-days="{{ $totalDays }}">

    <div>
        <div class="flex justify-between items-start">
            <div>
                <h3 class="font-bold text-xl text-foreground">{{ $plant->name }}</h3>
                <p class="text-sm text-muted-foreground capitalize">{{ $plant->type }} • Ditanam
                    {{ $plant->planted_at->diffForHumans() }}</p>
            </div>
            <form action="{{ route('plants.destroy', $plant) }}" method="POST"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus tanaman ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-muted-foreground hover:text-destructive transition-colors"
                    title="Hapus Tanaman">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                        class="bi bi-trash3" viewBox="0 0 16 16">
                        <path
                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5zM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11zm-6.568 1h7.136l-.84 10.502A1 1 0 0 1 9.615 15h-3.23a1 1 0 0 1-.996-.998L4.432 3.5z" />
                    </svg>
                </button>
            </form>
        </div>

        <div class="mt-4">
            <div class="flex justify-between text-sm mb-1">
                <span class="text-muted-foreground">Umur Tanaman</span>
                <span class="font-semibold text-foreground"><span class="plant-age">0</span> / {{ $totalDays }}
                    hari</span>
            </div>
            {{-- Progress Bar --}}
            <div class="w-full bg-muted rounded-full h-2.5">
                <div class="bg-primary h-2.5 rounded-full progress-bar" style="width: 0%"></div>
            </div>
        </div>
    </div>
</div>
