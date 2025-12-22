@props([
    'title' => '',
    'subtitle' => '',
    'domain' => parse_url(config('app.url'), PHP_URL_HOST),
])

<div class="w-full h-full p-20">
    <p class="text-base font-bold tracking-wider uppercase og-text-accent">
        {{ $domain }}
    </p>

    <p class="mt-12 text-8xl font-bold tracking-tight">
        {{ $title }}
    </p>

    <p class="max-w-2xl mt-4 text-5xl og-text-secondary">
        {{ $subtitle }}
    </p>
</div>
