<?php

namespace SzaboZoltan\FilamentEssentials\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SzaboZoltan\FilamentEssentials\FilamentEssentials
 */
class FilamentEssentials extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \SzaboZoltan\FilamentEssentials\FilamentEssentials::class;
    }
}
