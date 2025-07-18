<?php

namespace FilamentEssentials\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \FilamentEssentials\FilamentEssentials
 */
class FilamentEssentials extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \FilamentEssentials\FilamentEssentials::class;
    }
}
