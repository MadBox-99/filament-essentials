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

// Korábban így kellett volna:
TextInput::make('name')
    ->translateLabel()
    ->maxLength(255),

// Most egyszerűen csak így:
TextInput::make('name'),
// ↑ Automatikusan 255 karakter limit ÉS translateLabel()!

// A mezők címkéi automatikusan lefordulnak a Laravel lang fájlok alapján
```

### Automatikusan alkalmazott beállítások

- **TextInput** - Automatikusan translateLabel(), max 255 karakter
- **Textarea** - Automatikusan translateLabel(), 3 sor, 50 oszlop
- **RichEditor** - Automatikusan translateLabel()
- **Select** - Automatikusan translateLabel(), searchable
- **DatePicker** - Magyar dátum formátum (Y. m. d.), translateLabel()
- **TimePicker** - 24 órás formátum (H:i), translateLabel()
- **DateTimePicker** - Magyar dátum-idő formátum, translateLabel()
- **Toggle** - Zöld/szürke színek, translateLabel()
- **Checkbox** - translateLabel()
- **CheckboxList** - Searchable, bulk toggleable, translateLabel()
- **Radio** - translateLabel()
- **FileUpload** - 2MB limit, PDF és képek, letölthető és előnézettel, translateLabel()

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
    'default_text_maxlength' => 255,      // TextInput max hossz
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
                // ↑ Automatikusan max 255 karakter (opcionálisan translateLabel)
                
                Forms\Components\Textarea::make('description'),
                // ↑ Automatikusan 3 sor, 50 oszlop (opcionálisan translateLabel)
                
                Forms\Components\RichEditor::make('content'),
                // ↑ Opcionálisan translateLabel
                
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name'),
                // ↑ Automatikusan searchable (opcionálisan translateLabel)
                
                Forms\Components\DatePicker::make('published_at'),
                // ↑ Automatikusan Y. m. d. formátum (opcionálisan translateLabel)
                
                Forms\Components\Toggle::make('is_active'),
                // ↑ Automatikusan zöld/szürke színek (opcionálisan translateLabel)
                
                Forms\Components\FileUpload::make('images')
                    ->multiple(),
                // ↑ Automatikusan 2MB limit, képek, letölthető (opcionálisan translateLabel)
                
                // Ha szükséged van kötelező mezőre, egyszerűen add hozzá:
                Forms\Components\TextInput::make('required_field')
                    ->required(),
            ]);
    }
}
```

**Semmi extra kód nem kell!** Minden automatikusan működik. 🎉

## Tesztelés

A csomag Pest-tel van tesztelve:

```bash
# Tesztek futtatása
composer test

# Vagy direkt módon
./vendor/bin/pest

# Code coverage (Xdebug vagy PCOV szükséges)
composer test-coverage

# HTML coverage report generálása
composer test-coverage-html
```

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
