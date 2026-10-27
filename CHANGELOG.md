# Változásnapló

Minden jelentős változás ebben a projektben dokumentálva lesz ebben a fájlban.

Az formátum a [Keep a Changelog](https://keepachangelog.com/hu/1.0.0/) alapján készült,
és ez a projekt a [Semantic Versioning](https://semver.org/spec/v2.0.0.html) elveket követi.

## [2.0.0] - 2026-10-27

### Változott
- **BREAKING**: Filament 5, PHP 8.3+; a namespace `MadBox99\FilamentEssentials` lett
- **BREAKING**: `default_translatable` helyett `translate_labels`, alapból bekapcsolva
- A címkefordítás a Filament alaposztályain (`Field`, `Entry`, `Column`, `Step`) van beállítva, így minden mezőre, infolist-elemre és táblaoszlopra érvényes
- **BREAKING**: a komponens-alapértékek (maxLength, kereshető Select, dátumformátumok, feltöltési limit stb.) csak `component_defaults => true` mellett lépnek életbe; a kulcsokból kikerült a `default_` előtag

### Eltávolítva
- `FilamentEssentials` facade és osztály
- `default_required` konfiguráció

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
  - TextInput: maxLength, opcionális translateLabel
  - Textarea: rows, cols, opcionális translateLabel
  - RichEditor: opcionális translateLabel
  - Select: searchable, preload, opcionális translateLabel
  - DatePicker/TimePicker/DateTimePicker: magyar formátumok, opcionális translateLabel
  - Toggle: színek (zöld/szürke), opcionális translateLabel
  - FileUpload: fájl méretek, típusok, letöltés és előnézet, opcionális translateLabel
  - Checkbox, CheckboxList, Radio: opcionális translateLabel
- **Nincs szükség manuális makró hívásokra** - minden automatikusan működik!

### Technikai részletek
- PHP 8.1+ kompatibilitás
- Laravel 10.x és 11.x támogatás
- Filament 3.x kompatibilitás
- PSR-4 autoloading
- Spatie Laravel Package Tools integráció
