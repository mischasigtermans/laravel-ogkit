@props(['url'])

@php
    // Only use framework modals if we're actually inside their context (CSS is loaded)
    $inFilamentPanel = false;
    $inFluxContext = false;

    if (class_exists(\Filament\Facades\Filament::class)) {
        $requestPath = request()->getPathInfo();

        // Check if we're in a Filament panel
        foreach (\Filament\Facades\Filament::getPanels() as $panel) {
            $panelPath = '/' . ltrim($panel->getPath(), '/');
            if (str_starts_with($requestPath, $panelPath)) {
                $inFilamentPanel = true;
                break;
            }
        }

        // Check configured paths where Filament CSS is loaded
        $filamentPaths = config('ogkit.filament_paths', ['/app']);
        foreach ($filamentPaths as $path) {
            if (str_starts_with($requestPath, $path)) {
                $inFilamentPanel = true;
                break;
            }
        }
    }

    if (class_exists(\Flux\Flux::class) && view()->exists('flux::modal')) {
        $inFluxContext = true;
    }
@endphp

@if ($inFluxContext)
    {{-- Flux Modal --}}
    <div id="ogkit-preview" class="fixed bottom-4 right-4 z-[9999]">
        <flux:button
            icon="photo"
            variant="primary"
            x-data
            x-on:click="Flux.modal('ogkit-preview-modal').show()"
        >
            OG Preview
        </flux:button>
    </div>

    <flux:modal name="ogkit-preview-modal" class="w-full md:!max-w-4xl">
        <div class="space-y-4">
            <flux:heading size="lg">OG Image Preview (1200×630)</flux:heading>

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
                <flux:modal.close>
                    <flux:button>Close</flux:button>
                </flux:modal.close>
                <a
                    href="{{ $url }}"
                    target="_blank"
                    class="text-sm text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-300"
                >
                    Open in new tab ↗
                </a>
            </div>
        </div>
    </flux:modal>

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

@elseif ($inFilamentPanel)
    {{-- Filament Modal --}}
    <div
        id="ogkit-preview"
        class="fixed bottom-4 right-4 z-[9999]"
        x-data="{ open: false }"
    >
        <x-filament::button
            icon="heroicon-o-photo"
            color="primary"
            x-on:click="open = true; $dispatch('open-modal', { id: 'ogkit-preview-modal' })"
        >
            OG Preview
        </x-filament::button>

        <x-filament::modal
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
        </x-filament::modal>
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

@else
    {{-- Vanilla HTML/JS Modal --}}
    <div id="ogkit-preview" style="position:fixed;bottom:16px;right:16px;z-index:9999;font-family:system-ui;">
        <button onclick="document.getElementById('ogkit-modal').style.display='flex'" style="display:flex;align-items:center;gap:8px;background:#4f46e5;color:#fff;padding:10px 16px;border-radius:8px;font-size:14px;font-weight:500;border:none;cursor:pointer;box-shadow:0 4px 12px rgba(0,0,0,0.15);">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
            OG Preview
        </button>
    </div>
    <div id="ogkit-modal" style="display:none;position:fixed;inset:0;z-index:10000;background:rgba(0,0,0,0.8);align-items:center;justify-content:center;padding:16px;font-family:system-ui;" onclick="if(event.target===this)this.style.display='none'">
        <div style="background:#1f2937;border-radius:12px;padding:16px;width:100%;max-width:900px;box-shadow:0 25px 50px rgba(0,0,0,0.5);">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
                <span style="color:#fff;font-weight:600;font-size:14px;">OG Image Preview (1200×630)</span>
                <button onclick="document.getElementById('ogkit-modal').style.display='none'" style="background:none;border:none;color:#9ca3af;cursor:pointer;font-size:24px;line-height:1;">&times;</button>
            </div>
            <div id="ogkit-iframe-wrap" style="width:100%;aspect-ratio:1200/630;overflow:hidden;border-radius:8px;background:#000;border:1px solid #374151;">
                <iframe id="ogkit-iframe" src="{{ $url }}" style="width:1200px;height:630px;border:none;transform-origin:top left;"></iframe>
            </div>
            <div style="margin-top:12px;display:flex;justify-content:flex-end;gap:8px;">
                <a href="{{ $url }}" target="_blank" style="color:#9ca3af;font-size:12px;text-decoration:none;">Open in new tab ↗</a>
            </div>
        </div>
    </div>
    <script>
        (function(){
            function scaleIframe(){
                var wrap=document.getElementById('ogkit-iframe-wrap');
                var iframe=document.getElementById('ogkit-iframe');
                if(wrap&&iframe){var s=wrap.offsetWidth/1200;iframe.style.transform='scale('+s+')';}
            }
            window.addEventListener('resize',scaleIframe);
            new MutationObserver(scaleIframe).observe(document.getElementById('ogkit-modal'),{attributes:true,attributeFilter:['style']});
            setTimeout(scaleIframe,100);
        })();
    </script>
@endif
