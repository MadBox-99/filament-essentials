<?php

namespace MadBox99\FilamentEssentials\Tests;

use MadBox99\FilamentEssentials\FilamentEssentialsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            FilamentEssentialsServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['translator']->addJsonPath(__DIR__.'/Fixtures/lang');
        $app->setLocale('hu');
    }
}
