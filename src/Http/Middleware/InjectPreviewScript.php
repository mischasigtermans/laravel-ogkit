<?php

namespace Ogkit\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;
use Ogkit\Ogkit;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class InjectPreviewScript
{
    public function __construct(
        protected Ogkit $ogkit
    ) {}

    public function handle(Request $request, Closure $next): SymfonyResponse
    {
        $response = $next($request);

        if (! $this->isHtmlResponse($response)) {
            return $response;
        }

        $content = $response->getContent();

        if ($template = $this->ogkit->renderTemplate()) {
            $content = str_replace('</body>', $template.'</body>', $content);
            $this->ogkit->clearTemplate();
        }

        $script = '<script defer src="https://cdn.jsdelivr.net/npm/ogkit@1"></script>';
        $content = str_replace('</body>', $script.'</body>', $content);

        if (config('ogkit.preview') && ! $request->has('ogkit-render')) {
            $content = $this->injectPreviewUI($request, $content);
        }

        $response->setContent($content);

        return $response;
    }

    protected function injectPreviewUI(Request $request, string $content): string
    {
        $url = $request->fullUrl();
        $separator = str_contains($url, '?') ? '&' : '?';
        $renderUrl = $url.$separator.'ogkit-render';

        $preview = View::make('ogkit::components.preview', ['url' => $renderUrl])->render();

        return str_replace('</body>', $preview.'</body>', $content);
    }

    protected function isHtmlResponse(SymfonyResponse $response): bool
    {
        if (! $response instanceof Response) {
            return false;
        }

        if (! str_contains($response->headers->get('Content-Type', ''), 'text/html')) {
            return false;
        }

        $content = $response->getContent();

        return $content && str_contains($content, '</body>');
    }
}
