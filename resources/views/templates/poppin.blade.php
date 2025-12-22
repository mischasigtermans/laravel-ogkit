@props([
    'title' => '',
    'domain' => parse_url(config('app.url'), PHP_URL_HOST),
])

<div class="flex flex-col w-full h-full p-20 text-center border-t-[16px] og-border-accent">
    <div class="flex-grow">
        <p class="inline px-6 py-2 text-8xl font-bold leading-snug tracking-tight rounded-xl decoration-clone og-bg-primary">
            {{ $title }}
        </p>
    </div>

    <div>
        <p class="inline px-4 py-2 mt-8 text-base font-bold tracking-wider uppercase rounded-xl og-text-accent decoration-clone og-bg-primary">
            {{ $domain }}
        </p>
    </div>
</div>
