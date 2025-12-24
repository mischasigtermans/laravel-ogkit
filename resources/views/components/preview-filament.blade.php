@props(['url'])

{{-- Filament Modal - uses dynamic components to avoid compile-time errors when Filament is not installed --}}
<div
    id="ogkit-preview"
    class="fixed bottom-4 right-4 z-[9999]"
    x-data="{ open: false }"
>
    <x-dynamic-component
        component="filament::button"
        icon="heroicon-o-photo"
        color="primary"
        x-on:click="open = true; $dispatch('open-modal', { id: 'ogkit-preview-modal' })"
    >
        OG Preview
    </x-dynamic-component>

    <x-dynamic-component
        component="filament::modal"
        id="ogkit-preview-modal"
        width="4xl"
        :close-by-clicking-away="true"
    >
        <x-slot name="heading">
            OG Image Preview (1200×630)
        </x-slot>

        <div
            id="ogkit-iframe-wrap"
            class="w-full overflow-hidden rounded-lg bg-black border border-gray-700"
            style="aspect-ratio: 1200/630;"
        >
            <iframe
                id="ogkit-iframe"
                src="{{ $url }}"
                class="border-none"
                style="width: 1200px; height: 630px; transform-origin: top left;"
            ></iframe>
        </div>

        <x-slot name="footer">
            <div class="flex justify-end items-center w-full">
                <a
                    href="{{ $url }}"
                    target="_blank"
                    class="text-sm text-gray-500 hover:text-gray-700 dark:hover:text-gray-300"
                >
                    Open in new tab ↗
                </a>
            </div>
        </x-slot>
    </x-dynamic-component>
</div>

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
        setInterval(scaleIframe, 200);
    })();
</script>