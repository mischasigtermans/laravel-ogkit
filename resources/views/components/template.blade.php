@props([
    'name' => null,
    'font' => null,
    'backgroundType' => null,
    'accentColor' => null,
    'backgroundPrimary' => null,
    'backgroundSecondary' => null,
    'foregroundPrimary' => null,
    'foregroundSecondary' => null,
])

@php
    $defaults = config('ogkit.defaults', []);

    $font = $font ?? $defaults['font'] ?? 'sans';
    $accentColor = $accentColor ?? $defaults['accent'] ?? '#ffffff';
    $backgroundType = $backgroundType ?? $defaults['background']['type'] ?? 'gradient-diagonal';
    $backgroundPrimary = $backgroundPrimary ?? $defaults['background']['primary'] ?? '#505FE0';
    $backgroundSecondary = $backgroundSecondary ?? $defaults['background']['secondary'] ?? '#1d214b';
    $foregroundPrimary = $foregroundPrimary ?? $defaults['typography']['primary'] ?? '#ffffff';
    $foregroundSecondary = $foregroundSecondary ?? $defaults['typography']['secondary'] ?? '#ffffff';

    $backgroundClass = "og-bg-type-{$backgroundType}";
@endphp

<template data-og-template>
    @env('local')
        @if($font && $font !== 'sans' && $font !== 'serif' && $font !== 'mono')
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family={{ urlencode($font) }}:wght@400;500;600;700&display=swap">
        @endif
    @endenv
    <div
        {{ $attributes->class(['og-template w-full h-full og-bg-primary og-text-primary overflow-hidden', $backgroundClass]) }}
        style="
            --og-font-family: '{{ $font }}', system-ui, sans-serif;
            --og-accent-color: {{ $accentColor }};
            --og-background-primary-color: {{ $backgroundPrimary }};
            --og-background-secondary-color: {{ $backgroundSecondary }};
            --og-foreground-primary-color: {{ $foregroundPrimary }};
            --og-foreground-secondary-color: {{ $foregroundSecondary }};
        "
    >
        @if($name)
            @include("ogkit::templates.{$name}", $attributes->getAttributes())
        @else
            {{ $slot }}
        @endif
    </div>
</template>
