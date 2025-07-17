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
        return config('filament-essentials.default_translatable', true);
    }

    public static function isRequiredByDefault(): bool
    {
        return config('filament-essentials.default_required', false);
    }
}
