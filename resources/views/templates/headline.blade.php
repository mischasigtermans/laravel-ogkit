@props([
    'title' => '',
    'logo' => '',
])

<div class="relative flex flex-col items-start w-full h-full p-16">
    <img class="relative inline-block h-16" src="{{ $logo }}" alt="">

    <p class="relative mt-16 text-8xl font-bold tracking-tight">
        {{ $title }}
    </p>

    <div class="absolute inset-x-0 bottom-0 h-64 origin-bottom-right -skew-y-12 translate-x-1/3 og-bg-accent mix-blend-multiply"></div>

    <div class="absolute inset-x-0 bottom-0 h-64 origin-bottom-left skew-y-12 bg-current -translate-x-1/3 og-text-primary"></div>
</div>
