@props([
    'image' => '',
    'title' => '',
    'subtitle' => '',
    'code' => '',
])

<div class="flex flex-col items-center w-full h-full p-16 text-center border-b-[16px] og-border-accent">
    @if($image)
        <img class="object-cover w-32 h-32 rounded-full shadow-lg" src="{{ $image }}" alt="">
    @endif

    <p class="mt-12 text-8xl font-bold">{{ $title }}</p>

    @if($subtitle)
        <p class="mt-2 text-lg og-text-secondary">{{ $subtitle }}</p>
    @endif

    @if($code)
        <p class="px-4 py-2 mt-12 font-mono text-lg bg-current rounded-xl og-text-primary">
            <span class="text-transparent bg-clip-text og-bg-primary">{{ $code }}</span>
        </p>
    @endif
</div>
