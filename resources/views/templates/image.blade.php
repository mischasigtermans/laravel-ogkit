@props([
    'title' => '',
    'image' => '',
])

<div class="w-full h-full p-20 overflow-hidden border-b-[16px] og-border-accent">
    <p class="text-8xl font-bold tracking-tight text-center">
        {{ $title }}
    </p>

    <img
        class="object-cover object-top w-full h-full max-w-2xl mx-auto mt-16 rounded-t-2xl shadow-lg"
        src="{{ $image }}"
        alt=""
    >
</div>
