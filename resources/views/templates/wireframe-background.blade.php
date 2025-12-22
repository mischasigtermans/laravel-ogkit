@props([
    'title' => '',
    'image' => '',
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

    <div class="absolute inset-x-0 bottom-0 h-40 -skew-y-[15deg] og-bg-accent"></div>

    <div class="relative z-10 w-full h-full p-24">
        <p class="pl-12 -mx-12 text-base font-bold tracking-wider uppercase border-l og-border-accent og-text-accent">
            {{ $domain }}
        </p>

        <p class="mt-8 text-8xl font-bold tracking-tight">{{ $title }}</p>
    </div>

    <img class="absolute inset-0 object-cover w-full h-full opacity-25" src="{{ $image }}" alt="">
</div>
