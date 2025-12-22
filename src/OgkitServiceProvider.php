<?php

namespace Ogkit;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Ogkit\Http\Middleware\InjectPreviewScript;

class OgkitServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/ogkit.php', 'ogkit');

        $this->app->singleton(Ogkit::class, function ($app) {
            return new Ogkit(
                apiKey: config('ogkit.api_key') ?? '',
                baseUrl: config('ogkit.base_url', 'https://ogkit.dev'),
            );
        });

        $this->app->alias(Ogkit::class, 'ogkit');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/ogkit.php' => config_path('ogkit.php'),
            ], 'ogkit-config');

            $this->publishes([
                __DIR__.'/../resources/css/ogkit.css' => resource_path('css/vendor/ogkit.css'),
            ], 'ogkit-css');
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'ogkit');

        $this->registerBladeDirectives();
        $this->registerBladeComponents();
        $this->registerMiddleware();
    }

    protected function registerMiddleware(): void
    {
        $kernel = $this->app->make(Kernel::class);
        $kernel->pushMiddleware(InjectPreviewScript::class);
    }

    protected function registerBladeDirectives(): void
    {
        Blade::directive('ogkit', function ($expression) {
            if (empty($expression)) {
                return "<?php echo app(\Ogkit\Ogkit::class)->meta(); ?>";
            }

            return "<?php echo app(\Ogkit\Ogkit::class)->meta({$expression}); ?>";
        });

        Blade::directive('ogkitImage', function ($expression) {
            if (empty($expression)) {
                return "<?php echo app(\Ogkit\Ogkit::class)->imageMeta(); ?>";
            }

            return "<?php echo app(\Ogkit\Ogkit::class)->imageMeta({$expression}); ?>";
        });

        Blade::directive('ogkitUrl', function ($expression) {
            if (empty($expression)) {
                return "<?php echo app(\Ogkit\Ogkit::class)->imageUrl(); ?>";
            }

            return "<?php echo app(\Ogkit\Ogkit::class)->imageUrl({$expression}); ?>";
        });

        Blade::directive('ogkitTemplate', function () {
            return '<template data-og-template>';
        });

        Blade::directive('endOgkitTemplate', function () {
            return '</template>';
        });
    }

    protected function registerBladeComponents(): void
    {
        Blade::component('ogkit::components.template', 'ogkit-template');
    }
}
