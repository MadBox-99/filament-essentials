<?php

namespace SzaboZoltan\FilamentEssentials\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use SzaboZoltan\FilamentEssentials\FilamentEssentialsServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            FilamentEssentialsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');
    }
}
