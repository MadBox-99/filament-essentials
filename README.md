# Filament Essentials

Essential alapértelmezett konfigurációk a Filament PHP-hez. Ez a csomag **automatikusan** beállítja az alapértelmezett opciókat minden Filament form komponenshez, így nem kell külön meghívnod semmilyen makrót vagy függvényt.

## Telepítés

```bash
composer require madbox-99/filament-essentials
```

A csomag automatikusan regisztrálódik Laravel-ben a package discovery révén, és **azonnal** elkezd működni minden új Filament komponensnél.

### Opcionális translatable funkció

Ha szeretnéd használni a `translatable()` funkciót, telepítsd a következő csomagot is:

```bash
composer require spatie/laravel-translatable
```

Vagy használj bármilyen más translation csomagot, amely biztosítja a `translatable()` metódust a Filament komponensekhez.

## Konfiguráció

Publikáld a konfigurációs fájlt:

```bash
php artisan vendor:publish --tag="filament-essentials-config"
```

Ez létrehozza a `config/filament-essentials.php` fájlt, ahol testreszabhatod az alapértelmezett beállításokat.

## Használat

### Automatikus működés

**Nincs szükség semmilyen extra kódra!** A csomag telepítése után minden Filament form komponens automatikusan megkapja az alapértelmezett beállításokat:

```php
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;

```php
// Korábban így kellett volna:
TextInput::make('name')
    ->translateLabel()
    ->maxLength(255),

// Most egyszerűen csak így:
TextInput::make('name'),
// ↑ Automatikusan 255 karakter limit (ÉS translateLabel() ha be van kapcsolva)!

// A mezők címkéi automatikusan lefordulnak a Laravel lang fájlok alapján (ha engedélyezve)
```
```

### Automatikusan alkalmazott beállítások

- **TextInput** - Automatikusan `maxLength(255)`, opcionálisan `translateLabel()`
- **Textarea** - Automatikusan `maxLength(1000)`, `rows(3)`, opcionálisan `translateLabel()`
- **RichEditor** - Testreszabott toolbar, opcionálisan `translateLabel()`
- **Select** - Automatikusan `searchable(true)`, `preload(false)`, opcionálisan `translateLabel()`
- **DatePicker** - Magyar dátum formátum (Y-m-d → Y. m. d.), opcionálisan `translateLabel()`
- **TimePicker** - 24 órás formátum (H:i), opcionálisan `translateLabel()`
- **DateTimePicker** - Magyar dátum-idő formátum, opcionálisan `translateLabel()`
- **Toggle** - `onColor('success')`, `offColor('gray')`, opcionálisan `translateLabel()`
- **Checkbox** - Opcionálisan `translateLabel()`
- **CheckboxList** - `searchable(true)`, `bulkToggleable(true)`, opcionálisan `translateLabel()`
- **Radio** - Opcionálisan `translateLabel()`
- **FileUpload** - `maxSize(2048)` KB, PDF és képek, `downloadable(true)`, `previewable(true)`, opcionálisan `translateLabel()`

### TranslateLabel funkció

A `translateLabel()` alapértelmezésben **ki van kapcsolva**, de biztonságos bekapcsolni. 
Ez automatikusan lefordítja a mezők címkéit a Laravel lokalizációs fájlok alapján.

```php
// Például ha van resources/lang/hu/validation.php fájlodban:
'attributes' => [
    'name' => 'Név',
    'email' => 'E-mail cím',
]

// Akkor a TextInput::make('name') automatikusan "Név" címkét fog mutatni
```

Ha szeretnéd ezt a funkciót:

```php
// config/filament-essentials.php
'default_translatable' => true,
```

### Facade használata

```php
use FilamentEssentials\Facades\FilamentEssentials;

// Konfigurációs értékek lekérése
$isTranslatable = FilamentEssentials::isTranslatableByDefault(); // false
$config = FilamentEssentials::getDefaultConfig(); // összes konfiguráció
```

### Egyedi beállítások felülírása

Ha egy adott komponenshez más beállítást szeretnél, egyszerűen add hozzá:

```php
TextInput::make('special_field')
    ->maxLength(500)  // Felülírja az alapértelmezett 255-öt
    ->required(),     // Hozzáadod a required()-et ha szükséges
```

## Konfiguráció

Az alapértelmezett beállításokat a `config/filament-essentials.php` fájlban módosíthatod:

