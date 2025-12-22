<?php

namespace Ogkit;

use Illuminate\Support\Facades\View;

class Ogkit
{
    protected ?array $templateData = null;

    public function __construct(
        protected string $apiKey,
        protected string $baseUrl = 'https://ogkit.dev'
    ) {}

    public function template(string $name, array $data = []): static
    {
        $this->templateData = [
            'name' => $name,
            'data' => $data,
        ];

        return $this;
    }

    public function getTemplateData(): ?array
    {
        return $this->templateData;
    }

    public function renderTemplate(): ?string
    {
        if (! $this->templateData) {
            return null;
        }

        return View::make('ogkit::components.template', [
            'name' => $this->templateData['name'],
            ...$this->templateData['data'],
        ])->render();
    }

    public function clearTemplate(): void
    {
        $this->templateData = null;
    }

    public function imageUrl(?string $pageUrl = null, ?string $version = null): string
    {
        $pageUrl ??= request()->url();

        if ($version) {
            $separator = str_contains($pageUrl, '?') ? '&' : '?';
            $pageUrl .= "{$separator}v={$version}";
        }

        return "{$this->baseUrl}/img/{$this->apiKey}.jpeg?url=".urlencode($pageUrl);
    }

    public function meta(
        ?string $title = null,
        ?string $description = null,
        ?string $pageUrl = null,
        ?string $version = null,
    ): string {
        $imageUrl = $this->imageUrl($pageUrl, $version);
        $pageUrl ??= request()->url();

        $tags = [];

        if ($title) {
            $tags[] = '<meta property="og:title" content="'.e($title).'">';
            $tags[] = '<meta name="twitter:title" content="'.e($title).'">';
        }

        if ($description) {
            $tags[] = '<meta property="og:description" content="'.e($description).'">';
            $tags[] = '<meta name="twitter:description" content="'.e($description).'">';
        }

        $tags[] = '<meta property="og:type" content="website">';
        $tags[] = '<meta property="og:url" content="'.e($pageUrl).'">';
        $tags[] = '<meta property="og:image" content="'.e($imageUrl).'">';
        $tags[] = '<meta name="twitter:card" content="summary_large_image">';
        $tags[] = '<meta name="twitter:image" content="'.e($imageUrl).'">';

        return implode("\n", $tags);
    }

    public function imageMeta(?string $pageUrl = null, ?string $version = null): string
    {
        $imageUrl = $this->imageUrl($pageUrl, $version);

        return '<meta property="og:image" content="'.e($imageUrl).'">'."\n".
               '<meta name="twitter:image" content="'.e($imageUrl).'">';
    }
}
