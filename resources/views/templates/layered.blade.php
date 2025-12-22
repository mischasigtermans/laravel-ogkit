@props([
    'title' => '',
    'category' => '',
    'image' => '',
    'domain' => parse_url(config('app.url'), PHP_URL_HOST),
])

<div class="relative grid items-start w-full h-full grid-cols-2 gap-8 p-16 overflow-hidden">
    <aside class="flex flex-col items-start h-full">
        <p class="text-base font-bold tracking-wider uppercase og-text-accent">
            {{ $domain }}
        </p>

        <div class="flex-1"></div>

        <p class="text-6xl font-bold tracking-tight">{{ $title }}</p>

        @if($category)
            <p class="mt-8 og-text-secondary inline-block text-lg font-medium shadow-lg px-6 py-3 og-bg-primary rounded-full">{{ $category }}</p>
        @endif
    </aside>

    <aside class="flex flex-col w-full min-w-0">
        <figure class="aspect-[16/9] relative w-full">
            <div class="absolute inset-0 aspect-[16/9] bg-current rounded-xl -rotate-6 og-text-accent opacity-25"></div>

            <img class="absolute inset-0 object-cover aspect-[16/9] shadow-2xl rounded-xl" src="{{ $image }}" alt="">
        </figure>
    </aside>
</div>