```php
return [
    'default_translatable' => false,       // Minden mező legyen translateLabel()
    'default_max_length' => 255,          // TextInput max hossz
    'default_textarea_max_length' => 1000, // Textarea max hossz
    'default_textarea_rows' => 3,         // Textarea sorok száma
    'default_textarea_cols' => 50,        // Textarea oszlopok száma
    
    // Select beállítások
    'default_select_searchable' => true,
    'default_select_preload' => false,
    
    // Dátum formátumok
    'default_date_format' => 'Y-m-d',
    'default_date_display_format' => 'Y. m. d.',
    'default_time_format' => 'H:i',
    'default_time_display_format' => 'H:i',
    'default_datetime_format' => 'Y-m-d H:i:s',
    'default_datetime_display_format' => 'Y. m. d. H:i',
    
    // Toggle színek
    'default_toggle_on_color' => 'success',
    'default_toggle_off_color' => 'gray',
    
    // CheckboxList beállítások
    'default_checkbox_list_searchable' => true,
    'default_checkbox_list_bulk_toggleable' => true,
    
    // Fájl feltöltés
    'default_file_max_size' => 2048, // KB
    'default_file_types' => ['application/pdf', 'image/*'],
    'default_file_downloadable' => true,
    'default_file_previewable' => true,
    
    // RichEditor toolbar beállítások
    'rich_editor_toolbar' => [
        'attachFiles', 'blockquote', 'bold', 'bulletList', 'codeBlock',
        'h2', 'h3', 'italic', 'link', 'orderedList', 'redo',
        'strike', 'underline', 'undo',
    ],
];
```

## Példa használat

```php
<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;

class ProductResource extends Resource
{
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Minden komponens automatikusan megkapja az alapértelmezett beállításokat!
                Forms\Components\TextInput::make('name'),
                // ↑ Automatikusan maxLength(255) (opcionálisan translateLabel)
                
                Forms\Components\Textarea::make('description'),
                // ↑ Automatikusan maxLength(1000), rows(3) (opcionálisan translateLabel)
                
                Forms\Components\RichEditor::make('content'),
                // ↑ Testreszabott toolbar (opcionálisan translateLabel)
                
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name'),
                // ↑ Automatikusan searchable(true), preload(false) (opcionálisan translateLabel)
                
                Forms\Components\DatePicker::make('published_at'),
                // ↑ Automatikusan Y-m-d formátum (opcionálisan translateLabel)
                
                Forms\Components\Toggle::make('is_active'),
                // ↑ Automatikusan onColor('success'), offColor('gray') (opcionálisan translateLabel)
                
                Forms\Components\FileUpload::make('images')
                    ->multiple(),
                // ↑ Automatikusan maxSize(2048), PDF+képek, downloadable, previewable (opcionálisan translateLabel)
                
                // Ha szükséged van kötelező mezőre, egyszerűen add hozzá:
                Forms\Components\TextInput::make('required_field')
                    ->required(),
            ]);
    }
}
```

**Semmi extra kód nem kell!** Minden automatikusan működik. 🎉

## Tesztelés

A csomag Pest-tel van tesztelve és **teljes körűen lefedi az automatikus konfigurációt**:

```bash
# Tesztek futtatása
composer test

# Vagy direkt módon
./vendor/bin/pest

# Specifikus teszt futtatása
./vendor/bin/pest tests/ComponentConfigurationTest.php

# Code coverage (Xdebug vagy PCOV szükséges)
composer test-coverage
```

### Tesztelt funkciók

A tesztek ellenőrzik, hogy minden Filament komponens automatikusan megkapja-e a megfelelő konfigurációt:

- ✅ **Select** komponens - `searchable=true`, `preload=false`
- ✅ **TextInput** komponens - `maxLength=255`
- ✅ **Textarea** komponens - `maxLength=1000`, `rows=3`
- ✅ **DatePicker** komponens - formátum és megjelenítési formátum beállítása
- ✅ **Toggle** komponens - `onColor=success`, `offColor=gray`
- ✅ **FileUpload** komponens - méret limit, fájl típusok, letöltés/előnézet
- ✅ **CheckboxList** komponens - `searchable=true`, `bulkToggleable=true`
- ✅ **Facade** működése - konfiguráció elérhetősége
- ✅ **Konzisztencia** - minden példány ugyanazt a konfigurációt kapja

A tesztek **valóban ellenőrzik az automatikus konfigurációt** - nem csak azt, hogy a komponensek létrejönnek, hanem azt is, hogy megfelelő beállításokat kapnak.

**Megjegyzés:** A code coverage-hez szükséged van Xdebug vagy PCOV PHP extension-re.

## Követelmények

- PHP 8.1 vagy újabb
- Laravel 10.x vagy 11.x
- Filament 3.x

## Licenc

MIT License. Lásd a [LICENSE](LICENSE) fájlt a részletekért.

## Közreműködés

A közreműködés szívesen fogadott! Kérjük, nyiss egy issue-t vagy külj egy pull request-et.

## Szerző

Szabo Zoltan - [your@email.com](mailto:your@email.com)
