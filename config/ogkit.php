<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Ogkit API Key
    |--------------------------------------------------------------------------
    |
    | Your Ogkit API key from https://ogkit.dev
    |
    */

    'api_key' => env('OGKIT_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Preview Mode
    |--------------------------------------------------------------------------
    |
    | When enabled, the preview script is automatically injected into all
    | HTML responses. Set OGKIT_PREVIEW=true in your .env to enable.
    |
    */

    'preview' => env('OGKIT_PREVIEW', false),

    /*
    |--------------------------------------------------------------------------
    | Filament Paths
    |--------------------------------------------------------------------------
    |
    | Additional URL paths where Filament CSS is loaded. The preview modal
    | will use Filament components on these paths. Filament panel paths are
    | automatically detected.
    |
    */

    'filament_paths' => ['/app'],

    /*
    |--------------------------------------------------------------------------
    | Base URL
    |--------------------------------------------------------------------------
    |
    | The base URL for the Ogkit service.
    |
    */

    'base_url' => env('OGKIT_BASE_URL', 'https://ogkit.dev'),

    /*
    |--------------------------------------------------------------------------
    | Default Template Settings
    |--------------------------------------------------------------------------
    |
    | Default values for template styling. These can be overridden per-template.
    |
    | Available background_type options:
    | - gradient-vertical, gradient-diagonal, gradient-horizontal
    | - waves, zig-zag, moons, diagonal, diagonal-v2, diagonal-v3
    | - paper, lines, lines-v2, lines-v3, boxes
    | - triangles, triangles-v2, rectangles, plusses
    |
    */

    'defaults' => [
        'font' => 'Space Grotesk',
        'accent' => '#171717',
        'typography' => [
            'primary' => '#171717',
            'secondary' => '#8a8a8a',
        ],
        'background' => [
            'type' => 'boxes',
            'primary' => '#ffffff',
            'secondary' => '#f5f5f5',
        ],
    ],

];
