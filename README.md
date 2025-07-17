# Filament Essentials

Essential default configurations for Filament PHP. This package **automatically** sets up default options for every Filament form component, so you don't need to call any macros or functions separately.

## Installation

```bash
composer require madbox-99/filament-essentials
```

The package is automatically registered in Laravel through package discovery and **immediately** starts working with every new Filament component.

### Optional translatable functionality

If you want to use the `translatable()` function, install the following package as well:

```bash
composer require spatie/laravel-translatable
```

Or use any other translation package that provides the `translatable()` method for Filament components.

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --tag="filament-essentials-config"
```

This creates the `config/filament-essentials.php` file where you can customize the default settings.

## Usage

### Automatic operation

**No extra code needed!** After installing the package, every Filament form component automatically gets the default settings:

```php
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;

// Previously you would have needed:
TextInput::make('name')
    ->translateLabel()
    ->maxLength(255),

// Now simply:
TextInput::make('name'),
// ↑ Automatically 255 character limit (AND translateLabel() if enabled)!

// Field labels are automatically translated based on Laravel lang files (if enabled)
```
```

### Automatically applied settings

- **TextInput** - Automatically `maxLength(255)`, optionally `translateLabel()`
- **Textarea** - Automatically `maxLength(1000)`, `rows(3)`, optionally `translateLabel()`
- **RichEditor** - Custom toolbar, optionally `translateLabel()`
- **Select** - Automatically `searchable(true)`, `preload(false)`, optionally `translateLabel()`
- **DatePicker** - Hungarian date format (Y-m-d → Y. m. d.), optionally `translateLabel()`
- **TimePicker** - 24-hour format (H:i), optionally `translateLabel()`
- **DateTimePicker** - Hungarian date-time format, optionally `translateLabel()`
- **Toggle** - `onColor('success')`, `offColor('gray')`, optionally `translateLabel()`
- **Checkbox** - Optionally `translateLabel()`
- **CheckboxList** - `searchable(true)`, `bulkToggleable(true)`, optionally `translateLabel()`
- **Radio** - Optionally `translateLabel()`
- **FileUpload** - `maxSize(2048)` KB, PDF and images, `downloadable(true)`, `previewable(true)`, optionally `translateLabel()`

### TranslateLabel function

The `translateLabel()` is **disabled by default**, but it's safe to enable. 
This automatically translates field labels based on Laravel localization files.

```php
// For example, if you have in resources/lang/en/validation.php:
'attributes' => [
    'name' => 'Name',
    'email' => 'Email Address',
]

// Then TextInput::make('name') will automatically show "Name" as the label
```

If you want to use this feature:

```php
// config/filament-essentials.php
'default_translatable' => true,
```

### Facade usage

```php
use FilamentEssentials\Facades\FilamentEssentials;

// Get configuration values
$isTranslatable = FilamentEssentials::isTranslatableByDefault(); // false
$config = FilamentEssentials::getDefaultConfig(); // all configuration
```

### Overriding individual settings

If you want different settings for a specific component, simply add them:

```php
TextInput::make('special_field')
    ->maxLength(500)  // Overrides the default 255
    ->required(),     // Add required() if needed
```

## Configuration

You can modify the default settings in the `config/filament-essentials.php` file:

```php
return [
    'default_translatable' => false,       // Make every field translateLabel()
    'default_max_length' => 255,          // TextInput max length
    'default_textarea_max_length' => 1000, // Textarea max length
    'default_textarea_rows' => 3,         // Textarea row count
    'default_textarea_cols' => 50,        // Textarea column count
    
    // Select settings
    'default_select_searchable' => true,
    'default_select_preload' => false,
    
    // Date formats
    'default_date_format' => 'Y-m-d',
    'default_date_display_format' => 'Y. m. d.',
    'default_time_format' => 'H:i',
    'default_time_display_format' => 'H:i',
    'default_datetime_format' => 'Y-m-d H:i:s',
    'default_datetime_display_format' => 'Y. m. d. H:i',
    
    // Toggle colors
    'default_toggle_on_color' => 'success',
    'default_toggle_off_color' => 'gray',
    
    // CheckboxList settings
    'default_checkbox_list_searchable' => true,
    'default_checkbox_list_bulk_toggleable' => true,
    
    // File upload
    'default_file_max_size' => 2048, // KB
    'default_file_types' => ['application/pdf', 'image/*'],
    'default_file_downloadable' => true,
    'default_file_previewable' => true,
    
    // RichEditor toolbar settings
    'rich_editor_toolbar' => [
        'attachFiles', 'blockquote', 'bold', 'bulletList', 'codeBlock',
        'h2', 'h3', 'italic', 'link', 'orderedList', 'redo',
        'strike', 'underline', 'undo',
    ],
];
```

## Example usage

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
                // Every component automatically gets the default settings!
                Forms\Components\TextInput::make('name'),
                // ↑ Automatically maxLength(255) (optionally translateLabel)
                
                Forms\Components\Textarea::make('description'),
                // ↑ Automatically maxLength(1000), rows(3) (optionally translateLabel)
                
                Forms\Components\RichEditor::make('content'),
                // ↑ Custom toolbar (optionally translateLabel)
                
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name'),
                // ↑ Automatically searchable(true), preload(false) (optionally translateLabel)
                
                Forms\Components\DatePicker::make('published_at'),
                // ↑ Automatically Y-m-d format (optionally translateLabel)
                
                Forms\Components\Toggle::make('is_active'),
                // ↑ Automatically onColor('success'), offColor('gray') (optionally translateLabel)
                
                Forms\Components\FileUpload::make('images')
                    ->multiple(),
                // ↑ Automatically maxSize(2048), PDF+images, downloadable, previewable (optionally translateLabel)
                
                // If you need a required field, simply add it:
                Forms\Components\TextInput::make('required_field')
                    ->required(),
            ]);
    }
}
```

**No extra code needed!** Everything works automatically. 🎉

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
