@props([
    'overline' => '',
    'title' => '',
    'subtitle' => '',
    'repository' => '',
    'image' => '',
])

<div class="flex flex-col w-full h-full p-16 border-b-[16px] og-border-accent">
    @if($overline)
        <p class="text-lg font-medium og-text-accent">{{ $overline }}</p>
    @endif

    <p class="mt-4 text-8xl font-bold">{{ $title }}</p>

    @if($subtitle)
        <p class="mt-4 text-2xl og-text-secondary">{{ $subtitle }}</p>
    @endif

    <footer class="flex items-end justify-between gap-12 mt-auto">
        @if($repository)
            <p class="text-lg font-mono">{{ $repository }}</p>
        @endif

        @if($image)
            <img class="object-cover w-24 h-24 rounded-full shadow-xl" src="{{ $image }}" alt="">
        @endif
    </footer>
</div>
