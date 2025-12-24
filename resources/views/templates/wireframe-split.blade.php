@props([
    'title' => '',
    'description' => '',
    'image' => '',
    'domain' => parse_url(config('app.url'), PHP_URL_HOST),
])

<div class="relative grid w-full h-full grid-rows-[1fr,1fr]">
    <div class="absolute inset-0 flex justify-between px-12 opacity-10">
        <div class="border-l border-current border-dashed"></div>
        <div class="border-l border-current border-dashed"></div>
    </div>

    <div class="absolute inset-0 flex flex-col justify-between py-12 opacity-10">
        <div class="border-t border-current border-dashed"></div>
        <div class="border-t border-current border-dashed"></div>
    </div>

    <figure class="relative overflow-hidden [clip-path:polygon(0_0,_100%_0,_100%_100%,_0_90%)]">
        <img class="absolute inset-0 object-cover object-center w-full h-full" src="{{ $image }}" alt="">
    </figure>

    <header @class(['relative flex flex-col items-start px-24 pt-12 pb-20', 'justify-end' => !$description])>
        <p class="pl-12 -mx-12 text-lg font-bold tracking-wider uppercase border-l og-font-secondary og-border-accent og-text-accent">
            {{ $domain }}
        </p>

        <p class="mt-5 text-6xl font-bold tracking-tight">{{ $title }}</p>

        @if($description)
            <p class="mt-5 text-2xl og-text-secondary">{!! html_entity_decode($description) !!}</p>
        @endif
    </header>
</div>
