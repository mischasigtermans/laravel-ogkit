@props([
    'title' => '',
    'price' => '',
    'fromPrice' => '',
    'image' => '',
])

<div class="relative grid flex-col w-full h-full grid-cols-2 overflow-hidden border-[16px] og-border-accent">
    <div class="flex flex-col items-start gap-4 py-16 pl-16">
        <p class="text-6xl font-bold">{{ $title }}</p>

        <div class="flex-1"></div>

        @if($fromPrice)
            <p class="relative inline-flex items-center justify-center text-5xl og-text-secondary">
                <span>{{ $fromPrice }}</span>
                <span class="absolute inset-x-0 w-full h-2 bg-current rotate-3"></span>
            </p>
        @endif

        <p class="text-[6rem] font-bold og-text-accent">{{ $price }}</p>
    </div>

    <div class="min-h-0 overflow-hidden">
        <img class="object-contain w-full h-full" src="{{ $image }}" alt="">
    </div>
</div>
