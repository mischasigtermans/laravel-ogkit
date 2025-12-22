@props([
    'title' => '',
    'subtitle' => '',
])

<div class="relative flex flex-col items-center justify-center w-full h-full p-16">
    {{-- Top-left accent bar --}}
    <div class="absolute top-0 left-0 grid w-2/3 h-64 grid-cols-3 -translate-x-1/2 -skew-x-12 -rotate-12">
        <div class="col-span-3 og-bg-accent"></div>
        <div class="col-span-2 og-bg-accent opacity-10"></div>
    </div>

    {{-- Bottom-right accent bar --}}
    <div class="absolute bottom-0 right-0 grid w-2/3 h-64 grid-cols-3 translate-x-1/2 -skew-x-12 -scale-100 -rotate-12">
        <div class="col-span-3 og-bg-accent"></div>
        <div class="col-span-2 og-bg-accent opacity-10"></div>
    </div>

    {{-- Content --}}
    <div class="grid items-center gap-8 grid-cols-[1fr,auto,1fr] relative">
        <p class="text-6xl font-bold text-right">{{ $title }}</p>

        <div class="w-0.5 bg-current opacity-[.15] h-14 og-text-primary"></div>

        <p class="text-5xl font-medium og-text-secondary">{{ $subtitle }}</p>
    </div>
</div>
