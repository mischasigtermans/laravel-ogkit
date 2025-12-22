# Laravel OG Kit

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mischasigtermans/laravel-ogkit.svg?style=flat-square)](https://packagist.org/packages/mischasigtermans/laravel-ogkit)
[![Total Downloads](https://img.shields.io/packagist/dt/mischasigtermans/laravel-ogkit.svg?style=flat-square)](https://packagist.org/packages/mischasigtermans/laravel-ogkit)

Dynamic OG images for Laravel. Design social previews with HTML and CSS using [OG Kit](https://ogkit.dev).

OG Kit screenshots your custom HTML templates to generate beautiful Open Graph images. This package provides Blade components, directives, and 21 pre-built templates to get you started quickly.

## Installation

```bash
composer require mischasigtermans/laravel-ogkit
```

Add your API key to `.env`:

```env
OGKIT_API_KEY=your-api-key
```

## Quick Start

### Option 1: From Controller/Component (Recommended)

Set the OG template from your controller or Livewire component:

```php
use Ogkit\Ogkit;

class ArticleController extends Controller
{
    public function show(Article $article, Ogkit $ogkit)
    {
        $ogkit->template('layered', [
            'title' => $article->title,
            'category' => $article->category->name,
            'image' => $article->featured_image_url,
        ]);

        return view('articles.show', compact('article'));
    }
}
```

In Livewire:

```php
use Ogkit\Ogkit;

class ArticlePage extends Component
{
    public function mount(Article $article, Ogkit $ogkit)
    {
        $ogkit->template('detailed', [
            'title' => $article->title,
            'readingTime' => $article->reading_time . ' min read',
            'category' => $article->category->name,
            'image' => $article->featured_image_url,
        ]);
    }
}
```

### Option 2: In Blade View

Add a template directly in your Blade view:

```blade
<x-ogkit-template
    name="split-title"
    title="Welcome to My Site"
    subtitle="Building amazing things"
/>
```

### Add Meta Tags

Add the meta-tags to your layout's `<head>`:

```blade
<head>
    @ogkit
</head>
```

## Why OG Kit?

Static OG images are limiting. You want dynamic images that reflect your content – blog titles, product names, user profiles. OG Kit lets you design OG images with tools you already know: HTML, CSS, and Tailwind.

**How it works:**

1. Add a template to your page (via controller or Blade)
2. OG Kit's service screenshots that template at 1200x630
3. The screenshot URL is used as your `og:image`

No image generation code. No Puppeteer servers. No Canvas APIs. Just HTML.

**Common use cases:**

- **Blog posts**: Dynamic titles with featured images and reading time
- **E-commerce**: Product images with prices and sale badges
- **User profiles**: Personalized cards with avatars and stats
- **Documentation**: Section titles with code snippets
- **Social sharing**: Year-in-review cards, achievement badges

## Preview Mode

Enable the preview overlay during development to see your OG images in real-time:

```env
OGKIT_PREVIEW=true
```

The preview button is automatically injected into all HTML responses. It supports:

- **Filament panels**: Uses Filament's modal component
- **Flux UI**: Uses Flux's modal component
- **Vanilla**: Falls back to a custom modal with no dependencies

Click the "OG Preview" button to see exactly what will be screenshotted.

## Templates

21 pre-built templates included:

| Template | Fields | Best For |
|----------|--------|----------|
| `split-title` | title, subtitle | Landing pages |
| `image` | title, image | Blog posts |
| `headline` | title, logo | Announcements |
| `bold` | title, domain | Simple pages |
| `bold-logo` | title, logo | Brand pages |
| `masked` | title, cta | Marketing |
| `masked-logo` | title, logo, cta | Campaigns |
| `outlined` | title, domain | Minimal style |
| `centered` | title, subtitle, domain | About pages |
| `centered-logo-avatar` | title, logo, authorName, authorImage, image | Author posts |
| `poppin` | title, domain | Bold statements |
| `simple` | title, subtitle, domain | General use |
| `simple-logo` | title, subtitle, logo | Brand pages |
| `detailed` | title, readingTime, category, image, domain | Blog posts |
| `wireframe-background` | title, image, domain | Tech content |
| `wireframe-split` | title, image, domain | Articles |
| `layered` | title, category, image, domain | Featured content |
| `default` | title, subtitle, price, fromPrice, image | E-commerce |
| `bold-sale` | title, price, fromPrice, image | Sales |
| `documentation` | overline, title, subtitle, repository, image | Docs |
| `repository` | title, subtitle, image, code | Open source |

### Using Templates

From controller:

```php
$ogkit->template('layered', [
    'title' => 'How to Build Great Products',
    'category' => 'Engineering',
    'image' => asset('images/hero.jpg'),
]);
```

Or in Blade:

```blade
<x-ogkit-template
    name="layered"
    title="How to Build Great Products"
    category="Engineering"
    :image="asset('images/hero.jpg')"
/>
```

### Custom Templates

Create your own design without using a named template:

```blade
<x-ogkit-template
    background-primary="#1e1b4b"
    foreground-primary="#ffffff"
    accent-color="#818cf8"
>
    <div class="flex flex-col items-center justify-center w-full h-full p-16">
        <h1 class="text-6xl font-bold">{{ $title }}</h1>
        <p class="mt-4 text-2xl og-text-secondary">{{ $subtitle }}</p>
    </div>
</x-ogkit-template>
```

## Styling

### Color Props

| Prop | CSS Variable | Description |
|------|--------------|-------------|
| `background-primary` | `--og-background-primary-color` | Main background |
| `background-secondary` | `--og-background-secondary-color` | Gradient/pattern secondary |
| `foreground-primary` | `--og-foreground-primary-color` | Main text color |
| `foreground-secondary` | `--og-foreground-secondary-color` | Muted text color |
| `accent-color` | `--og-accent-color` | Accent/highlight color |

### CSS Utilities

Use these classes in your templates:

```css
/* Backgrounds */
.og-bg-primary
.og-bg-secondary
.og-bg-accent

/* Text */
.og-text-primary
.og-text-secondary
.og-text-accent

/* Borders */
.og-border-primary
.og-border-secondary
.og-border-accent
```

### Background Types

Set via `background-type` prop:

| Type | Description |
|------|-------------|
| `gradient-vertical` | Top to bottom gradient |
| `gradient-horizontal` | Left to right gradient |
| `gradient-diagonal` | Corner to corner gradient |
| `boxes` | Grid pattern |
| `paper` | Graph paper pattern |
| `lines` | Horizontal lines |
| `lines-v2` | Vertical lines |
| `lines-v3` | Cross-hatch lines |
| `diagonal` | Diagonal stripes |
| `diagonal-v2` | Reverse diagonal stripes |
| `diagonal-v3` | Fine diagonal lines |
| `waves` | Radial wave pattern |
| `zig-zag` | Zig-zag pattern |
| `moons` | Moon/circle pattern |
| `triangles` | Triangle pattern |
| `triangles-v2` | Reverse triangles |
| `rectangles` | Rectangle pattern |
| `plusses` | Plus sign pattern |

```php
$ogkit->template('bold', [
    'title' => 'My Page',
    'backgroundType' => 'boxes',
]);
```

### Fonts

Pass any Google Font name:

```php
$ogkit->template('split-title', [
    'title' => 'Hello World',
    'font' => 'Space Grotesk',
]);
```

## Configuration

Publish the config file:

```bash
php artisan vendor:publish --tag=ogkit-config
```

```php
// config/ogkit.php
return [
    'api_key' => env('OGKIT_API_KEY'),
    'preview' => env('OGKIT_PREVIEW', false),
    'base_url' => env('OGKIT_BASE_URL', 'https://ogkit.dev'),

    // Paths where Filament CSS is loaded (for preview modal styling)
    'filament_paths' => ['/app'],

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
```

## Blade Directives

### @ogkit

Output complete OG meta tags:

```blade
<head>
    @ogkit
</head>
```

With title and description:

```blade
@ogkit(title: 'My Page Title', description: 'Page description for social sharing')
```

Generates:

```html
<meta property="og:title" content="My Page Title">
<meta property="og:description" content="Page description for social sharing">
<meta property="og:type" content="website">
<meta property="og:url" content="https://example.com/page">
<meta property="og:image" content="https://ogkit.dev/img/xxx.jpeg?url=...">
<meta name="twitter:title" content="My Page Title">
<meta name="twitter:description" content="Page description for social sharing">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="https://ogkit.dev/img/xxx.jpeg?url=...">
```

### @ogkitUrl

Get just the image URL:

```blade
<meta property="og:image" content="@ogkitUrl">
```

With a version parameter for cache busting:

```blade
<meta property="og:image" content="@ogkitUrl(version: 'v2')">
```

### @ogkitTemplate / @endOgkitTemplate

Create inline custom templates:

```blade
@ogkitTemplate
    <div class="w-full h-full flex items-center justify-center bg-indigo-600 text-white">
        <h1 class="text-6xl font-bold">{{ $title }}</h1>
    </div>
@endOgkitTemplate
```

## Service Methods

```php
use Ogkit\Ogkit;

public function show(Article $article, Ogkit $ogkit)
{
    // Set template from controller
    $ogkit->template('layered', ['title' => $article->title]);

    // Get image URL
    $url = $ogkit->imageUrl();
    $url = $ogkit->imageUrl('https://example.com/page');
    $url = $ogkit->imageUrl(version: 'v2');

    // Get complete meta tags HTML
    $meta = $ogkit->meta();
    $meta = $ogkit->meta(
        title: 'Page Title',
        description: 'Page description',
        pageUrl: 'https://example.com/page',
        version: 'v2'
    );

    // Get just the image meta tags
    $meta = $ogkit->imageMeta();
}
```

## Tailwind Setup

Add the package views to your `tailwind.config.js` content array:

```js
content: [
    // ... your other paths
    './vendor/mischasigtermans/laravel-ogkit/resources/views/**/*.blade.php',
],
```

Publish and import the CSS utilities:

```bash
php artisan vendor:publish --tag=ogkit-css
```

```css
/* resources/css/app.css */
@import './vendor/ogkit.css';
```

Or import directly from vendor:

```css
@import '../../vendor/mischasigtermans/laravel-ogkit/resources/css/ogkit.css';
```

## Use Cases

### Blog with Dynamic OG Images

```php
class ArticleController extends Controller
{
    public function show(Article $article, Ogkit $ogkit)
    {
        $ogkit->template('detailed', [
            'title' => $article->title,
            'readingTime' => $article->reading_time . ' min read',
            'category' => $article->category->name,
            'image' => $article->featured_image_url,
        ]);

        return view('articles.show', compact('article'));
    }
}
```

### E-commerce Product Pages

```php
class ProductController extends Controller
{
    public function show(Product $product, Ogkit $ogkit)
    {
        $ogkit->template('default', [
            'title' => $product->name,
            'subtitle' => $product->short_description,
            'price' => '$' . number_format($product->price, 2),
            'fromPrice' => $product->compare_price
                ? '$' . number_format($product->compare_price, 2)
                : null,
            'image' => $product->featured_image_url,
        ]);

        return view('products.show', compact('product'));
    }
}
```

### User Profile Cards

```php
class ProfileController extends Controller
{
    public function show(User $user, Ogkit $ogkit)
    {
        $ogkit->template('centered-logo-avatar', [
            'title' => $user->name,
            'authorName' => '@' . $user->username,
            'authorImage' => $user->avatar_url,
            'logo' => asset('images/logo.svg'),
        ]);

        return view('profiles.show', compact('user'));
    }
}
```

### Documentation Pages

```php
class DocsController extends Controller
{
    public function show(string $section, string $page, Ogkit $ogkit)
    {
        $doc = Documentation::find($section, $page);

        $ogkit->template('documentation', [
            'overline' => $section,
            'title' => $doc->title,
            'subtitle' => $doc->description,
            'repository' => 'github.com/your-org/your-repo',
        ]);

        return view('docs.show', compact('doc'));
    }
}
```

## Testing

```bash
composer test
```

## Requirements

- PHP 8.2+
- Laravel 10, 11, or 12
- [OG Kit](https://ogkit.dev) API key

## Credits

- [OG Kit](https://ogkit.dev) by [Peter Suhm](https://github.com/petersuhm)
- [Mischa Sigtermans](https://github.com/mischasigtermans)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.