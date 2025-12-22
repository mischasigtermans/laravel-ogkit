@props([
    'title' => '',
    'logo' => '',
    'authorName' => '',
    'authorImage' => '',
    'image' => '',
])

<div class="relative flex flex-col items-start w-full h-full px-20 py-16 border-8 og-border-accent">
    @if($image)
        <img class="absolute inset-0 object-cover w-full h-full opacity-100" src="{{ $image }}" alt="">
        <div class="absolute inset-0 w-full h-full og-bg-type-gradient-vertical"></div>
    @endif

    <img class="relative inline-block h-16" src="{{ $logo }}" alt="">

    <p class="relative flex-grow mt-8 text-8xl font-bold tracking-tight">
        {{ $title }}
    </p>

    <div class="flex">
        <div class="relative z-20 inline-block w-32 h-32 bg-black rounded-full og-bg-accent">
            <img class="relative z-10 inline-block object-contain w-32 h-32 border-8 rounded-full og-border-accent" src="{{ $authorImage }}" alt="">
        </div>
        <div>
            <p class="relative flex-grow mt-8 ml-8 text-2xl font-bold tracking-tight">
                {{ $authorName }}
            </p>
        </div>
    </div>
</div>
