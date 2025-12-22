@props([
    'title' => '',
    'cta' => '',
])

<div class="relative flex flex-col items-start w-full h-full p-20 border-8 og-border-accent">
    <div class="absolute inset-0 w-full h-full og-bg-radial-gradient from-transparent to-[var(--og-background-primary-color)]"></div>

    <p class="relative flex-grow text-8xl font-bold tracking-tight">
        {{ $title }}
    </p>

    <p class="relative inline-flex items-center justify-center px-12 mt-24 text-2xl font-bold rounded-full shadow-xl h-20 text-[color:var(--og-background-primary-color)] bg-[color:var(--og-foreground-primary-color)]">
        {{ $cta }}
    </p>
</div>
