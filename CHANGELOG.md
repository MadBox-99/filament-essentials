# Változásnapló

Minden jelentős változás ebben a projektben dokumentálva lesz ebben a fájlban.

Az formátum a [Keep a Changelog](https://keepachangelog.com/hu/1.0.0/) alapján készült,
és ez a projekt a [Semantic Versioning](https://semver.org/spec/v2.0.0.html) elveket követi.

## [Unreleased]

### Eltávolítva
- **BREAKING CHANGE**: Eltávolítva a `default_required` konfiguráció és az automatikus `required()` alkalmazása
- Eltávolítva a `isRequiredByDefault()` metódus a Facade-ból

### Változott
- A mezők már nem lesznek automatikusan kötelezőek (`required()`)
- A fejlesztőknek manuálisan kell hozzáadniuk a `required()` metódust ahol szükséges
- Ez rugalmasabbá teszi a csomagot admin és frontend használathoz
- `default_translatable` alapértelmezett értéke `false` lett a biztonság érdekében

### Javítva
- Nagyobb rugalmasság a form validációban
- Nincs konfliktus az admin és frontend mezők között

### Korábbi változások
- **Breaking change**: `translatable()` helyett `translateLabel()` használata
- `translateLabel()` automatikusan lefordítja a mezők címkéit Laravel lang fájlok alapján
- Nincs szükség külső translation csomagokra
- Frissített dokumentáció a `translateLabel()` funkcióról

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
