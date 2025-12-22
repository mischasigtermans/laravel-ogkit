@props([
    'title' => '',
    'readingTime' => '',
    'category' => '',
    'image' => '',
    'domain' => parse_url(config('app.url'), PHP_URL_HOST),
])

<div class="relative flex flex-col w-full h-full p-16 overflow-hidden border-8 og-border-accent">
    <figure class="absolute h-[512px] overflow-hidden shadow-2xl -right-2 -bottom-32 w-[500px] -rotate-2 rounded-2xl">
        <img class="absolute inset-0 object-cover w-full h-full" src="{{ $image }}" alt="">
    </figure>

    <p class="text-base font-bold tracking-wider uppercase og-text-accent">
        {{ $domain }}
    </p>

    <p class="flex-grow mt-8 text-6xl font-bold tracking-tight">
        {{ $title }}
    </p>

    <dl class="flex gap-12 mt-8 items-star og-text-secondary">
        @if($readingTime)
            <div class="flex items-center gap-2">
                <dt>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </dt>
                <dd>{{ $readingTime }}</dd>
            </div>
        @endif

        @if($category)
            <div class="flex items-center gap-2">
                <dt>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </dt>
                <dd>{{ $category }}</dd>
            </div>
        @endif
    </dl>
</div>
