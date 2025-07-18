<?php

namespace FilamentEssentials;

use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\ServiceProvider;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DateTimePicker;

class FilamentEssentialsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FilamentEssentials::class, function () {
            return new FilamentEssentials();
        });
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/filament-essentials.php' => config_path('filament-essentials.php'),
        ], 'filament-essentials-config');

        $this->configureFilamentComponents();
    }

    protected function configureFilamentComponents(): void
    {

        TextInput::configureUsing(function (TextInput $component) {
            $component->maxLength(config('filament-essentials.default_max_length', 255));

            // Csak akkor alkalmazzuk a translateLabel-t, ha engedélyezve van
            if (config('filament-essentials.default_translatable', false)) {
                $component->translateLabel();
            }

            return $component;
        });

        Textarea::configureUsing(function (Textarea $component) {
            $component
                ->maxLength(config('filament-essentials.default_textarea_max_length', 1000))
                ->rows(config('filament-essentials.default_textarea_rows', 3));

            if (config('filament-essentials.default_translatable', false)) {
                $component->translateLabel();
            }

            return $component;
        });

        RichEditor::configureUsing(function (RichEditor $component) {
            $component->toolbarButtons(config('filament-essentials.rich_editor_toolbar', [
                'attachFiles',
                'blockquote',
                'bold',
                'bulletList',
                'codeBlock',
                'h2',
                'h3',
                'italic',
                'link',
                'orderedList',
                'redo',
                'strike',
                'underline',
                'undo',
            ]));

            if (config('filament-essentials.default_translatable', false)) {
                $component->translateLabel();
            }

            return $component;
        });

        // Select automatikus konfigurálása
        Select::configureUsing(function (Select $component) {
            $component
                ->searchable(config('filament-essentials.default_select_searchable', true))
                ->preload(config('filament-essentials.default_select_preload', false));

            if (config('filament-essentials.default_translatable', false)) {
                $component->translateLabel();
            }

            return $component;
        });

        // DatePicker automatikus konfigurálása
        DatePicker::configureUsing(function (DatePicker $component) {
            $component
                ->format(config('filament-essentials.default_date_format', 'Y-m-d'))
                ->displayFormat(config('filament-essentials.default_date_display_format', 'Y. m. d.'));

            if (config('filament-essentials.default_translatable', false)) {
                $component->translateLabel();
            }

            return $component;
        });

        // TimePicker automatikus konfigurálása
        TimePicker::configureUsing(function (TimePicker $component) {
            $component
                ->format(config('filament-essentials.default_time_format', 'H:i'))
                ->displayFormat(config('filament-essentials.default_time_display_format', 'H:i'));

            if (config('filament-essentials.default_translatable', false)) {
                $component->translateLabel();
            }

            return $component;
        });

        // DateTimePicker automatikus konfigurálása
        DateTimePicker::configureUsing(function (DateTimePicker $component) {
            $component
                ->format(config('filament-essentials.default_datetime_format', 'Y-m-d H:i:s'))
                ->displayFormat(config('filament-essentials.default_datetime_display_format', 'Y. m. d. H:i'));

            if (config('filament-essentials.default_translatable', false)) {
                $component->translateLabel();
            }

            return $component;
        });

        // Toggle automatikus konfigurálása
        Toggle::configureUsing(function (Toggle $component) {
            $component
                ->onColor(config('filament-essentials.default_toggle_on_color', 'success'))
                ->offColor(config('filament-essentials.default_toggle_off_color', 'gray'));

            if (config('filament-essentials.default_translatable', false)) {
                $component->translateLabel();
            }

            return $component;
        });

        // Checkbox automatikus konfigurálása
        Checkbox::configureUsing(function (Checkbox $component) {
            if (config('filament-essentials.default_translatable', false)) {
                $component->translateLabel();
            }

            return $component;
        });

        // CheckboxList automatikus konfigurálása
        CheckboxList::configureUsing(function (CheckboxList $component) {
            $component
                ->searchable(config('filament-essentials.default_checkbox_list_searchable', true))
                ->bulkToggleable(config('filament-essentials.default_checkbox_list_bulk_toggleable', true));

            if (config('filament-essentials.default_translatable', false)) {
                $component->translateLabel();
            }

            return $component;
        });

        // Radio automatikus konfigurálása
        Radio::configureUsing(function (Radio $component) {
            if (config('filament-essentials.default_translatable', false)) {
                $component->translateLabel();
            }

            return $component;
        });

        // FileUpload automatikus konfigurálása
        FileUpload::configureUsing(function (FileUpload $component) {
            $component
                ->maxSize(config('filament-essentials.default_file_max_size', 2048))
                ->acceptedFileTypes(config('filament-essentials.default_file_types', ['application/pdf', 'image/*']))
                ->downloadable(config('filament-essentials.default_file_downloadable', true))
                ->previewable(config('filament-essentials.default_file_previewable', true));

            if (config('filament-essentials.default_translatable', false)) {
                $component->translateLabel();
            }

            return $component;
        });

        Repeater::configureUsing(function (Repeater $component): void {
            $component->translateLabel();
        });

        // Step komponens konfiguráció - kompatibilis Filament v3 és v4 verziókkal
        $v3StepClass = 'Filament\Forms\Components\Wizard\Step';
        $v4StepClass = 'Filament\Schemas\Components\Wizard\Step';

        if (class_exists($v3StepClass)) {
            // Filament v3 kompatibilitás
            $v3StepClass::configureUsing(function ($component): void {
                $component->translateLabel();
            });
        } elseif (class_exists($v4StepClass)) {
            // Filament v4 kompatibilitás
            $v4StepClass::configureUsing(function ($component): void {
                $component->translateLabel();
            });
        }
    }
}
