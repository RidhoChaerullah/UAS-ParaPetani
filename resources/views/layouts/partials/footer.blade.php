{{-- resources/views/layouts/partials/footer.blade.php --}}
<footer class="bg-card border-t border-border mt-auto">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between">
            {{-- Bagian Kiri: Logo & Copyright --}}
            <div class="flex justify-center md:order-1">
                <div class="text-center md:text-left">
                    <a href="{{ route('home') }}" class="inline-block">
                        <img src="{{ asset('img/ZeroHunger.png') }}" alt="Zero Hunger Logo"
                            class="h-10 w-auto mx-auto md:mx-0">
                    </a>
                    <p class="mt-2 text-center text-sm text-muted-foreground">
                        © {{ date('Y') }} PT Regu Mawar. <br class="sm:hidden"> All rights reserved.
                    </p>
                </div>
            </div>


        </div>
    </div>
</footer>
