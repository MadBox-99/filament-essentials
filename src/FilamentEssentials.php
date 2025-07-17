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
        // Csak akkor engedélyezzük a translatable-t alapértelmezésként,
        // ha a konfiguráció explicit true és elérhető a funkció
        return config('filament-essentials.default_translatable', false);
    }

    public static function isRequiredByDefault(): bool
    {
        return config('filament-essentials.default_required', false);
    }
}
