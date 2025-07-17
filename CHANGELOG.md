# Változásnapló

Minden jelentős változás ebben a projektben dokumentálva lesz ebben a fájlban.

Az formátum a [Keep a Changelog](https://keepachangelog.com/hu/1.0.0/) alapján készült,
és ez a projekt a [Semantic Versioning](https://semver.org/spec/v2.0.0.html) elveket követi.

## [Unreleased]

### Changed
- **Breaking change**: `default_translatable` alapértelmezett értéke `false`-ra változott a biztonság érdekében
- Intelligensebb translatable kezelés: csak akkor alkalmazza, ha explicit engedélyezve van ÉS elérhető a metódus
- Frissített dokumentáció a biztonságos translatable használatról

## [1.0.0] - 2025-07-17

### Hozzáadva
- Kezdeti kiadás
- **Automatikus konfiguráció** minden Filament form komponenshez `configureUsing()` használatával
- Konfigurálható alapértelmezett beállítások
- `FilamentEssentials` facade
- Teljes PHPUnit teszt lefedettség
- Részletes dokumentáció magyar nyelven
- Intelligens `translatable()` támogatás (csak akkor alkalmazza, ha elérhető)
- Automatikus komponens-specifikus alapértelmezett beállítások:
  - TextInput: maxLength, translatable
  - Textarea: maxLength, rows, translatable
  - RichEditor: toolbar buttons, translatable
  - Select: searchable, preload, translatable
  - DatePicker/TimePicker/DateTimePicker: magyar formátumok
  - Toggle: színek (zöld/szürke)
  - FileUpload: fájl méretek, típusok, letöltés és előnézet
  - Checkbox, CheckboxList, Radio alapértelmezett beállítások
- **Nincs szükség manuális makró hívásokra** - minden automatikusan működik!

### Technikai részletek
- PHP 8.1+ kompatibilitás
- Laravel 10.x és 11.x támogatás
- Filament 3.x kompatibilitás
- PSR-4 autoloading
- Spatie Laravel Package Tools integráció
