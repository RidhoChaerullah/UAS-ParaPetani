{{-- resources/views/components/primary-button.blade.php --}}
<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center justify-center px-4 py-2 bg-primary border border-transparent
                rounded-md font-semibold text-xs text-primary-foreground uppercase tracking-widest
                hover:bg-primary/90 focus:bg-primary/90 active:bg-primary/90
                focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2
                transition ease-in-out duration-150'
    ]) }}>
    {{ $slot }}
</button>