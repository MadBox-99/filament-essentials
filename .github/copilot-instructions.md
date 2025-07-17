<!-- Use this file to provide workspace-specific custom instructions to Copilot. For more details, visit https://code.visualstudio.com/docs/copilot/copilot-customization#_use-a-githubcopilotinstructionsmd-file -->

# Filament Essentials Composer Package

Ez egy PHP Composer csomag, amely alapértelmezett konfigurációkat és makrókat biztosít a Filament PHP-hez.

## Projekt specifikus irányelvek:

1. **PSR-4 autoloading** - Használd a `SzaboZoltan\FilamentEssentials` namespace-t
2. **Filament kompatibilitás** - Minden kód legyen kompatibilis a Filament 3.x verzióval
3. **Laravel Package Tools** - Használd a Spatie Laravel Package Tools-t a package konfigurációhoz
4. **Makrók** - Minden form komponens kapjon egy `essentials()` makrót
5. **Konfiguráció** - Minden alapértelmezett érték legyen konfigurálható
6. **Magyar kommentek** - A kódban magyar nyelvű kommenteket használj
7. **Trait pattern** - Használj trait-eket a funkcionalitás megosztásához
8. **Facade pattern** - Biztosíts Facade-et a könnyebb használatért

## Kód stílus:
- PSR-12 kódolási standard
- Beszédes változó és metódus nevek
- Teljes dokumentáció minden publikus metódushoz
- Type hints használata minden paraméternél és visszatérési értéknél
