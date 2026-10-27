# Filament Essentials

Sensible defaults for Filament. Once installed, every form field, infolist entry,
table column and wizard step translates its label through Laravel's `__()`
helper, so you never have to call `->translateLabel()` again. Opinionated
component defaults (max lengths, searchable selects, Hungarian date formats,
upload limits) are available as an opt-in.

## Installation

```bash
composer require madbox-99/filament-essentials
```

The service provider is auto-discovered. There is nothing else to set up.

## Translated labels

Filament derives a label from the component name (`first_name` becomes
`First name`). With this package that label is passed through `__()`, so a
single entry in `lang/hu.json` translates it everywhere it appears:

```json
{
    "First name": "Keresztnév"
}
```

```php
TextInput::make('first_name');   // Keresztnév
TextEntry::make('first_name');   // Keresztnév
TextColumn::make('first_name');  // Keresztnév
```

The configuration is applied to Filament's base classes (`Field`, `Entry`,
`Column`, `Step`), so it reaches every built-in and custom subclass. Labels
without a translation render exactly as stock Filament.

To opt a single component out:

```php
TextInput::make('first_name')->translateLabel(false);
```

## Component defaults (opt-in)

Publish the config and enable them:

```bash
php artisan vendor:publish --tag=filament-essentials-config
```

```php
// config/filament-essentials.php
'component_defaults' => true,
```

| Component | Default |
|---|---|
| `TextInput` | `maxLength(255)` |
| `Textarea` | `maxLength(1000)`, `rows(3)` |
| `RichEditor` | a fixed toolbar |
| `Select` | `searchable()`, no preload |
| `DatePicker`, `TimePicker`, `DateTimePicker` | Hungarian display formats |
| `Toggle` | `onColor('success')`, `offColor('gray')` |
| `CheckboxList` | `searchable()`, `bulkToggleable()` |
| `FileUpload` | 2 MB, PDF and images, downloadable, previewable |

Every value is configurable, and anything set on the component itself still
wins:

```php
TextInput::make('notes')->maxLength(500);
```

## Configuration

```php
return [
    'translate_labels' => true,
    'component_defaults' => false,
    // ...the individual component defaults
];
```

## Requirements

- PHP 8.3+
- Filament 5

## Upgrading from 1.x

- The namespace is now `MadBox99\FilamentEssentials`; the facade was removed.
- `default_translatable` is now `translate_labels` and is on by default. It
  also covers infolist entries and every table column.
- Component defaults are off unless `component_defaults` is `true`, and their
  keys lost the `default_` prefix (`default_max_length` is now
  `text_input_max_length`).

## Testing

```bash
composer test
```

## License

MIT. See [LICENSE](LICENSE).
