<?php

use Ogkit\Facades\Ogkit;
use Ogkit\Ogkit as OgkitService;

it('can resolve the ogkit service', function () {
    expect(app('ogkit'))->toBeInstanceOf(OgkitService::class);
});

it('can use the facade', function () {
    $url = Ogkit::imageUrl('https://example.com');

    expect($url)->toBeString();
    expect($url)->toContain('ogkit.dev');
});

it('generates meta tags', function () {
    $meta = Ogkit::meta('https://example.com');

    expect($meta)->toContain('og:image');
    expect($meta)->toContain('twitter:image');
    expect($meta)->toContain('twitter:card');
});

it('registers blade directives', function () {
    $directives = app('blade.compiler')->getCustomDirectives();

    expect($directives)->toHaveKey('ogkit');
    expect($directives)->toHaveKey('ogkitUrl');
    expect($directives)->toHaveKey('ogkitTemplate');
    expect($directives)->toHaveKey('endOgkitTemplate');
});

it('can set and render template from service', function () {
    $ogkit = app(\Ogkit\Ogkit::class);

    $ogkit->template('simple', ['title' => 'Test Title']);

    expect($ogkit->getTemplateData())->toBe([
        'name' => 'simple',
        'data' => ['title' => 'Test Title'],
    ]);

    $rendered = $ogkit->renderTemplate();

    expect($rendered)->toContain('data-og-template');

    $ogkit->clearTemplate();

    expect($ogkit->getTemplateData())->toBeNull();
});