@props(['url'])

{{-- Flux Modal - uses dynamic components to avoid compile-time errors when Flux is not installed --}}
<div id="ogkit-preview" class="fixed bottom-4 right-4 z-[9999]">
    <x-dynamic-component
        component="flux::button"
        icon="photo"
        variant="primary"
        x-data
        x-on:click="Flux.modal('ogkit-preview-modal').show()"
    >
        OG Preview
    </x-dynamic-component>
</div>

<x-dynamic-component component="flux::modal" name="ogkit-preview-modal" class="w-full md:!max-w-4xl">
    <div class="space-y-4">
        <x-dynamic-component component="flux::heading" size="lg">OG Image Preview (1200×630)</x-dynamic-component>

        <div
            id="ogkit-iframe-wrap"
            class="w-full overflow-hidden rounded-lg bg-black border border-zinc-700"
            style="aspect-ratio: 1200/630;"
        >
            <iframe
                id="ogkit-iframe"
                src="{{ $url }}"
                class="border-none"
                style="width: 1200px; height: 630px; transform-origin: top left;"
            ></iframe>
        </div>

        <div class="flex justify-end items-center gap-4">
            <x-dynamic-component component="flux::modal.close">
                <x-dynamic-component component="flux::button">Close</x-dynamic-component>
            </x-dynamic-component>
            <a
                href="{{ $url }}"
                target="_blank"
                class="text-sm text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-300"
            >
                Open in new tab ↗
            </a>
        </div>
    </div>
</x-dynamic-component>

<script>
    (function(){
        function scaleIframe(){
            var wrap = document.getElementById('ogkit-iframe-wrap');
            var iframe = document.getElementById('ogkit-iframe');
            if(wrap && iframe){
                var s = wrap.offsetWidth / 1200;
                iframe.style.transform = 'scale(' + s + ')';
            }
        }
        window.addEventListener('resize', scaleIframe);
        document.addEventListener('modal-opened', scaleIframe);
        setInterval(scaleIframe, 200);
    })();
</script>