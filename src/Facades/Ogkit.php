<?php

namespace Ogkit\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Ogkit\Ogkit template(string $name, array $data = [])
 * @method static array|null getTemplateData()
 * @method static string|null renderTemplate()
 * @method static void clearTemplate()
 * @method static string imageUrl(?string $pageUrl = null, ?string $version = null)
 * @method static string meta(?string $title = null, ?string $description = null, ?string $pageUrl = null, ?string $version = null)
 * @method static string imageMeta(?string $pageUrl = null, ?string $version = null)
 *
 * @see \Ogkit\Ogkit
 */
class Ogkit extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Ogkit\Ogkit::class;
    }
}
