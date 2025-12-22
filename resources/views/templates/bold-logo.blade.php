@props([
    'title' => '',
    'logo' => '',
])

<div class="flex flex-col items-start w-full h-full p-20">
    <p class="flex-grow text-8xl font-bold tracking-tight">
        {{ $title }}
    </p>

    <img class="relative inline-block h-16 mt-8" src="{{ $logo }}" alt="">
</div>
