<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-neutral-focus dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{ __("You're logged in!") }}
</x-app-layout>