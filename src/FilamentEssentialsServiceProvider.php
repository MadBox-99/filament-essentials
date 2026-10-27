<?php

declare(strict_types=1);

namespace MadBox99\FilamentEssentials;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\Entry;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Tables\Columns\Column;
use Illuminate\Support\ServiceProvider;

class FilamentEssentialsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/filament-essentials.php', 'filament-essentials');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/filament-essentials.php' => config_path('filament-essentials.php'),
            ], 'filament-essentials-config');
        }

        $this->configureLabelTranslation();
        $this->configureComponentDefaults();
    }

    /**
     * Configuring the base classes cascades to every subclass, so this covers
     * all built-in and custom fields, entries and columns. The config is read
     * when each component is created, so it can be toggled at runtime.
     */
    protected function configureLabelTranslation(): void
    {
        foreach ([Field::class, Entry::class, Column::class, Step::class] as $component) {
            $component::configureUsing(function (Field|Entry|Column|Step $component): void {
                if (config('filament-essentials.translate_labels')) {
                    $component->translateLabel();
                }
            });
        }
    }

    protected function configureComponentDefaults(): void
    {
        $this->whenEnabled(TextInput::class, fn (TextInput $component): TextInput => $component
            ->maxLength(config('filament-essentials.text_input_max_length')));

        $this->whenEnabled(Textarea::class, fn (Textarea $component): Textarea => $component
            ->maxLength(config('filament-essentials.textarea_max_length'))
            ->rows(config('filament-essentials.textarea_rows')));

        $this->whenEnabled(RichEditor::class, fn (RichEditor $component): RichEditor => $component
            ->toolbarButtons(config('filament-essentials.rich_editor_toolbar')));

        $this->whenEnabled(Select::class, fn (Select $component): Select => $component
            ->searchable(config('filament-essentials.select_searchable'))
            ->preload(config('filament-essentials.select_preload')));

        $this->whenEnabled(DatePicker::class, fn (DatePicker $component): DatePicker => $component
            ->format(config('filament-essentials.date_format'))
            ->displayFormat(config('filament-essentials.date_display_format')));

        $this->whenEnabled(TimePicker::class, fn (TimePicker $component): TimePicker => $component
            ->format(config('filament-essentials.time_format'))
            ->displayFormat(config('filament-essentials.time_display_format')));

        $this->whenEnabled(DateTimePicker::class, fn (DateTimePicker $component): DateTimePicker => $component
            ->format(config('filament-essentials.datetime_format'))
            ->displayFormat(config('filament-essentials.datetime_display_format')));

        $this->whenEnabled(Toggle::class, fn (Toggle $component): Toggle => $component
            ->onColor(config('filament-essentials.toggle_on_color'))
            ->offColor(config('filament-essentials.toggle_off_color')));

        $this->whenEnabled(CheckboxList::class, fn (CheckboxList $component): CheckboxList => $component
            ->searchable(config('filament-essentials.checkbox_list_searchable'))
            ->bulkToggleable(config('filament-essentials.checkbox_list_bulk_toggleable')));

        $this->whenEnabled(FileUpload::class, fn (FileUpload $component): FileUpload => $component
            ->maxSize(config('filament-essentials.file_max_size'))
            ->acceptedFileTypes(config('filament-essentials.file_types'))
            ->downloadable(config('filament-essentials.file_downloadable'))
            ->previewable(config('filament-essentials.file_previewable')));
    }

    /**
     * @param  class-string<Field>  $component
     * @param  callable(Field): Field  $configure
     */
    protected function whenEnabled(string $component, callable $configure): void
    {
        $component::configureUsing(function (Field $field) use ($configure): void {
            if (config('filament-essentials.component_defaults')) {
                $configure($field);
            }
        });
    }
}
