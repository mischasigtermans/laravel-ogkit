<?php

namespace Ogkit\Tests;

use Ogkit\OgkitServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            OgkitServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app): array
    {
        return [
            'Ogkit' => \Ogkit\Facades\Ogkit::class,
        ];
    }
}
