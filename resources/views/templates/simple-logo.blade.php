@props([
    'title' => '',
    'subtitle' => '',
    'logo' => '',
])

<div class="w-full h-full p-20">
    <img class="relative inline-block h-16" src="{{ $logo }}" alt="">

    <p class="mt-12 text-8xl font-bold tracking-tight">
        {{ $title }}
    </p>

    <p class="max-w-2xl mt-4 text-5xl og-text-secondary">
        {{ $subtitle }}
    </p>
</div>
