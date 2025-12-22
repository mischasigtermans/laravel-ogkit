<?php

use Illuminate\Support\Facades\View;

$templates = [
    'bold',
    'bold-logo',
    'bold-sale',
    'centered',
    'centered-logo-avatar',
    'default',
    'detailed',
    'documentation',
    'headline',
    'image',
    'layered',
    'masked',
    'masked-logo',
    'outlined',
    'poppin',
    'repository',
    'simple',
    'simple-logo',
    'split-title',
    'wireframe-background',
    'wireframe-split',
];

$backgroundTypes = [
    'gradient-vertical',
    'gradient-diagonal',
    'gradient-horizontal',
    'waves',
    'zig-zag',
    'moons',
    'diagonal',
    'diagonal-v2',
    'diagonal-v3',
    'paper',
    'lines',
    'lines-v2',
    'lines-v3',
    'boxes',
    'triangles',
    'triangles-v2',
    'rectangles',
    'plusses',
];

it('can render template component', function () {
    $view = View::make('ogkit::components.template', [
        'name' => null,
        'slot' => '<p>Test content</p>',
    ]);

    $html = $view->render();

    expect($html)->toContain('data-og-template');
    expect($html)->toContain('og-template');
});

it('can render template component with name', function () {
    $view = View::make('ogkit::components.template', [
        'name' => 'simple',
    ]);

    $html = $view->render();

    expect($html)->toContain('data-og-template');
});

it('can render all templates', function (string $template) {
    expect(View::exists("ogkit::templates.{$template}"))->toBeTrue();

    $view = View::make("ogkit::templates.{$template}");
    $html = $view->render();

    expect($html)->toBeString();
})->with($templates);

it('applies background type class', function (string $backgroundType) {
    $view = View::make('ogkit::components.template', [
        'backgroundType' => $backgroundType,
        'slot' => '',
    ]);

    $html = $view->render();

    expect($html)->toContain("og-bg-type-{$backgroundType}");
})->with($backgroundTypes);

it('applies custom colors', function () {
    $view = View::make('ogkit::components.template', [
        'accentColor' => '#ff0000',
        'backgroundPrimary' => '#00ff00',
        'backgroundSecondary' => '#0000ff',
        'foregroundPrimary' => '#ffff00',
        'foregroundSecondary' => '#ff00ff',
        'slot' => '',
    ]);

    $html = $view->render();

    expect($html)->toContain('--og-accent-color: #ff0000');
    expect($html)->toContain('--og-background-primary-color: #00ff00');
    expect($html)->toContain('--og-background-secondary-color: #0000ff');
    expect($html)->toContain('--og-foreground-primary-color: #ffff00');
    expect($html)->toContain('--og-foreground-secondary-color: #ff00ff');
});

it('applies custom font', function () {
    $view = View::make('ogkit::components.template', [
        'font' => 'Inter',
        'slot' => '',
    ]);

    $html = $view->render();

    expect($html)->toContain("--og-font-family: 'Inter'");
});

it('uses default config values', function () {
    config(['ogkit.defaults' => [
        'font' => 'Roboto',
        'accent' => '#123456',
        'typography' => [
            'primary' => '#aaaaaa',
            'secondary' => '#bbbbbb',
        ],
        'background' => [
            'type' => 'waves',
            'primary' => '#cccccc',
            'secondary' => '#dddddd',
        ],
    ]]);

    $view = View::make('ogkit::components.template', ['slot' => '']);
    $html = $view->render();

    expect($html)->toContain("--og-font-family: 'Roboto'");
    expect($html)->toContain('og-bg-type-waves');
    expect($html)->toContain('--og-accent-color: #123456');
    expect($html)->toContain('--og-background-primary-color: #cccccc');
    expect($html)->toContain('--og-background-secondary-color: #dddddd');
    expect($html)->toContain('--og-foreground-primary-color: #aaaaaa');
    expect($html)->toContain('--og-foreground-secondary-color: #bbbbbb');
});
