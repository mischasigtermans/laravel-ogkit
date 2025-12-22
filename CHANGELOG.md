# Changelog

All notable changes to this project will be documented in this file.

## [1.0.0] - 2025-12-22

### Added
- `<x-ogkit-template>` Blade component for OG image templates
- `Ogkit::template()` method to set templates from controllers/components
- 21 pre-built templates: split-title, image, headline, bold, bold-logo, masked, masked-logo, outlined, centered, centered-logo-avatar, poppin, simple, simple-logo, detailed, wireframe-background, wireframe-split, layered, default, bold-sale, documentation, repository
- CSS utilities for template styling (backgrounds, text, borders, patterns)
- `@ogkit` directive for complete meta tag output (og:image, og:title, og:description, twitter:card)
- `@ogkitUrl` directive for image URL only
- `@ogkitTemplate` / `@endOgkitTemplate` directives for inline custom templates
- Ogkit service with `imageUrl()`, `meta()`, and `imageMeta()` methods
- Ogkit facade for static access
- Preview mode with automatic UI injection (supports Filament, Flux, and vanilla JS)
- Configurable defaults for font, colors, and background type
- 18 background patterns: gradient-vertical, gradient-horizontal, gradient-diagonal, boxes, paper, lines, lines-v2, lines-v3, diagonal, diagonal-v2, diagonal-v3, waves, zig-zag, moons, triangles, triangles-v2, rectangles, plusses
- Google Fonts support via `font` prop
- Version parameter for cache busting
- Laravel 10, 11, and 12 support
- PHP 8.2+ support