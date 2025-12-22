@props([
    'title' => '',
    'domain' => parse_url(config('app.url'), PHP_URL_HOST),
])

<div class="flex flex-col w-full h-full p-20 text-center border-t-[16px] og-border-accent">
    <p class="flex-grow text-8xl font-bold tracking-tight">
        {{ $title }}
    </p>

    <p class="mt-8 text-lg font-bold tracking-wider uppercase og-text-accent">
        {{ $domain }}
    </p>
</div>
