@props(['active'])

@php
    // Kelas untuk link yang tidak aktif
    $inactiveClasses =
        'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-neutral-content hover:text-neutral-focus  focus:outline-none focus:text-neutral-focus focus:border-gray-300 transition duration-150 ease-in-out';

    // Kelas untuk link yang aktif
    $activeClasses =
        'inline-flex items-center px-1 pt-1 border-b-2 border-primary text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $active ? $activeClasses : $inactiveClasses]) }}>
    {{ $slot }}
</a>
