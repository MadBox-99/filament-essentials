<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Translate labels
    |--------------------------------------------------------------------------
    |
    | When true, every form field, infolist entry, table column and wizard step
    | calls `->translateLabel()`, so its label resolves through Laravel's `__()`
    | helper. Filament derives the label from the name (`first_name` becomes
    | `First name`), so a `lang/hu.json` entry `"First name": "Keresztnév"` is
    | all a field needs. Untranslated labels render exactly as stock Filament.
    |
    */

    'translate_labels' => true,

    /*
    |--------------------------------------------------------------------------
    | Component defaults
    |--------------------------------------------------------------------------
    |
    | Opinionated defaults for individual form components (max lengths,
    | searchable selects, Hungarian date formats, upload limits, ...). Off by
    | default, because they change validation and behaviour of existing forms.
    | Set to true to apply the values below; anything set on the component
    | itself still wins.
    |
    */

    'component_defaults' => false,

    'text_input_max_length' => 255,

    'textarea_max_length' => 1000,
    'textarea_rows' => 3,

    'rich_editor_toolbar' => [
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
    ],

    'select_searchable' => true,
    'select_preload' => false,

    'date_format' => 'Y-m-d',
    'date_display_format' => 'Y. m. d.',
    'time_format' => 'H:i',
    'time_display_format' => 'H:i',
    'datetime_format' => 'Y-m-d H:i:s',
    'datetime_display_format' => 'Y. m. d. H:i',

    'toggle_on_color' => 'success',
    'toggle_off_color' => 'gray',

    'checkbox_list_searchable' => true,
    'checkbox_list_bulk_toggleable' => true,

    'file_max_size' => 2048, // KB
    'file_types' => ['application/pdf', 'image/*'],
    'file_downloadable' => true,
    'file_previewable' => true,

];
