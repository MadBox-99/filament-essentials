<?php

namespace SzaboZoltan\FilamentEssentials;

class FilamentEssentials
{
    public static function getDefaultConfig(): array
    {
        return config('filament-essentials', []);
    }

    public static function isTranslatableByDefault(): bool
    {
        // translateLabel() biztonságos minden komponensen
        return config('filament-essentials.default_translatable', true);
    }

    public static function isRequiredByDefault(): bool
    {
        return config('filament-essentials.default_required', false);
    }
}
