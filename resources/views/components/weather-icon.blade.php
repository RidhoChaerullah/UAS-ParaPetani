{{-- resources/views/components/weather-icon.blade.php --}}
@props(['code', 'size' => 24])

@php
    $url = "https://openweathermap.org/img/wn/{$code}@2x.png";
@endphp

<img src="{{ $url }}" alt="weather icon" width="{{ $size }}" height="{{ $size }}">