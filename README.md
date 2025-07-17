# Filament Essentials

Essential alapértelmezett konfigurációk a Filament PHP-hez. Ez a csomag **automatikusan** beállítja az alapértelmezett opciókat minden Filament form komponenshez, így nem kell külön meghívnod semmilyen makrót vagy függvényt.

## Telepítés

```bash
composer require szabozoltan/filament-essentials
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
    ->translatable()
    ->maxLength(255),

// Most egyszerűen csak így:
TextInput::make('name'),
// ↑ Automatikusan 255 karakter limit ÉS translateLabel()!

// A mezők címkéi automatikusan lefordulnak a Laravel lang fájlok alapján
```

### Automatikusan alkalmazott beállítások

- **TextInput** - Automatikusan translateLabel(), max 255 karakter
- **Textarea** - Automatikusan translateLabel(), max 1000 karakter, 3 sor
- **RichEditor** - Automatikusan translateLabel(), előre konfigurált toolbar
- **Select** - Automatikusan translateLabel(), searchable
- **DatePicker** - Magyar dátum formátum (Y. m. d.)
- **TimePicker** - 24 órás formátum (H:i)
- **DateTimePicker** - Magyar dátum-idő formátum
- **Toggle** - Zöld/szürke színek
- **CheckboxList** - Searchable, bulk toggleable, translateLabel()
- **Radio** - translateLabel()
- **FileUpload** - 2MB limit, PDF és képek, letölthető és előnézettel

### TranslateLabel funkció

A `translateLabel()` alapértelmezésben **be van kapcsolva** és biztonságos. 
Ez automatikusan lefordítja a mezők címkéit a Laravel lokalizációs fájlok alapján.

```php
// Például ha van resources/lang/hu/validation.php fájlodban:
'attributes' => [
    'name' => 'Név',
    'email' => 'E-mail cím',
]

// Akkor a TextInput::make('name') automatikusan "Név" címkét fog mutatni
```

Ha nem szeretnéd ezt a funkciót:

```php
// config/filament-essentials.php
'default_translatable' => false,
```

### Facade használata

```php
use SzaboZoltan\FilamentEssentials\Facades\FilamentEssentials;

// Konfigurációs értékek lekérése
$isTranslatable = FilamentEssentials::isTranslatableByDefault(); // true
$isRequired = FilamentEssentials::isRequiredByDefault(); // false
$config = FilamentEssentials::getDefaultConfig(); // összes konfiguráció
```

### Egyedi beállítások felülírása

Ha egy adott komponenshez más beállítást szeretnél, egyszerűen add hozzá:

```php
TextInput::make('special_field')
    ->maxLength(500)  // Felülírja az alapértelmezett 255-öt
    ->required(false), // Felülírja az alapértelmezett beállítást
```

## Konfiguráció

Az alapértelmezett beállításokat a `config/filament-essentials.php` fájlban módosíthatod:

```php
return [
    'default_translatable' => true,        // Minden mező legyen translatable
    'default_required' => false,           // Mezők ne legyenek kötelezőek alapból
    'default_max_length' => 255,          // TextInput max hossz
    'default_textarea_max_length' => 1000, // Textarea max hossz
    'default_textarea_rows' => 3,          // Textarea sorok száma
    
    // Select beállítások
    'default_select_searchable' => true,
    'default_select_preload' => false,
    
    // Dátum formátumok
    'default_date_format' => 'Y-m-d',
    'default_date_display_format' => 'Y. m. d.',
    
    // Toggle színek
    'default_toggle_on_color' => 'success',
    'default_toggle_off_color' => 'gray',
    
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
                // ↑ Automatikusan translatable, max 255 karakter
                
                Forms\Components\Textarea::make('description'),
                // ↑ Automatikusan translatable, max 1000 karakter, 3 sor
                
                Forms\Components\RichEditor::make('content'),
                // ↑ Automatikusan translatable, teljes toolbar
                
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name'),
                // ↑ Automatikusan translatable, searchable
                
                Forms\Components\DatePicker::make('published_at'),
                // ↑ Automatikusan Y. m. d. formátum
                
                Forms\Components\Toggle::make('is_active'),
                // ↑ Automatikusan zöld/szürke színek
                
                Forms\Components\FileUpload::make('images')
                    ->multiple(),
                // ↑ Automatikusan 2MB limit, képek, letölthető
            ]);
    }
}
```

**Semmi extra kód nem kell!** Minden automatikusan működik. 🎉

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
