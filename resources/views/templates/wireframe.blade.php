@props([
    'title' => '',
    'subtitle' => '',
    'domain' => parse_url(config('app.url'), PHP_URL_HOST),
])

<div class="relative w-full h-full">
    <div class="absolute inset-0 flex justify-between px-12 opacity-10">
        <div class="border-l border-current border-dashed"></div>
        <div class="border-l border-current border-dashed"></div>
    </div>

    <div class="absolute inset-0 flex flex-col justify-between py-12 opacity-10">
        <div class="border-t border-current border-dashed"></div>
        <div class="border-t border-current border-dashed"></div>
    </div>

    <div class="flex flex-col relative z-10 w-full h-full p-24">
        <p class="pl-12 -mx-12 text-base font-bold tracking-wider uppercase border-l og-border-accent og-text-accent">
            {{ $domain }}
        </p>

        <div class="flex-1"></div>

        <p class="text-6xl font-bold tracking-tight">{{ $title }}</p>

        @if($subtitle)
            <p class="mt-5 text-2xl og-text-secondary">{!! html_entity_decode($subtitle) !!}</p>
        @endif
    </div>
</div>
