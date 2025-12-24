@props(['url'])

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