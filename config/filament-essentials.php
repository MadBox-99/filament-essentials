<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Translatable Setting
    |--------------------------------------------------------------------------
    |
    | This value determines whether form components should have translatable
    | labels by default using translateLabel(). This automatically translates
    | field labels based on your Laravel localization files.
    | 
    | Safe to enable - doesn't require additional packages!
    |
    */
    'default_translatable' => true,

    /*
    |--------------------------------------------------------------------------
    | Default Required Setting
    |--------------------------------------------------------------------------
    |
    | This value determines whether form components should be required
    | by default when using the essentials() macro.
    |
    */
    'default_required' => false,

    /*
    |--------------------------------------------------------------------------
    | Text Input Defaults
    |--------------------------------------------------------------------------
    */
    'default_max_length' => 255,

    /*
    |--------------------------------------------------------------------------
    | Textarea Defaults
    |--------------------------------------------------------------------------
    */
    'default_textarea_max_length' => 1000,
    'default_textarea_rows' => 3,

    /*
    |--------------------------------------------------------------------------
    | Rich Editor Defaults
    |--------------------------------------------------------------------------
    */
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

    /*
    |--------------------------------------------------------------------------
    | Select Defaults
    |--------------------------------------------------------------------------
    */
    'default_select_searchable' => true,
    'default_select_preload' => false,

    /*
    |--------------------------------------------------------------------------
    | Date & Time Defaults
    |--------------------------------------------------------------------------
    */
    'default_date_format' => 'Y-m-d',
    'default_date_display_format' => 'Y. m. d.',
    'default_time_format' => 'H:i',
    'default_time_display_format' => 'H:i',
    'default_datetime_format' => 'Y-m-d H:i:s',
    'default_datetime_display_format' => 'Y. m. d. H:i',

    /*
    |--------------------------------------------------------------------------
    | Toggle Defaults
    |--------------------------------------------------------------------------
    */
    'default_toggle_on_color' => 'success',
    'default_toggle_off_color' => 'gray',

    /*
    |--------------------------------------------------------------------------
    | Checkbox List Defaults
    |--------------------------------------------------------------------------
    */
    'default_checkbox_list_searchable' => true,
    'default_checkbox_list_bulk_toggleable' => true,

    /*
    |--------------------------------------------------------------------------
    | File Upload Defaults
    |--------------------------------------------------------------------------
    */
    'default_file_max_size' => 2048, // KB
    'default_file_types' => ['application/pdf', 'image/*'],
    'default_file_downloadable' => true,
    'default_file_previewable' => true,
];
