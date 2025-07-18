<?php

namespace FilamentEssentials\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use FilamentEssentials\FilamentEssentialsServiceProvider;

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

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'testing');
        
        // Beállítjuk a filament-essentials konfigurációt
        $app['config']->set('filament-essentials', [
            'default_translatable' => false,
            'default_text_maxlength' => 255,
            'default_textarea_rows' => 3,
            'default_textarea_cols' => 50,
            'default_select_searchable' => true,
            'default_select_preload' => false,
        ]);
    }
}
